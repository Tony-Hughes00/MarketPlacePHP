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

$router->options('/api/connexion', 'api.AppApi.options');
$router->post('/api/connexion', 'api.User.connexion');

$router->options('/api/logout', 'api.AppApi.options');
$router->get('/api/logout', 'api.User.logout');

$router->options('/api/boutique', 'api.AppApi.options');
$router->get('/api/boutique', 'api.boutique.getAll');

$router->options('/api/categories', 'api.AppApi.options');
$router->get('/api/categories', 'api.category.getAll');

$router->options('/api/produits', 'api.AppApi.options');
$router->get('/api/produits', 'api.produit.getFiltre');
// backoffice
// inscription
$router->get('/inscription', 'backoffice.user.get');
$router->post('/inscription', 'backoffice.User.inscription');

$router->get('/logout', 'backoffice.User.logout');
$router->post('/connexion', 'backoffice.User.connexion');

// commun
// connexion
// $router->post('/connexion', 'backoffice.connexion.connexion'); // TODO à modif
// $router->get('/logout', 'backoffice.connexion.logout');


$router->post('/profil', 'backoffice.profil.getProfil');
$router->get('/profil', 'backoffice.profil.getProfil');

$router->get('/boutique', 'backoffice.boutique.boutique');
$router->post('/boutique', 'backoffice.boutique.update');
$router->get('/boutiqueById.:id', 'backoffice.boutique.boutiqueById');

$router->get('/tdb.:id', 'backoffice.tdb.getTdb');
$router->get('/produit.:id_boutique', 'backoffice.produit.get');
$router->post('/produit.:id_boutique', 'backoffice.produit.post');
// $router->post('/tdb.:id', 'backoffice.tdb.getTdb');

$router->run();
