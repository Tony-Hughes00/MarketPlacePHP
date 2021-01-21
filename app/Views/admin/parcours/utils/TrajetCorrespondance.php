<?php

namespace App\Controller;
use App;
use DateTime;
require_once ROOT ."/app/Views/admin/parcours/utils/Commune.php";
require_once ROOT ."/app/Views/admin/parcours/utils/TrajetDates.php";

class TrajetCorrespondance
{
  protected $trajet;
  protected $user;
  protected $details = true;

  // public function __construct($trajets, $trajet, $user, $parcours, $trajetCorr, $details, $titre, $idCtrl, $disabled, $validation=false) {
    public function __construct(
            $trajets, 
            $trajet, 
            $user, 
            $parcours, 
            $dispo, 
            $idCtrl, 
            $disabled) {
    $this->trajets = $trajets;
    $this->trajet = $trajet;
    // $this->details = $details;
    $this->user = $user;
    $this->dispo = $dispo;
    $this->parcours = $parcours;
    $this->idCtrl = $idCtrl;
    $this->trajetCorr = true;
    // $this->validation = $validation;
    $this->disabled = $disabled;
  }
  function affiche() {
    // var_dump($this->parcours);
?>
  <div class="parcoursDetail">
    <input type="hidden" value="TrajetCorrespondance::affiche()">
    <div class="row">
    <div class="col-12">
        <?php if($this->trajetCorr) { 
          ?>
        <input type="radio"
        <?php
        $checked = false;
        // var_dump($this->trajet);
        if ($this->trajet->actif == 0) {
          $this->disabled = true;
        }
        if($this->trajet->correspondance > 0 ) {
            $checked = false;
            // var_dump($this->parcours);
            // var_dump($this->trajet);
            if($this->parcours->trajetId == $this->trajet->correspondance) {
              echo ' checked="checked" ';
              if ($this->disabled) {
                echo ' disabled ';
              }
            } else {
              if($this->disabled) {
                echo ' disabled ';
              } else {
                if($this->trajet->correspondance > 0) {
                  echo ' disabled ';
                  echo 'name="' . $this->parcours->direction . 'id"'; 
                } else {
                  echo 'name="' . $this->parcours->direction . 'id"'; 
                  if ($this->trajet->actif == 0) {
                    $this->disabled = true;
                  }
          
                }
              }
            }
        } else {
          echo ' name="' . $this->parcours->direction . 'id" '; 
        }
        echo ' name="' . $this->parcours->direction . 'id" '; 

        if($checked == true) {        // ########## TODO check correspondance matches this parcours
          }
          if($this->disabled || $this->trajet->actif == 0) {
            // if (($this->parcours->trajetId != $this->trajet->correspondance) ||
            // if (($this->trajet->status > 1)) {
              echo ' disabled ';
            // }
          }
        ?>
        <?php if($this->trajetCorr) { ?>
          id="<?=$this->trajet->id?>"
          value="<?=$this->trajet->id?>"
        <?php } 
        // var_dump($this->trajet);
        ?>
            onclick="onClickedCorrespondance(this)"> 
            <label for="#attribue<?=$this->parcours->direction?>" >
            <?php if ($this->disabled) { 
            if ($this->dispo != 'none') {
              // var_dump($this->trajet);
            ?>
            <a href="<?=ROUTE?>enrCopy.<?=$this->trajet->userId?>.<?=$this->parcours->parcours?>">
            <!-- <a href="< ?=ROUTE?>enrCopy.< ?=$this->parcours->parcours?>.< ?=$this->trajet->userId?>"> -->
            <i class="far fa-copy" alt="copier"></i>
            <?php } else { 
                if ($this->parcours->date_debut == null) {
                  ?>
                  <a href="<?=ROUTE?>enrCopy.<?=$this->trajet->userId?>.<?=$this->parcours->parcours?>enrCopy.<?=$this->trajet->userId?>.<?=$this->parcours->parcours?>">
                  <!-- <a href="<?=ROUTE?>parcoursnewForDispo.<?=$this->trajet->parcoursId?>.<?=$this->parcours->parcours?>"> -->
                  <i class="far fa-copy" alt="copier"></i>
      <?php
                } else {
                  // var_dump($this->trajet);
              ?>
              <a href="<?=ROUTE?>enrCopy.<?=$this->trajet->userId?>.<?=$this->parcours->parcours?>">
            <!-- <a href="<?=ROUTE?>detailParcours.<?=$this->trajet->parcoursId?>"> -->
            <i class="fas fa-copy" alt="modifier"></i>
            <?php } } 
            }?>
        <?=$this->trajet->nomDepart?>&nbsp;->&nbsp;<?=$this->trajet->nomArrivee?>
        </a>
        <?php if($this->dispo == 'none') { 
          $dates = new TrajetDates(
            $this->trajet->date_debut,
            $this->trajet->date_fin, 
              "", false, "parcoursLabel", "parcoursStrong");
          echo $dates->getDateString();
          ?>
       <?php } else { ?>
          <?php 
          if (count($this->dispo) > 0) {
            echo ' - les ';
          }
            foreach($this->dispo as $dispo) {
              $joursLong = ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
              echo '<span class="parcoursStrong">';
              echo $joursLong[$dispo->jour_dispo];
              echo '</span>';              
              echo " (" . substr($dispo->h_dbt, 0 ,5) . "-" . substr($dispo->h_fin, 0 ,5) . ") ";
            }
        } ?>
      </label>
        <?php } ?>
      </div>
    <div class="col-9">
        <div style="padding-left:30px;">
          <span class="parcoursLabel">Chauffeur :&nbsp;</span>&nbsp;
          <?php 
          // var_dump($this->trajet);
            if($this->user == 'none') {
              echo '<b>';
              echo ucfirst($this->trajet->civilite) . '&nbsp;';
              echo ucfirst($this->trajet->prenom) . '&nbsp;';
              echo ucfirst($this->trajet->nom) . '&nbsp;';
              echo '</b>';
              if (strlen($this->trajet->mobile) > 0) {
                echo '<i>mobile: </i>&nbsp;<b>' . $this->trajet->mobile . '</b>&nbsp;';
              } else {
                echo '<i>tél: </i>&nbsp;<b>' . $this->trajet->tel . '</b>&nbsp;';
              }
              if ($this->trajet->actif == 0) {
                echo '<div class="text-danger"><i><b>(inactif)</b></i></div>';
              }
              if($this->trajet->correspondance > 0) {
                echo ' <span class="parcoursLabel">Status :&nbsp;</span>';
                switch ($this->trajet->status) {
                  case 0:
                      echo '<span class="text-secondary"> non attribué</span>';
                      break;
                  case 1:
                      echo '<span class="parcoursStrong">&nbsp;attribué</span>';
                      break;
                  case 2:
                      echo '<span class="parcoursStrong"> confirmé</span>';
                      break;
                  case 2:
                      echo '<span class="parcoursStrong"> validé</span>';
                      break;
                  default:
                      echo '<span class="text-secondary"> non attribué</span>';
                      break;                    
                }
              }
            } else if($this->trajet['trajet']->correspondance == null) {
              echo '<span class="parcoursLabel">non renseigné</span>';
            } else {
              echo "###### TODO ########";
            }
          ?>
        </div>
      </div>
    </div>
  </div>
<?php
  }
  function getCommuneFromAdresse($adresseId) {
    $loadAdresse = App::getInstance()->getTable('Adresse');
    $adresse = $loadAdresse->selectAdresse($adresseId); 

    return $this->getNomCommune($adresse->commune);
  }
  function getNomCommune($communeid) {
    $loadCommune = App::getInstance()->getTable('Commune');
    $communes = $loadCommune->selectCommunes(); 
    foreach($communes as $commune) {
      if($commune->id == $communeid) {
        return $commune->nom;
      }
    }
  }
}
?>

