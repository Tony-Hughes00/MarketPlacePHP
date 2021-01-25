<?php

namespace App\Controller\BackOffice;
use App;
use App\Controller\BackOffice\AppBackOfficeController;
use Core\Entity;

class ConnexionController extends AppBackOfficeController {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Function render login page
     *
     * @return void
     */
    public function index() {
        App::getInstance()->title = 'Connexion' .  App::getInstance()->title;

        // Redirect to profile/dashboard page if user is logged
        if ($this->auth->logged() && isset($_SESSION['marketplace']['user_type'])) {
            header('location: ' . ROUTE . 'profil', true, 303);
        } else if ($this->auth->logged() && isset($_SESSION['marketplace']['statut'])) {
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
        $loginPNM = $this->auth->loginPNM($_POST['con_email'], $_POST['con_mdp']);

        // Redirect to profile/dashboard page if user is a member/technician
        if ($login && isset($_SESSION['marketplace']['user_type'])) {
            header('location: ' . ROUTE . 'profil', true, 303);
        } else if ($loginPNM && isset($_SESSION['marketplace']['statut'])) {
            header('location: ' . ROUTE . 'Tdb', true, 303);
        }
    }

}