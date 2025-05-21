<?php

use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\DashboardController;

$router->mount('/admin',fn:function()use($router){
$router->get('/',DashboardController::class.'@index');
$router->get('/category',CategoryController::class.'@index');

});