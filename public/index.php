<?php

// Démarrer la session
session_start();

// Charger la configuration
require_once __DIR__ . '/../config/database.php';

// Charger les classes core
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Auth.php';

// Créer le router
$router = new Router();

// Définir les routes GET
$router->get('/', 'StudentController@index');
$router->get('/login', 'StudentController@login');
$router->get('/register', 'StudentController@register');
$router->get('/student/dashboard', 'StudentController@dashboard');
$router->get('/student/course', 'StudentController@course');
$router->get('/logout', 'StudentController@logout');

// Définir les routes POST
$router->post('/login', 'StudentController@login');
$router->post('/register', 'StudentController@register');
$router->post('/enroll', 'StudentController@enroll');

// Obtenir l'URI et la méthode
$uri = $_SERVER['REQUEST_URI'] ?? '/thoth2/public/';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// Nettoyer l'URI (supprimer la query string)
$uri = strtok($uri, '?');

// Supprimer le base URL et le /public
$uri = str_replace(BASE_URL, '', $uri);
$uri = str_replace('/public', '', $uri);

// Nettoyer les slashes multiples
$uri = preg_replace('/\/+/', '/', $uri);

// Enlever le slash final
$uri = rtrim($uri, '/');

// Si l'URI est vide, rediriger vers /
if (empty($uri)) {
    $uri = '/';
}

// Dispatcher la requête
$router->dispatch($uri, $method);
