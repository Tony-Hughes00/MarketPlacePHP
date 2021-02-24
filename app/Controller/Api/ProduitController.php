<?php
namespace App\Controller\Api;
use App;
use App\Business;
use App\Controller\Admin\AppAdminController;

class ProduitController extends AppApiController {
protected $businessLayer;
    public function __construct() {
        $this->businessLayer = new business\ProduitBusiness();
    }
    public function getAll() {

      $boutiques = $this->businessLayer->get('Produit');

      $this->sendResponse($boutiques);
    }
    public function getFiltre() {

      $filtre = [];

      $produits = $this->businessLayer->getFiltre($filtre);

      $this->sendResponse($produits);
    }
  }