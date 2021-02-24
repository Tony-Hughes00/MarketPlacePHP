<?php

namespace App\Entity;
use App;
use Core\Entity\Entity;

class ProduitEntity extends Entity {

  /**
  * init
  */
  public function __construct() {
    $this->tableName = "produit";
    $this->id = "id_produit";

    $this->init();
  }
  public function init() {
    $this->values = [
      'id_produit' => null,
      'nom_produit' => "",
      'code_produit' => "",
      'desc_produit' => "",
      'id_boutique' => "0",
      'statut_produit' => "0",
      'produit_detail' => "",
      'id_prod_categorie' => "0",
      'id_supplier' => "0"      
    ];

  }
}