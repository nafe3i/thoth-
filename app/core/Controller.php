<?php

class Controller {
    
    // Charger une vue
    protected function view($view, $data = []) {
        // Extraire les données pour les rendre accessibles dans la vue
        extract($data);
        
        // Construire le chemin de la vue
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View not found: " . $view);
        }
    }
    
    // Rediriger vers une URL
    protected function redirect($url) {
        header("Location: " . BASE_URL . $url);
        exit;
    }
    
    // Vérifier si la requête est en POST
    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
    
    // Récupérer une valeur POST
    protected function post($key, $default = null) {
        return $_POST[$key] ?? $default;
    }
    
    // Récupérer une valeur GET
    protected function get($key, $default = null) {
        return $_GET[$key] ?? $default;
    }
}
