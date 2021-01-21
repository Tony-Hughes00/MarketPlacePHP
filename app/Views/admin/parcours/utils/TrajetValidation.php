<?php

namespace App\Controller;
use App;
use DateTime;
require_once ROOT ."/app/Views/admin/parcours/utils/Commune.php";
require_once ROOT ."/app/Views/admin/parcours/utils/TrajetDate.php";

class TrajetValidation
{
  public function __construct($date, $contrId, $validation, $trajetId, $status, $distance) {
    $this->date = $date;
    $this->contrId = $contrId;
    $this->validation = $validation;
    $this->trajetId = $trajetId;
    $this->status = $status;
    $this->distance = $distance;
    // var_dump($this->validation);
  }

  function affiche() {
    ?>
    <div>
      <input type="hidden" value="TrajetValidation::affiche()">
      <?php
      // var_dump($this->validation);
        if(!$this->validation) {
          echo '<i class="parcoursLabel">Départ le&nbsp;</i>';
          if($this->date == null) {
            echo '<i class="text-secondary"> Non renseigné</i>';
          } else {
            echo '<span class="parcoursStrong">';
            $date = new DateTime($this->date);
            echo $date->format("d/m/y à H:i");
            // echo substr($this->date, 0, 10) . ' ' . substr($this->date, 11, 5);
            echo '</span>';
          }
          echo '<br> <span class="parcoursLabel">Status :&nbsp; </span>';
          switch ($this->status) {
            case 0:
                echo '<span class="text-secondary"> Non attribué</span>';
                break;
            case 1:
                echo '<span class="parcoursStrong">&nbsp;Attribué</span>';
                break;
            case 2:
                echo '<span class="parcoursStrong"> Confirmé</span>';
                break;
            case 2:
                echo '<span class="parcoursStrong"> Validé</span>';
                break;
            default:
                echo '<span class="text-secondary"> Non attribué</span>';
                break;                    
          }
        } else {
        ?>
        <div class="row">
          <div class="col-12 col-sm-12" style="padding-top:5px;">
            <?php
            // var_dump("val" . "Debut" . $this->status);
              $dateObjDebut = new App\Controller\TrajetDate($this->date, " Départ le :", "val" . "Debut" . $this->contrId, $this->status >= 2);
              $dateObjDebut->afficheDateValidation();
            ?>
          </div>
<!--           <div class="col-12 col-sm-12">
            <input type="checkbox" id="valCheckbox< ?=$this->contrId?>" 
                    onclick="onClickValCheckbox(this)" 
                    name="valCheckbox< ?=$this->contrId?>"
                    id="valCheckbox< ?=$this->contrId?> "
                    
            < ?php
              if($this->status >= 2) {
                echo ' checked ';
              }
            ?>
                    value="< ?=$this->trajetId?>">
            <label for="valCheckbox< ?=$this->contrId?>">
                    <span class="parcoursLabelStrong">Confirmé</span>
          </div> -->
          <div class="col-12 mt-3">
          <b> <u>Estimation du Coût</u> </b><br>
            <label class="parcoursLabel parcoursPaddingInfo" 
                  for="valDistance<?=$this->contrId?>">Distance :&nbsp;</label>
            <input type="decimal" step=".01" style="width:50px"
              name="valDistance<?=$this->contrId?>" 
                  onchange="onClickValDateTime(this)" 
                  id="valDistance<?=$this->contrId?>"
                  value="<?=$this->distance?>"
                  >&nbsp;
                <span class="parcoursLabel">km</span><br>
                <a style="font-size:12px;" href="https://www.google.fr/maps/dir/" target="_blank">Vérifier distance</a>
          </div>
          <div class="col-12">
            <label class="parcoursLabel  
                  for="valCout<?=$this->contrId?>">Coût (Passager):&nbsp;€</label>
            <span type="decimal" step=".01"
                  name="valCout<?=$this->contrId?>" 
                  id="valCout<?=$this->contrId?>"
                  disabled><span>
          </div>
          <div class="col-12">
            <label class="parcoursLabel  
                  for="valCoutMosc<?=$this->contrId?>">Coût (MOSC) :&nbsp;€</label>
            <span type="decimal" step=".01"
                  name="valCoutMosc<?=$this->contrId?>" 
                  id="valCoutMosc<?=$this->contrId?>"
                  disabled><span>
          </div>
          <div class="col-12 col-sm-12" style="text-align:right;padding-right:40px">
            <input type="checkbox" id="valCheckbox<?=$this->contrId?>" 
                    onclick="onClickValCheckbox(this)" 
                    name="valCheckbox<?=$this->contrId?>"
                    id="valCheckbox<?=$this->contrId?> "
                    
            <?php
              if($this->status >= 2) {
                echo ' checked ';
              }
            ?>
                    value="<?=$this->trajetId?>">
            <label for="valCheckbox<?=$this->contrId?>">
                    <span class="parcoursLabelStrong">Confirmé</span>
          </div>
        </div>
      <?php
        }
      ?>
    </div>
    <?php
  }
}

?>
<script>
  function enableParcoursConfirmButton() {
    console.log("validation date/time");
  }
</script>