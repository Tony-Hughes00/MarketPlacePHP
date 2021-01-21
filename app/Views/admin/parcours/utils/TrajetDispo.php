<?php

namespace App\Controller;
use App;

require_once ROOT ."/app/Views/admin/parcours/utils/TrajetDispoJour.php";

class TrajetDispo
{
  public function __construct() {
  }

  function afficheFormulaire() {
    ?><div class="row">
      <input type="hidden" value="TrajetDispo::afficheFormulaire()">
      <div class="col-12 col-sm-6">
    <?php
    for($j = 1; $j < 5; $j++) {
      ?>
      <div class="col-12 parcoursDispo"><?php
        $dispoJour = new TrajetDispoJour($j, "dispo");
        $dispoJour->affiche();

      ?></div><?php
    }
    ?>
    </div>
    <div class="col-12 col-sm-6">
    <?php
    for($j = 5; $j < 7; $j++) {
      ?>
      <div class="col-12 parcoursDispo"><?php
        $dispoJour = new TrajetDispoJour($j, "dispo");
        $dispoJour->affiche();

      ?></div><?php
    }
    ?>
        <div class="col-12 parcoursDispo"><?php
        $dispoJour = new TrajetDispoJour(0, "dispo");
        $dispoJour->affiche();

      ?></div>
    </div>
    </div><?php
  }
  function afficheFormulaireUpdate($dispo) {
    $aller = null;
    $retour = null;
    foreach($dispo['trajets'] as $trajet) {
      if ($trajet['trajet']->direction == 'aller') {
        $aller = $trajet['trajet'];
      }
      if ($trajet['trajet']->direction == 'retour') {
        $retour = $trajet['trajet'];
      }
    }
    $dispoRetour = null;
    $dispoAller = $dispo['dispo'][$aller->trajetId];
    if ($retour != null) {
      $dispoRetour = $dispo['dispo'][$retour->trajetId];
    }
    // var_dump($dispoAller);
    // var_dump($dispoRetour);
  ?>
    <div class="row">
      <input type="hidden" value="TrajetDispo::afficheFormulaireUpdate()">
      <div class="col-12 col-md-6">
    <?php
    for($j = 1; $j < 5; $j++) {
      ?>
      <div class="col-12  parcoursDispo"><?php
        $dispoJour = new TrajetDispoJour($j, "dispo");
        $dispoJour->afficheUpdate($dispoAller, $dispoRetour);

      ?></div><?php
    }
    ?></div>
    <div class="col-12 col-md-6">
    <?php
    for($j = 5; $j < 7; $j++) {
      ?>
      <div class="col-12  parcoursDispo"><?php
        $dispoJour = new TrajetDispoJour($j, "dispo");
        $dispoJour->afficheUpdate($dispoAller, $dispoRetour);

      ?></div>

      <?php
    }
    ?>
          <div class="col-12  parcoursDispo"><?php
        $dispoJour = new TrajetDispoJour(0, "dispo");
        $dispoJour->afficheUpdate($dispoAller, $dispoRetour);

      ?></div>
    </div>
    </div><?php
  }
  function affiche($parcours, $direction) {
    ?><div class="">
      <input type="hidden" value="TrajetDispo::affiche()"><?php
        foreach($parcours['trajets'] as $trajet) {
          if($trajet['trajet']->direction == $direction) {
            $trajetId = $trajet['trajet']->trajetId;
            foreach ($parcours['dispo'][$trajetId] as $dispo) {
              echo '<span class="parcoursStrong" style="padding-left:5%;">';
              $this->afficheDayTime($dispo, $court = false);
              echo '</span>';
              echo '<br />';
            }
          }
        }
    ?></div><?php
  }
  function afficheConsult($offre, $direction) {
    ?><!-- <div class="row"> -->
        <input type="hidden" value="TrajetDispo::afficheConsult()">
        <!-- <div class="col-12"> -->
<?php
    foreach ($offre['dispos'] as $dispo) {
      ?>
      <span class="parcoursSmall parcoursStrong"> <?php
      if ($dispo->direction == $direction) {
        $this->afficheJour($dispo, true);
      }?>
      </span> <?php
    }
    ?>
    <!-- </div></div> --><?php
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