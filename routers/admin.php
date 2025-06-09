<?php

use App\Controllers\Admin\UserController;
use App\Controllers\Admin\OrderController;
use App\Controllers\Admin\BannerController;
use App\Controllers\Admin\BientheController;
use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\ProductsController;
use App\Controllers\Admin\DashboardController;

$router->mount('/admin', fn: function () use ($router) {
    $router->get('/', DashboardController::class . '@index');
    $router->get('/categories', CategoryController::class . '@index');
    $router->get('/categories/create', CategoryController::class . '@create');
    $router->post('/categories/store', CategoryController::class . '@store');
    $router->get('/categories/edit/{id}', CategoryController::class . '@edit');
    $router->post('/categories/update/{id}', CategoryController::class . '@update');
    $router->get('/categories/delete/{id}', CategoryController::class . '@delete');
    $router->get('/categories/{id}', CategoryController::class . '@show');



    $router->get('/product', ProductsController::class . '@index');
    $router->get('/product/create', ProductsController::class . '@create');
    $router->post('/product/store', ProductsController::class . '@store');
    $router->get('/product/edit/{id}', ProductsController::class . '@edit');
    $router->post('/product/update/{id}', ProductsController::class . '@update');
    $router->get('/product/delete/{id}', ProductsController::class . '@delete');
    $router->get('/product/show/{id}', ProductsController::class . '@show');

    $router->get('/banner', BannerController::class . '@index');
    $router->get('/banner/create', BannerController::class . '@create');
    $router->post('/banner/store', BannerController::class . '@store');
    $router->get('/banner/edit/{id}', BannerController::class . '@edit');
    $router->post('/banner/update/{id}', BannerController::class . '@update');
    $router->get('/banner/delete/{id}', BannerController::class . '@delete');
    $router->get('/banner/{id}', BannerController::class . '@show');


    $router->get('/bienthe',BientheController::class.'@index');
    $router->get('/bienthe/create',BientheController::class.'@create');
    $router->post('/bienthe/store',BientheController::class.'@store');
    $router->get('/bienthe/edit/{id}',BientheController::class.'@edit');
    $router->post('/bienthe/update/{id}',BientheController::class.'@update');
    $router->get('/bienthe/delete/{id}',BientheController::class.'@delete');

    $router->get('/users',UserController::class.'@index');
    $router->get('/users/create',UserController::class.'@create');
    $router->post('/users/store',UserController::class.'@store');
    $router->get('/users/edit/{id}',UserController::class.'@edit');
    $router->post('/users/update/{id}',UserController::class.'@update');
    $router->get('/users/delete/{id}',UserController::class.'@delete');
    $router->get('/users/{id}',UserController::class.'@show');

    $router->get('/orders',OrderController::class.'@index');
    $router->get('/orders/{id}/show',OrderController::class.'@show');
    $router->post('/orders/{id}/update',OrderController::class.'@update');
    $router->get('/orders/{id}/edit',OrderController::class.'@edit');
});
