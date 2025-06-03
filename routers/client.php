<?php

use App\Controllers\Client\HomeController;
use App\Controllers\Client\ChitietController;

$router->get('/',HomeController::class.'@index');
$router->get('/chitiet/{id}', ChitietController::class.'@index');
$router->get('/danhmuc', HomeController::class.'@danhmuc');
$router->post('/login', HomeController::class.'@login');
$router->get('/logout', HomeController::class.'@logout');
$router->post('/register', HomeController::class.'@register');

$router->before('GET|POST', '/.*', function() {
    middleware_auth();
});