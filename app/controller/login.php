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
        $cnt_session = count($_SESSION);
        if($cnt_session>0) return;

        
/*        [$method, $input] = get_payload();
        dbg($method); dbg($input);
        unset($input['pass']);

        $rules_required = [
            'login'=>'O Campo login é obrigatório.', //este caso é de evitar pois podes querer personalizar a msg
            'pass'=>'O Campo senha é obrigatório.'
        ];
        $rules = $rules_required;
        // $dados=keyIsInKeyArray($rules_required, $input);
        // $erros=getMissingReqFields($rules_required, $input);
        [$erros, $dados] = validate_input( $rules_required, $rules, $input);
        dbg($dados);dbg($erros);

        $rules_required=[0=>'login', 'pass']; $rules = $rules_required;
        // $dados=valuesIsInKeyArray($rules_required, $input);
        // $erros=getMissingReqFields($rules_required, $input);
        [$erros, $dados] = validate_input( $rules_required, $rules, $input);
        dbg($dados);dbg($erros);
*/


        [$method, $input] = get_payload();
        $rules_required=['login', 'pass']; $rules = $rules_required;
        [$erros, $dados] = validate_input( $rules_required, $rules, $input);
         dbg($dados);
         dbg(" a seguir erros");
         dbg(count($erros));
        if(count($erros)<=0 and count($dados) === count($rules)){
            $row = \app\model\Login::select_record($dados);
            if(count($row) > 0){
                //login ok
                $_SESSION = $row;
                return;
            }
            else    
                dbg("deu erro retornou 0 row's");
        }
        dbg(prefix_rules($rules, 'erros_'));
        $rules=[
            'login'=>'O Campo login é obrigatório.', //este caso é de evitar pois podes querer personalizar a msg
            'pass'=>'O Campo senha é obrigatório.'
        ];
        dbg(prefix_rules($rules, 'erros_'));

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