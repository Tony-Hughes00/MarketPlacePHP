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
  public function boutiqueById() {
    $idParts = explode('.', $_GET['url']);
    $idClean = array_filter($idParts);
    $id_boutique = intval(end($idClean));

    $boutique = $this->businessLayer->getById($id_boutique);
var_dump($boutique);
    $this->render('backoffice.boutique', compact('boutique'));

  }
  public function boutique() {
// var_dump(($_SESSION));
    $userId = $this->businessLayer->UserId();

    $boutique = $this->businessLayer->getByUser($userId);
// var_dump($boutique);
    $countBoutique = count((array)$boutique);
    if ($countBoutique == 0 ) {
      $this->render('backoffice.boutique', compact('boutique'));
    } else if ($countBoutique  == 1){
      header('location: ' . ROUTE . 'tdb.$boutique->id_boutique', true, 303);
      // $this->render('backoffice.tdb', compact('boutique'));
    } else {
      header('location: ' . ROUTE . 'profil', true, 303);
    }

  }
  public function update() {
    var_dump($_FILES);
    var_dump($_REQUEST);
    $id_boutique = 0;
    if (isset($_REQUEST['id_boutique']) && ($_REQUEST['id_boutique'] > 0)) {
      $id_boutique = $_REQUEST['id_boutique'];
    }

    $boutique = $this->businessLayer->update($id_boutique, $_REQUEST, $_FILES);    

    // $boutique->message = "testing....";

    // header('location: ' . ROUTE . '/tdb.' . $boutique->id_boutique, true, 303);
    $this->render('backoffice.boutique', compact('boutique'));
  }
}