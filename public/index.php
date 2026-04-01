<?php

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../bootstrap.php';

$router = new Router($container);
require __DIR__ . '/../routes.php';
$router->dispatch();