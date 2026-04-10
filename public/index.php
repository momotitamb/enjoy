<?php

session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));            
}

ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../bootstrap.php';

$router = new Router($container);
require __DIR__ . '/../routes.php';
$router->dispatch();