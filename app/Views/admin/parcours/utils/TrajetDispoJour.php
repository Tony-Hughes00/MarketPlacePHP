<?php

namespace App\Controller;
use App;

require_once ROOT ."/app/Views/admin/parcours/utils/TrajetDate.php";

class TrajetDispoJour
{
  public function __construct($jour, $ctrlId) {
    $this->ctrlId = $ctrlId;
    $this->jour = $jour;
  }

  function affiche() {
    ?>
    <div class="parcoursDispo">
    <input type="checkbox" 
          id="check<?=$this->ctrlId.$this->jour?>" 
          name="check<?=$this->ctrlId.$this->jour?>"
          onchange="onChangeDispo(this)">
    <label class="parcoursLabel parcoursStrong" for="<?=$this->ctrlId.$this->jour?>check"><?php
    $joursLong = ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];

    echo $joursLong[$this->jour];

    ?></label>
    </div>
    <div class="col-12" style="text-align:center" id="<?=$this->ctrlId?><?=$this->jour?>Aller">
    <?php
      $this->afficheTime($this->ctrlId . $this->jour . "AllerDebut", "départ entre ", "");
      $this->afficheTime($this->ctrlId . $this->jour . "AllerFin", " et ", "");
    ?>  
    </div>
    <div class="col-12" style="text-align:center" id="<?=$this->ctrlId?><?=$this->jour?>Retour">
    <?php
      $this->afficheTime($this->ctrlId . $this->jour . "RetourDebut", "retour entre ", "");
      $this->afficheTime($this->ctrlId . $this->jour . "RetourFin", " et ", "");
    ?>
    </div>
    <?php
  }
  function afficheUpdate($dispoAller, $dispoRetour) {
    $aller = null;
    $retour = null;
    foreach($dispoAller as $dispo) {
      if ($dispo->jour_dispo == $this->jour) {
        $aller = $dispo;
      }
    }
    if ($dispoRetour != null) {
      foreach($dispoRetour as $dispo) {
        if ($dispo->jour_dispo == $this->jour) {
          $retour = $dispo;
        }
      }
    }
    ?>
    <div class="parcoursDispo">
    <input type="checkbox" 
          id="check<?=$this->ctrlId.$this->jour?>" 
          name="check<?=$this->ctrlId.$this->jour?>"
    <?php
    if ($aller != null) {
      echo ' checked ';
    }
    ?>
          onchange="onChangeDispo(this)">
    <label class="parcoursLabel parcoursStrong" for="<?=$this->ctrlId.$this->jour?>check"><?php
    $joursLong = ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];

    echo $joursLong[$this->jour];

    ?></label>
    </div>
    <div class="col-12" style="text-align:center" id="<?=$this->ctrlId?><?=$this->jour?>Aller">
    <?php
      if ($aller == null) {
        $h_dbt = null;
        $h_fin = null;
      } else {
        $h_dbt = $aller->h_dbt;
        $h_fin = $aller->h_fin;
      }
      $this->afficheTime($this->ctrlId . $this->jour . "AllerDebut", "départ entre ", $h_dbt);
      $this->afficheTime($this->ctrlId . $this->jour . "AllerFin", " et ", $h_fin);
    ?>  
    </div>
    <div class="col-12" style="text-align:center" id="<?=$this->ctrlId?><?=$this->jour?>Retour">
    <?php
      if ($retour == null) {
        $h_dbt = null;
        $h_fin = null;
      } else {
        $h_dbt = $retour->h_dbt;
        $h_fin = $retour->h_fin;
      }
      $this->afficheTime($this->ctrlId . $this->jour . "RetourDebut", "retour entre ", $h_dbt);
      $this->afficheTime($this->ctrlId . $this->jour . "RetourFin", " et ", $h_fin);
    ?>
    </div>
    <?php
  }
  function afficheUpdateUser($dispos) {
    ?>
    <div class="parcoursDispo">
      <input type="checkbox" 
            id="check<?=$this->ctrlId.$this->jour?>" 
            name="check<?=$this->ctrlId.$this->jour?>"
      <?php
        $h_dbt = null;
        $h_fin = null;
  //      var_dump($dispo);
        if($dispos) {
          foreach($dispos as $dispo) {
            if ($this->jour == $dispo->jour_dispo) {
              $h_dbt = $dispo->h_dbt;
              $h_fin = $dispo->h_fin;
              echo ' checked ';
            }
          }
        }
      ?>
            onchange="onChangeDispoUser(this)">
      <label class="parcoursLabel parcoursStrong" for="<?=$this->ctrlId.$this->jour?>check"><?php
      $joursLong = ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];

      echo $joursLong[$this->jour];

      ?></label>
      <?php
      $this->afficheUpdateUserDispo($dispos);
      ?>
    </div>
    <?php
  }
  function afficheUpdateUserDispo($dispos) {
    $count = 0;
    foreach($dispos as $dispo) {
    ?>
    <div class="col-12" style="text-align:center" id="<?=$this->ctrlId?><?=$this->jour?>Aller">
        <i class="fas fa-trash" 
        id="<?php echo $this->ctrlId . $this->jour . "Delete" . $count;?>"
        onClick="onDeleteDispoUser(this)"></i>
    <?php
      $this->afficheTimeUser($this->ctrlId . $this->jour . "Debut" . $count, "disponible entre ", $dispo->h_dbt);
      $this->afficheTimeUser($this->ctrlId . $this->jour . "Fin" . $count, " et ", $dispo->h_fin);
      $count++;
    ?>  
    </div>
    <?php
    }
    ?>
    <div class="col-12" style="text-align:center" id="<?=$this->ctrlId?><?=$this->jour?>Aller">
    <?php
    $this->afficheTimeUser($this->ctrlId . $this->jour . "Debut" . $count, "disponible entre ", null);
    $this->afficheTimeUser($this->ctrlId . $this->jour . "Fin" . $count, " et ", null);
    ?>
    </div>
    <?php
  }
  function afficheTime($ctrlId, $label, $value) {
    ?>

    <label for="<?=$ctrlId?>Time"><span class="parcoursLabel"><?=$label?>&nbsp;</span></label>
      <input type="time"
        id="<?=$ctrlId?>Time"
        name="<?=$ctrlId?>Time"
         onchange="onChangeDispo(this)"
             value="<?=$value?>">

  <?php
  }
  function afficheTimeUser($ctrlId, $label, $value) {
    ?>

    <label for="<?=$ctrlId?>Time"><span class="parcoursLabel"><?=$label?>&nbsp;</span></label>
      <input type="time"
        id="<?=$ctrlId?>Time"
        name="<?=$ctrlId?>Time"
         onchange="onChangeDispoUser(this)"
             value="<?=$value?>">

  <?php
  }
}