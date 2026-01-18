<?php
include_once __DIR__ . '/../third/vendor/autoload.php';

function dbg($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}
// echo "do index.php<br>";

spl_autoload_register(function($class){
    $file = __DIR__ . '/../' . str_replace('\\','/',strtolower( $class)) . '.php';
    // echo "path: $path<br>";
    if(file_exists($file)){
        include_once $file;
    }
});
// include_once __DIR__ . '/../app/controller/login.php';
/*

Podia terr isto no composer.json


*/

/*
//o app/controller é o namespace
use app\controller\Login;
// Login::login(); // usado na aula 3
// Login::logout(); die();
if(!Login::amIlogged()){
    // Login::login();
    echo "Vou fazer login<br>";
    die();
};
echo "código protegido<br>";
$result = app\model\Login::select_record('inacio', 'ola');

// dbg($result);

*/

// app\view\Login::render();

// // require_once '/path/to/vendor/autoload.php';

// $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../app/view/tpl_bootstrap');
// $twig = new \Twig\Environment($loader, [
//     // 'cache' => '/path/to/compilation_cache',
// ]);


// $arr = [
//     'nome' => "João",
//     'datanasc' => "2001-05-20",
//     "geenero" => "Masculino"
// ];

// $template = $twig->load('tabela_users.tpl');

//  //$template->render(['the' => 'variables', 'go' => 'here']);

// // Usar o array que criaste:
// echo $template->render($arr);

app\view\Login::render();

?>