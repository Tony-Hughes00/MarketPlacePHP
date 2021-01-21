<?php 
  require_once ROOT ."/app/Views/admin/parcours/utils/membre.php";  
  require_once ROOT ."/app/Views/admin/parcours/utils/trajetInfo.php";  
  require_once ROOT ."/app/Views/admin/parcours/utils/Correspondances.php";
  require_once ROOT ."/app/Views/admin/parcours/utils/Commune.php";  
  require_once ROOT ."/app/Views/admin/parcours/utils/CarteLegend.php";

function getDescMotif($id) {
  $loadMotif = App::getInstance()->getTable('Motif');
  $motifs = $loadMotif->selectMotifs(); 
  foreach($motifs as $motif) {
    if($motif->id == $id) {
      return $motif->description;
    }
  }
}
  $erreur = null;
  if(isset($data['erreur'])) {
    $erreur = $data['erreur'];
  }

?>
<div class="container">
<?php
echo '<a class="float-left ml-2" href="' . $_SERVER['HTTP_REFERER'] . '"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour</a><br>';
?>
<form method="post" action="<?=ROUTE?>parcoursCorr.<?=$data['parcours']['parcours']->id?>" id="form-trajet-corr" 

style="background:#f8f9fa ; border: 2px solid green; border-radius: 22px 22px 0px 0px;"
>
    <!-- <div class="col-12 parcoursTitre" style="text-align:center;"> -->
    <div class="col-12 text-center p-2 bg-success" style="border-radius: 22px 22px 0px 0px;">    <!-- titre -->
      <h3 class="text-light">Mise en relation</h3>
    </div>
    <div class="row" >     <!--  body -->
    <div class="col-12" style="width:93% important">         <!-- offre/demande -->
      <?php
        $membre = null;
        $user = null;
        if(isset($data)) {
          $membre = $data['user']['membre']; 
          $user = $data['user']['user']; 
        }
        $membreObj = new App\Controller\Membre($membre, $user, $erreur, 2);
        $membreObj->affiche();
      ?>
    </div>
    <div class="col-12" style="padding:30px;">
    </div>  
    <div class="col-12 col-md-5">
    <div style="padding-left:15px">
      <?php
        $trajetInfoObj = new App\Controller\TrajetInfo($data['parcours'], null, null, $membre,false, true, 1);
        $trajetInfoObj->afficheDetails();
      ?>
    </div>
    </div>  
    <div class="col-12 col-md-7 ">         <!-- Carte -->
        <!-- <h3>Carte</h3> --> 
        <div class="parcoursLabel parcoursStrong" style="text-align:center; padding-bottom:30px; font-size:25px;">
        <u>OFFRES</u>
      </div>
      <!-- <div class="text-center m-3">
      <u>Offres</u>
      </div> -->
      <div style="height:300px;">
      <?php
      require ROOT . '/app/Views/carte2.php'; ?>
                    <!-- Carte -->
      </div>
      <div class="col-12">
      <?php
        $legendObj = new App\Controller\CarteLegend();
        $legendObj->afficheRelation();
      ?>
      </div>
    </div>
    <!-- <div class="col-12" style="padding:60px;">
    </div>                    -->
    <!--  correspondances -->
    <div class="col-12">
      <?php
        $allerCorespondance = 0;
        $retourCorespondance = 0;
        $hasAller = false;
        $hasRetour = false;
        foreach($data['correspondances'] as $trajet) {
/*           var_dump($trajet['corrs']['corrBothDispo']);
          if ($trajet['corrs']['corrBothDispo'] != 'none') {
            var_dump($trajet['corrs']['corrBothDispo'][0]->correspondance);
          } */
          if ($trajet['corrs']['corrBoth'] != 'none') {
            if ($trajet['corrs']['corrBoth'][0]->correspondance > 0) {
              if ($trajet['corrs']['corrBoth'][0]->direction == 'aller') {
                // $hasAller = true;
                $allerCorespondance = $trajet['corrs']['corrBoth'][0]->correspondance;
              } 
              if ($trajet['corrs']['corrBoth'][0]->direction == 'retour') {
                // $hasRetour = true;
                $retourCorespondance = $trajet['corrs']['corrBoth'][0]->correspondance;
              } 
            }
          }
          }
      
          foreach($data['parcours']['trajets'] as $trajet) {
            if ($trajet['trajet']->direction == 'aller') {
              if ($trajet['trajet']->trajetId == $allerCorespondance) {
                $hasAller = true;
              }
            }
            if ($trajet['trajet']->direction == 'retour') {
              if ($trajet['trajet']->trajetId == $retourCorespondance) {
                $hasRetour = true;
              }
            }
            // var_dump($trajet['trajet']); 
          }   
          ?>   
          <input type="hidden" value="<?=$hasAller ? 'true' : 'false'?>" id="hasAller">
          <input type="hidden" value="<?=$hasRetour ? 'true' : 'false'?>" id="hasRetour">
          <input type="hidden" value="<?=$data['parcours']['parcours']->aller_retour?>" id="parcoursType" id="parcoursType">
          <?php 
            $correspondancesObj = new App\Controller\Correspondances(
                    $data['parcours'], 
                    $data['correspondances'], 
                    'none', 
                    $chauffeurs,
                    "Correspondance label",
                    "controlId",
                  $membre );
            $correspondancesObj->affiche();
      ?>
    </div>
    <div class="col-4 parcoursBtn">
    </div>

    <div class="col-4 parcoursBtn" style="margin-top:20px">
      <button id="btnCorrSubmit"
              class="btn-ins btn btn-success btn-block"
              type="submit" 
              style="font-size:28px; padding: 0.375rem 0.65rem;"
        <?php
          $enabled = false;
          if ($data['parcours']['parcours']->aller_retour == 'retour') {
            $enabled = $hasAller && $hasRetour;
          }
          if ($data['parcours']['parcours']->aller_retour == 'aller') {
            $enabled = $hasAller;
          }
          if (!$enabled) {
            echo ' disabled ';
          }
        ?>
         >
         Valider
      </button>
    </div>
    <div class="col-4 parcoursBtn">
    </div>
    <div class="col-12">
    <div class="row mb-2">
          <div class="col col-md-4 offset-md-2 offset-12">
            <a class="btn-ins btn btn-secondary float-left" style="font-size: 18px;" href="parcoursUpdate.<?= $data['parcours']['parcours']->id ?>">
              <i class="fas fa-edit text-light"alt="modifier"></i>
              Modifier le trajet           
            </a>
          </div>
          <div class="col col-md-4" data-toggle="modal" data-target="#supModal"> 
            <a class="btn-ins btn btn-secondary float-right" style="font-size: 18px;" href="#" 
            onclick="onDelete('parcoursDelete.<?=$data['parcours']['parcours']->id?>')">
              <i class="fas fa-trash  text-light"alt="modifier"></i>
              Supprimer le trajet           
            </a>
          </div> 
        </div>   
      </div>


  </div>
</form>
</div>
<script>
// validateCorrespondance();
    function onClickRadio() {
      // $("#btnCorrSubmit")[0].disabled = false;
    }
    function onClickedCorrespondance(ctrl) {
      // $("#btnCorrSubmit")[0].disabled = false;
    }    
    function onClickedCorrespondanceConf(ctrl) {
      // $("#btnCorrSubmit")[0].disabled = false;
      // var boxes = $('#\d
    }    
    function onClickedCorrespondanceVal(ctrl) {
      // $("#btnCorrSubmit")[0].disabled = false;
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