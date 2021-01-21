<?php

namespace App\Controller;
use App;

require_once ROOT ."/app/Views/admin/parcours/utils/TrajetCorrespondance.php";

class TrajetsDetails
{
  protected $parcours;
  protected $titre;
  protected $user;
  
  public function __construct(
          $trajets, 
          $parcours, 
          $user, 
          $titre, 
          $idCtrl, 
          $validation = false,
          $membre) {
    $this->trajets = $trajets;
    $this->parcours = $parcours;
    $this->titre = $titre;
    $this->user = $user;
    $this->class = "parcoursBox";
    $this->idCtrl = $idCtrl;
    $this->validation = $validation;
    $this->membre = $membre;
  }
  /**
  * Function render adress view
  *
  * @return void
  */
  function affiche($chauffeurs = null) {
    $corrs = [];
    if($this->parcours == null || $this->parcours == 'none') {
      $corrs['corrBoth'] = 'none';
      $corrs['corrDep'] = 'none';
      $corrs['corrArr'] = 'none';
    } else {
      $corrs = $this->parcours['corrs'];
    }
    // var_dump($this->membre);
    ?>
    <div class="parcoursBoxTest"  >
    <input type="hidden" value="trajetsDetails::affiche()">
      <div class="row">
        <button type="button" class="col-12 trajetsTitre" data-toggle="collapse" 
                data-target="#<?=$this->idCtrl?>Corrs"
                onclick="onClickCorrespondance()">
          <span class="parcoursLabel parcoursStrong "><?=$this->titre?>&nbsp;
            <?=$this->parcours['detail']->nomDepart?>&nbsp;->&nbsp<?=$this->parcours['detail']->nomArrivee?>
            &nbsp;<i class="fas fa-chevron-down" id="corrChevron"></i>
        </button>
        <div class="col-12 col-sm-4">  
          <?php 
            if(($corrs["corrBoth"] == 'none') && ($corrs["corrBothDispos"] == 'none')) { ?>
              <span class="parcoursLabel : ">Offres correspondantes :&nbsp;0
            <?php } else { ?>
              <span class="parcoursLabel : ">Offres correspondantes :&nbsp;</span>
                <?php 
                $count = 0;
                if ($corrs["corrBoth"] != 'none') {
                  $count = sizeof($corrs["corrBoth"]);
                } 
                if ($corrs["corrBothDispos"] != 'none') {
                  $count = $count + sizeof($corrs["corrBothDispos"]['trajetCorr']);
                } 
                echo $count;
             }
          ?>
        </div>
        <div class="col-12 col-sm-4"> 
         <?php 
         $titresDep = 'Départs correspondants'; 
            if(($corrs["corrDep"] == 'none') && ($corrs["corrDepDispos"] == 'none')) { ?>
              <span class="parcoursLabel : "><?=$titresDep?> :&nbsp;0</span>
           <?php } else { ?>
              <span class="parcoursLabel : "><?=$titresDep?> :&nbsp;</span>
              <?php
              $count = 0;
                if ($corrs["corrDep"] != 'none') {
                  $count = sizeof($corrs["corrDep"]);
                } 
                if ($corrs["corrDepDispos"] != 'none') {
                  $count = $count + sizeof($corrs["corrDepDispos"]['trajetCorr']);
                } 
                echo $count;              
          }
          ?>
        </div>
        <div class="col-12 col-sm-4">          
          <?php 
         $titresDep = 'Arrivées correspondantes'; 
        //  var_dump($corrs);
         if(($corrs["corrArr"] == 'none') && ($corrs["corrArrDispos"] == 'none')) { ?>
           <span class="parcoursLabel : "><?=$titresDep?> :&nbsp;0</span>
        <?php } else { ?>
           <span class="parcoursLabel : "><?=$titresDep?> :&nbsp;</span>
           <?php
           $count = 0;
             if ($corrs["corrArr"] != 'none') {
               $count = sizeof($corrs["corrArr"]);
             } 
             if ($corrs["corrArrDispos"] != 'none') {
               $count = $count + sizeof($corrs["corrArrDispos"]['trajetCorr']);
             } 
             echo $count;              
       }
          ?>
        </div>   
      </div>
      <div class="row">
        <div class="col-12 collapse " id="<?=$this->idCtrl?>Corrs">
      <?php
        $disabled = false;
        if ($this->membre->actif == 0) {
          $disabled = true;
        }
        if (!($corrs['corrBoth'] == 'none')) {
          foreach($corrs['corrBoth'] as $details) {
            if($details->correspondance == $this->parcours['detail']->trajetId) {
                $disabled = true;
            }
          }
        }
        if (!($corrs['corrDep'] == 'none')) {
          foreach($corrs['corrDep'] as $details) {
            if($details->correspondance == $this->parcours['detail']->trajetId) {
              $disabled = true;
            }
          }
        }
        if (!($corrs['corrArr'] == 'none')) {
          foreach($corrs['corrArr'] as $details) {
            if($details->correspondance == $this->parcours['detail']->trajetId) {
              $disabled = true;
            }
          }
        }
        ?>
        <div class="parcoursPaddingContent">
        </div>
        <?php
        $this->afficheDetails($corrs['corrBoth'], $corrs['corrBothDispos'], "Offres correspondantes", $corrs['trajet'], $disabled, $chauffeurs, "both");
        ?>
        <div class="parcoursPaddingContent">
        </div>
        <?php
        $this->afficheDetails($corrs['corrDep'],  $corrs['corrDepDispos'], "Départs correspondants", $corrs['trajet'], true, $chauffeurs, "aller");
        ?>
        <div class="parcoursPaddingContent">
        </div>
        <?php
        $this->afficheDetails($corrs['corrArr'],  $corrs['corrArrDispos'], "Arrivées correspondantes", $corrs['trajet'], true, $chauffeurs, "retour");
        ?>
        </div>
      </div>
    </div>
    <?php
  }
  function afficheDetails($data, $dispo, $titres, $parcours, $disabledIn, $chauffeurs, $direction) {
    // var_dump($data);
    ?>
    <fieldset class="col-12 <?=$this->class?>" >
      <legend class="parcoursLabel parcoursLegend"><?=$titres?> </legend>
      <?php
        $disabled = false;
        if (($data == 'none') && ($dispo == 'none')) {
          $commune = $parcours->direction == "aller" ? $parcours->departCommuneId : $parcours->arriveeCommuneId;
          $communeNom = $parcours->direction == "aller" ? $parcours->nomDepart : $parcours->nomArrivee;
          echo '<div class="parcoursStrong text-secondary">Aucune correspondance directe trouvée</div>';
          // echo '<br>Chauffeurs dans le commune de ' . $communeNom . ' (' . $commune . '): <br>';
          // var_dump($chauffeurs);
          // var_dump($parcours);
          if ($direction == "aller") {
            $this->afficheChauffeurs($chauffeurs['depart'], $parcours);
          }
          if ($direction == "retour") {
            $this->afficheChauffeurs($chauffeurs['arrivee'], $parcours);
          }
          echo '<div class="col-12">';
          if ($direction == "both") {
            echo '<div class="row">';
            echo '<div class="col-12 col-md-6">';
            $this->afficheChauffeurs($chauffeurs['depart'], $parcours);
            echo '</div>';
            echo '<div class="col-12 col-md-6">';
            $this->afficheChauffeurs($chauffeurs['arrivee'], $parcours);
            echo '</div>';
            echo '</div>';
          }
          echo "</div>";
/*           if ($chauffeurs != null ) {
            foreach($chauffeurs as $chauffeur) {
              echo '<span class="parcoursStrong">' . $chauffeur->civilite . ' ';
              echo $chauffeur->nom . ' ' . $chauffeur->prenom;
              echo ' </span>';
              if (strlen($chauffeur->mobile) > 0 ) {
                echo '<i>&nbsp; Mobile :&nbsp; </i><span class="parcoursStrong">' . $chauffeur->mobile . '&nbsp;';
              } else {
                echo '<i>&nbsp; Téléphone :&nbsp; </i><span class="parcoursStrong">' . $chauffeur->tel . '&nbsp;';
              }
              echo '</span><br>';
            }
          }
 */        } else {
          if (!($data == 'none')) {
            // var_dump($data);
            foreach($data as $details) {
              $trajetsCorrespondanceObj = new App\Controller\TrajetCorrespondance(
                    $this->trajets, 
                    $details, 
                    $this->user, 
                    $parcours, 
                    'none', 
                    $details->id, 
                    $disabledIn);
              $trajetsCorrespondanceObj->affiche();
            }
          }
          if (!($dispo == 'none')) {
            foreach($dispo['trajetCorr'] as $details) {
              $trajetsCorrespondanceObj = new App\Controller\TrajetCorrespondance(
                    $this->trajets, 
                    $details, 
                    $this->user, 
                    $parcours, 
                    $dispo[$details->id_trajet], 
                    $details->id, 
                    $disabledIn);
              $trajetsCorrespondanceObj->affiche();
            }
          }
        }
        
      ?>
    </fieldset>
    <?php
  }
  function afficheChauffeurs($chauffeurs, $parcours) {
    if ($chauffeurs != null ) {
      if (count($chauffeurs) > 0) {
        echo '<br>Chauffeurs situés dans le commune de <span class="parcoursStrong">' . $chauffeurs[0]->nomCommune . ' : </span><br>';
      }

      // var_dump($this->parcours['corrs']['trajet']);
      foreach($chauffeurs as $chauffeur) {
        // var_dump($parcours);
        ?>
        <a href="<?=ROUTE?>enrCopy.<?=$chauffeur->id?>.<?=$parcours->parcours?>">
        <!-- <a href="< ?=ROUTE?>parcoursNewChauffeur.< ?=$this->parcours['corrs']['trajet']->parcours?>.< ?=$chauffeur->id?>"> -->
        <i class="far fa-copy" alt="copier"></i>
        <?php
        echo '<span class="parcoursStrong">' . ucfirst($chauffeur->civilite) . ' ';
        echo ucfirst($chauffeur->nom) . ' ' . ucfirst($chauffeur->prenom);
        echo ' </span>';
        if (strlen($chauffeur->mobile) > 0 ) {
          echo '<i>&nbsp; Mobile :&nbsp; </i><span class="parcoursStrong">' . $chauffeur->mobile . '&nbsp;';
        } else {
          echo '<i>&nbsp; Téléphone :&nbsp; </i><span class="parcoursStrong">' . $chauffeur->tel . '&nbsp;';
        }
        if ($chauffeur->actif == 0) {
          echo '<span class="text-danger"><i>(inactif)</i></span>';
        }
        echo '</span><br></a>';
      }
    }

  }
}
?>
<style>
.trajetsBox {
  border: 1px solid lightgray;

}
.trajetsTitre {
  text-align:center;
  background:lightgray;
}
</style>