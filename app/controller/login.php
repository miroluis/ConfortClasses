<?php
namespace app\controller;

include_once __DIR__ . '/controller.php';

class Login {

    public static function amIlogged(){
        if (session_status() === PHP_SESSION_NONE) session_start();
        return isset($_SESSION['id_user']);
    }

    public static function login(){
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (self::amIlogged()) return;

        [$method, $input] = get_payload();

        $rules_required = ['user', 'pass'];
        $rules = $rules_required;

        [$erros, $dados] = validate_input($rules_required, $rules, $input);

        if (count($erros) === 0 && count($dados) === count($rules)) {
            $row = \app\model\Login::select_record($dados);

            if (!empty($row)) {
                $_SESSION = $row;
                $l = getBrowserLang();
                $_SESSION['lang'] = $_SESSION['lang'] ?? $l;
                //return;
                header('Location: index.php?a=dashboard');
                exit;
            } else {
                dbg("Login inválido: user/pass não encontrados");
            }
        }

        \app\view\Login::render();
        die();
    }

    public static function logout(){
        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION = [];
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
?>
