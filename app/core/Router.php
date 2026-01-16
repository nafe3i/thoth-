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
        // Nettoyer l'URI mais garder le slash pour la racine
        if ($uri !== '/') {
            $uri = rtrim($uri, '/');
        }
        
        if (!isset($this->routes[$method][$uri])) {
            // Route non trouvée - page 404 simple
            http_response_code(404);
            echo "<h1>404 - Page not found</h1>";
            exit;
        }

        // Extraire le contrôleur et la méthode
        $controllerAction = $this->routes[$method][$uri];
        list($controllerName, $methodName) = explode('@', $controllerAction);
        
        // Inclure le fichier du contrôleur
        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            
            // Créer une instance du contrôleur
            $controller = new $controllerName();
            
            // Appeler la méthode
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
