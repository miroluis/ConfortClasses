<?php
namespace app\model;

class Sensor
{
    /**
     * Lista todos os sensores (admin)
     */
    public static function all(): array
    {
        $pdo = db_access();
        $sql = "SELECT *
                FROM sensor
                ORDER BY id_sensor DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Lista sensores por dispositivo
     */
    public static function allByDispositivo(int $id_dispositivo): array
    {
        $pdo = db_access();

        $sql = "
            SELECT s.*, u.simbolo AS unidade_simbolo
            FROM sensor s
            JOIN unidade_medida u ON u.id_unidade = s.id_unidade
            WHERE s.id_dispositivo = ?
            ORDER BY s.ordem_leitura, s.nome
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_dispositivo]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }




    /**
     * Buscar sensor por ID
     */
    public static function find(int $id_sensor)
    {
        $pdo = db_access();
        $sql = "SELECT *
                FROM sensor
                WHERE id_sensor = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id_sensor]);
        return $stmt->fetch();
    }

    /**
     * Criar sensor
     */
    public static function create(
        int $id_dispositivo,
        int $id_unidade,
        ?string $nome,
        ?string $tipo_sensor,
        string $token,
        ?int $ordem_leitura,
        int $ativo = 1
    ): int {
        $pdo = db_access();
        $sql = "INSERT INTO sensor
                    (id_dispositivo, id_unidade, nome, tipo_sensor, token, ordem_leitura, ativo)
                VALUES
                    (:id_dispositivo, :id_unidade, :nome, :tipo_sensor, :token, :ordem_leitura, :ativo)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id_dispositivo' => $id_dispositivo,
            ':id_unidade'     => $id_unidade,
            ':nome'           => $nome,
            ':tipo_sensor'    => $tipo_sensor,
            ':token'          => $token,
            ':ordem_leitura'  => $ordem_leitura,
            ':ativo'          => $ativo
        ]);

        return (int)$pdo->lastInsertId();
    }

    /**
     * Atualizar sensor
     */
    public static function update(
        int $id_sensor,
        int $id_dispositivo,
        int $id_unidade,
        ?string $nome,
        ?string $tipo_sensor,
        string $token,
        ?int $ordem_leitura,
        int $ativo
    ): bool {
        $pdo = db_access();
        $sql = "UPDATE sensor
                SET id_dispositivo = :id_dispositivo,
                    id_unidade = :id_unidade,
                    nome = :nome,
                    tipo_sensor = :tipo_sensor,
                    token = :token,
                    ordem_leitura = :ordem_leitura,
                    ativo = :ativo
                WHERE id_sensor = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':id'            => $id_sensor,
            ':id_dispositivo'=> $id_dispositivo,
            ':id_unidade'    => $id_unidade,
            ':nome'          => $nome,
            ':tipo_sensor'   => $tipo_sensor,
            ':token'         => $token,
            ':ordem_leitura' => $ordem_leitura,
            ':ativo'         => $ativo
        ]);
    }

    /**
     * Apagar sensor
     */
    public static function delete(int $id_sensor): bool
    {
        $pdo = db_access();
        $sql = "DELETE FROM sensor WHERE id_sensor = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id_sensor]);
    }

    /**
     * Ativar / desativar
     */
    public static function setAtivo(int $id_sensor, int $ativo): bool
    {
        $pdo = db_access();
        $sql = "UPDATE sensor SET ativo = :ativo WHERE id_sensor = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id_sensor,
            ':ativo' => $ativo
        ]);
    }

    public static function findByToken(string $token)
    {
        $pdo = db_access();
        $sql = "SELECT * FROM sensor WHERE token = :token LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':token' => $token]);
        return $stmt->fetch();
    }
}
