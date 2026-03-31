<?php

class Router {
    private $routes = [];

    public function get($uri, $handler) {
        $this->routes[] = ['GET', $uri, $handler];
    }

    public function post($uri, $handler) {
        $this->routes[] = ['POST', $uri, $handler];
    }

    public function put($uri, $handler) {
        $this->routes[] = ['PUT', $uri, $handler];
    }

    public function delete($uri, $handler) {
        $this->routes[] = ['DELETE', $uri, $handler];
    }

    public function dispatch() {
        $url = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = $_POST['_method'];
        }

        foreach ($this->routes as $route) {
            $pattern = '#^' . preg_replace('/\{[a-z]+\}/', '(\d+)', $route[1]) . '$#';
            if ($method == $route[0] && preg_match($pattern, $url, $matches)) {                
                [$class, $action] = ($route[2]);
                $controller = new $class();
                $controller->$action($matches[1]);
            }
        }
    }
}