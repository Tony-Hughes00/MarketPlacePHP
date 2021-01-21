<?php

function getNomCommune($id) {
    $nom = '<i class="text-secondary"> Non renseigné</i>';
    // if(!$communes) {
    //     return $nom;
    // }
    $loadCommune = App::getInstance()->getTable('Commune');
    $communes = $loadCommune->selectCommunes(); 
    foreach($communes as $commune) {
      if( $commune->id == $id) {
        return $commune->nom;
      }
    }
    return $nom;
  }
  function getCodePostalCommune($communes, $idd) {
    $codePostal = '<i class="text-secondary"> Non renseigné</i>';
    if(!$communes) {
        return $codePostal;
    }
    foreach($communes as $commune) {
      if( $commune->id = $id) {
        return $commune->code_postal;
      }
    }
    return $codePostal;
  }
?>