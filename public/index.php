<?php
// Defaults::$crossOriginResourceSharing = true;
// Defaults::$accessControlAllowOrigin = '*';
// Defaults::$accessControlAllowMethods = 'GET, POST, PUT, PATCH, DELETE, OPTIONS, HEAD';
use Core\Router\Router;

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['url']) && $_GET['url'] != '') {
    $url = $_GET['url'];
} else {
    $url = '/';
}

define('ROOT', dirname(__DIR__));

if (php_sapi_name() === 'cli-server') {
    define('RACINE', '/');
    define('ROUTE', '/');
    $url = $_SERVER['REQUEST_URI'];
} else if (PHP_OS === 'WINNT') {
    define('ROUTE', '/marketplace/');
    define('RACINE', 'public/');
} else {
    $route = explode('/', dirname(__DIR__));
    define('RACINE', 'public/');
    define('ROUTE', '/');
    // define('RACINE', '/' . end($route) . '/public/');
    // define('ROUTE', '/' . end($route) . '/');
}

require ROOT . '/app/App.php';

App::load();

$router = new Router($url);

// $router->method('/render_url_rewriting', 'controller.function');

$router->get('/', 'index.index');
$router->get('/test', 'api.test.get');
$router->post('/test', 'api.test.post');
$router->option('/', 'api.test.index');

$router->run();
