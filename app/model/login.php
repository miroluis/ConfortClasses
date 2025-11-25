<?php
namespace app\model;
include_once __DIR__ . '/../../config/config.php';
class Login{
//-----------------------------------
    static function select_record($login, $senha){
        $pdo = \db_access();
        $sql = "SELECT id, login, level, user, email  FROM user WHERE login = ? AND pass = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$login, $senha]);
        $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        dbg($row);
        return $row ?: [];
    }
//-----------------------------------
}   
?>