<?php    
require_once ROOT ."/app/Views/admin/parcours/utils/Commune.php";  
require_once ROOT ."/app/Views/admin/parcours/utils/TrajetDispo.php";  
require_once ROOT ."/app/Views/admin/parcours/utils/TrajetDate.php";

// TrajetUtils::selectParcoursListe
function getDescMotif($id) {
  $loadMotif = App::getInstance()->getTable('Motif');
  $motifs = $loadMotif->selectMotifs(); 
  foreach($motifs as $motif) {
    if($motif->id == $id) {
      return $motif->description;
    }
  }
}
?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

<?php
?>

<div class="row mt-5">
  <div class="col-12 col-md-6 text-center">
    <h4>OFFRES</h4>
    <div class="mx-auto mt-3 mb-3" style="width:60%;">
      <?php /*********** CHART 1 ************ */ ?>
        <canvas id="chartOffre"></canvas>
    </div>
    <div>
      <form method="post" action="<?=ROUTE?>consult?consultTraj" id="filtre-passagers">
        <fieldset>
        <input type="hidden" id="idCommuneFiltreChauffeur" name="idCommuneFiltreChauffeur" 
            value="<?php echo $trajets['idCommuneFiltreChauffeur']?>">
        <input type="hidden" id="idCommuneFiltrePassagerDemande" name="idCommuneFiltrePassagerDemande" 
            value="<?php echo $trajets['idCommuneFiltrePassager']?>">
            <input type="hidden" id="idPnmFiltreChauffeur" name="idPnmFiltreChauffeur" 
            value="<?php echo $trajets['idPnmFiltreChauffeur']?>">
        <input type="hidden" id="idPnmFiltrePassagerDemande" name="idPnmFiltrePassagerDemande" 
            value="<?php echo $trajets['idPnmFiltrePassager']?>">
        <div class="row">
        <div class="col-12">
          <label class="" for="CommuneFiltreChauffeur"> Filtrer par Commune : </label> 
            <select id="CommuneFiltreChauffeur" name="CommuneFiltreChauffeur"
                value="<?php echo $trajets['idCommuneFiltreChauffeur']?>"
                onChange="onCommuneFiltreChauffeur(this)">
              <option value="0">Tous</option>"<?php
              // MembreTable::selectCommunesPassagers
                foreach($trajets['communesOffres'] as $commune) {
                  echo '<option value="' . $commune->communeId . '">' . $commune->nomCommune . '</option>';           
                }
              ?>
            </select>
            </div>
            <div class="col-12 col-md-12">
            <label class="" for="PnmFiltreChauffeur"> Filtrer par Pnm : </label> 
            <select id="PnmFiltreChauffeur" name="PnmFiltreChauffeur"
                value="<?php echo $trajets['idPnmFiltreChauffeur']?>"
                onChange="onPnmFiltreChauffeur(this)">
              <option value="0">Tous</option>"<?php
              // MembreTable::selectCommunesPassagers
                foreach($pnms as $pnm) {
                  echo '<option value="' . $pnm->id_pnm . '">' . $pnm->titre_pnm . '</option>';           
                }
              ?>
            </select>
            </div>
            <div class="col-12 col-md-12">
            <button class="btn btn-secondary px-2 py-1" type="submit" style="padding:0px;margin-bottom:10px;" 
              >Selectionner
            </button>
            </div>
          </div>
          </fieldset>
        </form>
       </div>
       <?php 
          $offreStatus = array (
            array(),
            array(),
            array()
          );
          foreach ($trajets['offres'] as $offre) {
            $offreStatus[$offre['offre']->status][] = $offre;
          }
          require_once ROOT ."/app/Views/stats/statsObject.php";

          $chartOffreJSON = getOffresPnmStatus($offreStatus);
          // var_dump($offreStatus);
          $offres = $offreStatus[0];
          ?>
          <br>
          <h5 class="w-100 p-2 text-center" data-toggle="collapse" data-target="#offresNonAttribue">
          En attente (<?= count($offres) ?>)
          <i class="fas fa-caret-square-down"></i></h5>
          <div class="collapse" id="offresNonAttribue">
          <?php
          require ROOT ."/app/Views/admin/parcours/utils/ParcoursTableOffre.php"; 
          echo '</div>';
          $offres = $offreStatus[1];
          ?>
          <h5 class="w-100 p-2 text-center" data-toggle="collapse" data-target="#offresAttribue">
          à étudier (<?= count($offres) ?>)
          <i class="fas fa-caret-square-down"></i></h5>
          <div class="collapse" id="offresAttribue">
          <?php

          require ROOT ."/app/Views/admin/parcours/utils/ParcoursTableOffre.php"; 
          echo '</div>';
          $offres = $offreStatus[2];
          ?>
          <h5 class="w-100 p-2 text-center" data-toggle="collapse" data-target="#offreConfirme">
          Programmé (<?= count($offres) ?>)
          <i class="fas fa-caret-square-down"></i></h5>
          <div class="collapse" id="offreConfirme">
          <?php

           require ROOT ."/app/Views/admin/parcours/utils/ParcoursTableOffre.php"; 
           echo '</div>';
           ?>
       
      </div>
      <div class="col-12 col-md-6 text-center"> 
        <h4>DEMANDES</h4>
        <div  class="mx-auto mt-3 mb-3" style="width:60%;">
        <?php /*********** CHART 1 ************ */ ?>
          <canvas id="chartDemande"></canvas>
      </div>
        <div>
        <form method="post" action="<?=ROUTE?>consult?consultTraj" id="filtre-passagers">
        <fieldset>
          <input type="hidden" id="idCommuneFiltrePassager" name="idCommuneFiltrePassager" 
          value="<?php echo $trajets['idCommuneFiltrePassager']?>">
          <input type="hidden" id="idCommuneFiltreChauffeurOffre" name="idCommuneFiltreChauffeurOffre" 
          value="<?php echo $trajets['idCommuneFiltreChauffeur']?>">
          <input type="hidden" id="idPnmFiltrePassager" name="idPnmFiltrePassager" 
          value="<?php echo $trajets['idPnmFiltrePassager']?>">
          <input type="hidden" id="idPnmFiltreChauffeurOffre" name="idPnmFiltreChauffeurOffre" 
          value="<?php echo $trajets['idPnmFiltreChauffeur']?>">
          <div class="row">
          <div class="col-12">
          <label class="" for="CommuneFiltrePassager"> Filtrer par Commune : </label> 
            <select id="CommuneFiltrePassager" name="CommuneFiltrePassager"
                value="<?php echo $trajets['idCommuneFiltrePassager']?>"
                onChange="onCommuneFiltrePassager(this)">
              <option value="0">Tous</option>"<?php
              // MembreTable::selectCommunesPassagers
                foreach($trajets['communesDemandes'] as $commune) {
                  echo '<option value="' . $commune->communeId . '">' . $commune->nomCommune . '</option>';           
                }
              ?>
            </select>
            </div>
            <div class="col-12">
            <label class="" for="PnmFiltrePassager"> Filtrer par Pnm : </label> 

            <select id="PnmFiltrePassager" name="PnmFiltrePassager"
                value="<?php echo $trajets['idPnmFiltrePassager']?>"
                onChange="onPnmFiltrePassager(this)">
              <option value="0">Tous</option>"<?php
              // MembreTable::selectCommunesPassagers
                foreach($pnms as $pnm) {
                  echo '<option value="' . $pnm->id_pnm . '">' . $pnm->titre_pnm . '</option>';           
                }
              ?>
            </select>
            </div>
            <div class="col-12">
            <button class="btn btn-secondary px-2 py-1" type="submit" style="padding:0px;margin-bottom:10px;" 
              >Selectionner
            </button>
            </div>
            </div>
          </fieldset>
        </form>
       </div>
       

       <?php 

          $demandeStatus = array (
            array(),
            array(),
            array()
          );
          foreach ($trajets['demandes'] as $demande) {
            $demandeStatus[$demande['demande']->status][] = $demande;
          }
          // var_dump($offreStatus);
          $chartDemandeJSON = getDemandesPnmStatus($demandeStatus);

          $demandes = $demandeStatus[0];
          ?>
          <br>
          <h5 class="w-100 p-2 text-center" data-toggle="collapse" data-target="#demandesNonAttribue">
           En attente (<?= count($demandes) ?>)
          <i class="fas fa-caret-square-down"></i></h5>
          <div class="collapse" id="demandesNonAttribue">
          <?php

          require ROOT ."/app/Views/admin/parcours/utils/ParcoursTableDemande.php"; 
          echo '</div>';

          $demandes = $demandeStatus[1];
          ?>
          <h5 class="w-100 p-2 text-center" data-toggle="collapse" data-target="#demandesAttribue">
           à étudier (<?= count($demandes) ?>)
          <i class="fas fa-caret-square-down"></i></h5>
          <div class="collapse" id="demandesAttribue">
          <?php
          require ROOT ."/app/Views/admin/parcours/utils/ParcoursTableDemande.php"; 
          echo '</div>';
          $demandes = $demandeStatus[2];
          ?>
          <h5 class="w-100 p-2 text-center" data-toggle="collapse" data-target="#demandesConfirme">
           Programmé (<?= count($demandes) ?>)
          <i class="fas fa-caret-square-down"></i></h5>
          <div class="collapse" id="demandesConfirme">
          <?php
          require ROOT ."/app/Views/admin/parcours/utils/ParcoursTableDemande.php"; 
          echo '</div>';
          ?>

      </div>
    </div>
  </div>
  <script>
  function onPnmFiltreChauffeur(ctrl) {
    console.log(ctrl);
    $("#idPnmFiltreChauffeurOffre")[0].value = ctrl.value;
    $("#idPnmFiltreChauffeur")[0].value = ctrl.value;
    
    $("#CommuneFiltreChauffeur")[0].value = 0;
    $("#idCommuneFiltreChauffeurOffre")[0].value = 0;
    $("#idCommuneFiltreChauffeur")[0].value = 0;
    console.log(ctrl.value);    
  }
  function onCommuneFiltreChauffeur(ctrl) {
    console.log(ctrl);
    $("#idCommuneFiltreChauffeurOffre")[0].value = ctrl.value;
    $("#idCommuneFiltreChauffeur")[0].value = ctrl.value;
    
    console.log(ctrl.value);
  }
  function onPnmFiltrePassager(ctrl) {
    console.log(ctrl);
    $("#idPnmFiltrePassagerDemande")[0].value = ctrl.value;
    $("#idPnmFiltrePassager")[0].value = ctrl.value;

    $("#CommuneFiltrePassager")[0].value = 0;
    $("#idCommuneFiltrePassagerDemande")[0].value = 0;
    $("#idCommuneFiltrePassager")[0].value = 0;

    console.log(ctrl.value);

  }
  function onCommuneFiltrePassager(ctrl) {
    console.log(ctrl);
    $("#idCommuneFiltrePassagerDemande")[0].value = ctrl.value;
    $("#idCommuneFiltrePassager")[0].value = ctrl.value;
    
    console.log(ctrl.value);
  }
  function onLoad() {
    console.log('onload');
    let CommuneFiltreChauffeur = document.getElementById("CommuneFiltreChauffeur");
    CommuneFiltreChauffeur.value = <?php echo $trajets['idCommuneFiltreChauffeur']?>;

    let CommuneFiltrePassager = document.getElementById("CommuneFiltrePassager");
    CommuneFiltrePassager.value = <?php echo $trajets['idCommuneFiltrePassager']?>;

    let PnmFiltreChauffeur = document.getElementById("PnmFiltreChauffeur");
    PnmFiltreChauffeur.value = <?php echo $trajets['idPnmFiltreChauffeur']?>;

    let PnmFiltrePassager = document.getElementById("PnmFiltrePassager");
    PnmFiltrePassager.value = <?php echo $trajets['idPnmFiltrePassager']?>;

  }
  onLoad();

  var JSONChartOffre = <?php echo json_encode($chartOffreJSON); ?>;
  var offreJSON = JSON.parse(JSONChartOffre);
                
  var ctx = document.getElementById('chartOffre').getContext('2d');
                
  try {
    var chartPassager = new Chart(ctx, offreJSON);
  }
  catch(err) {
    console.log("myChart Error: ", err);
  }

  var JSONChartDemande = <?php echo json_encode($chartDemandeJSON); ?>;
  var demandeJSON = JSON.parse(JSONChartDemande);
                
  var ctx = document.getElementById('chartDemande').getContext('2d');
                
  try {
    var chartPassager = new Chart(ctx, demandeJSON);
  }
  catch(err) {
    console.log("myChart Error: ", err);
  }

  
</script>
<div id="supModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h2 class="text-white">Êtes-vous sûrs de vouloir supprimer ce trajet.</h2>
        <button type="button" class="close" data-dismiss="modal">&times; Fermer</button> 
      </div>
      <div class="row modal-body mx-auto text-center">
        <div class="col-12 col-md-2">
          <a class="btn-ins btn btn-secondary px-2" href=""
          id="supLink">Confirmer</a>
        </div>
        <!-- <div class="col-12 col-md-6">
          <a class="btn-ins btn btn-secondary px-2" href="#" class="close" data-dismiss="modal">Annuler</a>
        </div> -->
      </div>
    </div>
  </div>
</div>
<script>
  function onDelete(id) {
    console.log("onDelete, id");

    hrefSup = document.getElementById("supLink");
    console.log(hrefSup);
    hrefSup.setAttribute("href", id);
    console.log(document.getElementById("supLink").href);
  }
</script>