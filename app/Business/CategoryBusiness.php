<?php

namespace App\Business;
use App;
// use App\Business;
use Exception;
use Core\Entity;
use Core\Business\Business;


class CategoryBusiness extends Business {

  public function __construct() {

  }
  public function getAll() {
    $categories = $this->loadAll('Category');

    return $categories;
  }
}