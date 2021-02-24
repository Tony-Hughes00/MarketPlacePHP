<?php

namespace App\Business;
use App;
// use App\Business;
use Exception;
use Core\Entity;
use Core\Business\Business;


class ProduitBusiness extends Business {

  public function __construct() {

  }
  public function getByBoutique() {

  }
  public function get($id_boutique) {
    if ($id_boutique > 0) {
      $boutique = $this->load('Boutique', 'id_boutique', $id_boutique);
      // var_dump($boutique);
      if ($boutique) {
        if (is_array($boutique) && (count($boutique) > 0 )) {
          // var_dump($boutique);
          $boutique = $boutique[0];
          $boutique->adresse = null;
        }
        $boutique->produits = $this->getByCol('Produit', 'id_boutique', $id_boutique);
      }
    }
    return $boutique; 
  }
  public function post($id_boutique) {
    $boutique = $this->create('Produit', $_REQUEST);
    // var_dump($boutique);
    return $boutique;
  }
  public function getFiltre(array $filtre) {
    return $this->loadFiltre('Produit', $filtre);
  }
}