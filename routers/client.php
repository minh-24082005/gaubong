<?php

use App\Controllers\Client\HomeController;
use App\Controllers\Client\ChitietController;
use App\Controllers\Client\giohangController;
use App\Controllers\Client\ThanhtoanController;
use App\Controllers\Client\OrderHistoryController;
use App\Controllers\Client\TrangconController;

$router->get('/',HomeController::class.'@index');
$router->get('/chitiet/{id}', ChitietController::class.'@index');
$router->get('/danhmuc', HomeController::class.'@danhmuc');
$router->post('/login', HomeController::class.'@login');
$router->get('/logout', HomeController::class.'@logout');
$router->post('/register', HomeController::class.'@register');

$router->get('/giohang', GiohangController::class.'@index');
$router->post('/giohang/add', GiohangController::class.'@addToCart');
$router->post('/giohang/update',GiohangController::class. '@updateQuantity');
$router->post('/giohang/delete', GiohangController::class.'@removeItem');

$router->get('/checkout', ThanhtoanController::class.'@index');
$router->post('/checkout/store', ThanhtoanController::class.'@store');

$router->get('/lich-su-don-hang', OrderHistoryController::class . '@index');
$router->post('/cancel-order/{id}', OrderHistoryController::class . '@cancelOrder');


$router->get('about',TrangconController::class.'@about');
$router->get('blog',TrangconController::class.'@blog');
$router->get('contact',TrangconController::class.'@contact');





$router->before('GET|POST', '/.*', function () {
    $uri = $_SERVER['REQUEST_URI'];
    // Nếu URI bắt đầu bằng /admin
    if (preg_match('#^/admin#', $uri)) {
        // Nếu chưa đăng nhập
        if (!isset($_SESSION['user'])) {
            redirect('/');
            exit;
        }
        // Nếu không phải admin
        if ($_SESSION['user']['type'] !== 'admin') {
            http_response_code(403); // Forbidden
            echo "Bạn không có quyền truy cập khu vực quản trị.";
            exit;
        }
    }

    // Các route khác không bị ảnh hưởng
});