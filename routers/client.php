<?php

use App\Controllers\Client\HomeController;

$router->get('/',HomeController::class.'@index');
