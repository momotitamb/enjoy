<?php

class Router {
    private $routes = [];

    public function get($uri, $handler) {
        $this->routes[] = ['GET', $uri, $handler];
    }

    public function post($uri, $handler) {
        $this->routes[] = ['POST', $uri, $handler];
    }

    public function dispatch() {
        $url = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        foreach ($this->routes as $route) {
            if ($method == $route[0] && $url == $route[1]) {
                [$class, $method] = ($route[2]);
                call_user_func([new $class(), $method]);
            }
        }
    }
}