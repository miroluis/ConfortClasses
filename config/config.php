<?php
define('DB_HOST', '127.0.0.1');
// define('DB_PORT', '3306');
define('DB_NAME', '04-php');
define('DB_USER', 'root');
define('DB_PASS', 'supersegredo');  

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
?>