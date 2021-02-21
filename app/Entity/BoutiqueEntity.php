<?php

namespace App\Entity;
use App;
use Core\Entity\Entity;

class BoutiqueEntity extends Entity {

  /**
  * init
  */
  public function __construct() {
    $this->tableName = "boutique";
    $this->id = "id_boutique";

    $this->init();
  }
  public function init() {
    $this->values = [
      (string) "id_boutique" => null,
      (string) "id_vendeur" => "",
      (string) "nom_boutique" => "",
      (string) "img_boutique" => ""
    ];

  }
}