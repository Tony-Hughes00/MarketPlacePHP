<div class="container-fluid form-bg">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-11 col-lg-9 text-center p-0 mt-3 mb-2">
            <span class="d-block mb-3">
                <a class="float-left ml-2" href="<?=ROUTE?>ficheUser.<?=$userId;?>"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour sur la fiche utilisateur</a><br>
            </span>
            <div class="card px-0 pb-0 mt-3 mb-3">
                <form method="post" action="<?=ROUTE?>doc<?= (isset($userId)) ? '.' . $userId : false; ?>" id="form-docs-user" enctype="multipart/form-data"><!-- enctype="multipart/form-data" -->
                    <fieldset>
                        <div class="form-card">
                            <div class="" style="background-color:#9ac526;">
                                <?php if (isset($userId)) { ?>
                                    <legend class="text-center fs-legend mb-4">
                                        Documents de <?= $membre->civilite . ' ' . $membre->nom . ' ' . $membre->prenom; ?>
                                        <br>
                                        <span class="text-light">Chauffeur Bénévole</span>
                                    </legend>
                                    <!-- <p class="text-danger">Ajouter Alerte sur doc à renouveler ou expirés si Doss déjà crée<br>
                                    ou : Formulaire interactif avec champs visibles si vide ou expiré ds base de données ??? </p> -->
                                <?php } else { ?>
                                    <legend class="text-center fs-legend mb-4">Documents à fournir :<br>Chauffeur Bénévole</legend>
                                <?php } ?>
                            </div>

                            <?php if (!isset($userId)) { ?>
                                <div class="form-group row px-5">                    
                                    <label for="exampleFormControlSelect1" class="col-sm-5 col-form-label">Selectionner un <?= (isset($membre->membre_type) && $membre->membre_type == 'chauffeur') ? 'chauffeur' : false; ?>
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
                                <!-- <small class="text-danger"> SEULEMENT USER PAS A JOUR OU A RENOUVELER ==> y a til des Docs sans passer par fiche User ?</small> -->
                            <?php } ?>

                            <?php
                            $date_aujourdhui = date('Y/m/d');

                            $expir_permis_valide = strftime("%Y/%m/%d", strtotime($permis_valide->expiration));
                            $expir_attestation_assurance = strftime("%Y/%m/%d", strtotime($attestation_assurance->expiration));
                            $expir_controle_technique = strftime("%Y/%m/%d", strtotime($controle_technique->expiration));
                            ?>

                            <div class="form-row mt-4">
                                <!-- PERMIS DE CONDUIRE -->
                                <div class="offset-md-1 col-md-5 mb-2 px-5">
                                    <img src="<?= RACINE ?>/images/permis.png" style="height:50px;">

                                    <span class="form-text text-muted">
                                        Permis de conduire
                                    </span>

                                    <div class="custom-file mb-2">
                                        <input type="file" class="custom-file-input" id="docs_user_permis" name="docs_user_permis">
                                        <label class="custom-file-label" for="docs_user_permis">
                                            <?php if (isset($permis)) {
                                                if ($permis->doc_name == NULL || $permis->doc_name == '' || empty($permis->doc_name)) {
                                                echo '<span style="color:#dc3545;"><i class="fa fa-exclamation-triangle"></i> Sélectionnez le document...</span>';
                                            } else if ($permis->doc_name != NULL) {
                                                if ($permis->valide == 1) {
                                                    echo '<span style="color:#28a745;"><i class="fas fa-check-circle"></i> Document validé</span>';
                                                } else {
                                                    echo '<span style="color:#17a2b8;"><i class="fas fa-history"></i> Non validé...</span>';
                                                }
                                            }} ?>
                                        </label>
                                    </div>

                                    <div class="col-12">
                                        <input id="ins_check_permis" name="ins_check_permis" class="form-check-input" type="checkbox" <?= ($permis->valide == 1) ? 'checked' : false; ?>>
                                        <label for="ins_check_permis" class="form-check-label">
                                            <span class="col-12 text-justify mb-3 px-0">
                                                Valider le document
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <!-- ATTESTATION PERMIS DE CONDUIRE -->
                                <div class="offset-md-0 col-md-5 mb-2 px-5">
                                    <img src="<?= RACINE ?>/images/validite.png" style="height:50px;">

                                    <span class="form-text text-muted">
                                        Attestation de validité du permis de conduire
                                    </span>

                                    <div class="custom-file mb-2">
                                        <input type="file" class="custom-file-input" id="docs_user_attest" name="docs_user_attest">
                                        <label class="custom-file-label" for="docs_user_attest">
                                            <?php if ($permis_valide->doc_name == NULL || $permis_valide->doc_name == '' || empty($permis_valide->doc_name)) {
                                                echo '<span style="color:#dc3545;"><i class="fa fa-exclamation-triangle"></i> Sélectionnez le document...</span>';
                                            } else if ($permis_valide->doc_name != NULL) {
                                                if ($permis_valide->valide == 1 && isset($permis_valide->expiration) && $expir_permis_valide > $date_aujourdhui) {
                                                    echo '<span style="color:#28a745;"><i class="fas fa-check-circle"></i> Document validé</span>';
                                                } else if (isset($permis_valide->expiration) && $expir_permis_valide <= $date_aujourdhui) {
                                                    echo '<span style="color:#f68c02;"><i class="fa fa-exclamation-triangle"></i> À renouveler</span>';
                                                } else {
                                                    echo '<span style="color:#17a2b8;"><i class="fas fa-history"></i> Non validé...</span>';
                                                }
                                            } ?>
                                        </label>
                                    </div>

                                    <!-- DATE D'EXPIRATION ATTESTATION PERMIS DE CONDUIRE -->
                                    <div class="col-12 mb-2">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="date_exp_attest">Expiration :</label>
                                            </div>
                                            <div class="col-7">
                                                <input type="date" name="date_exp_attest" id="date_exp_attest" class="form-control"
                                                    <?= (isset($permis_valide->expiration)) ? 'value="' . $permis_valide->expiration . '"' : false; ?>>
                                                <!-- <small class="form-text">Date d'expiration</small> -->
                                            </div>
                                        </div>
                                    </div>

                                    <?php //if (isset($permis_valide->expiration) && $expir_permis_valide > $date_aujourdhui) { ?>
                                        <div class="col-12 mb-2">
                                            <input id="ins_check_attest" name="ins_check_attest" class="form-check-input" type="checkbox" <?= ($permis_valide->valide == 1) ? 'checked' : false; ?>>
                                            <label for="ins_check_attest" class="form-check-label">
                                                <span class="col-12 text-justify px-0">
                                                    Valider le document
                                                </span>
                                            </label>
                                        </div>
                                    <?php //} ?>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <!-- CARTE GRISE -->
                                <div class="offset-md-1 col-md-5 mb-2 px-5">
                                    <img src="<?= RACINE ?>/images/immat.png" style="height:50px;">

                                    <span class="form-text text-muted">
                                        Carte grise
                                    </span>

                                    <div class="custom-file mb-2">
                                        <input type="file" class="custom-file-input" id="docs_user_cg" name="docs_user_cg">
                                        <label class="custom-file-label" for="docs_user_cg">
                                            <?php if ($carte_grise->doc_name == NULL || $carte_grise->doc_name == '' || empty($carte_grise->doc_name)) {
                                                echo '<span style="color:#dc3545;"><i class="fa fa-exclamation-triangle"></i> Sélectionnez le document...</span>';
                                            } else if ($carte_grise->doc_name != NULL) {
                                                if ($carte_grise->valide == 1) {
                                                    echo '<span style="color:#28a745;"><i class="fas fa-check-circle"></i> Document validé</span>';
                                                } else {
                                                    echo '<span style="color:#17a2b8;"><i class="fas fa-history"></i> Non validé...</span>';
                                                }
                                            } ?>
                                        </label>
                                    </div>

                                    <div class="col-12">
                                        <input id="ins_check_cg" name="ins_check_cg" class="form-check-input" type="checkbox" <?= ($carte_grise->valide == 1) ? 'checked' : false; ?>>
                                        <label for="ins_check_cg" class="form-check-label">
                                            <span class="col-12 text-justify mb-3 px-0">
                                                Valider le document
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- ATTESTATION D'ASSURANCE -->
                                <div class="offset-md-0 col-md-5 mb-2 px-5">
                                    <img src="<?= RACINE ?>/images/accident.png" style="height:50px;">

                                    <span class="form-text text-muted">
                                        Attestation d'assurance
                                    </span>

                                    <div class="custom-file mb-2">
                                        <input type="file" class="custom-file-input" id="docs_user_assur" name="docs_user_assur">
                                        <label class="custom-file-label" for="docs_user_assur">
                                            <?php if ($attestation_assurance->doc_name == NULL || $attestation_assurance->doc_name == '' || empty($attestation_assurance->doc_name)) {
                                                echo '<span style="color:#dc3545;"><i class="fa fa-exclamation-triangle"></i> Sélectionnez le document...</span>';
                                            } else if ($attestation_assurance->doc_name != NULL) {
                                                if ($attestation_assurance->valide == 1 && isset($attestation_assurance->expiration) && $expir_attestation_assurance > $date_aujourdhui) {
                                                    echo '<span style="color:#28a745;"><i class="fas fa-check-circle"></i> Document validé</span>';
                                                } else if (isset($attestation_assurance->expiration) && $expir_attestation_assurance <= $date_aujourdhui) {
                                                    echo '<span style="color:#f68c02;"><i class="fa fa-exclamation-triangle"></i> À renouveler</span>';
                                                } else {
                                                    echo '<span style="color:#17a2b8;"><i class="fas fa-history"></i> Non validé...</span>';
                                                }
                                            } ?>
                                        </label>
                                    </div>

                                    <!-- DATE D'EXPIRATION ATTESTATION D'ASSURANCE -->
                                    <div class="col-12 mb-2">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="date_exp_assur">Expiration :</label>
                                            </div>
                                            <div class="col-7">
                                                <input type="date" name="date_exp_assur" id="date_exp_assur" class="form-control"
                                                    <?= (isset($attestation_assurance->expiration)) ? 'value="' . $attestation_assurance->expiration . '"' : false; ?>>
                                                <!-- <small class="form-text">Date d'expiration</small> -->
                                            </div>
                                        </div>
                                    </div>

                                    <?php //if (isset($attestation_assurance->expiration) && $expir_attestation_assurance > $date_aujourdhui) { ?>
                                        <div class="col-12">
                                            <input id="ins_check_assur" name="ins_check_assur" class="form-check-input" type="checkbox" <?= ($attestation_assurance->valide == 1) ? 'checked' : false; ?>>
                                            <label for="ins_check_assur" class="form-check-label">
                                                <span class="col-12 text-justify mb-3 px-0">
                                                    Valider le document
                                                </span>
                                            </label>
                                        </div>
                                    <?php //} ?>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <!-- CONTRÔLE TECHNIQUE -->
                                <div class="offset-md-1 col-md-5 mb-2 px-5">
                                    <img src="<?= RACINE ?>/images/controle.png" style="height:50px;">

                                    <span class="form-text text-muted">
                                        Contrôle technique
                                    </span>

                                    <div class="custom-file mb-2">
                                        <input type="file" class="custom-file-input" id="docs_user_controle" name="docs_user_controle">
                                        <label class="custom-file-label" for="docs_user_controle">
                                            <?php if ($controle_technique->doc_name == NULL || $controle_technique->doc_name == '' || empty($controle_technique->doc_name)) {
                                                echo '<span style="color:#dc3545;"><i class="fa fa-exclamation-triangle"></i> Sélectionnez le document...</span>';
                                            } else if ($controle_technique->doc_name != NULL) {
                                                if ($controle_technique->valide == 1 && isset($controle_technique->expiration) && $expir_controle_technique > $date_aujourdhui) {
                                                    echo '<span style="color:#28a745;"><i class="fas fa-check-circle"></i> Document validé</span>';
                                                } else if (isset($controle_technique->expiration) && $expir_controle_technique <= $date_aujourdhui) {
                                                    echo '<span style="color:#f68c02;"><i class="fa fa-exclamation-triangle"></i> À renouveler</span>';
                                                } else {
                                                    echo '<span style="color:#17a2b8;"><i class="fas fa-history"></i> Non validé...</span>';
                                                }
                                            } ?>
                                        </label>
                                    </div>

                                    <!-- DATE D'EXPIRATION CONTRÔLE TECHNIQUE -->
                                    <div class="col-12 mb-2">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="date_exp_controle">Expiration :</label>
                                            </div>
                                            <div class="col-7">
                                                <input type="date" name="date_exp_controle" id="date_exp_controle" class="form-control"
                                                    <?= (isset($controle_technique->expiration)) ? 'value="' . $controle_technique->expiration . '"' : false; ?>>
                                                <!-- <small class="form-text">Date d'expiration</small> -->
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php //if (isset($controle_technique->expiration) && $expir_controle_technique > $date_aujourdhui) { ?>
                                        <div class="col-12">
                                            <input id="ins_check_controle" name="ins_check_controle" class="form-check-input" type="checkbox" <?= ($controle_technique->valide == 1) ? 'checked' : false; ?>>
                                            <label for="ins_check_controle" class="form-check-label">
                                                <span class="col-12 text-justify mb-3 px-0">
                                                    Valider le document
                                                </span>
                                            </label>
                                        </div>
                                    <?php //} ?>
                                </div>
                                
                                <!-- RIB -->
                                <div class="offset-md-0 col-md-5 mb-2 px-5">
                                    <img src="<?= RACINE ?>/images/money.png" style="height:50px;">

                                    <span class="form-text text-muted">
                                        Relevé d'Identité Bancaire (RIB)
                                    </span>

                                    <div class="custom-file mb-2">
                                        <input type="file" class="custom-file-input" id="docs_user_rib" name="docs_user_rib">
                                        <label class="custom-file-label" for="docs_user_rib">
                                            <?php if ($rib->doc_name == NULL || $rib->doc_name == '' || empty($rib->doc_name)) {
                                                echo '<span style="color:#dc3545;"><i class="fa fa-exclamation-triangle"></i> Sélectionnez le document...</span>';
                                            } else if ($rib->doc_name != NULL) {
                                                if ($rib->valide == 1) {
                                                    echo '<span style="color:#28a745;"><i class="fas fa-check-circle"></i> Document validé</span>';
                                                } else {
                                                    echo '<span style="color:#17a2b8;"><i class="fas fa-history"></i> Non validé...</span>';
                                                }
                                            } ?>
                                        </label>
                                    </div>

                                    <div class="col-12">
                                        <input id="ins_check_rib" name="ins_check_rib" class="form-check-input" type="checkbox" <?= ($rib->valide == 1) ? 'checked' : false; ?>>
                                        <label for="ins_check_rib" class="form-check-label">
                                            <span class="col-12 text-justify mb-3 px-0">
                                                Valider le document
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- SUBMIT -->
                            <div class="offset-md-1 col-md-10 align-items-center">
                                <input class="btn btn-block btn-primary my-5" type="submit" id="docs_user_submit" name="#" value="Enregistrer les modifications">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>    
        </div>
    </div>           
</div>
