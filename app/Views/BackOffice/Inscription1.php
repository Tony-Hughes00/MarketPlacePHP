<div class="container-fluid form-bg">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-11 col-lg-7 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <div class="row">
                    <div class="col">
                        <h2 class="text-center">Formulaire d'inscription</h2>
                        <hr class="title-underline">
                    </div>
                </div>
                <p>Remplissez tous les champs d'une étape pour passer à la suivante.</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form method="post" action="<?=ROUTE?>inscription" id="form-backoffice">
                            <ul id="progressbar" class="nav d-none d-md-flex">
                                <li class="nav-item">
                                    <a id="form-step-1" class="form-step nav-link p-0 active" href="#step-1">
                                        Compte
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a id="form-step-2" class="form-step nav-link p-0" href="#step-2">
                                        Identité
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a id="form-step-3" class="form-step nav-link p-0" href="#step-3">
                                        Contact
                                    </a>
                                </li>
                            </ul>



                            <div class="tab-content">
                                <!-- STEP 1 -->
                                <div id="step-1" class="step tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <fieldset>
                                        <div class="form-card p-3 p-md-5">
                                            <legend class="fs-legend mb-4">Informations de connexion</legend>

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
                                                            class="has-icon form-control" required>
                                                    </div>
                                                    <small class="form-text">* Cette adresse e-mail vous servira
                                                        d'identifiant</small>
                                                </div>
                                            </div>

                                            <!-- CONFIRMATION E-MAIL -->
                                            <div class="form-row">
                                                <div class="col-md-12 mb-4">
                                                    <label for="ins_email_confirm">Confirmez votre adresse
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
                                                            required>
                                                    </div>
                                                    <small class="form-text">* Doit être identique à l'adresse e-mail
                                                        entrée dans le champ ci-dessus</small>
                                                </div>
                                            </div>

                                            <!-- MOT DE PASSE -->
                                            <div class="form-row">
                                                <div class="col-md-12 mb-4">
                                                    <label for="ins_mdp">Mot de passe</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text justify-content-center form-tel-icon">
                                                            <i class="fa fa-eye toggle-eye" onclick="myFunction1()"></i>       
                                                            </span>
                                                        </div>
                                                        <input minlength="8" maxlength="20" type="password" name="ins_mdp"
                                                            id="ins_mdp" class="form-control" required>    
                                                    </div>
                                                    <small class="form-text">* Entre 8 et 20 caractères</small>
                                                </div>
                                            </div>

                                            <!-- CONFIRMATION MOT DE PASSE -->
                                            <div class="form-row">
                                                <div class="col-md-12 mb-4">
                                                    <label for="ins_mdp_confirm">Confirmez votre mot de passe</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"> 
                                                            <span class="input-group-text justify-content-center form-tel-icon">
                                                            <i class="fa fa-eye toggle-eye2" onclick="myFunction2()"></i>       
                                                            </span>
                                                        </div>
                                                        <input minlength="8" maxlength="20" type="password"
                                                            name="ins_mdp_confirm" id="ins_mdp_confirm" class="form-control"
                                                            required>
                                                    </div>
                                                    <small class="form-text">* Doit être identique au mot de passe entré
                                                        dans le champ ci-dessus</small>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>



                                <!-- STEP 2 -->
                                <div id="step-2" class="step tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <fieldset>
                                        <div class="form-card p-3 p-md-5">
                                            <legend class="fs-legend mb-4">Informations personnelles</legend>

                                            <!-- CIVILITÉ -->
                                            <div class="row">
                                                <span class="col-sm-2 col-md-3 col-lg-2">Civilité</span>
                                                <div class="form-row col-sm-10 col-md-9 col-lg-10 mb-4">
                                                    <div class="col-md-12">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="ins_civilite_1" name="ins_civilite"
                                                                value="Mme" class="custom-control-input" required>
                                                            <label class="radio-label custom-control-label"
                                                                for="ins_civilite_1">Madame</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="ins_civilite_2" name="ins_civilite"
                                                                value="M." class="custom-control-input" required>
                                                            <label class="radio-label custom-control-label"
                                                                for="ins_civilite_2">Monsieur</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row justify-content-center">
                                                <!-- NOM -->
                                                <div class="col-md-6 mb-4">
                                                    <label for="ins_nom">NOM</label>
                                                    <input type="text" name="ins_nom" id="ins_nom" class="form-control"
                                                        required>
                                                </div>

                                                <!-- PRÉNOM -->
                                                <div class="col-md-6 mb-4">
                                                    <label for="ins_prenom">Prénom</label>
                                                    <input type="text" name="ins_prenom" id="ins_prenom"
                                                        class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="form-row justify-content-center">
                                                <!-- DATE DE NAISSANCE -->
                                                <div class="col-md-4 mb-4">
                                                    <label for="ins_date_nais">Date de naissance</label>
                                                    <input type="date" name="ins_date_nais" id="ins_date_nais"
                                                        class="form-control" >
                                                    <small class="form-text">* Vous pouvez cliquer sur le
                                                        calendrier</small>
                                                </div>

                                                <!-- LIEU DE NAISSANCE -->
                                                <div class="col-md-4 mb-4">
                                                    <label for="ins_lieu_nais">Lieu de naissance</label>
                                                    <input type="text" name="ins_lieu_nais" id="ins_lieu_nais"
                                                        class="form-control" >
                                                    <small class="form-text">* Ville seulement</small>
                                                </div>

                                                <!-- DÉPARTEMENT DE NAISSANCE -->
                                                <div class="col-md-4 mb-4">
                                                    <label for="ins_dep_nais">Département de naissance</label>
                                                    <input pattern="[0-9]{2}" maxlength="2" type="text" name="ins_dep_nais" id="ins_dep_nais"
                                                        class="form-control" >
                                                    <small class="form-text">* Les 2 chiffres (99 si étranger)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>



                                <!-- STEP 3 -->
                                <div id="step-3" class="step tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <fieldset>
                                        <div class="form-card p-3 p-md-5">
                                            <legend class="fs-legend mb-4">Informations de contact</legend>

                                            <!-- NUMÉROS -->
                                            <div class="row">
                                                <span class="col-12 text-justify mb-1">Numéros de téléphone :</span>
                                            </div>

                                            <div class="form-row">
                                                <!-- TÉLÉPHONE / penser à ctype_digit() -->
                                                <div class="col-md-6 mb-2 mb-md-4">
                                                    <label for="ins_tel_dom">
                                                        Fixe
                                                    </label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text justify-content-center form-tel-icon">
                                                                <i class="fas fa-phone-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input pattern="[0-9]{10}" maxlength="10" type="tel"
                                                            name="ins_tel_dom" id="ins_tel_dom"
                                                            class="has-icon form-control">
                                                    </div>
                                                    <small class="form-text">* Tout attaché (ex. :
                                                        0545852565)</small>
                                                </div>

                                                <!-- PORTABLE -->
                                                <div class="col-md-6 mb-4">
                                                    <label for="ins_tel_mob">
                                                        Mobile
                                                    </label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span
                                                                class="input-group-text justify-content-center form-tel-icon">
                                                                <i class="fas fa-mobile-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input pattern="[0-9]{10}" maxlength="10" type="tel"
                                                            name="ins_tel_mob" id="ins_tel_mob"
                                                            class="has-icon form-control">
                                                    </div>
                                                    <small class="form-text">* Tout attaché (ex. :
                                                        0605040302)</small>
                                                </div>
                                            </div>

                                            <!-- ADRESSE -->
                                            <div class="form-row">
                                                <div class="col-md-12 mb-4">
                                                    <label for="ins_adresse">Adresse</label>
                                                    <input type="text" name="ins_adresse" id="ins_adresse"
                                                        class="form-control" required>
                                                    <small class="form-text">* N°, rue, lieu-dit... (ex. 3 avenue Henri
                                                        Dunant)</small>
                                                </div>
                                            </div>

                                            <!-- COMPLÉMENT D'ADRESSE -->
                                            <div class="form-row">
                                                <div class="col-md-12 mb-4">
                                                    <label for="ins_complement">Complément d'adresse</label>
                                                    <input type="text" name="ins_complement" id="ins_complement"
                                                        class="form-control">
                                                    <small class="form-text">* Bâtiment, étage... (ex. Bâtiment C1)</small>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <!-- CODE POSTAL -->
                                                <div class="col-md-4 mb-4">
                                                    <label for="ins_cp">Code postal</label>
                                                    <input pattern="[0-9]{5}" maxlength="5" type="text" name="ins_cp"
                                                        id="ins_cp" class="form-control" disabled>
                                                </div>

                                                <!-- COMMUNE -->
                                                <div class="col-md-8 mb-5">
                                                    <label for="ins_commune">Commune : </label>
                                                    <select style="width:100%" id="ins_commune" name="ins_commune" class="p-2"
                                                            class="form-control" required
                                                            onchange="onSelectCommune(this)">
                                                        <?php
                                                            $loadCommune = App::getInstance()->getTable('Commune');
                                                            $communes = $loadCommune->selectCommunes();
                                                            echo '<option value="0,0" selected disabled>Sélectionnez une commune...</option>';
                                                            foreach($communes as $commune) {
                                                                if ($commune->id < 10000) {
                                                                    echo '<option value="' . $commune->id . ',' . $commune->code_postal . '"';
                                                                    echo '>' . $commune->nom . "</option>";
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>

                                                <script>
                                                    function onSelectCommune(ctrl) {
                                                        let values = ctrl.value.split(','); 
                                                        document.getElementById("ins_cp").value = values[1];
                                                        console.log("onSelectCommune", values);
                                                    }
                                                </script>
                                            </div>

                                            <!-- CONFIRMATION -->
                                            <div class="form-group">
                                                <div class="form-check col-md-12 mb-4">
                                                    <input id="ins_conditions" name="ins_conditions" class="form-check-input" type="checkbox" value="1" required>
                                                    <label for="ins_conditions" class="form-check-label">
                                                        <span class="col-12 text-justify mb-4">
                                                            En cochant la case ci-contre,
                                                            vous autorisez <a
                                                                href="https://www.cnil.fr/fr/limiter-la-conservation-des-donnees"
                                                                target="_blank">l'utilisation et la conservation de vos
                                                            données</a> par MOSC dans le cadre du service mobilité,
                                                            vous vous engagez à signaler toute modification de votre permis, de
                                                            votre assurance ou de l'état de votre véhicule
                                                            et vous déclarez avoir pris connaissance du règlement d'utilisation
                                                            du transport solidaire et en acceptez pleinement les <a
                                                                href="<?=RACINE?>pdf/doc_conditions_utilisation.pdf"
                                                                download="Conditions d'utilisation Transport Solidaire.pdf">conditions</a>.
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            
                                            <!-- BOUTON D'ENVOI DU FORMULAIRE -->
                                            <input type="submit" name="ins_submit" id="ins_submit" class="action-button"
                                                value="Confirmer l'inscription" disabled>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
function myFunction1() {
    let x = document.getElementById("ins_mdp");
    if (x.type === "password") {
        x.type = "text";
        $('.toggle-eye').attr('class', 'fa fa-eye-slash toggle-eye');
    } else {
        x.type = "password";
        $('.toggle-eye').attr('class', 'fa fa-eye toggle-eye');
    }
} 

function myFunction2() {
    let y = document.getElementById("ins_mdp_confirm");
    if (y.type === "password") {
        y.type = "text";
        $('.toggle-eye2').attr('class', 'fa fa-eye-slash toggle-eye2');
    } else {
        y.type = "password";
        $('.toggle-eye2').attr('class', 'fa fa-eye toggle-eye2');
    }
} 
</script>