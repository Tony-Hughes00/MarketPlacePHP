<?php

namespace App\Controller;
use App;
require_once ROOT ."/app/Views/admin/parcours/utils/Commune.php";
require_once ROOT ."/app/Views/admin/parcours/utils/TrajetValidation.php";

class TrajetDetails
{
  protected $trajet;
  protected $user;
  protected $details = true;

  public function __construct(
              $trajets, 
              $trajet, 
              $user, 
              $parcours, 
              $trajetCorr, 
              $titre, 
              $idCtrl, 
              $disabled, 
              $validation=false) {
    $this->trajets = $trajets;
    $this->trajet = $trajet;
    $this->user = $user;
    $this->titre = $titre;
    $this->parcours = $parcours;
    $this->idCtrl = $idCtrl;
    $this->trajetCorr = $trajetCorr;
    $this->validation = $validation;
    $this->disabled = $disabled;
    // var_dump($this->validation);
  }
    /**
  * Function render adress view
  *
  * @return void
  */
  function afficheValidation() {
    // var_dump($this->trajet);
?>
  <div class="parcoursDetail">
    <input type="hidden" value="TrajetDetails::afficheValidation()">
    <div class="row">
      <div class="col-12">
        <div class="parcoursStrong" style="width:100%; margin-top:5px">
          <?=$this->trajet['trajet']->nomDepart?>&nbsp;->&nbsp;<?=$this->trajet['trajet']->nomArrivee
          ?>
        </div>
        <div>
          <?php 
          // var_dump($this->trajet['trajet']);          
          $date_debut = $this->trajet['trajet']->date_debut;
          $date_fin = $this->trajet['trajet']->date_fin;
          if ($date_debut == null) {
            if ($this->trajet['trajet']->date_val == null) {
              echo '<i>date non attribuée</i>';
            } else {
              echo $this->trajet['trajet']->date_val;
            }
          } else {
            $datesObj = new App\Controller\TrajetDates(
              $date_debut, 
              $date_fin, "Aller", false, "parcoursLabel");
            echo $datesObj->getDateString();
          }
          ?>
        </div>
        <div class="mt-4">
          
          <b><u>Mise en Relation à confirmer</u></b><br>
          <span class="parcoursLabel">Chauffeur :&nbsp;</span>&nbsp;
          <?php 
            if(!($this->trajet == 'none' || $this->trajet['membre'] == 'none')) {
              echo '<span class="parcoursStrong">';
              echo $this->trajet['membre']['membre']->civilite . '&nbsp;';
              echo $this->trajet['membre']['user']->nom . '&nbsp;';
              echo $this->trajet['membre']['user']->prenom . '&nbsp;';
              echo '<a href="' . ROUTE . 'ficheUser.' . $this->trajet['membre']['membre']->users_id . '">';
              echo '<i class="fas fa-user-edit"alt="modifier"></i></a>';
              echo '</span><br/>';
              if (strlen($this->trajet['membre']['membre']->mobile) > 0) {
                echo 'Mobile : <span class="parcoursStrong"><a href="tel:+33' . substr($this->trajet['membre']['membre']->mobile,1) . '">'. $this->trajet['membre']['membre']->mobile. ' </a>&nbsp;';
              } else {
                echo 'Téléphone : <span class="parcoursStrong"><a href="tel:+33' . substr($this->trajet['membre']['membre']->tel,1) . '">'. $this->trajet['membre']['membre']->tel. ' </a>&nbsp;';
              }
              echo '</span><br/>';
              $validationInfoObj = new App\Controller\TrajetValidation(
                          $this->trajet['trajet']->date_val, 
                          $this->trajet['trajet']->trajetId, 
                          $this->validation,
                          $this->trajet['trajet']->trajetId,
                          $this->trajet['trajet']->status,
                          $this->trajet['trajet']->distance);
              $validationInfoObj->affiche();

            } else if($this->trajet['trajet']->correspondance == 0) {
              echo '<span class="parcoursLabel">non renseigné</span>';
            } else {
              echo "###### TODO ########";
            }
          ?>
        </div>
      </div>
      <div class="col-12">
        <?php if($this->trajetCorr) { ?>
        <label for="#attribue<?=$this->parcours->direction?>" >Attribué</label>
        <input type="radio" name="<?=$this->parcours->direction?>id" 
        <?php if($this->trajetCorr) { ?>
          id="<?=$this->trajet->id?>"
          value="<?=$this->trajet->id?>"
        <?php } ?>
            onclick="onClickedCorrespondance(this)"> 
        <label for="#confirme<?=$this->parcours->direction?>" >Confirmé</label>
        <input type="checkbox" name="<?=$this->parcours->direction?>confirm<?=$this->trajet->id?>" 
            id="confirme<?=$this->parcours->direction?><?=$this->trajet->id?>" 
          <?php if($this->trajetCorr) { 
            echo 'onclick="onClickedCorrespondanceConf(this)"';
            echo 'value="' . $this->trajet->id . '"';
          } ?>
            > 
        <label for="#<?=$this->parcours->direction?>valide" >validé</label>
        <input type="checkbox" name="<?=$this->parcours->direction?>id" id="valide<?=$this->parcours->direction?>" 
            onclick="onClickedCorrespondanceVal(this)"> 
        <?php } ?>
      </div>
    </div>
  </div>
<?php
  }
  /**
  * Function render adress view
  *
  * @return void
  */
  function affiche() {
    // var_dump($this->trajet);
?>

  <div class="parcoursDetail">
    <input type="hidden" value="trajetDetails::affiche()">
    <div class="row">
      <div class="col-12">
        <div>
          <div class="parcoursStrong">
            <u><?=$this->titre?> :</u><br/>
            <?=$this->trajet['trajet']->nomDepart?>&nbsp;->&nbsp;<?=$this->trajet['trajet']->nomArrivee?>
          </div>
          <?php 
            if($this->trajet['trajet']->date_debut == null) {
              $dispos = $this->trajets["dispo"][$this->trajet['trajet']->trajetId];
              $dispoObj = new App\Controller\TrajetDispo();
              foreach($dispos as $dispo) {
                $dispoObj->afficheDayTime($dispo, 'aller');
              }
            } else {            
              $dates = new TrajetDates(
              $this->trajet['trajet']->date_debut,
              $this->trajet['trajet']->date_fin, 
              "", false, "parcoursLabel", "parcoursStrong");
              echo $dates->getDateString() . '</span>';
            }
            ?>
        </div>
        <div >
          <?php
          // var_dump($this->trajet);
          ?>
          <?php
            if ($this->trajet['correspondance'] == 'none') {
              // echo '<span class="parcoursLabel">Correspondance : </span>';
              // echo '<i class="text-secondary"> &nbsp; Non renseignée </i>';
            } else {
              ?>
          <span class="parcoursLabel parcoursStrong" style="vertical-align: text-top">
          <u>Mise en relation :</u><br>
          <?php
             if ($this->trajet['membre']['membre']->membre_type == 'passager') {
              echo 'Passager :';
            } else {
              echo 'Chauffeur :';
            }
            ?>
            <!-- &nbsp;</span>&nbsp; -->
          <?php 
            if(!($this->trajet == 'none' || $this->trajet['membre'] == 'none')) {
              // echo '<span class="parcoursStrong">';
              echo $this->trajet['membre']['membre']->civilite . '&nbsp;';
              echo $this->trajet['membre']['user']->nom . '&nbsp;';
              echo $this->trajet['membre']['user']->prenom . '<br>';
              if (strlen($this->trajet['membre']['membre']->mobile) > 0) {
                echo 'Mobile : ' . $this->trajet['membre']['membre']->mobile . '&nbsp;';
              } else {
                echo 'Téléphone : ' . $this->trajet['membre']['membre']->tel . '&nbsp;';
              }
              echo '</span>';
              // echo '</span>';
              // echo '<a href="' . ROUTE . 'ficheUser' . '.' . $this->trajet['membre']['membre']->users_id . '">';
              // echo '<i class="fas fa-user-edit"alt="modifier"></i></a>';
              // var_dump($this->idCtrl . $this->trajet['trajet']->id);
              $validationInfoObj = new App\Controller\TrajetValidation(
                              $this->trajet['trajet']->date_val, 
                              $this->trajet['trajet']->id, 
                              $this->validation,
                              $this->trajet['trajet']->trajetId,
                              $this->trajet['trajet']->status,
                              $this->trajet['trajet']->distance,
                            "affiche");
              $validationInfoObj->affiche();
              echo '</span>';
            } else if($this->trajet['trajet']->correspondance == 0) {
              echo '<span class="parcoursLabel">non renseigné</span>';
            } else {
              echo "###### TODO ########";
            }
          }
          ?>

        </div>
      </div>
      <div class="col-12">
        <?php if($this->trajetCorr) { ?>
        <label for="#attribue<?=$this->parcours->direction?>" >Attribué</label>
        <input type="radio" name="<?=$this->parcours->direction?>id" 
        <?php if($this->trajetCorr) { ?>
          id="<?=$this->trajet->id?>"
          value="<?=$this->trajet->id?>"
        <?php } ?>
            onclick="onClickedCorrespondance(this)"> 
        <label for="#confirme<?=$this->parcours->direction?>" >Confirmé</label>
        <input type="checkbox" name="<?=$this->parcours->direction?>confirm<?=$this->trajet->id?>" 
            id="confirme<?=$this->parcours->direction?><?=$this->trajet->id?>" 
          <?php if($this->trajetCorr) { 
            echo 'onclick="onClickedCorrespondanceConf(this)"';
            echo 'value="' . $this->trajet->id . '"';
          } ?>
            > 
        <label for="#<?=$this->parcours->direction?>valide" >validé</label>
        <input type="checkbox" name="<?=$this->parcours->direction?>id" id="valide<?=$this->parcours->direction?>" 
            onclick="onClickedCorrespondanceVal(this)"> 
        <?php } ?>
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

