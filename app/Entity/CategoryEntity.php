<?php

namespace App\Entity;
use App;
use Core\Entity\Entity;

class CategoryEntity extends Entity {

  /**
  * init
  */
  public function __construct() {
    $this->tableName = "category";
    $this->id = "id_category";

    $this->init();
  }
  public function init() {
    $this->values = [
      (string) "id_category" => null,
      (string) "nom-category" => "",
      (string) "img_category" => ""
    ];

  }
}