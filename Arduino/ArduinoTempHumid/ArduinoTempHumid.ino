#include <WiFi.h>
#include <HTTPClient.h>
#include "DHT.h"

// ===== SENSOR =====
#define DHTPIN 2
#define DHTTYPE DHT22
DHT dht(DHTPIN, DHTTYPE);

// ===== WIFI =====
const char* ssid = "duckietown";
const char* password = "quackquack";

// ===== API =====
const char* serverUrl = "http://10.28.50.136/ConfortClasses/public/index.php?a=api_leitura";
const char* tokenTemp = "T123";
const char* tokenHum  = "H123";


bool leituraValida(float h, float t) {
  if (isnan(h) || isnan(t)) return false;
  if (h < 0 || h > 100) return false;
  if (t < -40 || t > 80) return false;
  return true;
}

void setup() {
  Serial.begin(115200);
  delay(2000);
  Serial.println("BOOT OK");

  dht.begin();
  delay(2000);

  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  Serial.print("A ligar ao Wi-Fi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nWi-Fi ligado!");
  Serial.print("IP do ESP32: ");
  Serial.println(WiFi.localIP());
}
void loop() {
  float h = dht.readHumidity();
  float t = dht.readTemperature();

  if (!leituraValida(h, t)) {
    Serial.println("Leitura inválida (ignorar)...");
    delay(2000);
    return;
  }

  Serial.print("Humidade: ");
  Serial.print(h, 1);
  Serial.print("%  Temperatura: ");
  Serial.print(t, 1);
  Serial.println("C");

  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;

    // ---- Enviar Temperatura ----
    http.begin(serverUrl);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    String bodyTemp = "token=" + String(tokenTemp) + "&valor=" + String(t, 1);
    int codeTemp = http.POST(bodyTemp);
    String respTemp = http.getString();
    http.end();

    Serial.print("TEMP HTTP: ");
    Serial.println(codeTemp);
    Serial.println(respTemp);

    delay(500); // pequena pausa entre POSTs

    // ---- Enviar Humidade ----
    http.begin(serverUrl);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    String bodyHum = "token=" + String(tokenHum) + "&valor=" + String(h, 1);
    int codeHum = http.POST(bodyHum);
    String respHum = http.getString();
    http.end();

    Serial.print("HUM HTTP: ");
    Serial.println(codeHum);
    Serial.println(respHum);

  } else {
    Serial.println("Wi-Fi desligado.");
  }

  delay(30000); // 30 segundos
}
