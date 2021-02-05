<?php

namespace App\Controller\Admin;

use Core\Controller\Controller;
use \App;
use Core\Auth\DbAuth;

class AppAdminController extends Controller {

    /**
     * Admin template for views
     *
     * @var string
     */
    protected string $_template = 'technicien';
    protected string $_model_name;
    protected object $auth;

    /**
     * Define the default path for views
     */
    public function __construct() {
        $this->viewPath = ROOT . '/app/Views/';
        $this->auth = $this->getAuth();
        $this->template = 'technicien';
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
        (isset($_SESSION['marketplace']['statut'])) ? $this->template = 'technicien' : $this->template = 'default';
        $this->render('errors.403');
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

    public function notFound() :string{
        App::getInstance()->title = 'Page introuvable' .  App::getInstance()->title;
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Forbidden');
        (isset($_SESSION['marketplace']['statut'])) ? $this->template = 'technicien' : $this->template = 'default';
        $this->render('errors.404');
    }
    // public function sendHeaders() {
    //     header("Access-Control-Allow-Credentials: true");
    //     header("Access-Control-Allow-Origin: *");
    //     header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, authorization");
    //     header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");

    //     header('Content-Type: application/json');
    // }

    // public function sendResponse($body) {

    //     $resBody = (object) array();
    //     $resBody->status = "200";
    //     $resBody->message = "valid request";
    //     $resBody->data = $body;

    //     $this->sendHeaders();
    //     echo json_encode($resBody); 
    // }

}