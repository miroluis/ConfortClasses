
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">
        <a href="index.php?a=salas&id_empresa={{ empresa.id_empresa }}">Salas</a>
    </li>
    <li class="breadcrumb-item">
        <a href="index.php?a=dispositivos&id_sala={{ dispositivo.id_sala }}">Dispositivos</a>
    </li>

    {% if modo == 'sensor' %}
        <li class="breadcrumb-item">
            <a href="index.php?a=sensores&id_dispositivo={{ sensor.id_dispositivo }}">Sensores</a>
        </li>
        <li class="breadcrumb-item active">Leituras</li>
    {% else %}
        <li class="breadcrumb-item active">Leituras</li>
    {% endif %}
</ol>


{% if modo == 'sensor' %}
  <h2>Leituras — Sensor: {{ sensor.nome }}</h2>
  <p>Tipo: {{ sensor.tipo_sensor }} | Token: {{ sensor.token }}</p>
  <p>
    <a href="index.php?a=sensores&id_dispositivo={{ sensor.id_dispositivo }}">Voltar aos sensores</a>
  </p>
{% else %}
  <h2>Leituras — Dispositivo</h2>
  <p>
    <a href="index.php?a=dispositivos&id_sala={{ dispositivo.id_sala }}">Voltar aos dispositivos</a>
  </p>
{% endif %}

<table border="1" cellpadding="6" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>Data / Hora</th>
      <th>Sensor</th>
      <th>Valor</th>
    </tr>
  </thead>
  <tbody>
    {% for l in leituras %}
      <tr>
        <td>{{ l.data_hora }}</td>
        <td>{{ l.sensor_nome ?? (sensor.nome ?? '-') }}</td>
        <td>
        {{ l.valor }}
        {% if l.unidade_simbolo %} {{ l.unidade_simbolo }}{% endif %}
        </td>

      </tr>
    {% else %}
      <tr><td colspan="3">Sem leituras.</td></tr>
    {% endfor %}
  </tbody>
</table>
