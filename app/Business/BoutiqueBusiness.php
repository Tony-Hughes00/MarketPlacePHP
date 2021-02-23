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
  $boutique = $boutiques['0'];
  $boutique->adresse = $this->loadAdresse($boutique->adr_boutique);
  var_dump($boutique);
    return ($boutique);
  }
  public function update($id_boutique, $data, $files) {
    
    $imgName = "";
    if (isset($files['boutiqueImage']['name'])) {
      $imgName = $files['boutiqueImage']['name'];
    }
    $data['img_boutique'] = $imgName;
    // var_dump($data);

    $adresse = $this->updateAdresse($data);

    $data['adr_boutique'] = $adresse->id_adresse;
    if ($id_boutique > 0) {
      $boutique = $this->load('Boutique', 'id_boutique', $data['id_boutique']);

      if (is_array($boutique) && count($boutique) > 0) {
        $boutique = $boutique[0];
      }
      $boutique = $boutique->update($data);
      // var_dump($boutique);
    } else {
      $data['id_vendeur'] = $this->UserId();
      $boutique = $this->create('Boutique', $data);
      // var_dump($boutique);
    }
    $tele = new TelechargementBusiness();
    $tele->upload($boutique->id_boutique, $files);

    $boutique->adresse = $this->loadAdresse($boutique->adr_boutique);

    return $boutique;
  }
  private function updateAdresse($data) {
    $adreseBusiness = new App\business\AdresseBusiness();
    return $adreseBusiness->update($data);
  }
  private function loadAdresse($id) {
    $adreseBusiness = new App\business\AdresseBusiness();
    return $adreseBusiness->loadById($id);
  }
}