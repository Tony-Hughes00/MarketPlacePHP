<style>
.notification .badge {
  position: absolute;
  top: -15px;
  right: 0px;
  padding: 5px 5px;
  border-radius: 50%;
  background: #dc3545;
  /* color: white; */
}

.badge-green { background: #28a745 !important; }
.badge-blue { background: #17a2b8 !important; }

#excl:hover {
    animation-name: example;
    position: relative;
    animation-duration: 1s;
    animation-iteration-count: infinite;
}

</style>

<?php
require_once ROOT ."/app/Views/admin/parcours/utils/TrajetDates.php";
function getNomCommune($id) {
  $loadCommune = App::getInstance()->getTable('Commune');
  $communes = $loadCommune->selectCommunes(); 
  foreach($communes as $commune) {
    if($commune->id == $id) {
      return $commune->nom;
    }
  }
}
$timeZone = new DateTimeZone('Europe/Paris');
$now = new DateTime(null, $timeZone);
  
$date = $now->sub(new DateInterval('P1Y'));   // subtract 1 year
// $date = $now->add(new DateInterval('P14D'));    // add 14 days
$date->setTime(0,0);
if (isset($cotis)) {
    $dateValid = new DateTime($cotis->date_cotis_valid, $timeZone);
}
?>
<div class="container px-5 py-3" style="border: 3px solid green; border-radius:25px;">
    <div class="row ">
        <div class="col-md order-2 order-md-1">
            <u><a id="modif-benef"><h3><b>Dossier de <?= $membre->civilite . ' ' . ucfirst($membre->nom) . ' ' . ucfirst($membre->prenom); ?>
            <?php
                if ($membre->actif == 0) {
                    echo '<i class="text-danger">Inactif</i>';
                }
                ?>
            </b></h3></a></u>          
            <p>
                <!-- <i class="far fa-edit text-secondary small"></i> -->
                <!-- <?//= $membre->civilite . ' ' . $membre->nom . ' ' . $membre->prenom; ?><br> -->
               <?php if ($membre->civilite =='Mme'){echo 'Née'; } else {echo 'Né';}?>
               <?= 'le ' . strftime("%d/%m/%Y", strtotime($membre->date_naissance)) . ' à ' . $membre->lieu_naissance . ' (' . $membre->dep_naissance . ')<br>'; ?>
                <?php if ($membre->membre_type == 'passager') { 
                    if (isset($retraite->caisse)) {
                        echo 'Caisse de retraite : <a type="button" class="text-primary" data-toggle="modal" data-target="#retraiteUser"><strong>' . $retraite->caisse;
                        echo (isset($retraite->gir) && $retraite->gir != 0) ? ' (GIR : ' . $retraite->gir . ')' : false;
                        echo '</strong></a>';
                    } else {
                        echo 'Caisse de retraite : <a type="button" class="text-primary" data-toggle="modal" data-target="#retraiteUser"><i>Non renseigné</i></a>';
                    }
                } ?>
                <!-- TODO reformater date en fr -->
            </p>  

                <p>
                    <!-- <i class="far fa-edit text-secondary small"></i> -->
               <b> Adresse : <?= $membre->adresse; ?></b><br>
                <?= ($membre->complement != NULL) ? 'Complément : ' . $membre->complement . '<br>' : false; ?>
                <b>Commune : <span class="text-primary"> <?= getNomCommune($membre->commune) . ' (' . $membre->code_postal . ')'; ?></span></b></p>

                <p>
                    <!-- <i class="far fa-edit text-secondary small"></i> -->
                <!-- TODO reformater num avec espace tous les 2 chars -->
                <?php if($membre->mobile != NULL){ ?>
                   <b> Mobile :  <a href="tel:+33<?= $membre->mobile; ?>"> <?= $membre->mobile; ?></a></b><br>
                <?php } else {
                     echo 'Mobile : <i class="text-secondary"> Non renseigné</i><br>';
                     } ?>
                <!-- TODO reformater num avec espace tous les 2 chars -->
                <?php if($membre->tel != NULL){ ?>
                    <b>Fixe : <a href="tel:+33<?= $membre->tel; ?>"><?= $membre->tel; ?></a></b><br>
                <?php } else {
                    echo 'Fixe : <i class="text-secondary"> Non renseigné</i><br>';
                    } ?>
               <b> Mail : <a href ="mailto:<?= $membre->email; ?>"><?= $membre->email; ?></a></b><br></p>
        </div>
        <div class="col-md order-1 order-md-1 text-center mt-md-5">
            <?php if ($membre->membre_type == 'chauffeur'){ // remplace isset($_GET['consultCond']) ?>
                <img src="<?= RACINE ?>images/icons8-chauffeur-80.png">
                <u><h4>CHAUFFEUR BÉNÉVOLE</h4></u>
            <?php } else if ($membre->membre_type == 'passager'){ // isset($_GET['consultPass']) ?>
                <img src="<?= RACINE ?>images/icons8-passager-80.png">
                <u><h4>PASSAGER</h4></u>
            <?php } ?>

            <p>Inscrit depuis le <?= strftime("%d/%m/%Y", strtotime($membre->created_at)); ?><br><!-- TODO à revoir -->
                <!-- <u>Statut :</u> -->
                <?php
                // var_dump($membre);
                // echo '<i class="fa fa-exclamation-triangle"></i> Évaluation à effectuer';
                // echo ' / ';
                // if ($permis->valide == 1 && $permis_valide->valide == 1 && $carte_grise->valide == 1 && $attestation_assurance->valide == 1 && $controle_technique->valide == 1 && $rib->valide == 1) {
                //     echo '<i class="fas fa-check-circle"></i> Documents à jour';
                // } else {
                //     echo '<i class="fa fa-exclamation-triangle"></i> Documents à valider';
                // }
                // echo ' / ';
                // if (isset($cotis->date_cotis_valid)) {
                //     echo '<i class="fas fa-check-circle"></i> Adhésion valide';
                // } else {
                //     echo '<i class="fa fa-exclamation-triangle"></i> Adhésion à renouveler';
                // }
                ?>
            </p>

            <a href="<?= ROUTE ?>modif.<?=$membre->id?>" type="button" class="btn btn-outline-secondary mb-5">
                Modifier les informations
            </a>
          
        </div>
    </div>
    <!-- <div class="row">
        <div class="col">   <i class="far fa-edit text-secondary small"></i>    
        </div>
        <div class="col"><i class="far fa-edit text-secondary small"></i>            
            <a href="#" role="button" class="btn btn-sm btn-secondary">Réinitialiser Mot de passe </btn> </a><br>
         </div>
    </div>  -->
    <div class="row notification">
        <?php if($membre->membre_type == 'chauffeur'){ ?> 
        <div class="col-md ">           
            <button class="btn btn-block btn-info dropdown-toggle" data-toggle="collapse" data-target="#eval">  
            <span class="badge"><i id="excl" class="fa fa-exclamation-triangle text-light" aria-hidden="true"></i>  </span> 
            <h5><b>ÉVALUATION<!-- CONDUITE --></b></h5>
            </button>
            <div id="eval" class="collapse border border-primary">
                 <!-- <a type="button" class="btn btn-block btn-success btn-sm my-auto" href="eval?idUser">Compléter</a>  -->
                 
        
                <div class="p-2">
                    <b class="mt-3"> Pas de Test Auto-Ecole enregistré </b> <br>        
                   
                   <!-- <a href="#"><i class="text-secondary">Non renseigné</i></a><br>

                   
                    <b class="mt-3"> Date RDV Eval : </b><br>
                    <a href="#"><i class="text-secondary">Non renseigné</i></a><br>


                    <b class="mt-3"> Aptitudes validées : </b><br>
                    <a href="#"><i class="text-secondary">Non renseigné</i></a>-->
                </div> 
            </div>
        </div>
        <?php } ?>
        <?php if($membre->membre_type == 'chauffeur'){ ?> 
        <div class="col-md">
            <button class="btn btn-block btn-info dropdown-toggle" data-toggle="collapse" data-target="#doc">

                <?php if ($permis->valide == 1 && $permis_valide->valide == 1 && $carte_grise->valide == 1 && $attestation_assurance->valide == 1 && $controle_technique->valide == 1 && $rib->valide == 1) { ?>
                    <span class="badge badge-green"><i class="fas fa-check text-light" aria-hidden="true"></i></span>
                <?php } else { ?>
                    <span class="badge"><i id="excl" class="fa fa-exclamation-triangle text-light" aria-hidden="true"></i></span>
                <?php } ?>
                
                <h5><b>DOCUMENTS</b></h5> 
            </button>
            <div id="doc" class="collapse border border-info">
                
                <?php if (($permis->valide == 0 && $permis->doc_name == NULL) && ($permis_valide->valide == 0 && $permis_valide->doc_name == NULL) && ($carte_grise->valide == 0 && $carte_grise->doc_name == NULL) && ($attestation_assurance->valide == 0 && $attestation_assurance->doc_name == NULL) && ($controle_technique->valide == 0 && $controle_technique->doc_name == NULL) && ($rib->valide == 0 && $rib->doc_name == NULL)) { ?>
                <a type="button" class="btn btn-block btn-success btn-sm" href="doc.<?=$id?>">Enregistrer des documents</a>
                <div class="p-2">
                    <small class="text-danger">
                        <i class="fa fa-exclamation-triangle"></i>
                        <i>Aucun document enregistré</i>
                    </small>
                </div>
                <?php } else { ?>
                    <a type="button" class="btn btn-block btn-success btn-sm" href="doc.<?=$id?>">Gérer les documents</a>
                    <!-- <span class="p-2"> -->
                        <?php if ($permis->doc_name != NULL || $permis->doc_name != '' || $permis_valide->doc_name != NULL || $permis_valide->doc_name != '' || $carte_grise->doc_name != NULL || $carte_grise->doc_name != '' || $attestation_assurance->doc_name != NULL || $attestation_assurance->doc_name != '' || $controle_technique->doc_name != NULL || $controle_technique->doc_name != '' || $rib->doc_name != NULL || $rib->doc_name != '') {
                            $date_aujourdhui = date('Y/m/d');

                            $expir_permis_valide = strftime("%Y/%m/%d", strtotime($permis_valide->expiration));
                            $expir_attestation_assurance = strftime("%Y/%m/%d", strtotime($attestation_assurance->expiration));
                            $expir_controle_technique = strftime("%Y/%m/%d", strtotime($controle_technique->expiration));

                            // Documents à jour
                            if ($permis->valide == 0 && $permis_valide->valide == 0 && $carte_grise->valide == 0 && $attestation_assurance->valide == 0 && $controle_technique->valide == 0 && $rib->valide == 0) {
                                false;
                            } else {
                                echo '<div class="p-2">';
                                echo '<span style="color:#28a745;"><b>Documents validés :</b></span><br>';
                                echo ($permis->valide == 1) ? '<span style="color:#28a745;"><i class="fas fa-check-circle"></i></span>&nbsp; Permis de conduire<br>' : false;
                                echo ($permis_valide->valide == 1 && $expir_permis_valide > $date_aujourdhui) ? '<span style="color:#28a745;"><i class="fas fa-check-circle"></i></span>&nbsp; Validité du permis<br>' : false;
                                echo ($carte_grise->valide == 1) ? '<span style="color:#28a745;"><i class="fas fa-check-circle"></i></span>&nbsp; Carte grise<br>' : false;
                                echo ($attestation_assurance->valide == 1 && $expir_attestation_assurance > $date_aujourdhui) ? '<span style="color:#28a745;"><i class="fas fa-check-circle"></i></span>&nbsp; Assurance<br>' : false;
                                echo ($controle_technique->valide == 1 && $expir_controle_technique > $date_aujourdhui) ? '<span style="color:#28a745;"><i class="fas fa-check-circle"></i></span>&nbsp; Contrôle technique<br>' : false;
                                echo ($rib->valide == 1) ? '<span style="color:#28a745;"><i class="fas fa-check-circle"></i></span>&nbsp; RIB<br>' : false;
                                echo '</div>';
                            } ?>
                            
                            <!-- Documents en cours de validation -->
                            <?php if (($permis->valide == 0 && $permis->doc_name != NULL) || ($permis_valide->valide == 0 && $permis_valide->doc_name != NULL && ($permis_valide->expiration == NULL || $expir_permis_valide > $date_aujourdhui)) || ($carte_grise->valide == 0 && $carte_grise->doc_name != NULL) || ($attestation_assurance->valide == 0 && $attestation_assurance->doc_name != NULL && ($attestation_assurance->expiration == NULL || $expir_attestation_assurance > $date_aujourdhui)) || ($controle_technique->valide == 0 && $controle_technique->doc_name != NULL && ($controle_technique->expiration == NULL || $expir_controle_technique > $date_aujourdhui)) || ($rib->valide == 0 && $rib->doc_name != NULL)) {
                                echo '<div class="p-2">';
                                // echo '<small><p class="text-danger mt-2 mb-0"><i class="fa fa-exclamation-triangle text-danger"></i> <i><b>Il reste des documents à valider</b></i></p></small>';
                                echo '<span style="color:#17a2b8;"><b>Documents à valider :</b></span><br>';
                                echo ($permis->valide == 0 && $permis->doc_name != NULL) ? '<span style="color:#17a2b8;"><i class="fas fa-history"></i></span>&nbsp; Permis de conduire<br>' : false;
                                echo ($permis_valide->valide == 0 && $permis_valide->doc_name != NULL && ($permis_valide->expiration == NULL || $expir_permis_valide > $date_aujourdhui)) ? '<span style="color:#17a2b8;"><i class="fas fa-history"></i></span>&nbsp; Validité du permis<br>' : false;
                                echo ($carte_grise->valide == 0 && $carte_grise->doc_name != NULL) ? '<span style="color:#17a2b8;"><i class="fas fa-history"></i></span>&nbsp; Carte grise<br>' : false;
                                echo ($attestation_assurance->valide == 0 && $attestation_assurance->doc_name != NULL && ($attestation_assurance->expiration == NULL || $expir_attestation_assurance > $date_aujourdhui)) ? '<span style="color:#17a2b8;"><i class="fas fa-history"></i></span>&nbsp; Assurance<br>' : false;
                                echo ($controle_technique->valide == 0 && $controle_technique->doc_name != NULL && ($controle_technique->expiration == NULL || $expir_controle_technique > $date_aujourdhui)) ? '<span style="color:#17a2b8;"><i class="fas fa-history"></i></span>&nbsp; Contrôle technique<br>' : false;
                                echo ($rib->valide == 0 && $rib->doc_name != NULL) ? '<span style="color:#17a2b8;"><i class="fas fa-history"></i></span>&nbsp; RIB' : false;
                                echo '</div>';
                            }

                            // Documents expirés
                            if (isset($permis_valide->expiration) && $expir_permis_valide <= $date_aujourdhui || isset($attestation_assurance->expiration) && $expir_attestation_assurance <= $date_aujourdhui || isset($controle_technique->expiration) && $expir_controle_technique <= $date_aujourdhui) {
                                echo '<div class="p-2">';
                                echo '<small><p class="text-danger mt-2 mb-0"><i class="fa fa-exclamation-triangle text-danger"></i> <i><b>Il reste des documents à renouveler</b></i></p></small>';
                                echo '<span style="color:#f68c02;"><b>Documents à renouveler :</b></span><br>';
                                echo (isset($permis_valide->expiration) && $expir_permis_valide <= $date_aujourdhui) ? '<span style="color:#f68c02;"><i class="fas fa-times-circle"></i></span>&nbsp; Validité du permis<br>' : false;
                                echo (isset($attestation_assurance->expiration) && $expir_attestation_assurance <= $date_aujourdhui) ? '<span style="color:#f68c02;"><i class="fas fa-times-circle"></i></span>&nbsp; Assurance<br>' : false;
                                echo (isset($controle_technique->expiration) && $expir_controle_technique <= $date_aujourdhui) ? '<span style="color:#f68c02;"><i class="fas fa-times-circle"></i></span>&nbsp; Contrôle technique<br>' : false;
                                echo '</div>';
                            }
                            
                            // Documents à fournir
                            if ($permis->valide == 1 && $permis_valide->valide == 1 && $carte_grise->valide == 1 && $attestation_assurance->valide == 1 && $controle_technique->valide == 1 && $rib->valide == 1) {
                                echo '<div class="p-2">';
                                echo '<span style="color:#28a745;"><b>Tous les documents sont à jour.</b></span><br>';
                                echo '</div>';
                            } else if (($permis->valide == 0 && $permis->doc_name == NULL) || ($permis_valide->valide == 0 && $permis_valide->doc_name == NULL) || ($carte_grise->valide == 0 && $carte_grise->doc_name == NULL) || ($attestation_assurance->valide == 0 && $attestation_assurance->doc_name == NULL) || ($controle_technique->valide == 0 && $controle_technique->doc_name == NULL) || ($rib->valide == 0 && $rib->doc_name == NULL)) {
                                echo '<div class="p-2">';
                                echo '<span style="color:#dc3545;"><b>Documents manquants :</b></span><br>';
                                echo ($permis->valide == 0 && $permis->doc_name == NULL) ? '<span style="color:#dc3545;"><i class="fas fa-times-circle"></i></span>&nbsp; Permis de conduire<br>' : false;
                                echo ($permis_valide->valide == 0 && $permis_valide->doc_name == NULL) ? '<span style="color:#dc3545;"><i class="fas fa-times-circle"></i></span>&nbsp; Validité du permis<br>' : false;
                                echo ($carte_grise->valide == 0 && $carte_grise->doc_name == NULL) ? '<span style="color:#dc3545;"><i class="fas fa-times-circle"></i></span>&nbsp; Carte grise<br>' : false;
                                echo ($attestation_assurance->valide == 0 && $attestation_assurance->doc_name == NULL) ? '<span style="color:#dc3545;"><i class="fas fa-times-circle"></i></span>&nbsp; Assurance<br>' : false;
                                echo ($controle_technique->valide == 0 && $controle_technique->doc_name == NULL) ? '<span style="color:#dc3545;"><i class="fas fa-times-circle"></i></span>&nbsp; Contrôle technique<br>' : false;
                                echo ($rib->valide == 0 && $rib->doc_name == NULL) ? '<span style="color:#dc3545;"><i class="fas fa-times-circle"></i></span>&nbsp; RIB<br>' : false;
                                echo '</div>';
                                // echo '<small><p class="text-danger"><i class="fa fa-exclamation-triangle text-danger"></i> <i>Manquant(s)</i></p></small>';
                            } ?>
                        <?php } ?>
                    <!-- </span> -->
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        <?php if ($membre->membre_type == 'passager'){ ?> 
        <div class="col col-md-6 offset-md-3 offset-0">
        <?php }  ?>
        <?php if ($membre->membre_type == 'chauffeur'){ ?> 
            <div class="col-md"> 
        <?php } ?>        
            <button class="btn btn-block btn-info dropdown-toggle" data-toggle="collapse" data-target="#cotis">
            
            <?php if (empty($cotis->date_cotis_valid)) { ?> 
                <span class="badge"><i id="excl" class="fa fa-exclamation-triangle text-light" aria-hidden="true"></i></span>
            <?php } else if (isset($cotis->date_cotis_valid)) { 
                                  if ($dateValid < $date) {
                                    ?>
                                  <span class="badge"><i id="excl" class="fa fa-exclamation-triangle text-light" aria-hidden="true"></i></span>
                                  <?php
                                } else {
                ?>
                <span class="badge badge-green"><i class="fas fa-check text-light" aria-hidden="true"></i></span>
            <?php } 
            }
            ?>

            <h5><b>COTISATION</b></h5>

            </button>
            <div id="cotis" class="collapse border border-info">

                <?php if (!isset($cotis)) { ?>
                    <a type="button" class="btn btn-success btn-block btn-sm" href="cotis.<?=$membre->id?>">Enregistrer un paiement</a>

                    <div class="p-2">
                        <small class="text-danger">
                            <i class="fa fa-exclamation-triangle"></i>
                            <i>Aucun paiement enregistré</i>
                        </small>
                    </div>
                    
                    <!-- <div class="pt-2 pl-2">
                        <i class="text-secondary">Aucun paiement enregistré</i>
                    </div> -->
                <?php } else {
                    if (!isset($cotis->date_cotis_valid)) { ?>
                        <a type="button" class="btn btn-success btn-block btn-sm" href="cotis.<?=$membre->id?>">Valider le paiement</a>
                        
                        <div class="p-2">
                            <b>Paiement prévu</b> le <?= strftime("%d/%m/%Y", strtotime($cotis->date_cotis));?> en
                            <?php
                            if (isset($cotis->cotis_type)) {
                                if ($cotis->cotis_type == 'virement') {
                                    echo 'virement';
                                } else if ($cotis->cotis_type == 'espece') {
                                    echo 'espèce';
                                } else if ($cotis->cotis_type == 'cheque') {
                                    echo 'chèque';
                                }
                            }
                            ?>

                            <small class="text-danger">
                                <i class="fa fa-exclamation-triangle"></i>
                                <i>En attente de validation</i>
                            </small>

                            <!-- <b>Validation du paiement :</b> <i class="text-secondary">Non réceptionné</i> -->
                        </div>
                    <?php } else { ?>
                        <a type="button" class="btn btn-success btn-block btn-sm" href="cotis.<?=$membre->id?>">Modifier le paiement</a>

                        <div class="p-2">
                        <?php //if (count($trajets['dispoUser']) == 0) { ?>

                            <b>Encaissement du paiement</b> <br>

                            le <?= strftime("%d/%m/%Y", strtotime($cotis->date_cotis_valid)); ?> 
                            <br>
                            par <?= $techCotis->prenom . ' ' . strtoupper($techCotis->nom); ?>
                            <br>

                            <?php
                            $futureDate = date('d/m/Y', strtotime('+1 year', strtotime($cotis->date_cotis_valid)));
                            $actualDate = date('d/m/Y');
                            $alerteDate = date('d/m/Y', strtotime('+11 month', strtotime($cotis->date_cotis_valid)));
                            // echo '<br>';
                            // echo 'future ' . $futureDate . '<br>';
                            // echo 'actual ' . $actualDate . '<br>';
                            // echo 'alerte ' . $alerteDate . '<br>';
                            if ($dateValid < $date) {
                                // var_dump($dateValid);
                                // var_dump($date);
                                ?>
                            <small class="text-danger">
                                <br>
                                <i class="fa fa-exclamation-triangle"></i>
                                <i>La cotisation était due le</i><?=$futureDate?>
                            </small> 
                            <?php
                            } else {
                            // if ($futureDate > $actualDate) {
                                echo '<br><b>La cotisation sera à renouveler le</b><br>' . $dateValid->format("d/m/Y");
                                } ?>
                                <?php if ($alerteDate <= $actualDate) { ?>
                                    <!-- <small class="text-info">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        <i>J-30 exp</i>
                                    </small> -->
                                <?php }
                            // } else if ($futureDate <= $actualDate) { ?>
                                <!-- <small class="text-danger">
                                    <i class="fa fa-exclamation-triangle"></i>
                                    <i>Cotisation expirée depuis le <= //$futureDate; ?></i>
                                </small> -->
                            <?php //} ?>
                        </div>
                    <?php  } 
                } ?>
            </div>

        </div>
    </div>
    <div class="row text-center p-2 mt-5 bg-success">
          
        <h4 class="text-light"><i class="fas fa-car" aria-hidden="true"></i> &nbsp; &nbsp;  <b>TRAJETS : </b></h4>

    </div>
    <div class="row text-center p-2">
        <div class="col-lg px-1 border border-success py-3" style="border-radius:25px;">
        <?php if($membre->membre_type == 'chauffeur'){ ?>
            <b><u>Offres proposées </u></b><br>
        <?php } else { ?>
            <b><u>Trajets demandés </u></b><br>
        <?php } ?>
            <!-- <a type="button" class="btn btn-block btn-outline-success btn-sm" href="enr?idUser"><b>Enregistrer un Nouveau Trajet</b></a> -->
            <!-- <a type="button" class="btn btn-block btn-outline-success btn-sm" href="enr?inscrTraj&user=<?= $membre->id?>"><b>Enregistrer un Nouveau Trajet</b></a> -->
            <!-- <ul class="p-0"> -->
             
 
                <?php 
                
                    foreach($trajets['nouveaux'] as $trajet) {
                        // var_dump($trajet);
                        echo "- ";
                        // if($membre->membre_type == 'passager') {
                            if($membre->membre_type == 'chauffeur'){ 
                                echo '<a href="'.ROUTE.'detailParcours.'.$trajet->parcoursId. '" class="">' . $trajet->depart . ' -> ' . $trajet->arrivee . "<br/>"; 
                        } else {
                            echo '<a href="'.ROUTE.'misRelation.'.$trajet->parcoursId. '" class="">' . $trajet->depart . ' -> ' . $trajet->arrivee . "<br/>"; 
                        }
                        if($trajet->date_debut == null) {
                            $joursLong = ["dimanches", "lundis", "mardis", "mercredis", "jeudis", "vendredis", "samedis"];
                            $joursCourt = ["dim", "lun", "mar", "mer", "jeu", "ven", "sam"];
                            echo 'Tous les ';
                            foreach($trajets['dispos'][$trajet->id] as $dispo) {
                                echo "<strong>" . $joursLong[$dispo->jour_dispo] . " </strong>";
                            }
                        } else {
                            $datesObj = new App\Controller\TrajetDates($trajet->date_debut, $trajet->date_fin, "Aller", false, "", "");
                            echo $datesObj->getDateStringProfil();
                            echo '<br/>';
                        
                            // echo getDateString($trajet->date_debut, $trajet->date_fin);
                            // $dateDebut = new DateTime($trajet->date_debut);
                            // echo 'le ' . $dateDebut->format("d/m/Y") . "<br/>"; 
                        }
                        if ($trajet->status == 1) {
                            echo 'Status : <strong>Attribué</strong>';
                        }
                        if ($trajet->status == 2) {
                            echo 'Status : <strong>Confirmé</strong>';
                        }
                        // echo '&nbsp;<i class="fa fa-eye-slash"></i>';
                        echo "</a><br>";
                    }
                ?>            

        <?php if($membre->membre_type == 'chauffeur'){ ?>
            <br/>
            <b><u>Disponibilité</u></b><br>
            <?php
        if (count($trajets['dispoUser']) == 0) {
    ?>

        <!-- <a type="button" class="btn btn-block btn-outline-success btn-sm" href="enrDispo.<?= $membre->id?>"><b>Enregistrer une disponibilité</b></a> -->
        <?php
        } else {
        ?>
        <!-- <ul class="p-0"> -->
        <?php
            $joursLong = ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
            foreach($trajets['dispoUser'] as $dispo) {
                echo 'le <strong>' . $joursLong[$dispo->jour_dispo] . '</strong>';
                echo ' entre <strong>' . $dispo->h_dbt . '</strong> et <strong>' . $dispo->h_fin . '</strong><br/>';
            }
        ?>
        <!-- </ul> -->
        <!-- <br><a type="button" class="btn btn-block btn-success btn-sm" href="enr?inscrTraj&user=<?= $membre->id?>"><b>Enregistrer un Nouveau Trajet</b></a>

        <a type="button" class="btn btn-block btn-success btn-sm" href="enrDispo.<?= $membre->id?>"><b> Enregistrer une disponibilité</b></a> -->
        <?php
        }
        }
        ?>
        <br><a type="button" class="btn btn-block btn-success btn-sm" href="enr?inscrTraj&user=<?= $membre->id?>"><b>Enregistrer un Nouveau Trajet</b></a>
        <?php if($membre->membre_type == 'chauffeur'){ ?>
        <a type="button" class="btn btn-block btn-success btn-sm" href="enrDispo.<?= $membre->id?>"><b> Enregistrer une disponibilité</b></a>
<?php } ?>

        </div>
       
        <div class="col-lg border border-success py-3" style="border-radius:25px;">
            <!-- <b><u> Mises en relation à finaliser :</u></b><br> -->
            <!-- <ul class="p-0">     -->
            <?php 
            if (count($trajets['attribues']) !== 0) {
                echo '<b><u> Mises en relation à finaliser :</u></b><br>';
                foreach($trajets['attribues'] as $trajet) {
                    // var_dump($trajet);
                    echo "- ";
                    // if($membre->membre_type == 'passager') {
                        echo '<a href="'.ROUTE.'misRelation.'.$trajet->parcoursId. '" class="">' . $trajet->depart . ' -> ' . $trajet->arrivee . "<br/>"; 
                    // } else {
                        // echo '<a href="*" class="text-secondary">' . $trajet->depart . ' -> ' . $trajet->arrivee . "<br/>"; 
                    // }
                    // $datesObj2 = new App\Controller\TrajetDates($trajet->date_debut, $trajet->date_fin, "Aller", false, "", "parcoursStrong");
                    // echo $datesObj->getDateString();
                    $datesObj = new App\Controller\TrajetDates($trajet->date_debut, $trajet->date_fin, "Aller", false, "", "");
                    echo $datesObj->getDateStringProfil();
                    echo '<br/>';
                    // $dateDebut = new DateTime($trajet->date_debut);
                    // echo 'le ' . $dateDebut->format("d/m/Y") . "<br/>"; 
                    // if ($trajet->status == 1) {
                    //     echo 'Status : <strong>Attribué</strong>';
                    // }
                    // if ($trajet->status == 2) {
                    //     echo 'Status : <strong>confirmé</strong>';
                    // }
                    echo '&nbsp;<i class="fa fa-eye-slash"></i>';
                    echo "</a><br>";
                }
            // } else { echo '<i class="text-secondary">Pas de Trajet concerné</i><br><br>';}
        } else { echo '';}

            ?>                 
            <b><u>Les Trajets programmés</u></b><br>
            <i style="font-size:11px;">(= Mise en relation effectuée)</i>
            <!-- <ul class="p-0"> -->
             
                <?php 
                // var_dump($trajets);
                if (count($trajets['programmes']) !== 0) {

                    foreach($trajets['programmes'] as $trajet) {
                        echo "<br>- ";
                        // if($membre->membre_type == 'passager') {
                            echo '<a href="'.ROUTE.'parcoursVal.'.($trajet)->parcoursId. '" class="">' . $trajet->depart . ' -> ' . $trajet->arrivee . "<br/>"; 
                        // } else {
                            // echo '<a href="*" class="text-secondary">' . $trajet->depart . ' -> ' . $trajet->arrivee . "<br/>"; 
                        // }
                        $datesObj = new App\Controller\TrajetDates($trajet->date_debut, $trajet->date_fin, "Aller", false, "", "");
                        echo $datesObj->getDateStringProfil();
                        echo '<br/>';
                        // $dateDebut = new DateTime($trajet->date_debut);
                        // echo 'le ' . $dateDebut->format("d/m/Y") . ' à ' . substr($trajet->date_val, 11, 5). "<br/>";
                        echo " avec <b>" . $trajet->civilite . " " . $trajet->nom ."</b>"; 
                        // echo '&nbsp;<i class="fa fa-eye"></i>';
                        echo "</a><br>";
                    } } else { echo '<br><i class="text-secondary mt-4">Pas de trajet programmé</i><br>'; }
                ?>     
            <!-- </ul> -->
          
        </div>
        <div class="col-lg border border-success py-3" style="border-radius:25px;">
            <!-- <b><u>Trajets Effectués:</u></b> <br>
            <small class="text-secondary">Pour enregistrer un trajet effectué, vous devez réceptionner le bon de transport</small><br><br>-->
            <!-- <a type="button" class="btn btn-block btn-success btn-sm" href="enrbon?id_user=<?//=$membre->id?>""><b>Enregistrer un Bon de Transport</b></a><br><br> -->
            <b><u>  Les Bons de Transports attendus </u></b><br>
                <?php  if(count($trajets['programmes']) !== 0) {
                    foreach($trajets['programmes'] as $trajet) {
                        echo "- ";
                        echo '<a href="bon.'. $membre->users_id .'" class="text-primary">';
                        $dateDebut = new DateTime($trajet->date_debut);
                        echo 'Trajet du ' . $dateDebut->format("d/m/Y") . " : "; 
                        echo $trajet->depart . ' -> ' . $trajet->arrivee . "<br/>"; 
                        // echo '&nbsp;<i class="fa fa-eye"></i>';
                        echo "</a><br>";
                        echo '<a type="button" class="btn btn-block btn-success btn-sm mt-3" href="bon.' . $membre->users_id . '"><b>Enregistrer un bon de transport</b></a><br>'; 

                    }}else{ echo '<i class="text-secondary mt-4">Pas de trajet programmés en cours</i><br>';}
                ?> 

            <!-- <b><u>  Les Bons de Transports payés </u></b><br> 
            <small class="text-secondary"><i>Pas d'indemnité perçue</i></small><br>    -->
            <b><u>  Les Bons de Transports à Valider </u></b><br>
                <?php  if($trajets['bonAValider'] != null && count($trajets['bonAValider']) !== 0) {
                    foreach($trajets['bonAValider'] as $trajet) {
                        echo "- ";
                        echo '<a href="/validateBons.'. $membre->users_id .'" class="text-primary">';
                        $dateDebut = new DateTime($trajet->date_debut);
                        echo 'Trajet du ' . $dateDebut->format("d/m/Y") . " : "; 
                        echo $trajet->depart . ' -> ' . $trajet->arrivee . "<br/>"; 
                        // echo '&nbsp;<i class="fa fa-eye"></i>';
                        echo "</a><br>";
                        echo '<a type="button" class="btn btn-block btn-success btn-sm mt-3" href="bon.' . $membre->users_id . '"><b>Valider un bon de transport</b></a><br>'; 

                    }}else{ echo '<i class="text-secondary mt-4">Pas de bons de transport à valider</i><br>';}
                ?> 
        </div>
    </div> 
        </div>


    <div id="retraiteUser" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header bg-success">
                <h3 class="modal-title">Dossier de <?= $membre->civilite . ' ' . $membre->nom . ' ' . $membre->prenom; ?></h3><br>
                <button type="button" class="close float-right text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <h4>Compléter la caisse de retraite</h4>

                <form action="<?=ROUTE?>ficheUser.<?=$membre->id?>" method="post"> 
                    <input hidden name='id_user' value="<?=$membre->id?>">
                 
                    <b>L'utilisateur a plus de 60 ans : </b><br><br>
                    <label for="gir_niv_select">Niveau GIR : </label>
                    <!-- <input type="text" id="gir" name="gir_niv" class="my-3"><br> -->
                    <select name="gir_niv" id="gir_niv_select">
                        <option value="">Sélectionner le niveau d'autonomie</option>
                        <option value="1" <?= (isset($retraite->gir) && $retraite->gir == '1') ? 'selected' : false; ?>>1</option>
                        <option value="2" <?= (isset($retraite->gir) && $retraite->gir == '2') ? 'selected' : false; ?>>2</option>
                        <option value="3" <?= (isset($retraite->gir) && $retraite->gir == '3') ? 'selected' : false; ?>>3</option>
                        <option value="4" <?= (isset($retraite->gir) && $retraite->gir == '4') ? 'selected' : false; ?>>4</option>
                        <option value="5" <?= (isset($retraite->gir) && $retraite->gir == '5') ? 'selected' : false; ?>>5</option>
                    </select>

                    <label for="caisse_retraite">Nom de la caisse de retraite : </label>
                    <input type="text" id="caisse_retraite" name="caisse_retraite" class="my-3" <?= (isset($retraite->caisse)) ? 'value="' . $retraite->caisse . '"' : false; ?>><br>

                    <input type="submit" name="enrCaisRet" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
           




        
</div>