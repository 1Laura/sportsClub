<?php
require_once '../vendor/autoload.php';

use app\controller\SiteController;
use app\controller\UsersController;
use app\core\Application;

// env
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'index']);

$app->router->get('/feedback', [SiteController::class, 'feedback']);

//routes for login and register
$app->router->get('/register', [UsersController::class, 'register']);
$app->router->post('/register', [UsersController::class, 'register']);
$app->router->get('/login', [UsersController::class, 'login']);
$app->router->post('/login', [UsersController::class, 'login']);

$app->router->get('/logout', [UsersController::class, 'logout']);

$app->run();