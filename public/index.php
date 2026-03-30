<?php

require_once __DIR__ . '/../autoload.php';

$router = new Router();
require __DIR__ . '/../routes.php';
$router->dispatch();