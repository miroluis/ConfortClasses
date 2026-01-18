<?php
namespace app\model;
class Dispositivo{
    /**
     * Lista todos os dispositivos
     */
    public static function all():array{
        $pdo = db_access();
        $sql = "SELECT d.id_dispositivo, d.id_sala, d.nome, d.descricao, d.mac_address, d.ativo
                FROM dispositivo d
                ORDER BY d.nome";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Lista dispositivos por sala
     */
    public static function allBySala(int $id_sala): array {
        $pdo = db_access();
        $sql = "SELECT id_dispositivo, id_sala, nome, descricao, mac_address, ativo
                FROM dispositivo 
                WHERE id_sala = :id_sala
                ORDER BY nome";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_sala' => $id_sala]);
        return $stmt->fetchAll();
    }

    /**
     * Obtem um dispositivo pelo ID
     */ 
    public static function find(int $id_dispositivo)    
    {
        $pdo = db_access();
        $sql = "SELECT *
                FROM dispositivo 
                WHERE id_dispositivo = :id_dispositivo";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_dispositivo' => $id_dispositivo]);
        return $stmt->fetch();
    }

    /**
     * Cria um novo dispositivo
     */
    public static function create(
        int $id_sala, 
        string $nome, 
        string $descricao, 
        string $mac_address, 
        int $ativo = 1
    ): int{
        $pdo = db_access();
        $sql = "INSERT INTO dispositivo 
                (id_sala, nome, descricao, mac_address, ativo) 
                VALUES 
                (:id_sala, :nome, :descricao, :mac_address, :ativo)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id_sala' => $id_sala,
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':mac_address' => $mac_address,
            ':ativo' => $ativo
        ]);
        return (int) $pdo->lastInsertId();
    }

    /**
     * Atualizar dispositivo
     */
    public static function update(
        int $id_dispositivo,
        int $id_sala, 
        string $nome, 
        string $descricao, 
        string $mac_address, 
        int $ativo
    ): bool {
        $pdo = db_access();
        $sql = "UPDATE dispositivo 
                SET id_sala = :id_sala, 
                    nome = :nome, 
                    descricao = :descricao, 
                    mac_address = :mac_address, 
                    ativo = :ativo
                WHERE id_dispositivo = :id_dispositivo";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':id_dispositivo' => $id_dispositivo,
            ':id_sala' => $id_sala,
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':mac_address' => $mac_address,
            ':ativo' => $ativo
        ]);
    }

    /**
     * Apagar um dispositivo
     */
    public static function delete(int $id_dispositivo): bool {
        $pdo = db_access();
        $sql = "DELETE FROM dispositivo WHERE id_dispositivo = :id_dispositivo";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id_dispositivo' => $id_dispositivo]);
    }
    
    /**
     * Ativar / desativar um dispositivo (soft toggle)
     */
    public static function setAtivo(int $id_dispositivo, int $ativo): bool {
        $pdo = db_access();
        $sql = "UPDATE dispositivo 
                SET ativo = :ativo
                WHERE id_dispositivo = :id_dispositivo";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':id_dispositivo' => $id_dispositivo,
            ':ativo' => $ativo
        ]);
    }
}

?>