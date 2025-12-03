<?php
include_once __DIR__ . '/../third/vendor/autoload.php';

function dbg($var){
    echo "<pre>";
    var_dump($var);
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



// app\view\Login::render();
app\view\Dashboard::render();
?>