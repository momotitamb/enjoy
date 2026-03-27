<?php

require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__ . '/../app/Controllers/HomeController.php';

$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', function() { echo 'About page'; });

$router->dispatch();