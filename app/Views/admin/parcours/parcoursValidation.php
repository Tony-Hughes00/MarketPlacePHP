<?php 
  require_once ROOT ."/app/Views/admin/parcours/utils/membre.php";  
  require_once ROOT ."/app/Views/admin/parcours/utils/trajetInfo.php";  

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
<?php echo '<a class="float-left ml-2" href="' . $_SERVER['HTTP_REFERER'] . '"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour</a><br>'; ?>

<form method="post" action="<?=ROUTE?>parcours.<?=$data['parcours']['parcours']->id?>" id="form-trajet-corr" 
style="background:#f8f9fa ; border: 2px solid green; border-radius: 22px 22px 0px 0px;">
<fieldset>
<?php
// var_dump($data['parcours']['trajets']);
$params = [];
foreach($data['parcours']['trajets'] as $trajet) {
  $param = [];
  $param['id'] = $trajet['trajet']->trajetId;
  $param['status'] = $trajet['trajet']->status;
  $params[] = $param;
}
$dataIn = json_encode($params);
// var_dump($dataIn);
?>
  <input type="hidden" name="data" id="data" value='<?=$dataIn?>'>
  <div class="col-12 text-center p-2 bg-success" style="border-radius: 22px 22px 0px 0px;">    <!-- titre -->
      <h3 class="text-light"> Validation </h3>
    </div> 
  <div class="row" >     <!--  body -->

    <!-- <div class="col-12 parcoursTitre" style="text-align:center;">
      <h3>Validation</h3>
    </div> -->
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
    <div class="col-12">
      <?php
        $trajetInfoObj = new App\Controller\TrajetInfo($data['parcours'], null, null, $membre, true, true, 2);
        $trajetInfoObj->afficheDetailsVal();
      ?>
    </div>
    <!-- <div class="col-4 parcoursBtn">
    </div> -->

    <div class="col-8 col-md-4 mx-auto parcoursBtn text-center">
      <button id="btnValSubmit"
              class="btn-ins btn btn-primary btn-block"
              type="submit" 
              disabled
              style="font-size:28px; padding: 0.375rem 0.65rem;" >
                    Sauvegarder
      </button>
    </div>
    <!-- <div class="col-4 parcoursBtn">
    </div> -->
  </div>
  </fieldset>
</form>
</div>

