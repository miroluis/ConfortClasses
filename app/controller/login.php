<?php
namespace app\controller;
class Login {
//------------------------------
    public static function amIlogged(){
        session_start();
        $cnt_session = count($_SESSION);
        dbg($_SESSION);
        dbg($cnt_session);
        return $cnt_session>0;
    }
    public static function login(){
        session_start();
        $_SESSION['id'] = 12;
        $_SESSION['name'] = 'Joao';
    }
    public static function logout(){
        session_start();
        $_SESSION = [];
        session_destroy();
    }

//------------------------------
}
?>