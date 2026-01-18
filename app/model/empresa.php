<?php
namespace app\model;
// include_once __DIR__ . '/../../config/config.php';
class Empresa{
    static function all(){
        $pdo = db_access();
       $sql = "SELECT id_empresa, nome
                FROM empresa
                ORDER BY nome";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    public static function create($nome): bool
    {
        $pdo = db_access();
        $sql = "INSERT INTO empresa (nome) VALUES (:nome)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':nome' => $nome]);
        return (int) $pdo->lastInsertId();
    }
    public static function delete(int $id): bool
    {
        $pdo = db_access();
        $sql = "DELETE FROM empresa WHERE id_empresa = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}

?>