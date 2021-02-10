<?php

namespace App\Business;
use App;
// use App\Business;
use Exception;
use Core\Entity;
use Core\Business\Business;


class BoutiqueBusiness extends Business {

  public function __construct() {

  }

  public function getByUser($userId) {

    $boutiques = $this->loadBy('Boutique', 'id_vendeur', $userId);

    return $boutiques;
  }
}