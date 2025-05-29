<?php

use App\Controllers\Client\HomeController;
use App\Controllers\Client\ChitietController;

$router->get('/',HomeController::class.'@index');
$router->get('/chitiet/{id}', ChitietController::class.'@index');
$router->get('/danhmuc', HomeController::class.'@danhmuc');
