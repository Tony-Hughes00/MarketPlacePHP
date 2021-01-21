<?php

namespace App\Controller;
use App;
require_once ROOT ."/app/Views/admin/parcours/utils/trajetsDetails.php";

class Correspondance
{
  protected $data;
  protected $user;
  protected $label;
  protected $contrId;
  protected $class;
  protected $classLabel;
  protected $membre;

  public function __construct(
            $trajets, 
            $data, 
            $trajet, 
            $user, 
            $label, 
            $contrId, 
            $titre, 
            $idCtrl,
            $membre) {
    $this->trajets = $trajets;
    $this->data = $data;
    $this->trajet = $trajet;
    $this->user = $user;
    $this->label = $label;
    $this->contrId = $contrId;
    $this->titre = $titre;
    $this->idCtrl = $idCtrl;
    $this->class = "";
    $this->classLabel = "parcoursLabelRight";
    $this->membre = $membre;
    // var_dump($this->membre);
  }
  /**
  * Function render adress view
  *
  * @return void
  */
  function affiche($chauffeurs = null) {
    // var_dump($this->trajets);
  ?>
    <input type="hidden" value="correspondance::affiche()">
    <div class="<?= $this->class?>">
      <?php
        $trajet = null;
        // var_dump($this->data);
        if (!empty( $this->data )) {
          $trajet = $this->data;
          // var_dump($trajet);
        }
      ?>
      <div class="row">
        <div class="col-12">
          <?php
          // var_dump($this->trajets);
            $trajetsDetailsObj = new App\Controller\TrajetsDetails(
              $this->trajets, 
              $this->data, 
              $this->user, 
              $this->label, 
              $this->idCtrl,
              false,
            $this->membre);
            $trajetsDetailsObj->affiche($chauffeurs);
          ?>
        </div>
      </div>
    </div>
  <?php
  }
}
?>