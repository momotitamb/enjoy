<?php

$container = new Container();

$container->bind(PostController::class, function($container) {
    return new PostController($container->make(PostRepository::class));
});

$container->bind(HomeController::class, function($container) {
    return new HomeController($container->make(PostRepository::class));
});