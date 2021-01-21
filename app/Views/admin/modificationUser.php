<div class="container-fluid form-bg">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-11 col-lg-7 text-center p-0 mt-3 mb-2">
            <span class="d-block mb-3">
                <a class="float-left ml-2" href="<?=ROUTE?>ficheUser<?= (isset($userId)) ? '.' . $userId : false; ?>"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour sur la fiche utilisateur</a><br>
            </span>
            <div class="card px-0 pb-0 mt-3 mb-3"><!-- class="card px-3 pt-4 pb-0 mt-3 mb-3" -->
                <div class="" style="background-color:#9ac526;">
                    <?php if (isset($_SESSION['transport-solidaire']['id'])){ echo '<h4>'.ucfirst($membre->civilite) .' '. ucfirst($membre->nom) .' '. ucfirst($membre->prenom). '<br> </h4>';} ?>
                    <h3 class="text-center text-light">Modifier les informations de profil</h3>
                </div>
                <form method="post" action="<?=ROUTE?>modif.<?=$userId;?>" id="form-ins" enctype="multipart/form-data"><!-- enctype="multipart/form-data" -->
                    <fieldset>
                        <div class="form-card">
                            <!-- <div class="row">
                                <span class="step-info col-12 text-justify mb-4">
                                    Les champs de ce formulaire sont pré-remplis avec vos informations actuelles.
                                    Remplacez seulement les informations que vous voulez modifier, en laissant les autres champs que vous ne voulez pas modifier tels quels.
                                    Vous pouvez à tout moment retourner vers la page de votre profil en cliquant sur le lien ci-dessus.
                                </span>
                            </div> -->
                            
                            <!-- ******** -->
                            <!-- IDENTITÉ -->
                            <!-- ******** -->
                            <span class="fs-legend mb-4">Identité</span>

                            <!-- CIVILITÉ -->
                            <div class="row">
                                <span class="col-sm-2 col-md-3 col-lg-2">Civilité</span>
                                <div class="form-row col-sm-10 col-md-9 col-lg-10 mb-4">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="ins_civilite_1" name="mod_civilite"
                                                value="Mme" class="custom-control-input" <?= (isset($membre->civilite) && $membre->civilite == "Mme") ? "checked" : false; ?>>
                                            <label class="radio-label custom-control-label"
                                                for="ins_civilite_1">Madame</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="ins_civilite_2" name="mod_civilite"
                                                value="M." class="custom-control-input" <?= (isset($membre->civilite) && $membre->civilite == "M.") ? "checked" : false; ?>>
                                            <label class="radio-label custom-control-label"
                                                for="ins_civilite_2">Monsieur</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row justify-content-center">
                                <!-- NOM -->
                                <div class="col-md-6 mb-4">
                                    <label for="mod_nom">NOM</label>
                                    <input type="text" name="mod_nom" id="mod_nom" class="form-control"
                                        value="<?= (isset($membre->nom)) ? $membre->nom : false; ?>">
                                </div>

                                <!-- PRÉNOM -->
                                <div class="col-md-6 mb-4">
                                    <label for="mod_prenom">Prénom</label>
                                    <input type="text" name="mod_prenom" id="mod_prenom" class="form-control"
                                        value="<?= (isset($membre->prenom)) ? $membre->prenom : false; ?>">
                                </div>
                            </div>

                            <div class="form-row justify-content-center">
                                <!-- DATE DE NAISSANCE -->
                                <div class="col-md-4 mb-4">
                                    <label for="mod_date_nais">Date de naissance</label>
                                    <input type="date" name="mod_date_nais" id="mod_date_nais" class="form-control"
                                        value="<?= (isset($membre->date_naissance)) ? $membre->date_naissance : false; ?>">
                                    <small class="form-text">* Vous pouvez cliquer sur le
                                        calendrier</small>
                                </div>

                                <!-- LIEU DE NAISSANCE -->
                                <div class="col-md-4 mb-4">
                                    <label for="mod_lieu_nais">Lieu de naissance</label>
                                    <input type="text" name="mod_lieu_nais" id="mod_lieu_nais" class="form-control"
                                        value="<?= (isset($membre->lieu_naissance)) ? $membre->lieu_naissance : false; ?>">
                                    <small class="form-text">* Ville seulement</small>
                                </div>

                                <!-- DÉPARTEMENT DE NAISSANCE -->
                                <div class="col-md-4 mb-4">
                                    <label for="mod_dep_nais">Département de naissance</label>
                                    <input pattern="[0-9]{2}" maxlength="2" type="text" name="mod_dep_nais" id="mod_dep_nais" class="form-control"
                                        value="<?= (isset($membre->dep_naissance)) ? $membre->dep_naissance : false; ?>">
                                    <small class="form-text">* Les 2 chiffres (99 si étranger)</small>
                                </div>
                            </div>

                            <!-- ******* -->
                            <!-- ADRESSE -->
                            <!-- ******* -->
                            <span class="fs-legend mb-4">Adresse</span>

                            <!-- ADRESSE -->
                            <div class="form-row">
                                <div class="col-md-12 mb-4">
                                    <label for="mod_adresse">Adresse</label>
                                    <input type="text" name="mod_adresse" id="mod_adresse" class="form-control"
                                        value="<?= (isset($membre->adresse)) ? $membre->adresse : false; ?>">
                                    <small class="form-text">* N°, rue, lieu-dit... (ex. 3 avenue Henri Dunant)</small>
                                </div>
                            </div>

                            <!-- COMPLÉMENT D'ADRESSE -->
                            <div class="form-row">
                                <div class="col-md-12 mb-4">
                                    <label for="mod_complement">Complément d'adresse</label>
                                    <input type="text" name="mod_complement" id="mod_complement" class="form-control"
                                        value="<?= (isset($membre->complement)) ? $membre->complement : false; ?>">
                                    <small class="form-text">* Bâtiment, étage... (ex. Bâtiment C1)</small>
                                </div>
                            </div>

                            <div class="form-row">
                                <!-- CODE POSTAL -->
                                <div class="col-md-4 mb-4">
                                    <label for="mod_cp">Code postal</label>
                                    <input pattern="[0-9]{5}" maxlength="5" type="text" name="mod_cp"
                                        id="mod_cp" class="form-control" disabled
                                        value="<?= (isset($membre->code_postal)) ? $membre->code_postal : false; ?>">
                                </div>

                                <!-- COMMUNE -->
                                <div class="col-md-8 mb-5">
                                    <label for="mod_commune">Commune : </label>
                                    <select style="width:100%" id="mod_commune" name="mod_commune" class="p-2"
                                            class="form-control" required
                                            onchange="onSelectCommune(this)">
                                        <?php
                                            $loadCommune = App::getInstance()->getTable('Commune');
                                            $communes = $loadCommune->selectCommunes();
                                            echo '<option value="0,0" disabled>Sélectionnez une commune...</option>';
                                            foreach($communes as $commune) {
                                                if ($commune->id < 10000) {
                                                    echo '<option value="' . $commune->id . ',' . $commune->code_postal . '"';
                                                    if ($commune->id == $membre->commune) {
                                                        echo " selected ";
                                                    }
                                                    echo '>' . $commune->nom . "</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>

                                <script>
                                    function onSelectCommune(ctrl) {
                                        let values = ctrl.value.split(','); 
                                        document.getElementById("mod_cp").value = values[1];
                                        console.log("onSelectCommune", values);
                                    }
                                </script>
                            </div>

                            <!-- ****************** -->
                            <!-- NUMÉROS DE CONTACT -->
                            <!-- ****************** -->
                            <span class="fs-legend mb-4">Numéros de contact</span>

                            <div class="form-row">
                                <!-- TÉLÉPHONE / penser à ctype_digit() -->
                                <div class="col-md-6 mb-2 mb-md-4">
                                    <label for="mod_tel_dom">
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
                                            name="mod_tel_dom" id="mod_tel_dom"
                                            class="has-icon form-control"
                                            value="<?= (isset($membre->tel)) ? $membre->tel : false; ?>"
                                            <?= (empty($membre->tel)) ? ' placeholder="Aucun numéro indiqué"' : false; ?>>
                                    </div>
                                    <small class="form-text">* Tout attaché (ex. : 0545852565)</small>
                                </div>

                                <!-- PORTABLE -->
                                <div class="col-md-6 mb-4">
                                    <label for="mod_tel_mob">
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
                                            name="mod_tel_mob" id="mod_tel_mob"
                                            class="has-icon form-control"
                                            value="<?= (isset($membre->mobile)) ? $membre->mobile : false; ?>"
                                            <?= (empty($membre->mobile)) ? ' placeholder="Aucun numéro indiqué"' : false; ?>>
                                    </div>
                                    <small class="form-text">* Tout attaché (ex. : 0605040302)</small>
                                </div>
                            </div>

                            <?php // if (isset($membre->membre_type) && $membre->membre_type == 'passager') { ?>
                                <!-- ****************** -->
                                <!-- CAISSE DE RETRAITE -->
                                <!-- ****************** -->
                                <!-- <span class="fs-legend mb-4">Autre information</span>

                                <div class="form-row">
                                    <div class="col-md-12 mb-4">
                                        <label for="mod_caisse">Caisse de retraite</label>
                                        <input type="text" name="mod_caisse" id="mod_caisse" class="form-control"
                                            value="<?php // (isset($membre->caisse_retraite)) ? $membre->caisse_retraite : false; ?>"> -->
                                        <!-- <small class="form-text"></small> -->
                                    <!-- </div>
                                </div> -->
                            <?php // } ?>
                                            
                            <!-- BOUTON D'ENVOI DU FORMULAIRE -->
                            <input type="submit" name="mod_submit" id="mod_submit" class="action-button my-4"
                                value="Confirmer les modifications">

                            <!-- <div class="offset-md-1 col-md-10 align-items-center">
                                <input class="btn btn-block btn-primary my-5" type="submit" id="mod_submit" name="docs_user_submit" value="Envoyer">
                            </div> -->
                        </div>
                    </fieldset>
                </form>
            </div>    
        </div>
    </div>           
</div>
