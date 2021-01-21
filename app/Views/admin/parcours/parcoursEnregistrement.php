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
  <?php if (isset($_SESSION['transport-solidaire']['membre_type']) && !isset($_SESSION['transport-solidaire']['statut'])) { ?>
    <span class="d-block" style="font-size:18px!important;">
      <a class="float-left ml-2" href="<?=ROUTE?>profil"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour au profil</a><br>
    </span>  
  <?php } ?>
  <form method="post" action="<?=ROUTE?>enrParcours" id="form-trajet-enreg" 
  style="background:#f8f9fa ; border: 2px solid green; border-radius: 22px 22px 0px 0px;">
    <input type="hidden" name="userId" id="userId" value="<?php echo $data['user']->id?>">
    <input type="hidden" name="depAdresse" id="depAdresse" value="<?php echo $data['membre']->adresse?>">
    <input type="hidden" name="membre_type" id="membre_type" value="<?php echo $data['membre']->membre_type?>">
    <!-- <div class="row"> -->
      <div class="col-12 text-center p-2 bg-success" style="border-radius: 22px 22px 0px 0px;">    <!-- titre -->
        <h3 class="text-light"> Enregistrer un Trajet </h3>
      </div> 
    <!-- </div> -->
    <div class="row">
      <div class="col-12">    
        <?php if (isset($_SESSION['transport-solidaire']['membre_type']) && !isset($_SESSION['transport-solidaire']['statut'])) { ?>
            <div class="col-12 py-2" style="text-align:center;">
            Vous devez effectuer un trajet ponctuel ou régulier <br>
            et proposez de partager votre véhicule avec d'autres passagers.<br>
            Vous serez contacté si un Passager souhaite bénéficier de votre trajet pour se déplacer<br>. 
            </div>
          <?php } ?>  
      </div>              <!-- titre fin -->

      <div class="col-12">      <!-- membre -->
        <?php
          $isPnm = true;
          $membre = null;
          $user = null;
          if(isset($data)) {
            $membre = $data['membre']; 
            $user = $data['user']; 
          }
          if (isset($_SESSION['transport-solidaire']['membre_type'])) {
            $isPnm = false;
          } else {
          $membreObj = new App\Controller\Membre($membre, $user, $erreur);
          $membreObj->affiche();
        ?>
          <div style="padding:30px;">
          </div>
                       <!-- membre fin -->
      <?php
            }
      ?>
      </div> 
      <div class="col-12">
        <?php
          $trajet = null;

          if(isset($data['parcours'])) {
            $trajet = $data['parcours']; 
          }
          $depAdresse = null;
          if(isset( $data['adresse'])) {
            $depAdresse = $data['adresse'];
          }
          $arrAdresse = null;

          $trajetInfoObj = new App\Controller\TrajetInfo($trajet, $depAdresse, $arrAdresse, $membre, false, $isPnm);
          $trajetInfoObj->afficheFormulaire();
        ?>
      </div>
    </div>
    <div class="col-12">              <!-- bouton -->
      <div class="row" style="margin-top:20px">
        <div class="col-1 col-sm-4 parcoursBtn">
        </div>
        <div class="col-10 col-sm-4 parcoursBtn">
          <button id="btnParcoursEnrSubmit"
                  class="btn-ins btn btn-success btn-block" type="submit" disabled
                  style="font-size:28px; padding: 0.375rem 0.65rem;margin-bottom:10px;">
                      Créer le Trajet
          </button>
        </div>
        <div class="col-1 col-sm-4 parcoursBtn">
        </div>
      </div>
    </div>
  </form>
</div>
<?php
?>
