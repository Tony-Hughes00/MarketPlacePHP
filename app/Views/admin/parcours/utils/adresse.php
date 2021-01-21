<?php

namespace App\Controller;
use App;

class Adresse
{
	protected $adresse;
  protected $titre;
  protected $idRoot;
  public $disabled;
  public $changeable = true;
  
    public function __construct(
                    $membre,
                    $adresse,
                    $titre = 'Départ',
                    $idRoot = 'depart') {
      $this->membre = $membre;
      $this->adresse = $adresse;
      $this->titre = $titre;
      $this->idRoot = $idRoot;
      $this->disabled = false;
      $this->classLabel = 'parcoursLabel';
      $this->commune = $this->adresse == null ? '0.4' : $this->adresse->commune;
// var_dump($this->adresse);
    }
    /**
    * Function render adress view
    *
    * @return void
    */
    function affiche() {
      $loadAdresse = App::getInstance()->getTable('Adresse');
      $adresse = $loadAdresse->selectAdresse($this->membre->adresse); 
?>

  <input type="hidden" id="<?=$this->idRoot?>AdresseDom" value="<?php
    if ($this->adresse) { 
      echo $adresse->adresse;
    }?>">
  <input type="hidden" id="<?=$this->idRoot?>ComplementDom" value="<?php
    if ($this->adresse) { 
      echo $adresse->complement;
    }?>">
  <input type="hidden" id="<?=$this->idRoot?>CommuneDom" value="<?php
    if ($this->adresse) { 
      echo $adresse->commune . "," . $adresse->code_postal;
    }?>">
  <input type="hidden" id="<?=$this->idRoot?>CodePostalDom" value="<?php
    if ($this->adresse) { 
      echo $adresse->code_postal;
    }?>">
  <input type="hidden" value="adresse::affiche()">
<?php
      $this->getRowTitre();
      $this->getAdresse();

      // if($this->changeable) {  
        $this->getJavaScript();
      // }

    }
    private function getRowTitre() {
      ?>
      <div class="row">
      <div class="col-1 mx-auto">
      <?php 
      if ($this->idRoot == 'depart') {
        ?>
      <img style="height:25px;align:right;" src="<?=RACINE?>images/icons8-flag-filled-96-red.png">
      <?php
      }
      if ($this->idRoot == 'arrivee') {
        ?>
      <img style="height:25px;align:right;" src="<?=RACINE?>images/icons8-flag-filled-96.png">
      <?php
      }
      ?>          
        </div>
        <div class="col-3 <?=$this->classLabel?>" style="text-align: left;"> 
          <strong><?=$this->titre?></strong>
        </div>
        <div class="col-4">
          <?php if($this->changeable) {?>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" 
                    id="<?=$this->idRoot?>domicile" name="<?=$this->idRoot?>addType"
                    value="domicile" class="custom-control-input" required 
            <?php if($this->adresse->id == $this->membre->adresse) {
                  echo ' checked ';
            }
            ?>
                         onclick="clickDomicileAutre<?=$this->idRoot?>(this)"
            >
            <label class="radio-label custom-control-label parcoursLabel"
                    for="<?=$this->idRoot?>domicile">Domicile</label>
          </div>
      <?php }?>
        </div>
        <div class="col-4">
      <?php
      if($this->changeable) {
      ?>
        <div class="custom-control custom-radio custom-control-inline" style="font-size:0.9rem"> 
          <input type="radio" 
                  id="<?=$this->idRoot?>autre" name="<?=$this->idRoot?>addType"
                  value="autre" class="custom-control-input" required
            <?php if($this->adresse->id != $this->membre->adresse) {
                  echo ' checked ';
            }
            ?>
                  onclick="clickDomicileAutre<?= $this->idRoot?>(this)"
          >
          <label class="radio-label custom-control-label parcoursLabel"
                  for="<?=$this->idRoot?>autre">Autre</label>
        </div>
      <?php } ?>
      </div>
    </div>
<?php    } 
    private function getAdresse() {
      $this->getLigneAdresse();
      $this->getLigneComplement();
      $this->getLigneCommune();
      $this->getLigneCodePostal();

    }
    private function getLigneAdresse() {
      ?>
      <div class="col-12 col-sm-4">
        <p class="<?=$this->classLabel?>">Adresse :</p> 
      </div>
      <div class="col-12 col-sm-8>">
        <input type="text" style="width:100%" 
        onchange="enableParcoursEnregButton()"
        <?php
        if ($this->disabled) {
        ?>  
                  disabled 
        <?php }?>      
                  id="<?=$this->idRoot?>Adresse" name="<?=$this->idRoot?>Adresse"
                  value="<?php
        if ($this->adresse) { 
              echo $this->adresse->adresse;
            }
        ?>">
      </div>
    <?php
    }
    private function getLigneComplement() {
      ?>
      <div class="col-12" style="margin-top:10px">            
        <p class="<?=$this->classLabel?>">Complément d'adresse&nbsp;: (appartement, étage, Lieu dit) :</p> 
      </div>
      <div class="col-12">
          <input type="text" style="width:100%"
                id="<?=$this->idRoot?>Complement" name="<?=$this->idRoot?>Complement"
                onchange="enableParcoursEnregButton()"
        <?php
        if ($this->disabled) { ?>
                disabled 
        <?php }?>        
                value="<?php
        if (isset($dataTrajet)) { 
          echo ($dataTrajet['addDepart'])->complement;
        }
        ?>">
      </div>
    <?php      
    }
    private function getLigneCommune() {
      ?>
      <div class="col-12 col-sm-4" style="margin-top:10px">
        <p class="<?=$this->classLabel?>"> Commune : </p> 
      </div>
      <?php
        $loadCommune = App::getInstance()->getTable('Commune');
        $communes = $loadCommune->selectCommunes();  
      ?>
      <div class="col-12 col-sm-8">
        <select style="width:100%" 
                 id="<?=$this->idRoot?>Commune" name="<?=$this->idRoot?>Commune"
                 onchange="onChangeCommune(this, <?php $communes ?>)"
      <?php
      if ($this->disabled) {
        echo 'disabled ';
      }    
      ?>    
            value="<?php
              if ($this->adresse) {
                echo trim ($this->adresse->commune);
              }
      ?>">';

          <option value="0.0">Sélectionner....</option>"<?php
      foreach($communes as $commune) {
        echo '<option value="' . $commune->id . ',' . $commune->code_postal . '">' . $commune->nom . "</option>";           
      }
      ?>
        </select>  
      </div> 
    <?php
          if ($this->adresse) { 
            $selectValue = $this->adresse->commune . ',' . $this->adresse->code_postal;
          }
    }
    private function getLigneCodePostal() {
      ?>
      <div class="col-12 col-sm-4" style="margin-top:10px">
        <p class="<?=$this->classLabel?>"> Code Postal : </p>
      </div>
      <div class="col-12 col-sm-8">
        <input type="text" 
               id="<?=$this->idRoot?>CodePostal" name="<?=$this->idRoot?>CodePostal"
               disabled
               value="<?php
      if ($this->adresse) {
        $loadCommune = App::getInstance()->getTable('Commune');
        $codePostal = $loadCommune->selectPostCodeCommune($this->adresse->commune); 
        echo $codePostal->code_postal;
      }
      ?>">
      </div>
    <?php
    }
    private function getJavaScript() {
      ?>
      <script>
        var selectCodePostal = document.getElementById("<?=$this->idRoot?>CodePostal");
        var adresse = <?=$this->commune ?>;
        // var adresse = <?php echo json_encode($this->adresse); ?>;
        console.log("adresse", adresse, selectCodePostal);
        var selVal = adresse + ',' + selectCodePostal.value;
        console.log("adresse", selVal);
        let selectCommune<?=$this->idRoot?> = document.getElementById("<?=$this->idRoot?>Commune");
        selectCommune<?=$this->idRoot?>.value = selVal;

        function clickDomicileAutre<?=$this->idRoot?>(contr) {
          if(contr.value == "autre") {
            // console.log("contr.value - false","<?=$this->idRoot?>"); 
            $("#<?=$this->idRoot?>Adresse")[0].disabled = false;
            $("#<?=$this->idRoot?>Complement")[0].disabled = false;
            $("#<?=$this->idRoot?>Commune")[0].disabled = false;

            $("#<?=$this->idRoot?>Adresse")[0].value = "";
            $("#<?=$this->idRoot?>Complement")[0].value = "";
            $("#<?=$this->idRoot?>Commune")[0].value = "";
            $("#<?=$this->idRoot?>CodePostal")[0].value = "";
          } else {
            console.log("contr.value - true"); 
            $("#<?=$this->idRoot?>Adresse")[0].setAttribute("disabled", true);
            $("#<?=$this->idRoot?>Complement")[0].setAttribute("disabled", true);
            $("#<?=$this->idRoot?>Commune")[0].setAttribute("disabled", true);

            $("#<?=$this->idRoot?>Adresse")[0].value = $("#<?=$this->idRoot?>AdresseDom")[0].value;
            $("#<?=$this->idRoot?>Complement")[0].value = $("#<?=$this->idRoot?>ComplementDom")[0].value;
            $("#<?=$this->idRoot?>Commune")[0].value = $("#<?=$this->idRoot?>CommuneDom")[0].value;
            $("#<?=$this->idRoot?>CodePostal")[0].value = $("#<?=$this->idRoot?>CodePostalDom")[0].value;

            <?=$this->idRoot?>Adresse
          }
      };
      </script>
      <?php
    }
}

?>