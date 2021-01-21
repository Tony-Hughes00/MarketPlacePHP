<?php 
  require_once ROOT ."/app/Views/admin/parcours/utils/membre.php";  
  require_once ROOT ."/app/Views/admin/parcours/utils/trajetInfo.php";
  ?>

<style>
table, th, td {
  border: 0px solid black;
  border-collapse: collapse;
}
</style>
<?php
  $erreur = null;
  if(isset($data['erreur'])) {
    $erreur = $data['erreur'];
  }
?>

<div class="container">
<?php
echo '<a class="float-left ml-2" href="' . $data['HTTP_REFERER'] . '"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour</a><br>';
?>
  <?php
  // var_dump($data);
  ?>
  <form method="post" action="<?=ROUTE?>updateParcours.<?=$data['parcours']['parcours']->id?>" id="form-trajet-enreg" 
  style="background:#f8f9fa ; border: 2px solid green; border-radius: 22px 22px 0px 0px;"
  >
  <?php if (isset($data['demandeId'])) { ?>

    <input type="hidden" name="demandeId" id="demandeId" value="<?php echo $data['demandeId']?>">
  <?php } ?>
  <input type="hidden" name="HTTP_REFERER"
    id="HTTP_REFERER" value="<?=$data['HTTP_REFERER']?>">
  <input type="hidden" name="user" id="user" value="<?php echo $data['user']['user']->id?>">
  <input type="hidden" name="userId" id="userId" value="<?php echo $data['user']['user']->id?>">
    <input type="hidden" name="depAdresse" id="depAdresse" value="<?php echo $data['user']['membre']->adresse?>">
    <input type="hidden" name="membre_type" id="membre_type" value="<?php echo $data['user']['membre']->membre_type?>">
    <!-- <div class="row"> -->


          <div class="col-12 text-center p-2 bg-success" style="border-radius: 22px 22px 0px 0px;">    <!-- titre -->
            <h3 class="text-light"> Modifier le trajet </h3>
            </div>
           <!-- titre fin -->
      <div class="col-12">      <!-- membre -->
        <?php
          $membre = null;
          $user = null;
          if(isset($data)) {
            $membre = $data['user']['membre']; 
            $user = $data['user']['user']; 
          }
          $membreObj = new App\Controller\Membre($membre, $user, $erreur);
          $membreObj->affiche();
        ?>
      </div>                        <!-- membre fin -->
      <div style="padding:30px;">
      </div>
      <div class="col-12">
        <?php
          $trajet = null;
          if(isset($data['parcours'])) {
            $trajet = $data['parcours']['parcours']; 
          }
          $depAdresse = null;
          if(isset( $data['parcours']['departAdd'])) {
            $depAdresse = $data['parcours']['departAdd'];
          }
          $arrAdresse = null;
          if(isset( $data['parcours']['arriveeAdd'])) {
            $arrAdresse = $data['parcours']['arriveeAdd'];
          }
          $trajetInfoObj = new App\Controller\TrajetInfo($trajet, $depAdresse, $arrAdresse, $membre, false);
          $trajetInfoObj->afficheFormulaireUpdate($data['parcours']);
        ?>
      </div>
      <div class="m-5"></div>
    </div>
    <div class="col-12">              <!-- bouton -->
      <div class="row" style="margin-top:20px">
        <div class="col-1 col-sm-4 parcoursBtn">
        </div>
        <div class="col-10 col-sm-4 parcoursBtn">
        <?php if (isset($data['demandeId'])) { ?>
          <button id="btnParcoursEnrSubmit"
                  class="btn-ins btn btn-primary btn-block" type="submit" disabled
                  style="font-size:28px; padding: 0.375rem 0.65rem;margin-bottom:10px;">
                  Sauvegarder le Trajet
          </button>
        <?php } else { ?>
          <button id="btnParcoursEnrSubmit"
                  class="btn-ins btn btn-success btn-block" type="submit" disabled
                  style="font-size:28px; padding: 0.375rem 0.65rem;margin-bottom:10px;">
                  Modifier le Trajet
          </button>


        <?php } ?>
        </div>
        <div class="col-1 col-sm-4 parcoursBtn">
        </div>
      </div>
    <!-- </div> -->
  </form>
</div>
<?php
?>
<script>

</script>