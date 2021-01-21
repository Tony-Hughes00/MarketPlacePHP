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

<div class="container mx-5 px-5">
    <div class="row mx-5 px-5 mb-2">
        <div class="col-md">  
            <h4>ESPACE POLE NUMERIQUE DE MOBILITE</h4>
            <!-- Bonjour Conseiller Mobilité,  -->
        </div>
    </div>  
    <div class="row mx-3 px-5">
        <div class="col-md">        
            <p><b><u>Vos Informations Animateur Mobilité : </u></b><br>                
            <!-- <i class="far fa-edit text-secondary small"></i> -->
            Nom : <?= $technicien->nom ?> <br>
            Prénom : <?= $technicien->prenom ?> <br>
            <?php if($technicien->statut =='conseiller') { ?>
            Statut : Animateur Mobilité <br>
            <?php } ?>
            E-mail (=identifiant) : <a href ="mailto:<?= $technicien->email ?>"><?= $technicien->email ?></a><br>
            <!-- TODO modifier mdp -->
            <!-- Mot de passe : ......... <i class="far fa-eye"></i> <br> -->
            N° de Mobile : <a href ="tel:<?= $technicien->tel ?>"> &nbsp;<?= $technicien->tel ?></a><br></p><!-- TODO espace tous les 2 chars -->

            <b><u>Votre Antenne de Mobilité : </u></b><br>
            <!-- <i class="far fa-edit text-secondary small"></i> -->
            <b><?= $pnm->titre_pnm ?></b> -<?= $pnm->struct_pnm ?>-<br>
            N° Tel PNM: <a href ="tel:+33<?= $pnm->tel_pnm ?>">0<?= $pnm->tel_pnm ?></a><br>
            E-mail PNM: <a href ="mailto:<?= $pnm->mail_pnm ?>"><?= $pnm->mail_pnm ?></a><br>
            Site PNM : <a href ="<?= $pnm->site_pnm ?>" target="_blank"><?= $pnm->site_pnm ?></a><br>
            <br><b>Adresse PNM:</b><br> <?= $pnm->adr_pnm ?><br>
            <?= $pnm->cp_pnm ?> <?=getNomCommune($pnm->ville_pnm) ?><br>

           <?php //var_dump($disposLun); ?>

           
            <!-- <i class="far fa-edit text-secondary small"></i> -->
           <br>
           <a href="enrHouv.<?=$pnm->id_pnm?>">
                        <i class="far fa-edit text-secondary small"></i>
            </a><b><u>Les Horaires d'ouverture : </u></b> <br>
           <div class="row">
                <div class="col-4">
                <?php  if(!empty($dispos)){ ?>
                    <div class="mt-2"> Lundi :
                        <?php    
                        if(!empty($disposLun)){              
                            foreach($disposLun as $dispoLun){?> 
                                <div class="float-right">de <?= strftime("%H:%M", strtotime($dispoLun->h_dbt )); ?> à  <?= strftime("%H:%M", strtotime($dispoLun->h_fin)) ; ?></div><br>
                            <?php } 
                        } else { echo 'Fermé <br>'; }  ?>
                    </div>
                    <div class="mt-2">Mardi :
                        <?php 
                        if(!empty($disposMar)){              
                            foreach($disposMar as $dispoMar){?> 
                                <div class="float-right">de <?= strftime("%H:%M", strtotime($dispoMar->h_dbt )); ?> à  <?= strftime("%H:%M", strtotime($dispoMar->h_fin)); ?></div><br>
                            <?php }
                        } else { echo 'Fermé <br>';} ?>
                    </div>
                    <div class="mt-2"> Mercredi :
                        <?php 
                        if(!empty($disposMer)){              
                            foreach($disposMer as $dispoMer){?> 
                                <div class="float-right">de <?= strftime("%H:%M", strtotime($dispoMer->h_dbt)) ; ?> à  <?= strftime("%H:%M", strtotime($dispoMer->h_fin)) ; ?></div><br>
                            <?php }
                        } else { echo 'Fermé <br>'; } ?>
                    </div>
                    <div class="mt-2"> Jeudi :  
                        <?php 
                        if(!empty($disposJeu)){              
                            foreach($disposJeu as $dispoJeu){?> 
                                <div class="float-right">de <?= strftime("%H:%M", strtotime($dispoJeu->h_dbt)) ; ?> à  <?= strftime("%H:%M", strtotime($dispoJeu->h_fin)) ; ?></div><br>
                            <?php }
                        } else { echo 'Fermé <br>';} ?>
                    </div>    
                    <div class="mt-2"> Vendredi : 
                        <?php
                        if(!empty($disposVen)){              
                            foreach($disposVen as $dispoVen){?> 
                                <div class="float-right">de <?= strftime("%H:%M", strtotime($dispoVen->h_dbt)) ; ?> à  <?= strftime("%H:%M", strtotime($dispoVen->h_fin)) ; ?></div><br>
                            <?php }
                        } else { echo 'Fermé <br>';} ?>
                    </div>
                    <div class="mt-2">Samedi : 
                        <?php 
                        if(!empty($disposSam)){              
                            foreach($disposSam as $dispoSam){?> 
                                <div class="float-right">de <?= strftime("%H:%M", strtotime($dispoSam->h_dbt)) ; ?> à  <?= strftime("%H:%M", strtotime($dispoSam->h_fin)) ; ?></div><br>
                            <?php }
                        } else { echo 'Fermé <br>';} ?>
                    </div>             
                     <?php  } else {echo '<div class="mt-2"><a href="enrHouv.'. $pnm->id_pnm.'">Horaires non renseignés</a></div>' ; } ?>
                </div>
            </div>
            
          
                
                <!-- <p><b><u>Fermeture exceptionnelle : </u></b><br>
                - 12 Décembre 2020
                
                <p><b><u>Présence Animateur Mobilité :</u> <br>
                <li>Mr Jean-Marc Girard </b> : Mercredi 9h-12h30 <br></li>
                <li>Mr Dylan Darmostroup</li>
                </p>

                <p><u><b>Territoire du PNM : 13 Communes </b></u>
                <li>Montmoreaux </li>
                <li> ... </li> -->
            <!-- </p> -->

            <br><u><b>Territoire du PNM :</b></u>
            <?php if (empty($pnm->communes)){ ?>
                <!-- <a href="enrTerr.<?= $pnm->id_pnm ?>"><button class="btn btn-success"> Selectionner un Territoire d'Action : </button></a> -->
                <i class="text-secondary">Non renseigné</i>
            <?php }else {?>   
                <?php $communes = explode( ",",($pnm->communes )) ?>
                <?php $rowscountCom = count($communes) ; ?>
                <i class="text-secondary"><?= $rowscountCom .' communes sélectionnées' ?></i>
                <a href="enrTerr.<?= $pnm->id_pnm ?>">
                <?= '<i class="far fa-edit text-secondary small mt-2 mr-2 float-left"></i>' ?>
                </a>
                <!-- < ?='<i class="far fa-edit text-secondary small mt-2 mr-2 float-left"></i>'?> -->
                <?= '<div class="row">' ?>
                        <?php foreach ($communes as $commune){ ?>
                            <?= '<div class="col-2">'. getNomCommune($commune) .'</div>' ?>
                        <?php } ?>
                <?= '</div>'?>
            <?php } ?>

        </div>

        <div class="col-12 col-lg-4 justify-content-center pl-2 mt-5">
            <h5 class="text-center"> Les Antennes Mobilité MOSC :  </h5>    

            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">                    
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h5 class="mb-0 text-center">  PNM La Parenthèse</h5>
                        </button>                    
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                                                
                       <p> <b>La Parenthèse <br>
                        - ENSC - </b><br>
                        1, avenue de l'Aquitaine <br>
                        16190 Montmoreau-Saint-Cybard <br>
                        E-mail : <u class="text-primary"><a href ="mailto:parenthese@gmail.com">parenthese@gmail.com</a></u> <br>
                        Tel : <u class="text-primary"><a href ="tel:+335 32 54 12 45">05 32 54 12 45 </a></u></p>

                        <!-- <p><b><u> Direction : </u></b> <br>
                        Mr Braleret </p>

                       <p><b><u>Animateur Mobilité :</u></b>
                       <li>Penny Croustille <br>
                        Mail perso : <u class="text-primary"><a href ="penny.croustille@gmail.com">penny.croustille@gmail.com</a></u><br>
                        Tel perso : <u class="text-primary"><a href ="tel:06 32 54 12 45">06 32 54 12 45 </a></u></p>
                        </li>
                        <li>Dylan Darmostroupe<br>
                        mail perso : <u class="text-primary"><a href ="dylan.darmostroup@gmail.com">dylan.darmostroup@gmail.com</a></u>
                        Tel perso : <u class="text-primary"><a href ="tel:06 32 54 12 45">06 32 54 12 45 </a></u></p>
                        </li></p> -->

                        <!-- <p><b><u>Les Horaires d'ouverture : </u></b> <br>
                            Lundi : Fermé<br>
                            Mardi : Fermé<br>
                            Mercredi : 9h-12h30   14h-19h <br>
                            Jeudi :  9h-12h30   14h-19h <br>
                            Vendredi :  9h-12h30   14h-19h <br>
                            Samedi : Fermé <br>
                        </p>  -->
                         
                    </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">                    
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h5 class="mb-0 text-center">Centre Socioculturel Envol</h5>
                        </button>                    
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">    
                        <p><b> Centre Socioculturel Envol <br>
                        - Service Mobilité - </b><br>
                        7, rue Pascaud Choqueur <br>
                        16210 Chalais <br>
                        E-mail : <a href ="mailto:parenthese@gmail.com">parenthese@gmail.com</a> <br>
                        Tel : <a href ="tel:+335 32 54 12 45">05 32 54 12 45 </a><br><br></p>

                        <!-- <p><b><u> Direction : </u></b> <br>
                        Mr Braleret </p>

                       <p><b><u>Animateur Mobilité :</u></b> <br>
                       <li>Penny Croustille <br>
                       Mail perso : <u class="text-primary"><a href ="penny.croustille@gmail.com">penny.croustille@gmail.com</a></u><br>
                        Tel perso : <u class="text-primary"><a href ="tel:06 32 54 12 45">06 32 54 12 45 </a></u></p>
                        </li>
                        <li>Dylan Darmostroupe<br>
                        mail perso : <u class="text-primary"><a href ="dylan.darmostroup@gmail.com">dylan.darmostroup@gmail.com</a></u>
                        Tel perso : <u class="text-primary"><a href ="tel:06 32 54 12 45">06 32 54 12 45 </a></u></p>
                        </li></p>

                        <p><b><u>Les Horaires d'ouverture : </u></b> <br>
                            Lundi : Fermé<br>
                            Mardi : Fermé<br>
                            Mercredi : 9h-12h30   14h-19h <br>
                            Jeudi :  9h-12h30   14h-19h <br>
                            Vendredi :  9h-12h30   14h-19h <br>
                            Samedi : Fermé <br> -->
                        </p> 
                         
                    </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                  
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <h5 class="mb-0 text-center">Antenne de Mobilité </h5>
                        </button>
                  
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">                       
                    <p><b>Pôle Multimédia et Mobilité<br>
                        - ATLEB - </b><br>
                        6, route de Montmoreau <br>
                        16250 Blanzac-Porcheresse <br>
                        E-mail : <a href ="mailto:parenthese@gmail.com">parenthese@gmail.com</a> <br>
                        Tel : <a href ="tel:+335 32 54 12 45">05 32 54 12 45 </a><br><br></p>
                        <!-- 
                        <p><b><u> Direction : </u></b> <br>
                        Mr Braleret </p>

                       <p><b><u>Animateur Mobilité :</u></b> <br>
                       <li>Penny Croustille <br>
                       Mail perso : <u class="text-primary"><a href ="penny.croustille@gmail.com">penny.croustille@gmail.com</a></u><br>
                        Tel perso : <u class="text-primary"><a href ="tel:06 32 54 12 45">06 32 54 12 45 </a></u></p>
                        </li>
                        <li>Dylan Darmostroupe<br>
                        mail perso : <u class="text-primary"><a href ="dylan.darmostroup@gmail.com">dylan.darmostroup@gmail.com</a></u>
                        Tel perso : <u class="text-primary"><a href ="tel:06 32 54 12 45">06 32 54 12 45 </a></u></p>
                        </li></p>

                        <p><b><u>Les Horaires d'ouverture : </u></b> <br>
                            Lundi : Fermé<br>
                            Mardi : Fermé<br>
                            Mercredi : 9h-12h30   14h-19h <br>
                            Jeudi :  9h-12h30   14h-19h <br>
                            Vendredi :  9h-12h30   14h-19h <br>
                            Samedi : Fermé <br>
                        </p>  -->
                    </div>
                    </div>
                </div>
                </div>


        </div>   

    </div>
  
</div>
