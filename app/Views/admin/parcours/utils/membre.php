<?php

namespace App\Controller;
use App;
require_once ROOT ."/app/Views/admin/parcours/utils/Erreur.php";
require_once ROOT ."/app/Views/admin/parcours/utils/adresse.php";

class Membre
{
  protected $membre;
  protected $user;
  protected $erreur;
  protected $class;
  protected $classLabel;
  protected $classValue;

  public function __construct($membre, $user, $erreur, $columns = 2) {
    $this->membre = $membre;
    $this->user = $user;
    $this->erreur = $erreur;
    $this->class = "parcoursBoxTitre";
    $this->classLabel = "parcoursLabelRight";
    $this->classValue = "parcoursValue";
    $this->columns = $columns;
    $this->colClass = "col-12";
    if ($this->columns == 2) {
      $this->colClass = "col-12 col-sm-6";
    }
  }
  /**
  * Function render adress view
  *
  * @return void
  */
  function affiche() {
    if($this->membre == null) {
      echo '<i class="text-secondary"> Détail de membre non renseigné</i>';
      if($this->erreur) {
        $erreurObj = new App\Controller\ErreurUtils();
        $erreurObj->affiche($this->erreur);
      }
      return;
    }
    $this->afficheMembre();
  }
  function afficheMembre() {
    $loadAdresse = App::getInstance()->getTable('Adresse');
    $adresse = $loadAdresse->selectAdresse($this->membre->adresse);
    ?>
    <fieldset class="<?=$this->class?>" >

    <!-- <legend style="border: 1px black solid;margin-left: 1em; padding: 0.2em 0.8em ">Membre</legend> -->
    <!-- <legend class="parcoursLabel parcoursLegend"> -->
    <legend class="parcoursLabel parcoursLegend">
    <a href="<?=ROUTE?>ficheUser.<?=$this->user->id?>">
          <i class="fas fa-user-edit"alt="modifier"></i>
    </a>
    <?php
    if($this->membre && $this->membre->membre_type == 'passager') {
      echo 'Passager';
    } else { 
      echo 'Chauffeur';
    } 
    if ($this->membre->actif == 0) {
      echo ' <span class="text-danger"><i><b>(inactif)</b></i></span>';
    }
    ?>    
    </legend>
    <input type="hidden" value="Membre::affiche()">

      <div class="row">
        <div class="<?=$this->colClass?>">
          <table>
            <tr>
            <td class="<?= $this->classLabel?> parcoursStrong">Membre :&nbsp;</td>
<!--             < ?php
              if($this->membre && $this->membre->membre_type == 'passager') {
                ?>
                  <td class="<?= $this->classLabel?> parcoursStrong">Passager :&nbsp;</td>
              < ?php } else { ?>
                  <td class="<?= $this->classLabel?> parcoursStrong">Chauffeur :&nbsp;</td>
              < ?php } ?> -->
              <td class="<?= $this->classValue?> parcoursStrong"><?= $this->membre->civilite . " " . $this->user->nom . " " .  $this->user->prenom ?> 
              <!-- <a href="< ?=ROUTE?>ficheUser.< ?=$this->user->id?> ?>"><i class="fas fa-user-edit"alt="modifier"></i></a> -->
            </td>
            </tr>
            <tr>
              <td class="<?= $this->classLabel?> parcoursStrong">Téléphone :&nbsp;</td>
              <?php if(strlen($this->membre->tel) == 0) {?>
                <td class="<?= $this->classValue?>"><i class="text-secondary"> Non renseigné</i></td>
              <?php } else { ?>
                <td class="<?= $this->classValue?> parcoursStrong"><?= $this->membre->tel?></td>
              <?php }
              ?>
              
            </tr>
            <tr>
              <td class="<?= $this->classLabel?> parcoursStrong">Mobile :&nbsp;</td>
              <?php if(strlen($this->membre->mobile) == 0) {?>
                <td class="<?= $this->classValue?>"><i class="text-secondary"> Non renseigné</i></td>
              <?php } else { ?>
                <td class="<?= $this->classValue?> parcoursStrong"><?= $this->membre->mobile ?>
              <?php }?>
            </tr>
            <tr><td style="height:10px;"></td></tr>

          </table>
        </div>
        <div class="<?=$this->colClass?>">
          <table>
            <tr>
              <td class="<?= $this->classLabel?> ">Adresse :&nbsp;</td>
              <?php if(strlen($this->membre->adresse) == 0) {?>
                <td class="<?= $this->classValue?>"><i class="text-secondary"> Non renseigné</i></td>
              <?php } else { ?>
                <td class="text-secondary <?= $this->classValue?>"><?=$adresse->adresse?><?php 
                  if (strlen($adresse->complement) > 0) {
                    echo ', ' . $adresse->complement;
                  }?></td>
              <?php } ?>
            </tr>
            <tr>
              <td class="<?= $this->classLabel?> parcoursStrong">&nbsp;</td>
              <?php if(strlen($this->membre->mobile) == 0) {?>
                <td class="<?= $this->classValue?>"><i class="text-secondary"> Non renseigné</i></td>
              <?php } else { ?>
                <td class="text-secondary <?= $this->classValue?>"><?= $adresse->code_postal;
                echo " " . $this->getNomCommune($adresse->commune); ?>
              <?php }?>
                </td>
            </tr>
            <tr>
              <td class="<?= $this->classLabel?>">email :&nbsp;</td>
              <td class="<?= $this->classValue?>"><?= $this->user->email ?>
            </tr>
          </table>
        </div>
      </div>
    </fieldset>
<?php
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
