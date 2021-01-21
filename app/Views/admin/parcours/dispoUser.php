<?php 
  require_once ROOT ."/app/Views/admin/parcours/utils/Commune.php";
  require_once ROOT ."/app/Views/admin/parcours/utils/membre.php";  
  require_once ROOT ."/app/Views/admin/parcours/utils/UserDispo.php";
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
  $membre = null;
  $user = null;
  if(isset($data)) {
      $membre = $data['user']['membre']; 
      $user = $data['user']['user']; 
  }
  // var_dump($data['parcours']['parcoursEtape']);
?>
<div class="container">
  <?php
  echo '<a class="float-left ml-2" href="' . $_SERVER['HTTP_REFERER'] . '"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour</a><br>';
  // echo $_SERVER['HTTP_REFERER'];
  ?>
  <form method="post" action="
  <?php
  if (isset($_SESSION['transport-solidaire']['statut']) && !isset($_SESSION['transport-solidaire']['membre_type'])) {
    echo ROUTE . "enrDispo." . $data['user']['user']->id;
  } else if (isset($_SESSION['transport-solidaire']['membre_type']) && !isset($_SESSION['transport-solidaire']['statut'])) {
    echo ROUTE . "enrDispoUser." . $data['user']['user']->id;
  }
  ?>
  " id="form-dispo-enreg" style="background:#f8f9fa">

  <!-- < ?php if (isset($_SESSION['transport-solidaire']['membre_type']) && !isset($_SESSION['transport-solidaire']['statut'])) { ?>
    <span class="d-block" style="font-size:18px!important;">
      <a class="float-left ml-2" href="< ?=ROUTE?>profil"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour au profil</a><br>
    </span>
  
  < ?php } ?> -->

    <input type="hidden" name="HTTP_REFERER"
            id="HTTP_REFERER" value="<?=$_SERVER['HTTP_REFERER']?>">
    <input type="hidden" name="userId" id="userId" value="<?php echo $data['user']['user']->id?>">
    <div class="row">
      <div class="col-12 parcoursTitre" style="text-align:center;">
        <h3> Disponibilité du chauffeur </h3>
      </div>  
      <div class="col-12 col-md-12 text-center">  
        Vous pouvez proposer de vous rendre disponible certains jours dans la semaine pour effectuer des trajets à 30km de chez vous<br>
        Vous serez contacté si un Passager à besoin de vous pour effectuer un déplacement dans cette zone
      </div>     
      <!-- titre fin -->
      <div class="col-12 col-md-12">      <!-- membre -->
       <?php
          if (!isset($_SESSION['transport-solidaire']['membre_type'])) {
            // $isPnm = false;
          // } else {
          $membreObj = new App\Controller\Membre($membre, $user, $erreur);
          $membreObj->affiche();
        ?>
          <div style="padding:30px;">
          </div>
        <?php
            }
      ?>
      </div>                        <!-- membre fin -->
      <div class="col-12 parcoursPaddingInfo">
      </div>
      <div class="col-12 col-md-12">
        <?php
          $userDispo = new App\Controller\UserDispo();
          $userDispo->afficheFormulaireUpdate($data['dispo']);
        ?>
      </div>                            <!-- date fin -->
      <div class="col-12">              <!-- bouton -->
        <div class="row" style="margin-top:20px">
          <div class="col-1 col-sm-4">
          </div>
          <div class="col-10 col-sm-4 parcoursBtn">

          <button id="btnDispoEnrSubmit"
                  class="btn-ins btn btn-primary btn-block" type="submit" 
                  style="font-size:28px; padding: 0.375rem 0.65rem;margin-bottom:10px;"
                  disabled>
                      Sauvegarder
          </button>

          </div>
          <div class="col-1 col-sm-4">
          </div>
        </div>
      </div>                        <!-- bouton fin -->
    </div>
  </form>
</div>
