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
    $this->id = "id_user";

    $this->init();
    // App::console_log( "UserEntity constructor" );
  }
  private function init() {
    $this->values = [
      (string) "id_user" => null,
      (string) "email" => "",
      (string) "mdp" => "",
      (string) "user_type" => "",
      (string) "nom" => "",
      (string) "prenom" => "",
      (string) "civilite" => "",
      (string) "valide" => "2",
      (string) "changeMDP" => "0",
      (string) "created_by" => null,
      (string) "created_at" => null,
    ];
  }
}