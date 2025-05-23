<?php

use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\ProductsController;

$router->mount('/admin',fn:function()use($router){
$router->get('/',DashboardController::class.'@index');
$router->get('/categories',CategoryController::class.'@index');
$router->get('/categories/create',CategoryController::class.'@create');
$router->post('/categories/store',CategoryController::class.'@store');
$router->get('/categories/edit/{id}',CategoryController::class.'@edit');
$router->post('/categories/update/{id}',CategoryController::class.'@update');
$router->get('/categories/delete/{id}',CategoryController::class.'@delete');
$router->get('/categories/{id}',CategoryController::class.'@show');



$router->get('/product',ProductsController::class.'@index');
$router->get('/product/create',ProductsController::class.'@create');
$router->post('/product/store',ProductsController::class.'@store');
$router->get('/product/edit/{id}',ProductsController::class.'@edit');
$router->post('/product/update/{id}',ProductsController::class.'@update');
$router->get('/product/delete/{id}',ProductsController::class.'@delete');
$router->get('/product/{id}',ProductsController::class.'@show');
});