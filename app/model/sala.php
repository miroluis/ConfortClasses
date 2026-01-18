<?php
namespace app\model;

class Sala{

    public static function all(): array
    {
        $pdo = db_access();
        $sql = "SELECT * FROM sala ORDER BY nome";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    public static function allByEmpresa(int $id_empresa):array{
        $pdo = db_access();
        $sql = "SELECT id_sala, id_empresa, nome
                FROM sala
                WHERE id_empresa = :id_empresa
                ORDER BY nome";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_empresa' => $id_empresa]);
        return $stmt->fetchAll();
    }

    public static function create(int $id_empresa, string $nome): int
    {
        $pdo = db_access();
        $sql = "INSERT INTO sala (id_empresa, nome) VALUES (:id_empresa, :nome)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id_empresa' => $id_empresa, 
            ':nome' => $nome
        ]);
        return (int) $pdo->lastInsertId();
    }
    public static function delete(int $id_sala): bool
    {
        $pdo = db_access();
        $sql = "DELETE FROM sala WHERE id_sala = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id_sala]);
    }
}

?>