<?php

namespace App\Controller;
use App;

require_once ROOT ."/app/Views/admin/parcours/utils/motif.php";
require_once ROOT ."/app/Views/admin/parcours/utils/TrajetDates.php";
require_once ROOT ."/app/Views/admin/parcours/utils/trajetDetails.php";
require_once ROOT ."/app/Views/admin/parcours/utils/TrajetDispo.php";
require_once ROOT ."/app/Views/admin/parcours/utils/Commune.php";  

class TrajetInfo
{
  protected $trajet;

  public function __construct($parcours, $addDepart, $addArrivee, $membre, $validation, $fieldset = true, $columns = 2) {

    $this->parcours = $parcours;
    $this->addDepart = $addDepart;
    $this->addArrivee = $addArrivee;
    $this->membre = $membre;
    $this->validation = $validation;
    $this->class = "parcoursBox";
    $this->fieldset = $fieldset;
    $this->classLabel = "parcoursLabelRight";
    $this->idCtrl = "validation";
    $this->classValue = "parcoursValue";   
    $this->colClass = "col-12";
    $this->columns = $columns;
    $this->colClass = "col-12";
    if ($this->columns == 2) {
      $this->colClass = "col-12 col-lg-6";
    }

  }
  /**
  * Function render adress view
  *
  * @return void
  */
  function afficheDetailsTrajet() {
    $this->afficheDetails();
  }
  /**
  * Function render adress view
  *
  * @return void
  */
  function afficheDetails() {
    ?>
    <fieldset >
    <!-- <fieldset class="<?=$this->class?>" > -->
    <!-- <legend class="parcoursLabel parcoursLegend">Trajet</legend> -->
    <?php
      if ($this->validation) {
        echo '<div class="row">';
//        echo '<div class="col-12 col-md-5">';
        echo '<div class="col-12">';
      }
      ?>
      <input type="hidden" value="trajetInfo::afficheDetails()">
      <!-- <legend style="border: 1px black solid;margin-left: 1em; padding: 0.2em 0.8em ">Membre</legend> -->
<?php
// var_dump($this->membre);
?>
<div class="row">
  <div class="<?=$this->colClass?>">
  <?php
      if ($this->membre->membre_type == "passager") {
?>

      <div class="parcoursLabel parcoursStrong" style="text-align:center;padding-bottom:30px; font-size:25px;">
        <u>DEMANDE</u>
      </div>
      <div style="text-align:center;">   <!-- Motif de la demande -->
        <span class="<?=$this->classLabel?> parcoursStrong">Motif de la demande :&nbsp;</span>
        <span class="parcoursStrong">
          <?=$this->getDescMotif($this->parcours['parcours']->motif)?>
        </span>
      </div>    <!-- Motif de la demande -->
      <?php
      } else {?>
        <div class="parcoursLabel parcoursStrong" style="text-align:center;padding-bottom:30px; font-size:25px;">
        <u>OFFRE</u>
      </div>
      <?php
      }
      ?>
      <div>     <!-- n° de passagers -->
<!--         <span class="< ?=$this->classLabel?>">n° de passagers  :&nbsp;</span>
        < ?=$this->parcours['parcours']->no_passagers?>
 -->      
      </div>     <!-- n° de passagers -->
      <div style="text-align:center;">     <!-- Aller retour -->
        <span class="<?=$this->classLabel?> parcoursStrong">Type du Trajet :&nbsp;</span>
        <?php
        if ($this->parcours['parcours']->aller_retour == 'aller') {
          echo '<span class="parcoursStrong">Aller simple</span>';
        } else {
          echo '<span class="parcoursStrong">Aller retour</span>';
        }
        ?>
      </div>     <!-- Aller retour -->
      <div class="parcoursPaddingInfo">     <!-- Départ -->
        <div class="row">
          <div class="col-12 col-md-6" style="text-align:center;">
            <img style="height:25px;align:right;" src="<?=RACINE?>images/icons8-flag-filled-96-red.png">
            <br>
            <span class="<?=$this->classLabel?> parcoursStrong">Départ</span>
            <br>
            <span class="parcoursStrong">
            <?=$this->getCommuneFromAdresse($this->parcours['parcours']->depart)?>
            <br>
            <?= ($this->getAdresse($this->parcours['parcours']->depart))->adresse?>
            </span>
          </div>                                <!-- Départ -->
          <div class="col-12 col-md-6" style="text-align:center;">                               <!-- Arrivée -->
            <img style="height:25px;align:right;" src="<?=RACINE?>images/icons8-flag-filled-96.png">
            <br>
            <span class="<?=$this->classLabel?> parcoursStrong">Arrivée</span>
            <br>
            <span class="parcoursStrong">
            <?=$this->getCommuneFromAdresse($this->parcours['parcours']->arrivee)?>
            <br>
            <?php echo ($this->getAdresse($this->parcours['parcours']->arrivee))->adresse?>
            </span>
          </div> 
        </div>                              <!-- Arrivée -->
      </div>
      <div class="parcoursPaddingInfo">
      </div>
      <?php
      if ($this->validation) {
        // echo '</div>';
        // echo '<div class="col-12">';
        // echo '<div class="col-12 col-md-7">';
      }
      ?>
    </div>

    <div class="<?=$this->colClass?>">
     <div class="parcoursLabel parcoursStrong" style="text-align:center; padding-bottom:30px; font-size:25px;">
        <u>DETAILS</u>
      </div>
      <div class="text-center">         <!-- Détails -->
        <?php if ($this->fieldset) { ?>
        <fieldset class="parcoursBoxBody" >
          <!-- <legend class="parcoursLabel parcoursLegend">Détails</legend> -->
            <?php } ?>
            <!-- <span class="parcoursLabel parcoursStrong">Etapes</span> -->

            <!-- <span class="parcoursLabel parcoursStrong">Aller</span> -->
            <?php
              $trajet = null;
              $aller = [];
              $retour = [];
              foreach($this->parcours['trajets'] as $par) {
                if($par['trajet']->direction == 'aller') {
                  array_push($aller, $par);
                } else if ($par['trajet']->direction == 'retour') {
                  array_push($retour, $par);
                }
              }

              if($this->validation) {    // page validation
                ?>
                <p class="text-center parcoursStrong"><u>ALLER</u></p>
                <?php 
                foreach($aller as $trajet) {                  
                  $trajetsDetailsObj = new TrajetDetails($this->parcours, $trajet, null, $trajet, null, 'Aller', "Aller", false, true);
                  $trajetsDetailsObj->afficheValidation();
                }
                if (count($retour) > 0) {
                ?><p class="text-center parcoursStrong"><u>RETOUR</u></p>
                <?php 
                  foreach($retour as $trajet) {
                    $trajetsDetailsObj = new TrajetDetails($this->parcours, $trajet, null, $trajet, null, 'Retour', "Retour", false, true);
                    $trajetsDetailsObj->afficheValidation();
                  }     
                }       
              } else {    
                // page détails
                ?>
                <!-- <p class="text-center"><u>ALLER</u></p> -->
                <?php 
                foreach($aller as $trajet) {
                  $trajetsDetailsObj = new TrajetDetails($this->parcours, $trajet, null, $trajet, null, 'Aller', "Aller", true, false);
                  $trajetsDetailsObj->affiche();
                }
                if (count($retour) > 0) {
                ?>
                <!-- <p class="text-center"><u>RETOUR</u></p> -->
                <?php 
                  foreach($retour as $trajet) {
                    $trajetsDetailsObj = new TrajetDetails($this->parcours, $trajet, null, $trajet, null, 'Retour', "Retour", true, false);
                    $trajetsDetailsObj->affiche();
                  }
                }
              }
            ?>
                          <?php
              // if($this->validation) 
              if(false){
            ?>
            <div style="text-align:center; size:2em important">   
              <input type="checkbox" id="validationCheckbox" 
                      name="validationCheckbox"
                      id="validationCheckbox "
                      disabled
                      onclick="onClickValCheckbox(this)"
              <?php
              // var_dump($this->parcours['parcours']);
                if($this->parcours['parcours']->valide > 0) {
                  echo ' checked ';
                }
              ?>
              >
              <label for="validationCheckbox">
                <span class="parcoursValidationCheck">Validé</span>
              </label>

            </div>
          <?php
              }
          ?>
          <?php if ($this->fieldset) { ?>
        </fieldset> 
      </div>
      <?php
      if ($this->validation) {
      echo '</div>';
      echo '</div>';
      }
      ?>
      <?php } ?>
      <div>
      <div>
    </fieldset>
    <?php
  }
    /**
  * Function render adress view
  *
  * @return void
  */
  function afficheDetailsVal() {
    ?>
    <fieldset >
    <!-- <fieldset class="<?=$this->class?>" > -->
    <!-- <legend class="parcoursLabel parcoursLegend">Trajet</legend> -->
    <?php
      if ($this->validation) {
        echo '<div class="row">';
//        echo '<div class="col-12 col-md-5">';
        echo '<div class="col-12">';
      }
      ?>
      <input type="hidden" value="trajetInfo::afficheDetailsVal()">
      <!-- <legend style="border: 1px black solid;margin-left: 1em; padding: 0.2em 0.8em ">Membre</legend> -->
<?php
// var_dump($this->membre);
?>
<div class="row">
  <div class="col-md-8 offset-md-2">
  <?php
      if ($this->membre->membre_type == "passager") {
?>

      <div class="parcoursLabel parcoursStrong pb-2" style="text-align:center; margin-top: -25px; ; font-size:25px;">
        <u>TRAJET DEMANDÉ : </u>
      </div>
      <div style="text-align:center;">   <!-- Motif de la demande -->
        <span class="<?=$this->classLabel?> parcoursStrong">Motif de la demande :&nbsp;</span>
        <span class="parcoursStrong">
          <?=ucfirst($this->getDescMotif($this->parcours['parcours']->motif));?>
        </span>
      </div>    <!-- Motif de la demande -->
      <?php
      } else {?>
        <div class="parcoursLabel parcoursStrong" style="text-align:center;padding-bottom:30px; font-size:25px;">
        <u>OFFRE PROPOSÉE</u>
      </div>
      <?php
      }
      ?>

      <div style="text-align:center;">     <!-- Aller retour -->
        <span class="<?=$this->classLabel?> parcoursStrong">Type du Trajet :&nbsp;</span>
        <?php
        if ($this->parcours['parcours']->aller_retour == 'aller') {
          echo '<span class="parcoursStrong">Aller simple</span>';
        } else {
          echo '<span class="parcoursStrong">Aller retour</span>';
        }
        ?>
      </div>     <!-- Aller retour -->
      <div class="parcoursPaddingInfo">     <!-- Départ -->
        <div class="row">
          <div class="col-12 col-md-6" style="text-align:center;">
            <img style="height:25px;align:right;" src="<?=RACINE?>images/icons8-flag-filled-96-red.png">
            <br>
            <span class="<?=$this->classLabel?> parcoursStrong">Départ</span>
            <br>
            <span class="parcoursStrong">
            <?=$this->getCommuneFromAdresse($this->parcours['parcours']->depart)?>
            <br>
            <?= ($this->getAdresse($this->parcours['parcours']->depart))->adresse?>
            </span>
          </div>                                <!-- Départ -->
          <div class="col-12 col-md-6" style="text-align:center;">                               <!-- Arrivée -->
            <img style="height:25px;align:right;" src="<?=RACINE?>images/icons8-flag-filled-96.png">
            <br>
            <span class="<?=$this->classLabel?> parcoursStrong">Arrivée</span>
            <br>
            <span class="parcoursStrong">
            <?=$this->getCommuneFromAdresse($this->parcours['parcours']->arrivee)?>
            <br>
            <?php echo ($this->getAdresse($this->parcours['parcours']->arrivee))->adresse?>
            </span>
          </div> 
        </div>                              <!-- Arrivée -->
      </div>
      <div class="parcoursPaddingInfo">
      </div>
      <?php
      if ($this->validation) {
        // echo '</div>';
        // echo '<div class="col-12">';
        // echo '<div class="col-12 col-md-7">';
      }
      ?>
    </div>

    <div class="col-12">
    <div class="row">
     <div class="col-12 parcoursLabel parcoursStrong" style="text-align:center; padding-bottom:30px; font-size:25px;">
        <u>DETAILS</u>
      </div>
      <div class="col-12 col-md-6 text-center">         <!-- Détails -->
        <?php if ($this->fieldset) { ?>
        <fieldset class="parcoursBoxBody" >
          <!-- <legend class="parcoursLabel parcoursLegend">Détails</legend> -->
            <?php } ?>
            <!-- <span class="parcoursLabel parcoursStrong">Etapes</span> -->

            <!-- <span class="parcoursLabel parcoursStrong">Aller</span> -->
            <?php
              $trajet = null;
              $aller = [];
              $retour = [];
              foreach($this->parcours['trajets'] as $par) {
                if($par['trajet']->direction == 'aller') {
                  array_push($aller, $par);
                } else if ($par['trajet']->direction == 'retour') {
                  array_push($retour, $par);
                }
              }

              if($this->validation) {    // page validation
                ?>
                <span class="text-center parcoursStrong" style="margin-bottom:-15px;"><u> TRAJET ALLER :</u></span>
                <?php 
                foreach($aller as $trajet) {                  
                  $trajetsDetailsObj = new TrajetDetails($this->parcours, $trajet, null, $trajet, null, 'Aller', "Aller", false, true);
                  $trajetsDetailsObj->afficheValidation();
                }
                ?>
                </div>
                <div class="col-12 col-md-6 text-center">
                <?php
                if (count($retour) > 0) {
                ?><p class="text-center parcoursStrong"><u> TRAJET RETOUR :</u></p>
                <?php 
                  foreach($retour as $trajet) {
                    $trajetsDetailsObj = new TrajetDetails($this->parcours, $trajet, null, $trajet, null, 'Retour', "Retour", false, true);
                    $trajetsDetailsObj->afficheValidation();
                  }     
                }       
              } else {    
                // page détails
                ?>
                <!-- <p class="text-center"><u>ALLER</u></p> -->
                <?php 
                foreach($aller as $trajet) {
                  $trajetsDetailsObj = new TrajetDetails($this->parcours, $trajet, null, $trajet, null, 'Aller', "Aller", true, false);
                  $trajetsDetailsObj->affiche();
                }
                if (count($retour) > 0) {
                ?>
                </div>
                <div class="col-12 col-md-6 text-center">
                <?php
                  foreach($retour as $trajet) {
                    $trajetsDetailsObj = new TrajetDetails($this->parcours, $trajet, null, $trajet, null, 'Retour', "Retour", true, false);
                    $trajetsDetailsObj->affiche();
                  }
                }
              }
            ?>
                          <?php
              // if($this->validation) 
              if(false){
            ?>
            <div style="text-align:center; size:2em important">   
              <input type="checkbox" id="validationCheckbox" 
                      name="validationCheckbox"
                      id="validationCheckbox "
                      disabled
                      onclick="onClickValCheckbox(this)"
              <?php
              // var_dump($this->parcours['parcours']);
                if($this->parcours['parcours']->valide > 0) {
                  echo ' checked ';
                }
              ?>
              >
              <label for="validationCheckbox">
                <span class="parcoursValidationCheck">Validé</span>
              </label>

            </div>
          <?php
              }
          ?>
          <?php if ($this->fieldset) { ?>
        </fieldset> 
      </div>
      <?php
      if ($this->validation) {
      echo '</div>';
      echo '</div>';
      }
      ?>
      <?php } ?>
      <div>
      <div>
      </div>
    </fieldset>
    <?php
  }

  /**
  * Function render adress view
  *
  * @return void
  */
  function afficheFormulaire() {
    if ($this->fieldset) {
      ?>
      <fieldset class="<?=$this->class?>" >
        <legend class="parcoursLabel parcoursLegend">Détails du trajet</legend>
      <?php
    } else {
    ?>
      <div>
    <?php
    }
    ?>
        <input type="hidden" value="trajetInfo::afficheFormulaire()">

        <div class="row">

         <div class="col-12 col-sm-6" style="text-align:center;">
<!--          <label for="numPassagers" class="< ?= $this->classLabel ?> parcoursStrong">Passagers : </label>
          <input type="number" min="1" max="6"
          id="numPassagers" name="numPassagers"
          onchange="enableParcoursEnregButton()"
          value="0">-->
          <!-- < ?php
        if($this->membre->membre_type == "passager") {
          $motifObj = new App\Controller\MotifUtils($this->membre);
          $motifObj->affiche(null);
          ?>
            <div class="col-12" style="padding:20px;">
            </div>
          < ?php
        }
      ?> -->
        </div> 
        <div class="col-12 col-sm-6">

      </div>
      <div class="col-12 col-sm-6">
       <?php 
      //  var_dump($this->addDepart);
        $adresseObj = new App\Controller\Adresse($this->membre, $this->addDepart);
        $adresseObj->disabled = true;
        $adresseObj->affiche();
       ?>      
      </div>
      <div class="col-12 col-sm-6">
        <?php 
          $titre = 'Arrivée';
          $idRoot = 'arrivee';
          $adresseObj = new App\Controller\Adresse($this->membre, null, $titre, $idRoot);
          $adresseObj->changeable = false;
          $adresseObj->affiche();
        ?>         
      </div>
      <div class="col-12" style="padding:20px;">
      </div>
      <div class="col-12 col-sm-4" style="text-align:center;margin-top:25px;">
        <input type="radio" id="allerSimple" name="trajetType" value="simple" checked 
            onclick="clickAllerRetour(this)">
        <label for="allerSimple" class="<?= $this->classLabel ?>">Aller simple</label>
      </div>

      <div class="col-12 col-sm-4" style="text-align:center;margin-top:25px;">
        <input type="radio" id="allerRetour" name="trajetType" value="retour" 
            onclick="clickAllerRetour(this)">
        <label for="allerRetour" class="<?= $this->classLabel ?>">Aller retour</label>
      </div>

      <div class="col-12 col-sm-4" style="text-align:center;margin-top:25px;">
        <input type="checkbox" id="allerDispo" name="trajetTypeDispo" value="dispo" 
            onclick="clickAllerRetour(this)">
        <label for="allerDispo" class="<?= $this->classLabel ?>">Voyages réguliers</label>
      </div>
     
    <div class="col-12 col-sm-6" id="allerRetourAller">
       <?php
         $datesObj = new App\Controller\TrajetDates($this->parcours['date_debut'], $this->parcours['date_fin'], "Aller", false, $this->classLabel, "parcoursStrong");
         $datesObj->getDates();
      ?>
    </div>

     <div class="col-12 col-sm-6 collapse" id="allerRetourRetour">
       <?php
         $datesObj = new App\Controller\TrajetDates($this->parcours['date_debut'], $this->parcours['date_fin'], "Retour", true, $this->classLabel, "parcoursStrong");
         $datesObj->getDates();
       ?>
     </div>

     <div class="col-12 collapse" id="allerRetourDispo" style="text-align:center;margin-top:25px;">
      <?php

        $trajetDispo = new TrajetDispo();
        $trajetDispo->afficheFormulaire();

      ?>
    </div>

     <div class="col-12 text-center mt-3" style="padding:20px;">
     <?php
     if($this->membre->membre_type == "passager") {
          $motifObj = new App\Controller\MotifUtils($this->membre);
          $motifObj->affiche(null);
          ?>
            <!-- <div class="col-12" style="padding:20px;">
            </div> -->
          <?php
        } ?>
    </div>

    <div>
   </div>

    </div>        <!--  class="row" -->
    <?php
    if ($this->fieldset) {
      ?>
  </fieldset>
  <?php
    } else {
  ?>
  </div>
<?php
  }
}
    /**
  * Function render adress view
  *
  * @return void
  */
  function afficheFormulaireUpdate($dispo) {
    ?>
      <fieldset class="<?=$this->class?>" >
        <legend class="parcoursLabel parcoursLegend">Détails du trajet</legend>
        <input type="hidden" value="trajetInfo::afficheFormulaireUpdate()">

        <div class="row">

         <div class="col-12 col-sm-6" style="text-align:center;">
<!--          <label for="numPassagers" class="< ?= $this->classLabel ?> parcoursStrong">Passagers : </label>
          <input type="number" min="1" max="6"
          id="numPassagers" name="numPassagers"
          onchange="enableParcoursEnregButton()"
          value="0">-->
        </div> 
        <div class="col-12 col-sm-6">
        <?php
        if($this->membre->membre_type == "passager") {
          $motifObj = new App\Controller\MotifUtils($this->membre);
          $motifObj->afficheUpdate($this->parcours);
          ?>
            <div class="col-12" style="padding:20px;">
            </div>
          <?php
        }
      ?>
      </div>
      
     <div class="col-12" style="padding:20px;">
    </div>
      <div class="col-12 col-sm-6">
       <?php 
      //  var_dump($this->addDepart);
        $adresseObj = new App\Controller\Adresse($this->membre, $this->addDepart);
        $adresseObj->disabled = true;
        $adresseObj->affiche();
       ?>      
      </div>
      <div class="col-12 col-sm-6">
        <?php 
          $titre = 'Arrivée';
          $idRoot = 'arrivee';
          $adresseObj = new App\Controller\Adresse($this->membre, $this->addArrivee, $titre, $idRoot);
          $adresseObj->changeable = false;
          $adresseObj->affiche();
        ?>         
      </div>
      <div class="col-12" style="padding:20px;">
    </div>
      <div class="col-12 col-sm-4" style="text-align:center;margin-top:25px;">
        <input type="radio" id="allerSimple" name="trajetType" value="simple"  
            onclick="clickAllerRetour(this)"
        <?php
          if($this->parcours->aller_retour == 'aller') {
            echo ' checked ';
          }
        ?>   
            >
        <label for="allerSimple" class="<?= $this->classLabel ?>">Aller simple</label>
      </div>

      <div class="col-12 col-sm-4" style="text-align:center;margin-top:25px;">
        <input type="radio" id="allerRetour" name="trajetType" value="retour" 
            onclick="clickAllerRetour(this)"
      <?php
        if($this->parcours->aller_retour == 'retour') {
          echo ' checked ';
        }
      ?>      
            >
        <label for="allerRetour" class="<?= $this->classLabel ?>">Aller retour</label>
      </div>

      <div class="col-12 col-sm-4" style="text-align:center;margin-top:25px;">
        <input type="checkbox" id="allerDispo" name="trajetTypeDispo" value="dispo" 
            onclick="clickAllerRetour(this)"
            <?php
        if($this->parcours->date_debut_aller == null) {
          echo ' checked ';
        }
      ?>             
            
            >
        <label for="allerDispo" class="<?= $this->classLabel ?>">Voyages réguliers</label>
      </div>
     
<!--       <div class="col-12" style="text-align:center;margin-top:25px;">
    </div> -->

    <div class="col-12 col-sm-6" id="allerRetourAller">
       <?php
         $datesObj = new App\Controller\TrajetDates($this->parcours->date_debut_aller, $this->parcours->date_fin_aller, "Aller", false, $this->classLabel);
         $datesObj->getDates();
      ?>
    </div>

     <div class="col-12 col-sm-6 
     <?php
     if($this->parcours->aller_retour != 'retour') {
          echo ' collapse ';
        }
        ?>
        " id="allerRetourRetour">
       <?php
         $disabled = $this->parcours->aller_retour != "retour";
         $datesObj = new App\Controller\TrajetDates($this->parcours->date_debut_retour, $this->parcours->date_fin_retour, "Retour", $disabled, $this->classLabel);
         $datesObj->getDates();
       ?>
     </div>

     <div class="col-12 collapse" id="allerRetourDispo" style="text-align:center;margin-top:25px;">
      <?php
        $trajetDispo = new TrajetDispo();
        $trajetDispo->afficheFormulaireUpdate($dispo);

      ?>
    </div>
    <div>
   </div>

    </div>        <!--  class="row" -->
  </fieldset>
<?php
  }

  function getDescMotif($id) {
    $loadMotif = App::getInstance()->getTable('Motif');
    $motifs = $loadMotif->selectMotifs(); 
    foreach($motifs as $motif) {
      if($motif->id == $id) {
        return utf8_encode($motif->description);
      }
    }
    return '<span class="parcoursLabel">&nbsp;non rensiegné</span>';
  }
  function getCommuneFromAdresse($adresseId) {
    $loadAdresse = App::getInstance()->getTable('Adresse');
    $adresse = $loadAdresse->selectAdresse($adresseId); 

    return $this->getNomCommune($adresse->commune);
  }
  function getAdresse($adresseId) {
    $loadAdresse = App::getInstance()->getTable('Adresse');
    $adresse = $loadAdresse->selectAdresse($adresseId); 

    return $adresse;
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
