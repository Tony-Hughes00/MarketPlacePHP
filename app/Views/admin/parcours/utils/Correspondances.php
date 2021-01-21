<?php

namespace App\Controller;
use App;

require_once ROOT ."/app/Views/admin/parcours/utils/Correspondance.php";

class Correspondances
{
  protected $data;
  protected $user;
  protected $label;
  protected $contrId;
  protected $class;
  protected $classLabel;
  protected $membre;

  public function __construct($parcours, $correspondances, $user, $chauffeurs, $label, $contrId, $membre) {
    $this->parcours = $parcours;
    $this->data = $correspondances;
    // $this->aller_retour = $aller_retour;
    $this->chauffeurs = $chauffeurs;
    $this->aller_retour = $this->parcours['parcours']->aller_retour;
    $this->user = $user;
    $this->label = $label;
    $this->contrId = $contrId;
    $this->class = "parcoursBox";
    $this->classLabel = "parcoursLabelRight";
    $this->membre = $membre;
  }

  /**
  * Function render adress view
  *
  * @return void
  */
  function affiche() {
?>
<div style="padding:0px">
<input type="hidden" value="Correspondances::affiche()">

  <fieldset class="<?=$this->class?>" >

      <!-- <legend style="border: 1px black solid;margin-left: 1em; padding: 0.2em 0.8em ">Membre</legend> -->
    <legend class="parcoursLabel parcoursLegend">Correspondances</legend>
    <?php
        $aller = [];
      $retour = [];
      // var_dump($this->data);
      foreach($this->data as $etape) {
        if($etape['detail']->direction == "aller") {
          array_push($aller, $etape);
        } else {
          array_push($retour, $etape);
        }
      }
      // var_dump($aller);
      foreach($aller as $allerTrajet) {
        $bothObj = new App\Controller\Correspondance(
                        $this->parcours['trajets'], 
                        $allerTrajet, 
                        $this->user, 
                        $this->user, 
                        "Aller",
                        "controlId", 
                        "Correspondance Aller", 
                        "Aller",
                      $this->membre );
        $bothObj->affiche($this->chauffeurs); 
      }
      if($this->aller_retour == 'retour') {
        ?>
        <div class="parcoursPaddingContent" style="padding:20px">
        </div>
        <?php
        foreach($retour as $retourTrajet) {
        $bothObj = new App\Controller\Correspondance(
                    $this->parcours['trajets'], 
                    $retourTrajet, 
                    $this->user, 
                    $this->user, 
                    "Retour",
                    "controlId", 
                    "Correspondance Retour", 
                    "Retour",
                    $this->membre );
        $bothObj->affiche($this->chauffeurs); 
        }
        // $bothObj = new App\Controller\Correspondance($this->parcours['trajets'], $retourTrajet, $this->user, $this->user, "Retour","controlId", "Correspondance Retour", "Retour" );
        // $bothObj->affiche(); 
        // ############ TODO ###################
      }
    ?>
  </fieldset>
</div>
<?php
  }
}
?>