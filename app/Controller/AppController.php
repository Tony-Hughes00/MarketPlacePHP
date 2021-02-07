<?php

namespace App\Controller;

use Core\Controller\Controller;
use \App;
use Core\Auth\DbAuth;

class AppController extends Controller {

    /**
     * Default template for views
     *
     * @var string
     */
    protected string $_template = 'default';
    protected string $_model_name;
    protected object $auth;
    /**
     * Define the default path for views
     */
    public function __construct() {
        $this->viewPath = ROOT . '/app/Views/';
        $this->auth = $this->getAuth();
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

    public function unautorized() {
        header('location: ' . ROUTE . 'inscription', true, 303);
    }

	public function forbidden() :string {
		header('HTTP/1.0 403 Forbidden');
		die('Api overloaded 403 forbidden');
	}

    public function notFound() :string {
		header('HTTP/1.0 404 Not Found');
		die('Api overloaded 404 not found');
    }

}