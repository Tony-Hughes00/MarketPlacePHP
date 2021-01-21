<?php 

function getNomCommune($id) {
  $loadCommune = App::getInstance()->getTable('Commune');
  $communes = $loadCommune->selectCommunes(); 
  foreach($communes as $commune) {
    if($commune->id == $id) {
      return $commune->nom;
    }
  }
}
?>

<script src="<?= RACINE ?>js/cartePnm.js" type="text/javascript"></script>
<div class="container-fluid form-bg">
    <span class="d-block" style="font-size:18px!important;">
        <?php echo '<b><a class="ml-5 mb-5" href="' . $_SERVER['HTTP_REFERER'] . '"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour</a></b><br>'; ?>
    </span>
    <div class="row justify-content-center mt-3">
        <div class="col-11 col-sm-10 col-md-11 col-lg-10 text-center p-0 mb-2">
            <div class="card px-0 pt-4 pb-0 mb-3 mt-3">
                <h3 class="text-center bg-success p-2"  style="margin-top:-55px; margin-bottom: -2px; border-radius: 40px;">Définir un Territoire de référence</h3>
                <!-- <hr class="title-underline mx-auto"> -->
                <h4 class="bg-secondary text-light mx-4" style="border-radius:40px;">
                    <b><?= $pnm->titre_pnm ?></b>
                    <!-- <br>à <?//= getNomCommune($pnm->ville_pnm) ?> -->
                </h4>
                <div class="row mt-3">
                    <div class="col-md-12 px-md-5 px-1 mx-0 justify-content-center">
                    <span class="px-5"> Sélectionnez les communes de l'Antenne de Mobilité en cliquant sur la carte.</span>
                        <form method="post" action="#">
                            <fieldset>
                                <input type="hidden"  id="id_pnm" name="id_pnm" value="<?=$pnm->id_pnm ?>">

                                <div class="mx-auto" style="width:90%;">
                                    <?php 
                                        require ROOT . '/app/Views/admin/cartePNM.php'; 
                                        $loadCarteCommune = App::getInstance()->getTable('CommuneCarte');
                                        $loadPnm = App::getInstance()->getTable('Pnm');

                                        $pnms = $loadPnm->selectPnms();
                                        $communesCarte = $loadCarteCommune->selectPnmCarte();
                                        $data = [];
                                        $data['communePoly'] = $communesCarte;
                                        $data['data'] = [];
                                        $data['pnms'] = $pnms;
                                        $data['pnm'] = $pnm;
                                        $carte = new Carte($data);
                                        $carte->show();
                                    ?>
                                </div>

                                <?php
                                    $carte->onLoad();
                                ?>
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" for="enreg-Terr" class="btn-lg btn btn-success" style="margin-top: -55px;" value="Sauvegarder la selection">  
                                        <?php // var_dump($_POST); ?> 
                                    </div> 
                                </div>               
                          
                            </fieldset>
                        </form> 
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>

