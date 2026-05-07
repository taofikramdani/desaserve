<?php

require __DIR__ . '/../app/Helpers/Env.php';
\App\Helpers\Env::load(__DIR__ . '/../.env');

if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require __DIR__ . '/../vendor/autoload.php';
} else {
    spl_autoload_register(function ($class) {
        $prefix = 'App\\';
        if (strpos($class, $prefix) !== 0) {
            return;
        }

        $relative = str_replace('App\\', '', $class);
        $path = __DIR__ . '/../app/' . str_replace('\\', '/', $relative) . '.php';
        if (file_exists($path)) {
            require $path;
        }
    });
}

require __DIR__ . '/../app/Helpers/Url.php';


session_start();

use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\RequestController;
use App\Controllers\ComplaintController;
use App\Controllers\AdminController;

$router = new Router();

$authController = new AuthController();
$dashboardController = new DashboardController();
$requestController = new RequestController();
$complaintController = new ComplaintController();
$adminController = new AdminController();

$router->get('/', function () {
    if (\App\Helpers\Auth::check()) {
        if (\App\Helpers\Auth::isAdmin()) {
            header('Location: /admin');
        } else {
            header('Location: /dashboard');
        }
        exit;
    }
    header('Location: /login');
});

$router->get('/login', [$authController, 'showLogin']);
$router->post('/login', [$authController, 'login']);
$router->get('/register', [$authController, 'showRegister']);
$router->post('/register', [$authController, 'register']);
$router->get('/logout', [$authController, 'logout']);

$router->get('/dashboard', [$dashboardController, 'index']);
$router->get('/requests/new', [$requestController, 'showForm']);
$router->post('/requests/new', [$requestController, 'submit']);
$router->get('/complaints/new', [$complaintController, 'showForm']);
$router->post('/complaints/new', [$complaintController, 'submit']);

$router->get('/admin/login', [$adminController, 'showLogin']);
$router->post('/admin/login', [$adminController, 'login']);
$router->get('/admin', [$adminController, 'dashboard']);
$router->post('/admin/requests/update', [$adminController, 'updateRequestStatus']);
$router->post('/admin/complaints/update', [$adminController, 'updateComplaintStatus']);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($method, $path);
