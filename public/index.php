<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../third/vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';


spl_autoload_register(function($class){
    $file = __DIR__ . '/../' . str_replace('\\','/',strtolower( $class)) . '.php';
    // echo "path: $path<br>";
    if(file_exists($file)){
        require_once $file;
    }
});

// $a=$_GET['a'] ?? 'home';
// app\controller\Login::login();
$a = $_GET['a'] ?? 'home';

// só protege estas ações
$protected = [
    'dashboard', 'empresas', 'empresa_create', 'empresa_store', 'empresas_delete', 
    'salas', 'sala_create', 'sala_store', 'salas_delete', 

    'dispositivos', 'dispositivo_create', 'dispositivo_store', 
    'dispositivo_edit', 'dispositivo_update', 'dispositivo_delete',

    'logout'
];

if (in_array($a, $protected, true)) {
    app\controller\Login::login();
}
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

    case 'empresas':   
            $controller = new \app\controller\EmpresaController();
            $controller->index();
        break;
    case 'empresa_create':
            $controller = new \app\controller\EmpresaController();
            $controller->create();
        break;
    case 'empresa_store':
            $controller = new \app\controller\EmpresaController();
            $controller->store();
        break;
    case 'empresas_delete':
        $controller = new \app\controller\EmpresaController();
        $controller->delete();
        break;
// Salas
    case 'salas':   
            $controller = new \app\controller\SalaController();
            $controller->index();
        break;
    case 'sala_create':
            $controller = new \app\controller\SalaController();
            $controller->create();
        break;
    case 'sala_store':
            $controller = new \app\controller\SalaController();
            $controller->store();
        break;
    case 'salas_delete':
        $controller = new \app\controller\SalaController();
        $controller->delete();
        break;

    // Dispositivos
    case 'dispositivos':
        $controller = new \app\controller\DispositivoController();
        $controller->index();
        break;

    case 'dispositivo_create':
        $controller = new \app\controller\DispositivoController();
        $controller->create();
        break;

    case 'dispositivo_store':
        $controller = new \app\controller\DispositivoController();
        $controller->store();
        break;

    case 'dispositivo_edit':
        $controller = new \app\controller\DispositivoController();
        $controller->edit();
        break;

    case 'dispositivo_update':
        $controller = new \app\controller\DispositivoController();
        $controller->update();
        break;

    case 'dispositivo_delete':
        $controller = new \app\controller\DispositivoController();
        $controller->delete();
        break;
// Home
    case 'home':
        echo renderNtpl('base', [
            'title' => 'Home',
            'content' => '<p>OK — Twig a renderizar e config carregado.</p>'
            ]);
        break;
    default:
        echo "Ação inválida.<br>";
        break;
}


?>