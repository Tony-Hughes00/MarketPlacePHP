<?php

namespace App\Controller\BackOffice;
use App;
use App\Controller\BackOffice\AppBackOfficeController;
use Core\Entity;
use App\Business;

class TdbController extends AppBackOfficeController {
  protected $businessLayer;

    public function __construct() {
        parent::__construct();
        $this->businessLayer = new business\TdbBusiness();

    }
    public function getTdb() {
      $this->Titre('Tableau de Bord');
var_dump($_SESSION);
      // $this->console_log($this->UserId());

      $boutique = $this->businessLayer->getTdb();
      // $this->console_log($user);
      // var_dump($user);
      // $test = $_SESSION;
      $this->render('backoffice.tdb', compact('boutique'));
    }
  }