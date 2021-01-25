<?php

namespace App\Controller;
use App;
use App\Controller\AppController;
use Core\Entity;

class ConnexionController extends AppController {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Function render login page
     *
     * @return void
     */
    public function index() {
        // App::getInstance()->title = 'Connexion' .  App::getInstance()->title;
        $this->Titre('Connexion');
        // Redirect to profile/dashboard page if user is logged
        if ($this->auth->logged() && isset($_SESSION['transport-solidaire']['membre_type'])) {
            header('location: ' . ROUTE . 'profil', true, 303);
        } else if ($this->auth->logged() && isset($_SESSION['transport-solidaire']['statut'])) {
            header('location: ' . ROUTE . 'Tdb', true, 303);
        }

        // Render login page if user is not logged
        $this->render('connexion');
    }

    /**
     * Function login redirections
     *
     * @return void
     */
    public function connexion() {
        // Authenticate the user
        $login = $this->auth->login($_POST['con_email'], $_POST['con_mdp']);

        // Redirect to profile/dashboard page if user is a member/technician
        if ($login && isset($_SESSION['marketplace']['membre_type'])) {
            header('location: ' . ROUTE . 'backoffice.profil', true, 303);
        } else if ($loginPNM && isset($_SESSION['marketplace']['statut'])) {
            header('location: ' . ROUTE . 'Tdb', true, 303);
            var_dump("tdb");
        }
    }
        /**
     * Function logout and redirect to home page
     * 
     * @return void
     */
    public function logout() {
        if (isset($_COOKIE['rememberMe'])) {
            unset($_COOKIE['rememberMe']);
            setcookie('rememberMe', null, time() - 3600);
        }
        unset($_SESSION['marketplace']);
        header('location: ' . ROUTE, true, 303);
    }

}