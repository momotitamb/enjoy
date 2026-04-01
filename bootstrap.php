<?php

$container = new Container();

$container->bind(PostController::class, function($container) {
    return new PostController($container->make(PostRepository::class));
});