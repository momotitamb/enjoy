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
            $pattern = '#^' . str_replace('{id}', '(\d+)', $route[1]) . '$#';
            if (preg_match($pattern, $url, $matches)) {                
                [$class, $method] = ($route[2]);
                $controller = new $class();
                $controller->$method($matches[1]);
            }
        }
    }
}