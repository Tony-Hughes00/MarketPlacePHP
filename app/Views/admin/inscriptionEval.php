<div class="container-fluid form-bg">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-11 col-lg-7 text-center p-0 mt-3 mb-2">
            <div class="card p-4 my-3">
            <!-- <h2 class="text-center">Enregistrer RDV Aptitude Conduite </h2><br> -->
            <?php if (isset($_GET['UserEval'])){ echo '<h4>CHAUFFEUR BENEVOLE</h4>';} ?>

            <!-- TEST D'ÉVALUATION -->
                <div class="form-group">
                    <fieldset>
                    <div id="dispo">
                        <div class="form-card">
                            <legend class="fs-legend mb-4">Évaluation en auto-école</legend>


                            <!-- <div class="row">
                                <span class="col-12 text-justify mb-2">Cette évaluation est à réaliser pour valider votre inscription. MOSC vous communiquera une date de passage ultérieurement en fonction de vos disponibilités.<a href="#" target="_blank">En savoir plus</a></span>
                            </div> -->

                            <!-- <div class="row">
                                <span class="step-info col-12 text-justify mb-4">Si vous avez pris contact avec MOSC puis avez réalisé et validé cette évaluation avant de procéder à votre inscription en ligne, veuillez ne cocher que la case ci-dessous.</span>
                            </div> -->

                            <?php if (isset($_GET['evalCond'])){ ?>
                                <div class="form-group row px-1">                    
                                    <label class="col-sm-4 col-form-label" for="Select1" >Selectionner un Chauffeur                                
                                    </label>
                                    <div class="col-sm-4">
                                        <select class="form-control" id="Select1">
                                        <option>Jean Paul Pierre Marielle</option>
                                        <option>Paul Emile Louis</option>
                                        <option>Myriam Delafrange</option>
                                        <option>Marthe Vermeille</option>
                                        <option>Richard Delion</option>
                                        </select>
                                       
                                    </div>
                                    <div class="col-sm-2">
                                        <!-- <input type="submit" value="rechercher">  -->
                                        <!-- Rediriger vers  eval?idUser-->
                                        <a href="eval?idUser" type="button" class=" btn btn-secondary">Rechercher</a>
                                    </div>
                                </div>
                                <!-- <small class="text-danger"> -Seulement User avec elements a completer ==> y a til des eval sans passer par fiche User ?</small><br> -->
                                <!-- <small class="text-danger"> - Afficher info user apres select ( formulaire dynamique).. ex: dispo si enregistrée , date eval si enregistrée</small> -->
                                <!-- <small class="text-danger"> - Prevoir update edit /create ( collapse accordeon ? )</small><br> -->
                               
                            <?php } 
                            else if 
                            (isset($_GET['idUser'])){ ?>
                             
                                <h4 class="mb-5">Mr Tartempion Charles <br> 5 rue des Mimosas à Chalais<br>
                                <u class="text-primary"><a href "tel: 06 75 95 75 12 54"> 06 75 95 75 12 54</a></u><br></h4>
                            
                                <div class="row">
                                    <b><u>Infos Chauffeur : </u></b>
                                </div>

                                <div class="row">
                                    <div class="col border border-primary">
                                    <!-- <i class="far fa-edit text-secondary small"></i> -->
                                    <u> Disponibilités enregistrées : </u> <br><br>
                                       - le Lundi de 9h à 12h <br>
                                        - Mercredi 14h à 16h<br>
                                        - le 12/06/2020 de 9h à 16h <br><br>
                                        <button class="btn btn-secondary mt-2" type="button" data-parent="#dispo" data-toggle="collapse" data-target="#dispo-eval" aria-expanded="false" aria-controls="dispo-eval">Compléter Disponibilités</button>
                                        <!-- Update -->
                                        <!-- <button class="btn btn-secondary" type="button" data-parent="#dispo" data-toggle="collapse" data-target="#dispo-eval" aria-expanded="false" aria-controls="dispo-eval">Modifier Disponibilités</button> -->
                                    </div>
                                    <div class="col border border-primary">
                                    <i class="far fa-edit text-secondary small"></i><u> Date RDV Evaluation :</u> <br><br>
                                       le 15/12/2020 à 15h30 <br>
                                        communiqué par Tel<br><br>
                                        <button class="btn btn-secondary mt-4" type="button" data-parent="#dispo" data-toggle="collapse" data-target="#ins_date_eval" aria-expanded="false" aria-controls="ins_date_eval">Compléter RDV</button>
                                        <!-- Update -->
                                        <!-- <button class="btn btn-secondary" type="button" data-parent="#dispo" data-toggle="collapse" data-target="#ins_date_eval" aria-expanded="false" aria-controls="ins_date_eval">Modifier RDV</button> -->
                                    </div>
                                    <div class="col border border-primary">
                                    <i class="far fa-edit text-secondary small"></i><u> Date Aptitude : </u><br><br>
                                        le 16/12/2020 <br><br>
                                        <button class="btn btn-secondary mt-5" type="button" data-parent="#dispo" data-toggle="collapse" data-target="#ins_apt"  style="bottom:0;"aria-expanded="false" aria-controls="ins_apt">Compléter Aptitudes</button>
                                    </div>
                                </div>


                        <!-- APTITUDES  -->
                            <div id="ins_apt" class="collapse mt-3" data-parent="#dispo">
                                <div class="row">
                                    <span class="col-12 text-justify mb-0"> <h4>APTITUDES VALIDEES :</h4>Date réception évaluation : </span>
                                </div>
                                <div class="form-row justify-content-center mb-4">
                                    <div class="col-md-4 form-inline"> 
                                        <label for="date_eval">Le &nbsp; &nbsp;</label>
                                        <input type="date" name="date_eval" id="date_eval" class="form-control">
                                    </div> 
                                </div>
                            </div>


                        <!-- RDV EVAL -->
                            <div id="ins_date_eval" class="collapse mt-3" data-parent="#dispo">
                                <div class="row">
                                    <span class="col-12 text-justify mb-0"><h4>EVALUATION :</h4>Date retenue évaluation : 
                                </div>
                                <div class="form-row justify-content-center mb-4">
                                    <div class="col-md-4 form-inline"> 
                                        <label for="date_eval">Le &nbsp; &nbsp;</label>
                                        <input type="date" name="date_eval" id="date_eval" class="form-control">
                                    </div> 
                                    <div class="col-md-3 form-inline">
                                        <label for="ins_eval_h2"> à &nbsp; &nbsp;</label>
                                        <input type="time" name="ins_eval_h2" id="ins_eval_h2" class="form-control">
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-md form-inline">
                                        <span> RDV communiqué par : &nbsp; &nbsp;</span>
                                        <input id="ins_rdv_com1" name="ins_rdv_com" class="form-check-input"  type="checkbox" value="Mail">
                                        <label for="ins_rdv_com1" class="form-check-label" style="padding-left: 1rem !important;
                                                padding-right: 1rem !important;"> Mail </label>
                                        <input id="ins_rdv_com2" name="ins_rdv_com" class="form-check-input"  type="checkbox" value="Téléphone">
                                        <label for="ins_rdv_com2" class="form-check-label"style="padding-left: 1rem !important;
                                            padding-right: 1rem !important;"> Téléphone </label>
                                    </div>
                                </div>
                            </div>
                   

                        <!-- DISPOS -->
                            <div id="dispo-eval" class="collapse mt-3" data-parent="#dispo">
                                <div class="row">
                                    <span class="col-12 text-justify mb-0"><h4>DISPONIBILITES :</h4> Date de disponibilité :
                                </div>
                                 <!-- DATE DISPO -->
                                <div class="form-row justify-content-center mb-4">
                                    <div class="col-md-4 form-inline"> 
                                        <label for="date_dispo_eval">Le &nbsp; &nbsp;</label>
                                        <input type="date" name="date_dispo_eval" id="date_dispo_eval" class="form-control">
                                    </div>                           
                                <!-- HORAIRES DATE-->
                                    <div class="col-md-3 form-inline">
                                        <label for="ins_eval_h1">  de &nbsp; &nbsp;</label>
                                        <input type="time" name="ins_eval_h1" id="ins_eval_h1" class="form-control">
                                    </div>                        
                                    <div class="col-md-3 form-inline">
                                        <label for="ins_eval_h2"> à &nbsp; &nbsp;</label>
                                        <input type="time" name="ins_eval_h2" id="ins_eval_h2" class="form-control">
                                    </div>
                                </div>
                                <!-- JOURS -->
                                <div class="row">
                                    <span class="col-12 text-justify mb-2">Jour.s de disponibilité : <br>
                                    <small class="text-danger">- Prévoir date de dispo + horaire (jour) <br> ou lundi  : check 9h-12h /  check apres midi ??? </small><br>
                                </div>

                                <div class="form-row m-0">
                                    <div class="form-check col-md-2 mb-2">
                                        <input id="ins_eval_j1" name="ins_eval_j1" class="form-check-input" type="checkbox" value="Lundi">
                                        <label for="ins_eval_j1" class="form-check-label">
                                            Lundi
                                        </label>
                                    </div>

                                    <div class="form-check col-md-2 mb-2">
                                        <input id="ins_eval_j2" name="ins_eval_j2" class="form-check-input" type="checkbox" value="Mardi">
                                        <label for="ins_eval_j2" class="form-check-label">
                                            Mardi
                                        </label>
                                    </div>

                                    <div class="form-check col-md-2 mb-2">
                                        <input id="ins_eval_j3" name="ins_eval_j3" class="form-check-input" type="checkbox" value="Mercredi">
                                        <label for="ins_eval_j3" class="form-check-label">
                                            Mercredi
                                        </label>
                                    </div>

                                    <div class="form-check col-md-2 mb-2">
                                        <input id="ins_eval_j4" name="ins_eval_j4" class="form-check-input" type="checkbox" value="Jeudi">
                                        <label for="ins_eval_j4" class="form-check-label">
                                            Jeudi
                                        </label>
                                    </div>

                                    <div class="form-check col-md-2 mb-2">
                                        <input id="ins_eval_j5" name="ins_eval_j5" class="form-check-input" type="checkbox" value="Vendredi">
                                        <label for="ins_eval_j5" class="form-check-label">
                                            Vendredi
                                        </label>
                                    </div>
                                </div>

                                <div class="form-row m-0">
                                    <div class="form-check col-md-2 mb-2">
                                        <input id="ins_eval_j6" name="ins_eval_j6" class="form-check-input" type="checkbox" value="Samedi">
                                        <label for="ins_eval_j6" class="form-check-label">
                                            Samedi
                                        </label>
                                    </div>

                                    <div class="form-check col-md-2 mb-4">
                                        <input id="ins_eval_j7" name="ins_eval_j7" class="form-check-input" type="checkbox" value="Dimanche">
                                        <label for="ins_eval_j7" class="form-check-label">
                                            Dimanche
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <span class="col-12 text-justify mb-0">Horaires de disponibilité :
                                </div>
                                <div class="form-row justify-content-center mb-4">
                                    <!-- HORAIRES -->
                                    <div class="col-md-6">
                                        <label for="ins_eval_h1">De</label>
                                        <input type="time" name="ins_eval_h1" id="ins_eval_h1" class="form-control">
                                    </div>                        
                                    <div class="col-md-6">
                                        <label for="ins_eval_h2">À</label>
                                        <input type="time" name="ins_eval_h2" id="ins_eval_h2" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </fieldset>
                </div>
                      



            </div>
        </div>
    </div>
</div>  
