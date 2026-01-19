<?php

session_start();

require_once __DIR__ . '/../config/database.php';

require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Auth.php';

$router = new Router();

$router->get('/', 'StudentController@index');
$router->get('/login', 'StudentController@login');
$router->get('/register', 'StudentController@register');
$router->get('/student/dashboard', 'StudentController@dashboard');
$router->get('/student/course', 'StudentController@course');
$router->get('/logout', 'StudentController@logout');

$router->post('/login', 'StudentController@login');
$router->post('/register', 'StudentController@register');
$router->post('/enroll', 'StudentController@enroll');

$uri = $_SERVER['REQUEST_URI'] ?? '/thoth2/public/';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$uri = strtok($uri, '?');

$uri = str_replace(BASE_URL, '', $uri);
$uri = str_replace('/public', '', $uri);

$uri = preg_replace('/\/+/', '/', $uri);

$uri = rtrim($uri, '/');

if (empty($uri)) {
    $uri = '/';
}

$router->dispatch($uri, $method);
