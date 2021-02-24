<?php

namespace App\Controller\BackOffice;
use App;
use App\Controller\BackOffice\AppBackOfficeController;
use Core\Entity;
use App\Business;

class ProduitController extends AppBackOfficeController {
  // protected $businessLayer;

    public function __construct() {
        parent::__construct();
        $this->businessLayer = new business\ProduitBusiness();

    }
    public function get() {

      $idParts = explode('.', $_GET['url']);
      $idClean = array_filter($idParts);
      $id_boutique = intval(end($idClean));
      // var_dump($id_boutique);
      $boutique = $this->businessLayer->get($id_boutique);

      $this->renderPage('backoffice.produit', compact('boutique'));
    }
    public function post() {
      // var_dump($_REQUEST);
      $idParts = explode('.', $_GET['url']);
      $idClean = array_filter($idParts);
      $id_boutique = intval(end($idClean));
      // var_dump($id_boutique);
      $boutique = $this->businessLayer->post($id_boutique);

      $boutique = $this->businessLayer->get($boutique->id_boutique);

      $this->renderPage('backoffice.produit', compact('boutique'));
    }
  }