<?php
// SELECT * FROM `communecarte` JOIN commune ON communecarte.commune = commune.id WHERE 1
function getCommunesCarte() {
  $loadCarteCommune = App::getInstance()->getTable('CommuneCarte');
  $communeDB = $loadCarteCommune->selectAllCarte();
  // var_dump($communeDB[0]);
  $carteCommunes = [];
  foreach($communeDB as $commune) {
    $communeData = array();
    $communeData["class"] = $commune->class;
    $communeData["fill"] = $commune->fill;
    $communeData["stroke"] = $commune->stroke;
    $communeData["stroke_width"] = $commune->stroke_width;
    $communeData["points"] = $commune->points;
    $communeData["nom"] = $commune->nom;
    $carteCommunes[$commune->id] = $communeData;
  }
  return $carteCommunes;
}

function getSVGTrajetsCorr($trajetsCorr) {
  // var_dump($trajetsCorr);

  $trajets = array();
  // var_dump($trajetsCorr['corrArr']);
  // var_dump($trajetsCorr['corrDep']);
  // var_dump($trajetsCorr['addArrivee']);
  // var_dump($trajetsCorr['addDepart']);
  echo '<line id="corrTrajet" x1="0" y1="0" x2="0" y2="0" style="stroke: yellow; stroke-width:3px"/>';
  if($trajetsCorr['corrArr'] != "none") {
    foreach($trajetsCorr['corrArr'] as $trajArr) {
      // var_dump($trajArr);
      echo '<line id="corrArr' . $trajArr->id . '"  x1="0" y1="0" x2="0" y2="0" style="stroke: #3fa047; stroke-width:3px" />';
    }
  }
  if($trajetsCorr['corrDep'] != "none") {
    foreach($trajetsCorr['corrDep'] as $trajDep) {
      // var_dump($trajArr);
      echo '<line id="corrDep' . $trajDep->id . '"  x1="0" y1="0" x2="0" y2="0" style="stroke: #f04f3a; stroke-width:3px" />';
    }
  }
  if($trajetsCorr['corrArrDispo'] != "none") {
    foreach($trajetsCorr['corrArrDispo'] as $trajArr) {
      // var_dump($trajArr);
      echo '<line id="corrArr' . $trajArr->id . '"  x1="0" y1="0" x2="0" y2="0" style="stroke: #3fa047; stroke-width:3px" />';
    }
  }
  // var_dump($trajetsCorr['corrDepDispo']);
  if($trajetsCorr['corrDepDispo'] != "none") {
    // var_dump($trajetsCorr['corrDepDispo']);
    foreach($trajetsCorr['corrDepDispo'] as $trajDep) {
      // var_dump($trajArr);
      echo '<line id="corrDep' . $trajDep->id . '"  x1="0" y1="0" x2="0" y2="0" style="stroke: #f04f3a; stroke-width:3px" />';
    }
  }
  echo '<image id="corrTarget" width="0" height="0" transform="translate(390.37 360.01), scale(0.7)" href="' . RACINE. 'images/Flag.png" style="background: transparent"/>';

}
function getSVGTrajets() {
  $loadParcours = App::getInstance()->getTable('Parcours');
  $loadAdresse = App::getInstance()->getTable('Adresse');
  $trajetUtils = new App\Controller\Admin\TrajetUtils();

  $trajetsDB = $trajetUtils->selectParcoursDB($loadAdresse, $loadParcours); 
  $trajets = array();
  $index = 0;
  foreach($trajetsDB['offres'] as $offre) {

      $depart = [];
      $depart["commune"] = $offre['addDepart'];
      $depart["class"] = "clv-3";
      $depart["cx"] = "0";
      $depart["cy"] = "0";
      $depart["r"] = "8.0";
      $depart["type"] = "1";
      $trajets['circle' . $index] = $depart;
      $index += 1;

      $arrivee = [];
      $arrivee["commune"] = $offre['addArrivee'];
      $arrivee["class"] = "clv-2";
      $arrivee["cx"] = "0";
      $arrivee["cy"] = "0";
      $arrivee["r"] = "8.0";
      $arrivee["type"] = "0";
      $trajets['circle' . $index] = $arrivee;
      $index += 1;
  }
  foreach($trajetsDB['demandes'] as $offre) {

    $depart = [];
    $depart["commune"] = $offre['addDepart'];
    $depart["class"] = "clv-3";
    $depart["cx"] = "0";
    $depart["cy"] = "0";
    $depart["r"] = "8.0";
    $depart["type"] = "1";
    $trajets['circle' . $index] = $depart;
    $index += 1;

    $arrivee = [];
    $arrivee["commune"] = $offre['addArrivee'];
    $arrivee["class"] = "clv-2";
    $arrivee["cx"] = "0";
    $arrivee["cy"] = "0";
    $arrivee["r"] = "8.0";
    $arrivee["type"] = "0";
    $trajets['circle' . $index] = $arrivee;
    $index += 1;
}
// var_dump($trajets);
  return $trajets;
}
function getSVGDispos() {
  $loadDispo = App::getInstance()->getTable('Dispo');
  $trajetUtils = new App\Controller\Admin\TrajetUtils();

  $disposDB = $trajetUtils->selectDispoDB($loadDispo); 
  $index = 0;
// var_dump($disposDB);
  foreach($disposDB as $dispoDB) {

      $dispo = [];
      $dispo["commune"] = $dispoDB->commune;          
      $dispo["class"] = "clv-4";
      $dispo["cx"] = "0";
      $dispo["cy"] = "0";
      $dispo["r"] = "8.0";
      $dispo["type"] = "2";
      $dispos['dispo' . $index] = $dispo;
      $index += 1;

  }
  return $disposDB;
}
function getTrajets() {
  $loadParcours = App::getInstance()->getTable('Parcours');
  $loadAdresse = App::getInstance()->getTable('Adresse');
  $loadDispo = App::getInstance()->getTable('Dispo');
  $trajetUtils = new App\Controller\Admin\TrajetUtils();

  $trajetsDB = $trajetUtils->selectParcoursDB($loadAdresse, $loadParcours); 
  $trajets = array();
  $disposAllerStr = "";
  $disposRetourStr = "";

  foreach($trajetsDB['offres'] as $offre) {
    if($offre['date_debut_aller'] == null) {
      $dispos = $loadDispo->selectDispoParcours($offre['id']);
      $disposAllerStr = "";
      $disposRetourStr = "";
      $joursLong = ["dimanches", "lundis", "mardis", "mercredis", "jeudis", "vendredis", "samedis"];

      foreach($dispos as $dispo) {
        if (strlen($disposAllerStr) > 0) {
          $disposAllerStr = $disposAllerStr . ' ';
        }
        if (strlen($disposRetourStr) > 0) {
          $disposRetourStr = $disposRetourStr . ' ';
        }
        if ($dispo->direction == 'aller') {
          $disposAllerStr = $disposAllerStr . $joursLong[$dispo->jour_dispo];
        } else {
          $disposRetourStr = $disposRetourStr . $joursLong[$dispo->jour_dispo];
        }
      }
    }
      $trajet = [];
      $trajet["depart"] = $offre['addDepart'];
      $trajet["arrivee"] = $offre['addArrivee'];
      $trajet["type"] = $offre['tra_type'];
      $trajet["id"] = $offre['id'];
      $trajet["date_debut_aller"] = $offre['date_debut_aller'];;
      $trajet["date_fin_aller"] = $offre['date_fin_aller'];;
      $trajet["date_debut_retour"] = $offre['date_debut_retour'];;
      $trajet["date_fin_retour"] = $offre['date_fin_retour'];
      $trajet["dispoAller"] = $disposAllerStr;
      $trajet["dispoRetour"] = $disposRetourStr;
      $trajets[] = $trajet;
  }
  foreach($trajetsDB['demandes'] as $offre) {
    if($offre['date_debut_aller'] == null) {
      $dispos = $loadDispo->selectDispoParcours($offre['id']);
      $disposAllerStr = "";
      $disposRetourStr = "";
      $joursLong = ["dimanches", "lundis", "mardis", "mercredis", "jeudis", "vendredis", "samedis"];

      foreach($dispos as $dispo) {
        if (strlen($disposAllerStr) > 0) {
          $disposAllerStr = $disposAllerStr . ' ';
        }
        if (strlen($disposRetourStr) > 0) {
          $disposRetourStr = $disposRetourStr . ' ';
        }
        if ($dispo->direction == 'aller') {
          $disposAllerStr = $disposAllerStr . $joursLong[$dispo->jour_dispo];
        } else {
          $disposRetourStr = $disposRetourStr . $joursLong[$dispo->jour_dispo];
        }      
      }
    }
    $trajet = [];
    $trajet["depart"] = $offre['addDepart'];
    $trajet["arrivee"] = $offre['addArrivee'];
    $trajet["type"] = $offre['tra_type'];
    $trajet["id"] = $offre['id'];
    $trajet["date_debut_aller"] = $offre['date_debut_aller'];;
    $trajet["date_fin_aller"] = $offre['date_fin_aller'];;
    $trajet["date_debut_retour"] = $offre['date_debut_retour'];;
    $trajet["date_fin_retour"] = $offre['date_fin_retour'];;
    $trajet["dispoAller"] = $disposAllerStr;
    $trajet["dispoRetour"] = $disposRetourStr;

    $trajets[] = $trajet;
}
  return $trajets;
}
function GetBusTrain() {
  $busTrain = array (
    "busTrain0" => array ( "commune" => "St-avit", "class" => "clv-2", "cx" => "0", "cy" => "0", "r" => "6.0", "type" => "0"), 
  );
  return $busTrain; 
}
function GetInfo() {
  $info = array (
      "info0" => array ( "commune" => "48", "width"=>"100", "height"=>"100", "transform"=>"translate(572.37 232.01), scale(0.3)", "href"=>RACINE."images/gare.png"), 
      "info1" => array ( "commune" => "15", "width"=>"100", "height"=>"100", "transform"=>"translate(410.32 445.91), scale(0.3)", "href"=>RACINE."images/gare.png"), 
    );
//   echo '
//  <image width="64" height="64" transform="translate(399.32 445.91) scale(0.49)" xlink:href="data:image/png;base64,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"/>
//  <image width="100" height="100" transform="translate(562.37 232.01) scale(0.3)" xlink:href="data:image/png;base64,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"/>

//  ';
 return $info;
}
function GetAntenne() {
  // SELECT * FROM `carteantenne` JOIN commune ON carteantenne.commune = commune.id WHERE 1 
  $loadCarteAntenne = App::getInstance()->getTable('CarteAntenne');
  $antenneDB = $loadCarteAntenne->selectAllCarte();

  $index = 0;
  $carteAntennes = [];
  foreach($antenneDB as $antenne) {
    $antenneData = array();

    $antenneData["commune"] = $antenne->id;
    $antenneData["width"] = $antenne->width;
    $antenneData["height"] = $antenne->height;
    $antenneData["transform"] = $antenne->transform;
    $antenneData["href"] = RACINE.$antenne->href;

    $carteAntennes['antenne'.$index] = $antenneData;
    $index++;
  }
  return $carteAntennes;
}

