<div class="container-fluid form-bg">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-11 col-lg-7 text-center p-0 mt-3 mb-2">
            <span class="d-block mb-3">
                <a class="float-left ml-2" href="<?=ROUTE?>Tdb"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour au tableau de bord</a><br>
            </span>

            <div class="card px-0 pb-0 mt-3 mb-3">
                <form method="post" action="<?=ROUTE?>pdf" id="form-admin-pdf" enctype="multipart/form-data"><!-- enctype="multipart/form-data" -->
                    <fieldset>
                        <div class="form-card">
                            <div class="" style="background-color:#9ac526;">
                                <legend class="text-center fs-legend mb-5 py-3">Documents PDF téléchargeables sur le site</legend>
                            </div>

                            <!-- CONDITIONS D'UTILISATION TRANSPORT SOLIDAIRE -->
                            <div class="offset-md-1 col-md-10 mb-3">
                                <span class="form-text text-muted" style="font-weight:bold;">
                                    Conditions d'utilisation Transport Solidaire
                                </span>

                                <div class="custom-file mb-2">
                                    <input type="file" class="custom-file-input" id="pdf_conditions_utilisation" name="pdf_conditions_utilisation">
                                    <label class="custom-file-label" for="pdf_conditions_utilisation">
                                        Sélectionnez le document...
                                    </label>
                                </div>

                                <small>
                                    <span class="text-muted">Document actuel :</span>

                                    <a href="<?=RACINE?>pdf/doc_conditions_utilisation.pdf" target="_blank">Prévisualiser</a>
                                    -
                                    <a href="<?=RACINE?>pdf/doc_conditions_utilisation.pdf"
                                        download="Conditions d'utilisation Transport Solidaire.pdf">
                                        Télécharger
                                    </a>
                                </small>
                            </div>

                            <hr>

                            <!-- CONDITIONS DE FONCTIONNEMENT CHAUFFEUR BÉNÉVOLE -->
                            <div class="offset-md-1 col-md-10 mb-3">
                                <span class="form-text text-muted" style="font-weight:bold;">
                                    Conditions de fonctionnement Chauffeur Bénévole
                                </span>

                                <div class="custom-file mb-2">
                                    <input type="file" class="custom-file-input" id="pdf_conditions_fonctionnement_chauffeur" name="pdf_conditions_fonctionnement_chauffeur">
                                    <label class="custom-file-label" for="pdf_conditions_fonctionnement_chauffeur">
                                        Sélectionnez le document...
                                    </label>
                                </div>

                                <small>
                                    <span class="text-muted">Document actuel :</span>

                                    <a href="<?=RACINE?>pdf/doc_conditions_fonctionnement_chauffeur.pdf" target="_blank">Prévisualiser</a>
                                    -
                                    <a href="<?=RACINE?>pdf/doc_conditions_fonctionnement_chauffeur.pdf"
                                        download="Conditions de fonctionnement Chauffeur Bénévole.pdf">
                                        Télécharger
                                    </a>
                                </small>
                            </div>

                            <hr>

                            <!-- FICHE D'INSCRIPTION CHAUFFEUR BÉNÉVOLE -->
                            <div class="offset-md-1 col-md-10 mb-3">
                                <span class="form-text text-muted" style="font-weight:bold;">
                                    Fiche d'inscription Chauffeur Bénévole
                                </span>

                                <div class="custom-file mb-2">
                                    <input type="file" class="custom-file-input" id="pdf_fiche_inscription_chauffeur" name="pdf_fiche_inscription_chauffeur">
                                    <label class="custom-file-label" for="pdf_fiche_inscription_chauffeur">
                                        Sélectionnez le document...
                                    </label>
                                </div>

                                <small>
                                    <span class="text-muted">Document actuel :</span>

                                    <a href="<?=RACINE?>pdf/doc_fiche_inscription_chauffeur.pdf" target="_blank">Prévisualiser</a>
                                    -
                                    <a href="<?=RACINE?>pdf/doc_fiche_inscription_chauffeur.pdf"
                                        download="Fiche d'inscription Chauffeur Bénévole.pdf">
                                        Télécharger
                                    </a>
                                </small>
                            </div>

                            <hr>

                            <!-- FICHE D'INSCRIPTION PASSAGER -->
                            <div class="offset-md-1 col-md-10 mb-3">
                                <span class="form-text text-muted" style="font-weight:bold;">
                                    Fiche d'inscription Passager
                                </span>

                                <div class="custom-file mb-2">
                                    <input type="file" class="custom-file-input" id="pdf_fiche_inscription_passager" name="pdf_fiche_inscription_passager">
                                    <label class="custom-file-label" for="pdf_fiche_inscription_passager">
                                        Sélectionnez le document...
                                    </label>
                                </div>

                                <small>
                                    <span class="text-muted">Document actuel :</span>

                                    <a href="<?=RACINE?>pdf/doc_fiche_inscription_passager.pdf" target="_blank">Prévisualiser</a>
                                    -
                                    <a href="<?=RACINE?>pdf/doc_fiche_inscription_passager.pdf"
                                        download="Fiche d'inscription Passager.pdf">
                                        Télécharger
                                    </a>
                                </small>
                            </div>

                            <hr>

                            <!-- BON DE TRANSPORT -->
                            <div class="offset-md-1 col-md-10 mb-3">
                                <span class="form-text text-muted" style="font-weight:bold;">
                                    Bon de transport
                                </span>

                                <div class="custom-file mb-2">
                                    <input type="file" class="custom-file-input" id="pdf_bon_transport" name="pdf_bon_transport">
                                    <label class="custom-file-label" for="pdf_bon_transport">
                                        Sélectionnez le document...
                                    </label>
                                </div>

                                <small>
                                    <span class="text-muted">Document actuel :</span>

                                    <a href="<?=RACINE?>pdf/doc_bon_transport.pdf" target="_blank">Prévisualiser</a>
                                    -
                                    <a href="<?=RACINE?>pdf/doc_bon_transport.pdf"
                                        download="Bon de transport - Transport Solidaire.pdf">
                                        Télécharger
                                    </a>
                                </small>
                            </div>

                            <hr>

                            <!-- RIB -->
                            <div class="offset-md-1 col-md-10 mb-3">
                                <span class="form-text text-muted" style="font-weight:bold;">
                                    RIB - MOSC
                                </span>

                                <div class="custom-file mb-2">
                                    <input type="file" class="custom-file-input" id="pdf_rib_mosc" name="pdf_rib_mosc">
                                    <label class="custom-file-label" for="pdf_rib_mosc">
                                        Sélectionnez le document...
                                    </label>
                                </div>

                                <small>
                                    <span class="text-muted">Document actuel :</span>

                                    <a href="<?=RACINE?>pdf/doc_rib_mosc.pdf" target="_blank">Prévisualiser</a>
                                    -
                                    <a href="<?=RACINE?>pdf/doc_rib_mosc.pdf"
                                        download="RIB - MOSC.pdf">
                                        Télécharger
                                    </a>
                                </small>
                            </div>
                            
                            <!-- SUBMIT -->
                            <div class="offset-md-1 col-md-10 align-items-center">
                                <input class="btn btn-block btn-primary my-5" type="submit" id="admin_pdf_submit" name="admin_pdf_submit" value="Enregistrer les modifications">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>    
        </div>
    </div>           
</div>
