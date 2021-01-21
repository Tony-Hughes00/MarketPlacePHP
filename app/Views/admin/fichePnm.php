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

<div class="container px-2 px-md-5 " style="margin-top: -20px;">
    <div class="row mx-2 mx-md-5 px-md-5 mb-2 py-1 text-light bg-primary" style="border-radius:40px; border: solid 3px #3358ff; box-shadow: 12px 7px 2px 1px rgba(0, 0, 255, .2);">
        <div class="col text-center">  
            <h3>FICHE ANTENNE DE MOBILITE</h3>
        </div>
    </div>  
    <div class="row mx-3 px-md-5 px-1" style="margin-top:-20px; border-top-style:none !important; border: solid 3px #3358ff; border-radius: 40px;">
        <div class="col-md mx-2 mt-5 px-1 px-md-2">   
            <a href="enrPnmMod.<?= $pnm->id_pnm ?>">
            <h5 class="mt-2"><i class="far fa-edit text-secondary small"></i></a>
            <b><u><?= $pnm->titre_pnm ?></u></b></h5>           
            <b>- <?= $pnm->struct_pnm ?> -</b><br>
            Adresse : <?= $pnm->adr_pnm ?><br>
            <span class="ml-5"><?= $pnm->cp_pnm ?> - <?= getNomCommune($pnm->ville_pnm) ?></span><br>
            Tel : <a href="tel:+33<?= substr($pnm->tel_pnm, 1) ?>"> <?= $pnm->tel_pnm ?></a><br>
            Mail : <a href="mailto:<?= $pnm->mail_pnm ?>"><?= $pnm->mail_pnm ?></a><br>
            Site : <a href="<?= $pnm->site_pnm ?>" target="_blank"><?= $pnm->site_pnm ?></a><br>    
        </div>
        <div class="col col-md-4 mx-2 p-1 p-md-2 my-5 text-center" style="background-color:#ced0dd; border-radius: 40px; " >
            <a href="enrHouv.<?=$pnm->id_pnm?>">
                <i class="far fa-edit text-secondary small"></i>
            </a>
            <b ><u>Les Horaires d'ouverture : </u></b> <br>

            <?php  if(!empty($dispos)){ ?>
                <div class="mt-2 px-5"> Lundi :
                    <?php    
                    if(!empty($disposLun)){              
                        foreach($disposLun as $dispoLun){?> 
                            <div class="float-right">de <?= strftime("%H:%M", strtotime($dispoLun->h_dbt )); ?> à  <?= strftime("%H:%M", strtotime($dispoLun->h_fin)) ; ?></div><br>
                        <?php } 
                    } else { echo 'Fermé <br>'; }  ?>
                </div>
                <div class="mt-2 px-5">Mardi :
                    <?php 
                    if(!empty($disposMar)){              
                        foreach($disposMar as $dispoMar){?> 
                            <div class="float-right">de <?= strftime("%H:%M", strtotime($dispoMar->h_dbt )); ?> à  <?= strftime("%H:%M", strtotime($dispoMar->h_fin)); ?></div><br>
                        <?php }
                    } else { echo 'Fermé <br>';} ?>
                </div>
                <div class="mt-2 px-5"> Mercredi :
                    <?php 
                    if(!empty($disposMer)){              
                        foreach($disposMer as $dispoMer){?> 
                             <div class="float-right">de <?= strftime("%H:%M", strtotime($dispoMer->h_dbt)) ; ?> à  <?= strftime("%H:%M", strtotime($dispoMer->h_fin)) ; ?></div><br>
                        <?php }
                    } else { echo 'Fermé <br>'; } ?>
                </div>
                <div class="mt-2 px-5"> Jeudi :  
                    <?php 
                    if(!empty($disposJeu)){              
                        foreach($disposJeu as $dispoJeu){?> 
                            <div class="float-right">de <?= strftime("%H:%M", strtotime($dispoJeu->h_dbt)) ; ?> à  <?= strftime("%H:%M", strtotime($dispoJeu->h_fin)) ; ?></div><br>
                        <?php }
                    } else { echo 'Fermé <br>';} ?>
                </div>    
                <div class="mt-2 px-5"> Vendredi : 
                    <?php
                    if(!empty($disposVen)){              
                        foreach($disposVen as $dispoVen){?> 
                            <div class="float-right">de <?= strftime("%H:%M", strtotime($dispoVen->h_dbt)) ; ?> à  <?= strftime("%H:%M", strtotime($dispoVen->h_fin)) ; ?></div><br>
                        <?php }
                    } else { echo 'Fermé <br>';} ?>
                </div>
                <div class="mt-2 px-5">Samedi : 
                    <?php 
                    if(!empty($disposSam)){              
                        foreach($disposSam as $dispoSam){?> 
                            <div class="float-right">de <?= strftime("%H:%M", strtotime($dispoSam->h_dbt)) ; ?> à  <?= strftime("%H:%M", strtotime($dispoSam->h_fin)) ; ?></div><br>
                        <?php }
                    } else { echo 'Fermé <br>';} ?>
                </div>              
           
           <?php } else {echo '<div class="mt-2"><a href="enrHouv.'. $pnm->id_pnm.'">Horaires non renseignés</a></div>' ; }?>
        </div>
    </div>
    <div class="row mx-3 py-4">
        <div class="col-12 col-md-12 px-2" style=" border-radius:40px; border: solid 3px #3358ff; ">  
            <?php 
            $rowscount = count($usersTech);
            if($rowscount > '1'){
                echo'<h3 class="text-center text-light bg-primary p-2" style="margin-top:-10px; border-radius:40px; border: solid 3px #3358ff; box-shadow: 12px 7px 2px 1px rgba(0, 0, 255, .2);"><b>Animateurs Mobilité :</b></h3> <br>';
            } else if($rowscount == '1'){
               echo'<h3 class="text-center text-light bg-primary p-2" style="border-radius:40px; border: solid 3px #3358ff; box-shadow: 12px 7px 2px 1px rgba(0, 0, 255, .2);"><b>Animateur Mobilité :</b></h3> <br>';
            } else if ($rowscount == '0'){
                echo'<h3 class="text-center text-light bg-primary p-2" style="border-radius:40px; border: solid 3px #3358ff; box-shadow: 12px 7px 2px 1px rgba(0, 0, 255, .2);"><b>Animateur Mobilité :</b></h3> <br>';
                echo'<div class="text-secondary"><a href="enrCons">Non renseigné</a></div><br>';
            }
            echo '<div class="row mx-1 mt-2 px-3">';
            foreach($usersTech as $userTech){
                 if (ucfirst($userTech->statut) != "Comptable") {
                 echo '<div class="col-12 col-md-4">';
                 ?>
                <a href="enrConsMod.<?= $userTech->id ?>">
                <?= '<i class="far fa-edit text-secondary small mt-2 mr-2 float-left"></i>' ?>
                </a>
                <?php
                //echo '<i class="far fa-edit text-secondary small"></i>&nbsp;'; 
                echo '<b>'.$userTech->civilite_tech . ' ' . $userTech->nom . ' ' . $userTech->prenom . '</b><br>';
                echo 'Tel : <a href="tel:0'.$userTech->tel.'">'. $userTech->tel . '</a><br>';
                echo 'Mail : <a href="mailto:'.$userTech->email.'">'. $userTech->email . '</a><br>';
                    if(($userTech->statut)=='conseiller'){
                        echo 'Statut : Animateur <br><br>';
                    } else if (($userTech->statut)=='admin'){
                        echo 'Statut : Administrateur <br><br>';
                    } else {
                        echo 'Statut : ' . ucfirst($userTech->statut). '<br><br>';
                    }
                echo '</div>';
                }
            }
            echo '</div>';
            ?> 

        </div>
        <div class="row mt-5" style=" border-radius:40px; border: solid 3px #3358ff; ">
            <div class="col-12 col-md-12 text-center text-light bg-primary p-2 mb-5" style="border-radius:40px; border: solid 3px #3358ff; box-shadow: 12px 7px 2px 1px rgba(0, 0, 255, .2);"">
                <h3><b>Territoire du PNM</b></h3>
            </div>
            <div class="col-12 col-md-6 mt-5">
                <div style="max-height:500px">
                 <script src="<?= RACINE ?>js/cartePnm.js" type="text/javascript"></script>

                    <?php 
                        require ROOT . '/app/Views/admin/carteFichePnm.php'; 
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
                        $carte->onLoad($data);
                    ?>
                </div>
            </div>
            <div class="col-12 col-md-6 mt-4">
                <?php if (empty($communes)){ ?>
                    <a href="enrTerr.<?= $pnm->id_pnm ?>"><button class="btn btn-success"> Selectionner un Territoire d'Action : </button></a>
                <?php } else {?>   
                
                    <!-- < ?php $communes = explode( ",",($pnm->communes )) ?> -->
                    <?php $rowscountCom = count($communes) ; ?>
                    <?= '<b><span style="font-size:22px;">'. $rowscountCom .'</span> communes sélectionnées</b><br>' ?>
                    <a href="enrTerr.<?= $pnm->id_pnm ?>">
                    <?= '<i class="far fa-edit text-secondary small mt-2 mr-2 float-left"></i>' ?>
                    </a>
                    <?= '<div class="row">' ?>
                            <?php foreach ($communes as $commune){ ?>
                                <?= '<div class="col-12 col-md-6">'. $commune->nom .'</div>' ?>
                            <?php } ?>
                    <?= '</div><br>'?>
                <?php } ?>
                            </div>
            </div>
        </div>

    </div>
