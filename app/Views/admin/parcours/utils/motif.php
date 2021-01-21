<?php

namespace App\Controller;
use App;

class MotifUtils
{
  public function __construct($membre) {
    $this->membre = $membre;
    $this->classLabel = "parcoursLabelRight";
    $this->classValue = "parcoursValue";
  }

  function affiche($trajet) {
    ?>
    <input type="hidden" value="Motif::affiche()">
          
      <label for="traj_enr_motif" class="<?=$this->classLabel?>"><strong>Motif de la demande :</strong></label>
      <select style="width:auto" id="traj_enr_motif" name="traj_enr_motif"
              onchange="enableParcoursEnregButton()"

      value="<?php
      if($trajet) {
        echo $trajet['motif'];
      }
      ?>"

      >
    <option value="0">Veuillez sélectionner un motif... </option>
      <?php
        $loadMotif = App::getInstance()->getTable('Motif');
        $motifs = $loadMotif->selectMotifs(); 
        
        foreach($motifs as $motif) {
          
          echo '<option value="' . $motif->id . '">' . utf8_encode($motif->description) . "</option>";           
        }
      ?>
    </select> 
    <?php
      $selectMotifValue = 0;
    ?> 
        
<?php
  }
    /**
  * Function render tisane view
  *
  * @return void
  */
  function afficheUpdate($trajet) {
    ?>
    <input type="hidden" value="Motif::afficheUpdate()">
          
      <label for="traj_enr_motif" class="<?=$this->classLabel?>"><strong>Motif de la demande :</strong></label>
      <select style="width:auto" id="traj_enr_motif" name="traj_enr_motif"
              onchange="enableParcoursEnregButton()"

      value="<?php
      if($trajet) {
        echo $trajet->motif;
      }
      ?>">
    <option value="0">Veuillez sélectionner un motif... </option>
      <?php
        $loadMotif = App::getInstance()->getTable('Motif');
        $motifs = $loadMotif->selectMotifs(); 

        foreach($motifs as $motif) {
          echo '<option value="' . $motif->id . '">' . utf8_encode($motif->description) . "</option>";           
        }
      ?>
    </select> 
        
    <?php
      $selectMotifValue = "";

      if( $trajet != null) {
        $selectMotifValue = $trajet->motif;
        $this->getJavaScript($selectMotifValue);
      }
    ?> 
      <?php
  }
  private function getJavaScript($selectMotifValue) {
    ?>
    <script>
  var selMotifVal = <?php echo $selectMotifValue; ?>;
  console.log("traj_enr_motif", selMotifVal);
  var select = document.getElementById("traj_enr_motif");
  if (select != null) {
    console.log("traj_enr_motif", select);
    select.value = selMotifVal;
    console.log("traj_enr_motif", select);
  }
</script>  
    <?php 
  }
}
?>
