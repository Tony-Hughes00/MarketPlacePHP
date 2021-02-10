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

  public function get($table) {
    $boutiques = $this->loadAll($table);

    return $boutiques;
  }
  public function getByUser($userId) {

    $boutiques = $this->loadBy('Boutique', 'id_vendeur', $userId);

    return $boutiques;
  }

  public function update($data) {

    $resBody = (object) array();
    $resBody->testMessage = 'creating user...';
    // $rsBody->reqData = $data->body;
    $data['id_vendeur'] = $this->UserId();

    try {
     $boutiqueExists = $this->loadBy('Boutique', 'id_boutique', $data['id_boutique']);
    }
    catch (Exception $e) {
        $resBody->error = $e;
    }
    if (!$boutiqueExists) {
      $boutique = $this->create('Boutique', $data);
      $resBody->boutique = $boutique;

      $resBody->status = "0";
     //  $resBody->statusApi = "0";
      $resBody->message = "boutique created";
    } else {
      $resBody->status = "1";
      // $resBody->statusApi = "1";
      $resBody->message = "user already exists";
      $boutiqueExists->update();
      $resBody->boutique = $boutiqueExists;
    } 
    return $resBody;
  }
}