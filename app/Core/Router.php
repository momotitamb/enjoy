<?php

class Router {
    private $routes = [];
    private Container $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

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
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = $_POST['_method'];
        }

        foreach ($this->routes as $route) {
            $pattern = '#^' . str_replace(
                ['{id}', '{slug}'], 
                ['(\d+)', '([a-z0-9-]+)'],  
                $route[1]
            ) . '$#';
            if ($method == $route[0] && preg_match($pattern, $url, $matches)) {                
                [$class, $action] = ($route[2]);
                $controller = $this->container->make($class);
                $controller->$action(isset($matches[1])) ? $matches[1] : null;
            }
        }
    }
}