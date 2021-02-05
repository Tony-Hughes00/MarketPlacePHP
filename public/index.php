<?php
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
$router->options('/', 'api.AppApi.options');
// api
$router->get('/test', 'api.test.get');
$router->post('/test', 'api.test.post');
// $router->options('/', 'api.test.index');

$router->get('/api/User', 'api.User.get');
$router->post('/api/User', 'api.User.post');
$router->options('/api/User', 'api.User.options');

$router->options('/api/inscription', 'api.AppApi.options');
$router->post('/api/inscription', 'api.User.inscription');

// backoffice
// inscription
$router->get('/insProprietaire', 'backoffice.insProprietaire.get');
$router->post('/insProprietaire', 'backoffice.insProprietaire.post');
// commun
// connexion
$router->post('/connexion', 'connexion.connexion'); // TODO à modif
$router->get('/logout', 'connexion.logout');

$router->post('/profil', 'backoffice.profil.get');
$router->get('/profil', 'backoffice.profil.get');

$router->run();
