<?php
namespace app\controller;

include_once __DIR__ . '/controller.php';

class Login {

    public static function amIlogged(){
        if (session_status() === PHP_SESSION_NONE) session_start();
        return !empty($_SESSION);
    }

    public static function login(): void
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        // Se já está logado, segue para dashboard
        if (self::amIlogged()) {
            header('Location: index.php?a=dashboard');
            exit;
        }

        // GET -> só mostra o formulário
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            \app\view\Login::render();
            exit;
        }

        // POST -> processa credenciais
        [$method, $input] = get_payload();

        $rules_required = ['user', 'pass'];
        $rules = $rules_required;

        [$erros, $dados] = validate_input($rules_required, $rules, $input);

        if (count($erros) === 0 && count($dados) === count($rules)) {
            $row = \app\model\Login::select_record($dados);

            if (!empty($row)) {
                $_SESSION = $row;

                // garantir id_user para o amIlogged clássico
                if (!isset($_SESSION['id_user'])) {
                    $_SESSION['id_user'] = $row['id_user'] ?? $row['id'] ?? 1;
                }

                $l = getBrowserLang();
                $_SESSION['lang'] = $_SESSION['lang'] ?? $l;

                header('Location: index.php?a=dashboard');
                exit;
            }
        }

        // Se chegou aqui: login falhou -> volta a mostrar form
        \app\view\Login::render();
        exit;
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
