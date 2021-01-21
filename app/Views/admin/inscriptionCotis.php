<?php function date_full(){
    $mois = array(1=>'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    $jours = array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
    echo $jours[date('w')].' '.date('j').' '.$mois[date('n')].' '.date('Y'); }
?>

<div class="container-fluid form-bg">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-11 col-lg-7 text-center p-0 mt-3">
            <span class="d-block" style="font-size:18px!important;">
                <a class="float-left ml-2" href="<?=ROUTE?>ficheUser.<?=$userId;?>"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour sur la fiche utilisateur</a><br>
            </span>
            <div class="card px-0 pt-0 pb-0 mt-3">
                <div class="bg-success py-2">
                    <h2 class="text-center text-light">Enregistrer un Paiement d'Adhésion</h2>
                    <?php if (isset($user) && isset($membre)) { echo '<h4>'.ucfirst($membre->civilite) .' '. ucfirst($membre->prenom) .' '. ucfirst($membre->nom). '<br> </h4>';} ?>
                    <?php if (isset($membre)) {
                        if ($membre->membre_type == 'chauffeur') {
                            echo '<h4>CHAUFFEUR BÉNÉVOLE</h4>';
                        } else if ($membre->membre_type == 'passager') {
                            echo '<h4>PASSAGER</h4>';
                        }
                    } ?>
                </div>
            
                <h4 class="my-4">COTISATION 2020 : 10 €/AN </h4> 
                <p class="text-secondary mx-2">Nous sommes le <?= date_full();?></p>
                <p class="text-secondary mx-2">Si vous effectuez le paiement aujourd'hui,  <br>
                son adhésion sera valable 1 an, jusqu'au <?=date('d')?>/<?=date('m')?>/<?=(date('Y') +1)?> </p>
              
                <div class="row">
                    <div class="col-md-12">
                 
                        <form method="post" action="<?=ROUTE?>cotis<?= (isset($userId)) ? '.' . $userId : false; ?>" id="form-cotis">
                            
                            <?php if (!isset($user->id)) { ?>
                                <!-- SELECT SELON TYPE USER -->
                                <div class="form-group row px-5">                    
                                    <label for="exampleFormControlSelect1" class="col-sm-5 col-form-label">Sélectionner un utilisateur :
                                        <?php // if (isset($_GET['CondAdh'])){ echo 'Chauffeur Bénévole';} else if (isset($_GET['PassAdh'])){ echo 'Passager';}?>
                                    </label>
                                    <div class="col-sm-6">
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Jean Paul Pierre Marielle</option>
                                            <option>Paul Emile Louis</option>
                                            <option>Myriam Delafrange</option>
                                            <option>Marthe Vermeille</option>
                                            <option>Richard Delion</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- <small class="text-danger"> SEULEMENT USER PAS A JOUR OU A RENOUVELER ==> y a til des inscriptions sans passer par fiche User ?</small> -->
                            <?php } ?>
                        
                            <div class="form-group row px-5">
                                <?php if (isset($user->id)) { ?>
                                    <input hidden type="text" id="id_user" name="id_user" value="<?= $user->id; ?>">
                                <?php } ?>

                                <label class="col-md-4" for="cotis_type">Type de paiement prévu :</label>              
                                
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="cotis_type_1" name="cotis_type"
                                        value="virement" class="custom-control-input"
                                        data-toggle="collapse" data-target="#collapseOne" data-parent="#accordion"
                                        <?= (isset($cotis->cotis_type) && $cotis->cotis_type == 'virement') ? 'checked' : false; ?>
                                        required>
                                    <label class="radio-label custom-control-label" for="cotis_type_1">Virement</label> 
                                </div>

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="cotis_type_2" name="cotis_type"
                                        value="espece" class="custom-control-input"
                                        data-toggle="collapse" data-target="#collapseTwo" data-parent="#accordion"
                                        <?= (isset($cotis->cotis_type) && $cotis->cotis_type == 'espece') ? 'checked' : false; ?>
                                        required>
                                    <label class="radio-label custom-control-label" for="cotis_type_2">Espèce</label> 
                                </div>

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="cotis_type_3" name="cotis_type"
                                        value="cheque" class="custom-control-input"
                                        data-toggle="collapse" data-target="#collapseThree" data-parent="#accordion"
                                        <?= (isset($cotis->cotis_type) && $cotis->cotis_type == 'cheque') ? 'checked' : false; ?>
                                        required >
                                    <label class="radio-label custom-control-label" for="cotis_type_3">Chèque</label>
                                </div>
                            </div>

                            <div class="form-group row px-5">
                                <label for="date_cotis" class="col-md-4 my-auto">Date de paiement prévue :</label>
                                <div class="col-md-4 pl-0">
                                    <input type="date" name="date_cotis" class="form-control" id="date_cotis"
                                        <?= (isset($cotis->date_cotis)) ? 'value="' . strftime('%Y-%m-%d', strtotime($cotis->date_cotis)) . '"' : false; ?>
                                        required>
                                </div>
                            </div>

                            <div class="form-group row px-5">
                                <label for="date_cotis_valid" class="col-md-4 my-auto">Date de réception du paiement :</label>
                                <div class="col-md-4 pl-0">
                                    <input type="date" name="date_cotis_valid" class="form-control" id="date_cotis_valid"
                                        <?= (isset($cotis->date_cotis_valid)) ? 'value="' . strftime('%Y-%m-%d', strtotime($cotis->date_cotis_valid)) . '"' : false; ?>>
                                </div>
                            </div>

                            <div class="form-group row px-5">
                                <label for="id_tech" class="col-md-4 col-form-label">Enregistré par :</label>
                                <div class="col-md-4 my-auto">
                                    <?= ucfirst($_SESSION['transport-solidaire']['prenom']) . ' ' . strtoupper($_SESSION['transport-solidaire']['nom']); ?>
                                    <input hidden type="text" name="id_tech" class="form-control" id="id_tech" value="<?= $_SESSION['transport-solidaire']['id']?>">
                                </div>
                            </div>                                            
                          
                            <b><input type="submit" id="cotis_submit" name="cotis_submit" class="btn btn-lg btn-block btn-success mb-0" value="Enregistrer"></b>
                        </form>

                        <!-- <small class="text-danger">Prevoir identifiant pr virement ? </small><br>
                        <small class="text-danger">Générer reçu ? <br> </small>
                        <small class="text-danger">Rediriger vers ficheUser ? </small> -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>