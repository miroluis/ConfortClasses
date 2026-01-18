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

        $sql = "
            SELECT 
                l.*,
                s.nome AS sensor_nome,
                u.simbolo AS unidade_simbolo
            FROM leitura l
            JOIN sensor s ON s.id_sensor = l.id_sensor
            JOIN unidade_medida u ON u.id_unidade = s.id_unidade
            WHERE l.id_sensor = :id_sensor
            ORDER BY l.data_hora DESC, l.id_leitura DESC
            LIMIT $limit
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_sensor' => $id_sensor]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public static function lastByDispositivo(int $id_dispositivo, int $limit = 200): array
    {
        $pdo = db_access();

        $sql = "
            SELECT 
                l.*,
                s.nome AS sensor_nome,
                s.tipo_sensor,
                u.simbolo AS unidade_simbolo
            FROM leitura l
            JOIN sensor s ON s.id_sensor = l.id_sensor
            JOIN unidade_medida u ON u.id_unidade = s.id_unidade
            WHERE s.id_dispositivo = :id_dispositivo
            ORDER BY l.data_hora DESC, l.id_leitura DESC
            LIMIT $limit
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_dispositivo' => $id_dispositivo]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}
