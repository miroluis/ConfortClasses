<?php

require_once __DIR__ . '/../third/vendor/autoload.php';


define('DB_HOST', '127.0.0.1');
// define('DB_PORT', '3306');
//define('DB_NAME', '04-php');
define('DB_NAME', 'BD_Escola_Sense');
define('DB_USER', 'root');
define('DB_PASS', 'supersegredo');  
// define("LIB_TEMPLATE", "php");
define("LIB_TEMPLATE", "twig");

if (!function_exists('dbg')) {
    function dbg($var){
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }
}

function db_access(){
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new \PDO($dsn, DB_USER, DB_PASS, $options);
    return $pdo;
}

//require_once '/path/to/vendor/autoload.php';
global $twig;

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../app/view/bootstrap/twig/');
$twig = new \Twig\Environment($loader, [
    //'cache' => '/path/to/compilation_cache',
]);

//VIEW Definições base
define("TPL_FOLDER", __DIR__ . "/../app/view/bootstrap/php/");
function load_tpl($file){
    if(LIB_TEMPLATE === 'php'){
        if(!file_exists(TPL_FOLDER . $file.'.php')) die("Template $file não existe");
            $func = include TPL_FOLDER . $file.'.php';
        return $func;
    }else{
        return function($a) use ($file){
            global $twig;
            return $twig->render($file.'.tpl', $a);
        };
    }
}

function renderNtpl(...$args){
    $num = count($args);
    if($num === 0 || $num % 2 !== 0){
        throw new InvalidArgumentException("Número inválido de argumentos para load_Ntpl");
        // die("Número inválido de argumentos para load_Ntpl");
    }

    $content = [];
    for($j=0, $i = $num-1; $i >= 2; $i -= 2, $j++){
        $f = load_tpl($args[$i-1]);
        $vars = $args[$i];
        if(!is_array($vars)){
            dbg($vars);
            throw new InvalidArgumentException("O segundo argumento para o template {$i} 
            não é um array");
            // die("O segundo argumento para o template $args[$i-1] não é um array");
        }
        if(!is_callable($f)){
            //dbg($vars);
            throw new InvalidArgumentException("O argumento após '$i-1' deve ser uma função");
            // die("O ficheiro {$args[$i-1]} não devolveu uma função");
        }
        $key = $vars[0] ?? $vars['result'] ?? 'content_'.$j;
        unset($vars[0]); unset($vars['result']);
        $content[$key] = $f($vars);
    }
        //---
    $f = load_tpl($args[0]);
    $vars = $args[1];
    if(!is_array($vars)){
        dbg($vars);
        throw new InvalidArgumentException("O segundo argumento para o template {$i} 
        não é um array");
        // die("O segundo argumento para o template $args[$i-1] não é um array");
    }
    if(!is_callable($f)){
        dbg($args[-1]);
        throw new InvalidArgumentException("O argumento após '$i-1']}' deve ser uma função");
        // die("O ficheiro {$args[$i-1]} não devolveu uma função");
    }
    $a= array_merge($content, $vars);
    return $f($a);

}


?>