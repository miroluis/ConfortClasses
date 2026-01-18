<?php
namespace app\model;

class UnidadeMedida
{
    public static function all(): array
    {
        $pdo = db_access();
        $sql = "SELECT * FROM unidade_medida ORDER BY id_unidade";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }
}
