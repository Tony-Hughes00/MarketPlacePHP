<div class="container mx-5 p-5 tab-content">
    <fieldset class="border border-success rounded p-5">
        <div class="form-card">
            <legend class="fs-legend mb-4">ENREGISTRER UN TRAJET</legend>

            <!-- <div class="row">
                <span class="step-info col-12 text-justify mb-4">Vous pouvez passer cette étape et fournir ces informations ultérieurement si vous le souhaitez.</span>
            </div> -->

            <p class="text-danger">AJOUTER TYPE + USER </p>

            <div class="form-row justify-content-center">
                <!-- DÉPART -->
                <div class="col-md-6 mb-1">
                    <label for="ins_trajet_depart">Lieu de départ</label>
                    <input type="text" name="ins_trajet_depart" id="ins_trajet_depart" class="form-control">
                </div>

                <!-- ARRIVÉE -->
                <div class="col-md-6 mb-1">
                    <label for="ins_trajet_arrivee">Lieu d'arrivée</label>
                    <input type="text" name="ins_trajet_arrivee" id="ins_trajet_arrivee" class="form-control">
                </div>
            </div>

            <!-- ALLER-RETOUR -->
            <div class="form-group">
                <div class="form-check col-md-12 mb-4">
                    <input id="ins_ar" name="ins_ar" class="form-check-input" type="checkbox" value="1">
                    <label for="ins_ar" class="form-check-label">
                        Aller-retour
                    </label>
                </div>
            </div>

            <!-- JOURS -->

            <div class="row">
            <p class="text-danger">AJOUTER DATE ( ponctuel vs regulier) </p>

                <span class="col-12 text-justify mb-2">Jour.s de vos déplacements :
            </div>

            <div class="form-row m-0">
                <div class="form-check col-md-2 mb-2">
                    <input id="ins_trajet_j1" name="ins_trajet_j1" class="form-check-input" type="checkbox" value="1">
                    <label for="ins_trajet_j1" class="form-check-label">
                        Lundi
                    </label>
                </div>

                <div class="form-check col-md-2 mb-2">
                    <input id="ins_trajet_j2" name="ins_trajet_j2" class="form-check-input" type="checkbox" value="1">
                    <label for="ins_trajet_j2" class="form-check-label">
                        Mardi
                    </label>
                </div>

                <div class="form-check col-md-2 mb-2">
                    <input id="ins_trajet_j3" name="ins_trajet_j3" class="form-check-input" type="checkbox" value="1">
                    <label for="ins_trajet_j3" class="form-check-label">
                        Mercredi
                    </label>
                </div>

                <div class="form-check col-md-2 mb-2">
                    <input id="ins_trajet_j4" name="ins_trajet_j4" class="form-check-input" type="checkbox" value="1">
                    <label for="ins_trajet_j4" class="form-check-label">
                        Jeudi
                    </label>
                </div>

                <div class="form-check col-md-2 mb-2">
                    <input id="ins_trajet_j5" name="ins_trajet_j5" class="form-check-input" type="checkbox" value="1">
                    <label for="ins_trajet_j5" class="form-check-label">
                        Vendredi
                    </label>
                </div>
            </div>

            <div class="form-row m-0">
                <div class="form-check col-md-2 mb-2">
                    <input id="ins_trajet_j6" name="ins_trajet_j6" class="form-check-input" type="checkbox" value="1">
                    <label for="ins_trajet_j6" class="form-check-label">
                        Samedi
                    </label>
                </div>

                <div class="form-check col-md-2 mb-4">
                    <input id="ins_trajet_j7" name="ins_trajet_j7" class="form-check-input" type="checkbox" value="1">
                    <label for="ins_trajet_j7" class="form-check-label">
                        Dimanche
                    </label>
                </div>
            </div>

            <div class="row">
                <span class="col-12 text-justify mb-0">Horaires de vos déplacements :
            </div>

            <div class="form-row justify-content-center mb-4">
                <!-- HEURE DÉPART -->
                <div class="col-md-6">
                    <label for="ins_trajet_h1">De</label>
                    <input type="time" name="ins_trajet_h1" id="ins_trajet_h1" class="form-control">
                </div>

                <!-- HEURE ARRIVÉE -->
                <div class="col-md-6">
                    <label for="ins_trajet_h2">À</label>
                    <input type="time" name="ins_trajet_h2" id="ins_trajet_h2" class="form-control">
                </div>
            </div>

            <!-- GARE -->
            <div class="form-group">
                <div class="form-check col-md-12">
                    <input id="ins_gare" name="ins_gare" class="form-check-input" type="checkbox" value="1">
                    <label for="ins_gare" class="form-check-label">
                        Vous acceptez d'emmener vos passagers à la gare la plus proche si besoin
                        <p class="text-danger">Ajouter Checkbox avec les 3 Gares </p>

                    </label>
                </div>
            </div>
        </div>
    </fieldset>
</div>    