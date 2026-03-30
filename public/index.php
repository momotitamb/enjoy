<?php

require_once __DIR__ . '/../autoload.php';

$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', function() { echo 'About page'; });

$router->dispatch();