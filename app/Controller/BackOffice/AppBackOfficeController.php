<?php

namespace App\Controller\BackOffice;

use Core\Controller\Controller;
use \App;
use Core\Auth\DbAuth;
use App\Business;

class AppBackOfficeController extends Controller {
    protected $businessLayer;
    /**
     * Admin template for views
     *
     * @var string
     */
    protected string $_template = 'backoffice';
    protected string $_model_name;
    protected object $auth;

    /**
     * Define the default path for views
     */
    public function __construct() {
        $this->viewPath = ROOT . '/app/Views/';
        $this->auth = $this->getAuth();
        $this->template = 'backoffice';
    }

    /**
     * Load the Table of what you want
     *
     * @param string $model_name
     * @return object
     */
    protected function _loadModel(string $model_name) :object {
        return App::getInstance()->getTable($model_name);
    }

    /**
     * Set new instance of DbAuth
     * 
     * @return DbAuth
     */
    protected function getAuth() {
        return new DbAuth (App::getInstance()->getDb());
    }

    // public function unautorized() {
    //     header('location: ' . ROUTE . 'inscription', true, 303);
    // }

	public function forbidden() :string {
        App::getInstance()->title = 'Accès refusé' .  App::getInstance()->title;
        header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
        (isset($_SESSION['marketplace']['statut'])) ? $this->template = 'default' : $this->template = 'default';
        $this->render('errors.403');
        die('Api overloaded 403 forbidden');
    }

    public function isAdmin() {
        if (!isset($_SESSION['marketplace']['statut']) || $_SESSION['marketplace']['statut'] != 'admin') {
            $this->forbidden();
        }
    }

    public function isConseiller() {
        if (!isset($_SESSION['marketplace']['statut'])) {
            $this->forbidden();
        }
    }

    public function notFound() :string {
        App::getInstance()->title = 'Page introuvable' .  App::getInstance()->title;
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Forbidden');
        (isset($_SESSION['marketplace']['statut'])) ? $this->template = 'default' : $this->template = 'default';
        $this->render('errors.404');
        die('404 not found');
    }
    protected function renderPage(string $view, array $vars = []) {
        // var_dump($vars);
        $profileBusiness = new business\ProfileBusiness();

        $vars['user'] = $profileBusiness->getProfil();
// var_dump($vars);
        $this->render($view, $vars);

    }
    
}