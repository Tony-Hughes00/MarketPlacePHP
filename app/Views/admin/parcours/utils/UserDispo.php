<?php

namespace App\Controller;
use App;

require_once ROOT ."/app/Views/admin/parcours/utils/TrajetDispojour.php";

class UserDispo
{
  public function __construct() {
    $this->class = "parcoursBox";
  }

  function afficheFormulaireUpdate($dispos) {

  ?>
  <fieldset class="<?=$this->class?>" >
    <legend class="parcoursLabel parcoursLegend">Enregistrer vos Disponibilités</legend>
    <div class="row">
      <input type="hidden" value="TrajetDispo::afficheFormulaireUpdate()">
      <!-- <small class="text-danger">Changer Ordre column1 : Lundi, mardi mercredi, jeudi + colum2 : Vendredi, samedi, dimanche</small> -->
    <?php
    $dispoJour = [];
    for($j = 0; $j < 7; $j++) {
      $dispoJour[$j] = [];
    }
    foreach($dispos as $dispo) {
      $dispoJour[$dispo->jour_dispo][] = $dispo;
    }
    ?>
    <div class="col-12 col-sm-6">
    <?php
    for($j = 1; $j < 5; $j++) {
      ?>
      <div class="parcoursDispo"><?php
        $trajetDispoJour = new TrajetDispoJour($j, "dispo");
        $trajetDispoJour->afficheUpdateUser($dispoJour[$j]);

      ?></div><?php
    }
    ?>
    </div>
    <div class="col-12 col-sm-6">
    <?php
    for($j = 5; $j < 7; $j++) {
      ?>
      <div class="parcoursDispo"><?php
        $trajetDispoJour = new TrajetDispoJour($j, "dispo");
        $trajetDispoJour->afficheUpdateUser($dispoJour[$j]);

      ?></div><?php
    }
    ?>
      <div class="parcoursDispo"><?php
      $trajetDispoJour = new TrajetDispoJour(0, "dispo");
      $trajetDispoJour->afficheUpdateUser($dispoJour[0]);

    ?></div>
    </div>

    </fieldset>
    </div><?php
  }
  function afficheDayTime($dispo, $court = false) {
    $joursLong = ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
    $joursCourt = ["dim", "lun", "mar", "mer", "jeu", "ven", "sam"];
    $jours = $joursLong;
    if($court == true) {
      $jours = $joursCourt;
    }
    // echo '<span class="parcoursBold">';
    echo $jours[$dispo->jour_dispo];
    // echo '</span>';
    echo " (" . substr($dispo->h_dbt, 0 ,5) . "-" . substr($dispo->h_fin, 0 ,5) . ") ";
  }
  function afficheJour($dispo, $court = false) {
    $joursLong = ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
    $joursCourt = ["dim", "lun", "mar", "mer", "jeu", "ven", "sam"];
    $jours = $joursLong;
    if($court == true) {
      $jours = $joursCourt;
    }
    echo $jours[$dispo->jour_dispo] . " ";
  }
}