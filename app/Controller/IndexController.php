<?php

namespace App\Controller;

use App;

class IndexController extends AppController {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Function rendering index page
     *
     * @return void
     */
    public function index() :void {
        App::getInstance()->title = 'Accueil' .  App::getInstance()->title;
        $this->render('index');
    }
   
    /**
     * Function redering fonctionnement page
     *
     * @return void
     */
    public function fonctionnement() {
        App::getInstance()->title = 'Fonctionnement' .  App::getInstance()->title;
        $this->render('fonctionnement');
    }

    /**
     * Function redering chauffeur page
     *
     * @return void
     */
    public function chauffeur() {
        App::getInstance()->title = 'Chauffeur' .  App::getInstance()->title;
        $this->render('chauffeur');
    }

    /**
     * Function redering passager page
     *
     * @return void
     */
    public function passager() {
        App::getInstance()->title = 'Passager' .  App::getInstance()->title;
        $this->render('passager');
    }

}
