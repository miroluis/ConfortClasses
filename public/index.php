<?php
include_once __DIR__ . '/../third/vendor/autoload.php';

function dbg($var){
    echo "<pre>";
    #var_dump($var);
    print_r($var);
    echo "</pre>";
}

//na aula 4 video 4
spl_autoload_register(function($class){
    $file = __DIR__ . '/../' . str_replace('\\','/',strtolower( $class)) . '.php';
    // echo "path: $path<br>";
    if(file_exists($file)){
        require_once $file;
    }
});

$a=$_GET['a'] ?? 'dashboard';
app\controller\Login::login();
//Zona protegida, só acessível a quem está logado
switch ($a){
    case 'dashboard':
        app\view\Dashboard::render();
        break;
    // case 'login':
    //     app\view\Login::render();
    //     break;
    case 'logout':
        app\controller\Login::logout();
        // echo "Logout efetuado.<br>";
        break;
    default:
        echo "Ação inválida.<br>";
        break;
}


// if(!Login::amIlogged()){
//     Login::login();
//     echo "Vou fazer login.<br>";
//     die();
// }
// echo "Código protegido.<br>";
// app\model\Login::select_record('inacio', 'ola');

// // app\view\Login::render();
// app\view\Dashboard::render();
?>