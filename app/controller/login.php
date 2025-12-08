<?php
namespace app\controller;
include_once __DIR__ . '/controller.php';
class Login {
//------------------------------
    public static function amIlogged(){
        if(session_status() === PHP_SESSION_NONE)
            session_start();
        $cnt_session = count($_SESSION);
        dbg($_SESSION);
        dbg($cnt_session);
        return $cnt_session>0;
    }
    public static function login(){
        if(session_status() === PHP_SESSION_NONE)
            session_start();
        // session_status() === PHP_SESSION_NONE && session_start();
        // session_status() === PHP_SESSION_ACTIVE ?: session_start();
        // $_SESSION['id'] = 12;
        // $_SESSION['name'] = 'Joao';
        $cnt_session = count($_SESSION);
        if($cnt_session>0) return;

        [$method, $input] = get_payload();
        dbg($method); dbg($input);
        unset($input['pass']);

        // $rules_required = [
        //     'login'=>'O Campo login é obrigatório.', //este caso é de evitar pois podes querer personalizar a msg
        //     'pass'=>'O Campo senha é obrigatório.'
        // ];
        // $dados=keyIsInKeyArray($rules_required, $input);
        // dbg($dados);

        $rules_required=[
            0=>'login', 'pass'
        ];
        $dados=valuesIsInKeyArray($rules_required, $input);
        dbg($dados);

        \app\view\Login::render(); die();
    }
    public static function logout(){
        if(session_status() === PHP_SESSION_NONE)
            session_start();
        $_SESSION = [];
        session_destroy();
    }

//------------------------------
}
?>