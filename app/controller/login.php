<?php
namespace app\controller;
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