<?php
namespace app\model;

class Leitura
{
    public static function create(int $id_sensor, float $valor, string $data_hora): int
    {
        $pdo = db_access();
        $sql = "INSERT INTO leitura (id_sensor, valor, data_hora)
                VALUES (:id_sensor, :valor, :data_hora)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id_sensor' => $id_sensor,
            ':valor' => $valor,
            ':data_hora' => $data_hora
        ]);
        return (int)$pdo->lastInsertId();
    }

    public static function lastBySensor(int $id_sensor, int $limit = 50): array
    {
        $pdo = db_access();
        $sql = "SELECT * FROM leitura
                WHERE id_sensor = :id_sensor
                ORDER BY data_hora DESC, id_leitura DESC
                LIMIT $limit";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_sensor' => $id_sensor]);
        return $stmt->fetchAll();
    }

    public static function lastByDispositivo(int $id_dispositivo, int $limit = 200): array
    {
        $pdo = db_access();
        $sql = "SELECT l.*, s.nome AS sensor_nome, s.tipo_sensor, s.id_unidade
                FROM leitura l
                JOIN sensor s ON s.id_sensor = l.id_sensor
                WHERE s.id_dispositivo = :id_dispositivo
                ORDER BY l.data_hora DESC, l.id_leitura DESC
                LIMIT $limit";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_dispositivo' => $id_dispositivo]);
        return $stmt->fetchAll();
    }
}
