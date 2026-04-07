<?php

$router->get('/posts/create', [PostController::class, 'create']);
$router->get('/categories/create', [CategoryController::class, 'create']);
$router->get('/posts/{id}/edit', [PostController::class, 'edit']);
$router->get('/posts/slug/{slug}', [PostController::class, 'showBySlug']);
$router->get('/', [HomeController::class, 'index']);
$router->get('/about', function() { echo 'About page'; });
$router->get('/posts', [PostController::class, 'index']);
$router->get('/categories', [CategoryController::class, 'index']);
$router->post('/posts', [PostController::class, 'store']);
$router->post('/categories', [CategoryController::class, 'store']);
$router->get('/posts/{id}', [PostController::class, 'show']);
$router->put('/posts/{id}', [PostController::class, 'update']);
$router->delete('/posts/{id}', [PostController::class, 'destroy']);
$router->delete('/categories/{id}', [CategoryController::class, 'destroy']);
