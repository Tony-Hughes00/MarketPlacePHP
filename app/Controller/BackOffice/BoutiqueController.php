<?php

namespace App\Controller\BackOffice;
use App;
use App\Controller\BackOffice\AppBackOfficeController;
use Core\Entity;
use App\Business;

class BoutiqueController extends AppBackOfficeController {
  
  protected $businessLayer;

  public function __construct() {
    parent::__construct();
    $this->businessLayer = new business\BoutiqueBusiness();

  }

  public function boutique() {

    $userId = $this->businessLayer->UserId();

    $boutique = $this->businessLayer->getByUser($userId);

    if (count($boutique) == 0 ) {
      $this->render('backoffice.boutique', compact('boutique'));
    } if (count($boutique) == 1) {
      $this->render('backoffice.tdb', compact('boutique'));
    } 

  }
}