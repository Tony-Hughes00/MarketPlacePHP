<?php

namespace App\Entity;

use Core\Entity\Entity;

class UserEntity extends Entity {

     /**
     * init
     */
    public function __construct() {
      var_dump("UserEntity constructor");

      $this->tableName = "user";
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
  public static function fromArray( array $row ) {
    $instance = new self();
    $instance->fill( $row );
    return $instance;
  }
  public static function loadFromEmail( $email ) {
    $instance = new self();
    $user = $instance->loadByEmail( $email );
    return $user == null ? false : $user;
  }
}