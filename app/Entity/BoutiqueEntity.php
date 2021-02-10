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

    $this->init();
    // App::console_log( "UserEntity constructor" );
  }
  private function init() {
    $this->values = [
      (string) "id_boutique" => null,
      (string) "id_vendeur" => "",
      (string) "name" => ""
    ];
  }
}