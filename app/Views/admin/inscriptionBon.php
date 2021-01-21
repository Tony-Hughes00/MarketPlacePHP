<div class="container-fluid form-bg">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-11 col-lg-7 text-center p-0 mb-3">
            <span class="d-block mb-3">
                <a class="float-left ml-2" href="<?=ROUTE?>ficheUser<?= (isset($userId)) ? '.' . $userId : false; ?>"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour sur la fiche utilisateur</a><br>
            </span>
            <div class="card px-0 pb-0">
                <div class="" style="background-color:#9ac526;">  
                     <?php //if (isset($_GET['id_user'])){ echo '<h4>Mr Tartempion Charles <br> </h4>';}  ?>      
                     <?php if (isset($userId)){ echo '<h4>'.ucfirst($membre->civilite) .' '. ucfirst($membre->prenom) .' '. ucfirst($membre->nom). '<br> </h4>';}  ?>                 
           
                    <h3 class="text-center text-light">Enregistrez un bon de transport</h3>
                </div>
                
                <div class="row mt-3">
                    <div class="col mb-4">    
                        <form method="post" action="<?=ROUTE?>bon<?= (isset($userId)) ? '.' . $userId : false; ?>" id="form-bon" enctype="multipart/form-data">
                            <?php if (count($parcours) > 0) { ?>
                                <input type="hidden" name="parcours_id" id="parcours_id" value="<?= $parcours[0]->trajetId; ?>">
                            <?php } ?>

                            <script>
                                function selectBon() {
                                    $('#parcours_id')[0].value = $('#listBon')[0].value;
                                }
                            </script>

                            <?php if (!$parcours) {
                                echo '<br>';
                                echo '<i class="fas fa-check-circle" style="font-size:40px; color:#28a745;"></i>';
                                echo '<br><br>';
                                echo '<strong>Vous n\'avez aucun bon de transport à fournir.</strong><br><br>';
                            } else { ?>

                                <div class="form-group row px-5">
                                    <label for="id_trajet" class="col-12 col-form-label">Sélectionner un trajet effectué :</label>
                                    <div class="col-12">
                                        <script>
                                            function selectBon() {
                                                $('#parcours_id')[0].value = $('#listBon')[0].value;
                                            }
                                        </script>
                                        <?php
                                            // var_dump($parcours);
                                            echo '<select id="listBon" onchange="selectBon()">';
                                            foreach ($parcours as $p) {
                                                if ($p->direction == 'aller') {
                                                    echo '<option value="' . $p->trajetId . '">' . $p->date_debut . ' : ' . $p->depart . ' -> ' . $p->arrivee . '</option>';
                                                } else {
                                                    echo '<option value="' . $p->trajetId . '">' . $p->date_debut . ' : ' . $p->arrivee . ' -> ' . $p->depart . '</option>';
                                                }
                                            }
                                            echo '</select>';
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group row px-5">
                                    <label for="km_trajet" class="col-12 col-form-label">Nombre de kilomètres parcourus</label>
                                    <div class="col-12">
                                        <input type="text" name="km_trajet" size="3"> km
                                    </div>
                                </div>
                                <div class="form-group row px-5">
                                    <label for="bon_transp" class="col-12 col-form-label"><b>Envoyez votre bon de transport signé par le Chauffeur Bénévole et le Passager.</b></label>
                                    <div class="col-12">
                                        <input type="file" name="bon_transp">
                                    </div>
                                </div>
                                <div class="form-group row px-5">
                                    <?php if (count($parcours) > 0) { ?>
                                        <input class="btn btn-primary mx-auto" type="submit" name="enrBon" value="Envoyer le document">
                                    <?php } ?>
                                </div>

                            <?php } ?>

                            <small>
                                * Vous serez indeminisé par la MOSC après vérification des informations.<br>
                                Votre compte sera crédité de 0,20€/km parcourus.<br>
                                Vous serez informé du virement depuis votre espace utilisateur.
                            </small>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>