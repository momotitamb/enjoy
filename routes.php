<?php


$router->get('/', [HomeController::class, 'index']);
$router->get('/about', function() { echo 'About page'; });
$router->get('/posts', [PostController::class, 'index']);
$router->get('/posts/{id}', [PostController::class, 'show']);
$router->get('/posts/create', [PostController::class, 'create']);
$router->post('/posts', [PostController::class, 'store']);
$router->post('/posts/{id}', [PostController::class, 'update']);
$router->post('/posts/{id}', [PostController::class, 'destroy']);
