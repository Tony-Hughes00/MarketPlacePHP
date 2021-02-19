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

  // public function get($table) {
  //   $boutiques = $this->loadAll($table);

  //   return $boutiques;
  // }
  public function getByUser($userId) {

    $boutiques = $this->getByCol('Boutique', 'id_vendeur', $userId);
// var_dump($boutiques);
    return $boutiques;
  }
  public function getById($id_boutique) {

    $boutiques = $this->getByCol('Boutique', 'id_boutique', $id_boutique);
// var_dump($boutiques);
    return (get_object_vars($boutiques)['0']);
  }
  public function update($data) {

    $resBody = (object) array();
    $resBody->testMessage = 'creating user...';
    // $rsBody->reqData = $data->body;
    $data['id_vendeur'] = $this->UserId();
// var_dump(($data));
    try {
     $boutiqueExists = $this->getByCol('Boutique', 'id_boutique', $data['id_boutique']);
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