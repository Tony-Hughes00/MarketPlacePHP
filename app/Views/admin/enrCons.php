<?php
    $conId = 0;
    if (isset($data['conId'])) {
        $conId = $data['conId'];
    }
    $tech = null;
    if (isset($data['tech'])) {
        $tech = $data['tech'];
    }
?>
<div class="container-fluid form-bg">
            <span class="d-block" style="font-size:18px!important;">
                <?php echo '<b><a class="ml-5 mb-5" href="' . $_SERVER['HTTP_REFERER'] . '"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour</a></b><br>'; ?>
            </span>
    <div class="row justify-content-center" style="margin-top:40px;">
        <div class="col-11 col-sm-9 col-md-11 col-lg-7 text-center p-0 mb-2">
           
            <div class="card px-0 pt-4 pb-0 mb-3">
            <h2 class="text-center bg-success p-2" style="margin-top: -50px; border-radius: 40px;">Formulaire d'inscription : Animateur </h2>
            <!-- <hr class="title-underline mx-auto"> -->
                <div class="row">
                    <div class="col-md-12 px-5 mx-0">
                        <form method="post" action="<?= ROUTE ?>enrCons" id="form-tech_ins">

                            <fieldset>
                            <input type="hidden" value="<?=$conId?>" id="conId" name="conId" >
                            <div class="bg-secondary" style="border-radius:40px;"><h4 class="mb-4 text-white p-3">Informations personnelles</h4></div>

                            <!-- CIVILITÉ -->
                            <div class="row justify-content-center">
                                <span class="col-sm-3 col-md-3 col-lg-2">Civilité : </span>
                                <div class="form-row col-sm-9 col-md-9 col-lg-5 mb-4">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="civilite_tech_1" name="civilite_tech"
                                                value="Mme" class="custom-control-input" required
                                                <?php
                                                if ($tech != null) {
                                                    if ($tech->civilite_tech == "Mme") {
                                                        echo " checked ";
                                                    }
                                                }
                                                ?>
                                                >
                                            <label class="radio-label custom-control-label"
                                                for="civilite_tech_1">Madame</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="civilite_tech_2" name="civilite_tech"
                                                value="M." class="custom-control-input" required
                                                <?php
                                                if ($tech != null) {
                                                    if ($tech->civilite_tech == "M.") {
                                                        echo " checked ";
                                                    }
                                                }
                                                ?>
                                                >
                                            <label class="radio-label custom-control-label"
                                                for="civilite_tech_2">Monsieur</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row justify-content-center">
                                <!-- NOM -->
                                <div class="col-md-6 mb-4">
                                    <label for="ins_nom">NOM</label>
                                    <input type="text" name="ins_nom" id="ins_nom" class="form-control"
                                        required
                                        <?php
                                        if ($tech != null) {
                                            echo ' value = "' . $tech->nom . '"';
                                        }
                                        ?>
                                        >
                                </div>

                                <!-- PRÉNOM -->
                                <div class="col-md-6 mb-4">
                                    <label for="ins_prenom">Prénom</label>
                                    <input type="text" name="ins_prenom" id="ins_prenom"
                                        class="form-control" required
                                        <?php
                                        if ($tech != null) {
                                            echo ' value = "' . $tech->prenom . '"';
                                        }
                                        ?>
                                        >
                                </div>
                            </div>
                            <!-- NUMÉROS -->
                            <!-- <div class="row">
                                <span class="col-12 mb-1">Numéros de téléphone :</span>
                            </div> -->

                            <div class="form-row justify-content-center">
                                <!-- PORTABLE  / penser à ctype_digit() -->
                                <div class="col-md-6 mb-4">
                                    <label for="tel">
                                        Téléphone Pro : 
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span
                                                class="input-group-text justify-content-center form-tel-icon">
                                                <i class="fas fa-mobile-alt"></i>
                                            </span>
                                        </div>
                                        <input pattern="[0-9]{10}" maxlength="10" type="tel"
                                            name="tel" id="tel"
                                            class="has-icon form-control"
                                        <?php
                                        if ($tech != null) {
                                            echo ' value = "' . $tech->tel . '"';
                                        }
                                        ?>
                                            >
                                    </div>
                                    <small class="form-text">* Tout attaché (ex. :
                                        0605040302)</small>
                                </div>
                            </div>
                            <!-- <div class="form-row justify-content-center">
                                <div class="col-md-6 mb-4">
                                    <label for="statut">
                                        Statut : 
                                    </label> -->

                                    <!-- <div class="input-group form-control"> -->
                                    <!-- <select name="statut" class="p-2">
                                        <option value="">--Selectionner un statut--</option>
                                        <option value="admin">Administrateur</option>
                                        <option value="conseiller">Animateur Mobilité</option>
                                    </select> -->
                                    <!-- </div> -->
                                <!-- </div>
                            </div> -->
                            <div class="form-row justify-content-center">
                                <div class="col-md-6 mb-4">
                                    <label for="pnm_id">
                                        PNM de référence : 
                                    </label>
                                    <!-- <div class="input-group"> -->
                                    <!-- <select name="pnm_id" class="p-2">
                                        <option value="">--Selectionner une structure--</option>
                                        <option value="1">Csc Envol</option>
                                        <option value="2">Parenthèse</option>
                                        <option value="3">Atleb</option>
                                        <option value="4">CSC Barezieux</option>
                                    </select> -->


                                    <select style="width:100%" id="pnm_id" name="pnm_id" class="p-2"
                                            class="form-control" required>
                                            <?php
                                               $loadPnm = App::getInstance()->getTable('Pnm');
                                                $Pnms = $loadPnm->selectPnms(); 
                                                foreach($Pnms as $Pnm) {
                                                    echo '<option value="' . $Pnm->id_pnm . '"';
                                                    if ($tech != null) {
                                                        if ($Pnm->id_pnm == $tech->pnm_id) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    echo '>' . $Pnm->titre_pnm . "</option>";           
                                                } 
                                             ?>
                                    </select> 
                                    <small><a href="<?=ROUTE?>enrPnm">+ Ajouter un Pnm</a></small>
                                    <!-- </div> -->
                                </div>
                            </div>




                            <div class="bg-secondary" style="border-radius:40px;"><h4 class="mb-4 text-white p-3">Informations de connexion</h4></div>

                                 <!-- E-MAIL -->
                                 <div class="form-row">
                                    <div class="col-md-12 mb-4">
                                        <label for="ins_email">Adresse e-mail</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text justify-content-center form-tel-icon">
                                                    <i class="fas fa-at"></i>
                                                </span>
                                            </div>
                                            <input type="email" name="ins_email" id="ins_email"
                                                class="has-icon form-control" required
                                                <?php
                                                if ($tech != null) {
                                                    echo ' value = "' . $tech->email . '"';
                                                }
                                                ?>
                                                >
                                        </div>
                                        <small class="form-text">* Cette adresse e-mail servira
                                            d'identifiant</small>
                                    </div>
                                </div>
                                <!-- CONFIRMATION E-MAIL -->
                                <div class="form-row">
                                    <div class="col-md-12 mb-4">
                                        <label for="ins_email_confirm">Confirmez l'adresse
                                            e-mail</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text justify-content-center form-tel-icon">
                                                    <i class="fas fa-at"></i>
                                                </span>
                                            </div>
                                            <input type="email" name="ins_email_confirm"
                                                id="ins_email_confirm" class="has-icon form-control"
                                                required
                                                <?php
                                                if ($tech != null) {
                                                    echo ' value = "' . $tech->email . '"';
                                                }
                                                ?>

                                                >
                                        </div>
                                        <small class="form-text">* Doit être identique à l'adresse e-mail
                                            entrée dans le champ ci-dessus</small>
                                    </div>
                                </div>
                                <!-- MOT DE PASSE -->
                                <?php
                                    if ($tech == null) {
                                ?>
                                <div class="form-row">
                                    <div class="col-md-12 mb-4">
                                        <label for="ins_mdp">Mot de passe</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text justify-content-center form-tel-icon">
                                                <i class="fa fa-eye toggle-eye" onclick="myFunction1()"></i>       
                                                </span>
                                            </div>
                                            <input id="myInput1" minlength="8" maxlength="20" type="password" name="ins_mdp"
                                                id="ins_mdp" class="form-control" required>    
                                        </div>
                                        <small class="form-text">* Entre 8 et 20 caractères</small>
                                    </div>
                                </div>

                                 <!-- CONFIRMATION MOT DE PASSE -->
                                 <div class="form-row">
                                    <div class="col-md-12 mb-4">
                                        <label for="ins_mdp_confirm">Confirmez le mot de passe</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"> 
                                                <span class="input-group-text justify-content-center form-tel-icon">
                                                <i class="fa fa-eye toggle-eye2" onclick="myFunction2()"></i>       
                                                </span>
                                            </div>
                                            <input id="myInput2" minlength="8" maxlength="20" type="password"
                                                name="ins_mdp_confirm" id="ins_mdp_confirm" class="form-control"
                                                required>
                                        </div>
                                        <small class="form-text">* Doit être identique au mot de passe entré
                                            dans le champ ci-dessus</small>
                                    </div>
                                </div>
                            <?php 
                                if ($tech == null) {
                                    }
                                }
                            ?>
                            <?php
                                if ($tech == null) {
                                    echo '<input type="submit" for="enreg-cons" class="btn btn-lg btn-success my-5" value="Enregistrer">';                        
                                } else {
                                    echo '<input type="submit" for="enreg-cons" class="btn btn-lg btn-success my-5" value="Modifier">';                        
                                }
                            ?>

                              <!-- </fieldset> -->
                              <!-- STEP 2 -->
                              <!-- <div id="step-2" class="step tab-pane" role="tabpanel" aria-labelledby="step-2"> -->
                                    <!-- <fieldset> -->
                                        <!-- <div class="form-card p-3 p-md-5"> -->
                                         

                                        <!-- </div> -->
                                    </fieldset>
                        </form> 
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function myFunction1() {
    let x = document.getElementById("myInput1");
    if (x.type === "password") {
        x.type = "text";
        $('.toggle-eye').attr('class', 'fa fa-eye-slash toggle-eye');
    } else {
        x.type = "password";
        $('.toggle-eye').attr('class', 'fa fa-eye toggle-eye');
    }
} 

function myFunction2() {
    let y = document.getElementById("myInput2");
    if (y.type === "password") {
        y.type = "text";
        $('.toggle-eye2').attr('class', 'fa fa-eye-slash toggle-eye2');
    } else {
        y.type = "password";
        $('.toggle-eye2').attr('class', 'fa fa-eye toggle-eye2');
    }
} 
</script>