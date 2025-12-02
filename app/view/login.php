<?php

namespace app\view;
include __DIR__ . "/../../config/config.php";
class Login {
static function render() {

$arr = ['content'//, // 'result' => 'content'
       //  "title" => "Login"
];

// $arr = [ 0 =>'content'//, // 'result' => 'content'
//        //  "title" => "Login"
// ];
// dbg($arr);
$page = renderNtpl('base', ['title' => 'Login'], //aqui era [] ,//
                'login', $arr, 
                'menu',['menu'],
                'footer',['footer']);
                //o menu vai para menu php, o arr para  login e os 2 para a base

/* 
//template, Valores a injetar, indice onde ficam os resultados
$page = load_Ntpl('base.php', [],'', 
                'login.php', $arr,'content' 
                'menu.php',[], 'menu');
                //o menu vai para menu php, o arr para  login e os 2 para a base
 */

echo $page;

}
}
?>


