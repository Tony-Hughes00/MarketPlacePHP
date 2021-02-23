<?php

namespace App\Entity;
use App;
use Core\Entity\Entity;

class CommuneEntity extends Entity {

  /**
  * init
  */
  public function __construct() {
    $this->tableName = "commune";
    $this->id = "id_commune";

    $this->init();
  }
  public function init() {
    $this->values = [
      (string) "id_commune" => null,
      (string) "nom-commune" => "",
      (string) "code_postal" => ""
    ];

  }
}