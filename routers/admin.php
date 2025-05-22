<?php

use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\DashboardController;

$router->mount('/admin',fn:function()use($router){
$router->get('/',DashboardController::class.'@index');
$router->get('/categories',CategoryController::class.'@index');
$router->get('/categories/create',CategoryController::class.'@create');
$router->post('/categories/store',CategoryController::class.'@store');
$router->get('/categories/edit/{id}',CategoryController::class.'@edit');
$router->post('/categories/update/{id}',CategoryController::class.'@update');
$router->get('/categories/delete/{id}',CategoryController::class.'@delete');
$router->get('/categories/{id}',CategoryController::class.'@show');
});