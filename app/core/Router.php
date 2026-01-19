<?php

class Router {
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function get($uri, $controller) {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller) {
        $this->routes['POST'][$uri] = $controller;
    }

    public function dispatch($uri, $method) {
        if ($uri !== '/') {
            $uri = rtrim($uri, '/');
        }
        
        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            echo "<h1>404 - Page not found</h1>";
            exit;
        }

        $controllerAction = $this->routes[$method][$uri];
        list($controllerName, $methodName) = explode('@', $controllerAction);
        
        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            
            $controller = new $controllerName();
            
            if (method_exists($controller, $methodName)) {
                $controller->$methodName();
            } else {
                echo "<h1>Method not found</h1>";
                exit;
            }
        } else {
            echo "<h1>Controller not found</h1>";
            exit;
        }
    }
}
