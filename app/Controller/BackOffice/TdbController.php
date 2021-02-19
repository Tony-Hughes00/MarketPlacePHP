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

      $idParts = explode('.', $_GET['url']);
      $idClean = array_filter($idParts);
      $id_boutique = intval(end($idClean));

var_dump($_SESSION);
      // $this->console_log($this->UserId());

      $boutique = $this->businessLayer->getTdb($id_boutique);
      // $this->console_log($user);
      // var_dump($user);
      // $test = $_SESSION;
      $this->render('backoffice.tdb', compact('boutique'));
    }
  }