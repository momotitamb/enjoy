<?php

$router->get('/posts/create', [PostController::class, 'create']);
$router->get('/users/create', [UserController::class, 'create']);
$router->get('/categories/create', [CategoryController::class, 'create']);
$router->get('/posts/{id}/edit', [PostController::class, 'edit']);
$router->get('/users/{id}/edit', [UserController::class, 'edit']);
$router->get('/posts/slug/{slug}', [PostController::class, 'showBySlug']);
$router->get('/', [PostController::class, 'index']);
$router->get('/about', function() { echo 'About page'; });
$router->get('/login', [AuthController::class, 'loginForm']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'registerForm']);
$router->post('/register', [AuthController::class, 'register']);
$router->post('/logout', [AuthController::class, 'logout']);
$router->get('/posts', [PostController::class, 'index']);
$router->get('/users', [UserController::class, 'index']);
$router->get('/categories', [CategoryController::class, 'index']);
$router->post('/posts', [PostController::class, 'store']);
$router->post('/users', [UserController::class, 'store']);
$router->post('/categories', [CategoryController::class, 'store']);
$router->get('/posts/{id}', [PostController::class, 'show']);
$router->get('/users/{id}', [UserController::class, 'show']);
$router->put('/posts/{id}', [PostController::class, 'update']);
$router->put('/users/{id}', [UserController::class, 'update']);
$router->delete('/posts/{id}', [PostController::class, 'destroy']);
$router->delete('/users/{id}', [UserController::class, 'destroy']);
$router->delete('/categories/{id}', [CategoryController::class, 'destroy']);
