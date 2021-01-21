<?php 
  require_once ROOT ."/app/Views/admin/parcours/utils/Commune.php";
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
  $membre = null;
  $user = null;
  if(isset($data)) {
      $membre = $data['user']['membre']; 
      $user = $data['user']['user']; 
  }
  // var_dump($data['parcours']['parcoursEtape']);
?>
<div class="container">
  <!-- < ?php if (isset($_SESSION['transport-solidaire']['membre_type']) && !isset($_SESSION['transport-solidaire']['statut'])) { ?>
    <a class="float-left ml-2" href="< ?=ROUTE?>profil"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour au Profil</a><br>
  < ?php } ?> -->
  <?php 
  echo '<a class="float-left ml-2" href="' . $_SERVER['HTTP_REFERER'] . '"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour</a><br>';

// if (isset($_SESSION['transport-solidaire']['statut']) && !isset($_SESSION['transport-solidaire']['membre_type'])) { ? >
//     <a class="float-left ml-2" href="<?=ROUTE? >consult?consultTraj"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour aux Trajets </a><br>
// <?php } 
?>
  <form method="post" action="<?=ROUTE?>corrParcours.<?=$data['parcours']['parcours']->id?>" id="form-trajet-enreg" style="background:#f8f9fa; ; border: 2px solid green; border-radius: 22px 22px 0px 0px;">
    <input type="hidden" name="userId" id="userId" value="<?php echo $data['user']['user']->id?>">
    <input type="hidden" name="parcoursId" id="parcoursId" value="<?php echo $data['parcours']['parcours']->id?>">
     
    <div class="p-2 bg-success" style="text-align:center; border-radius: 22px 22px 0px 0px;">
        <h3 class="text-light"> Trajet enregistré </h3>
      </div>
    <!-- <div class="row">
    <div class="col">
          <a href="parcoursUpdate.< ?= $data['parcours']['parcours']->id ?>"><i class="fas fa-edit float-right mt-5"alt="modifier"></i></a><br>
          <a href="< ?=ROUTE?>parcoursDelete.< ?= $data['parcours']['parcours']->id ?>" onClick="return confirm('Confirmer la suppression ?');"> <i class="fas fa-trash float-right mt-5"></i></a>
      </div>
    </div> -->
    
    <div class="row" >
    <div class="col-12 col-md-12">      <!-- membre -->
      <div class="col-12" style="padding:20px;">
      <?php if (isset($_SESSION['transport-solidaire']['statut']) && !isset($_SESSION['transport-solidaire']['membre_type'])) { ?>
<!--       <div class="col-12 col-md-12">      < !-- membre -- >
      <div class="col-12" style="padding:20px;"> -->
    </div>  
        <?php
          $membreObj = new App\Controller\Membre($membre, $user, $erreur, 2);
          $membreObj->affiche();
        ?>
      </div>  
      <div class="col-12" style="padding:20px;">
    </div>  
    
      <?php } ?>     
                 <!-- membre fin -->
         
       <?php if (isset($_SESSION['transport-solidaire']['statut']) && !isset($_SESSION['transport-solidaire']['membre_type'])) { ?>     
        
        <div class="col-12 col-md-12"> 
       <?php } else { ?>
        <div class="col-12 col-md-12"> 
        
         <?php } ?>    
         
        <?php
          $trajetInfoObj = new App\Controller\TrajetInfo($data['parcours'], null, null, $membre, false, false, 2);
          
          $trajetInfoObj->afficheDetailsTrajet();
        ?>
        
      </div>  
         
<!--       <div class="col-12 col-sm-2 parcoursBtn">
          <?php
            if(isset($_SESSION['transport-solidaire']['membre_type']))
              {
              ?>
                <a href="parcoursUpdate.<?= $data['parcours']['parcours']->id ?>">
                <button class="btn-ins btn btn-success btn-block" style="border-radius: 40px;">
                <i class="fas fa-edit text-light"alt="modifier"></i>
                Modifier          
                </button>
                </a><br>
                <a href="< ?=ROUTE?>parcoursDelete.< ?= $data['parcours']['parcours']->id ?>" onClick="return confirm('Confirmer la suppression ?');">
                <button class="btn-ins btn btn-secondary btn-block" style="border-radius: 40px;">
                <i class="fas fa-trash  text-light"alt="supprimer"></i>
                Supprimer          
                </button>
                </a><br>     
              <?php
              } ?>
      </div> -->
      
      
      <!-- date fin -->
      
     
      <div class="col-12">              <!-- bouton -->
        <div class="row" >
          <div class="col-1 col-sm-4">
          </div>
          <div class="col-10 col-sm-4 parcoursBtn">

                       
          <?php
            if(isset($_SESSION['transport-solidaire']['membre_type'])&& !isset($_SESSION['transport-solidaire']['statut']))
              {
              ?>
                  <a class="btn-ins btn btn-success btn-block" 
                  style="font-size:25px; padding: 0.375rem 0.65rem;margin-bottom:10px;"
                  href="<?=ROUTE?>profil">&nbsp;&nbsp;Retour au Profil</a><br>
                
                  </div>
                <!-- <a href="parcoursUpdate.< ?= $data['parcours']['parcours']->id ?>">
                <button class='btn-ins btn btn-primary btn-block'>
                <i class="fas fa-edit text-light"alt="modifier"></i>
                Modifier le trajet           
                </button>
                </a><br>
                <a href="< ?=ROUTE?>parcoursDelete.< ?= $data['parcours']['parcours']->id ?>" onClick="return confirm('Confirmer la suppression ?');">
                <button class='btn-ins btn btn-secondary btn-block'>
                <i class="fas fa-trash  text-light"alt="modifier"></i>
                Supprimer le trajet           
                </button>
                </a><br>  -->
              <?php
              } else {
                if($membre->membre_type == 'passager') {
                  ?>
                  <button class="btn-ins btn btn-success btn-block" type="submit" 
                  style="font-size:25px; padding: 0.375rem 0.65rem;margin-bottom:10px;">
                  Etudier les mises en relation
                  </button>
                  <?php
                } else{
                  ?>
                  <!-- <a class="btn-ins btn btn-primary btn-block" href="<?=ROUTE?>consult?consultTraj">
                  Trajets </a> -->
                <?php
                }
              }
              ?>
            
          </div>
          <div class="col-1 col-sm-4">
          </div>
        </div>
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
      </div>                        <!-- bouton fin -->
    </div>
  </form>
</div>
<?php
?>
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