<?php
namespace app\model;
include_once __DIR__ . '/../../config/config.php';
class Login{
//-----------------------------------
    /**
     * Procura utilizador por user+pass (modo simples, password em texto).
     * Devolve 1 registo (associative array) ou [] se não existir.
     */
    //-------------------------------
    static function select_record($dados){
        $pdo = db_access();
       $sql = "SELECT id_user, id_empresa, user, pass, perfil
                FROM utilizador
                WHERE user = :user AND pass = :pass
                LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':user' => $dados['user'] ?? '',
            ':pass' => $dados['pass'] ?? '',
        ]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row ? $row : [];
    }
//-----------------------------------
}   
?>