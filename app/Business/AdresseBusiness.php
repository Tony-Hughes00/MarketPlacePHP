<?php

namespace App\Business;
use App;
// use App\Business;
use Exception;
use Core\Entity;
use Core\Business\Business;


class AdresseBusiness extends Business {

  public function __construct() {

  }
  public function update($data) {
    if (isset($data['id_adresse']) && $data['is_adresse'] > 0) {
      $adresse = $this->load('Adresse', 'id_adresse', $data['id_adresse']);
      if (is_array($adresse) && count($adresse) > 0) {
        $adresse = $adresse[0];
      }
      $adresse = $adresse->update($data);
    } else {
      $adresse = $this->create('Adresse', $data);
    }
    return $adresse;
  }
  public function loadById($id) {
    return $this->load('Adresse', 'id_adresse', $id);
  }
}