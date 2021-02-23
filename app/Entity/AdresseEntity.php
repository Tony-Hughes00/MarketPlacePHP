<?php

namespace App\Entity;

use Core\Entity\Entity;

class AdresseEntity extends Entity {

  public function __construct() {
    $this->tableName = "adresse";
    $this->id = "id_adresse";

    $this->init();
  }
  public function init() {
    $this->values = [
      (string) "id_adresse" => null,
      (string) "rue" => "",
      (string) "complement" => "",
      (string) "id_commune" => ""
    ];
  }
}
