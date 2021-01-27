<?php

namespace App\Entity;
use App;
use Core\Entity\Entity;

class UserEntity extends Entity {

  /**
  * init
  */
  public function __construct() {
    $this->tableName = "user";

    $this->init();
    
    App::console_log( "UserEntity constructor" );
  }
  private function init() {
    $this->values = [
      "id_user" => null,
      "email" => "",
      "mdp" => "",
      "user_type" => "",
      "nom" => "",
      "prenom" => "",
      "civilite" => "",
      "valide" => 0,
      "changeMDP" => 0,
      "created_by" => null,
      "created_at" => null,
    ];
  }
}