<?php
    $pnm = null;
    if (isset($data['pnm'])) {
        $pnm = $data['pnm'];
    }
    // var_dump($pnm);
?>
<div class="container-fluid form-bg">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-11 col-lg-7 text-center p-0 mb-2">
            <div class="card px-3 pt-4 pb-4 mt-1 mb-3">
                <div class="row">
                    <div class="col text-center pb-3">
                    <h3>Enregistrer un PNM</h3>
                    <hr class="title-underline">
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <fieldset>

                        <!-- <div class="bg-secondary"><h4 class="text-white p-3 mb-3">Informations Structure : </h4></div> -->

                            <form method="post" action="#" id="form-ins"> 
                                <!-- NOM PNM-->
                                <div class="form-row justify-content-center">
                                    <div class="col-md-6 mb-3">            
                                        <label for="titre_pnm">Nom du PNM : </label>
                                        <input id="titre_pnm" name="titre_pnm" 
                                        class="form-control" type="text" required
                                        <?php
                                            if ($pnm != null) {
                                                echo ' value="' . $pnm->titre_pnm . '"';
                                            }
                                        ?>
                                        > <br>
                                    </div>
                                <!-- </div> -->
                                <!-- NOM STRUCTURE-->

                                <!-- <div class="form-row justify-content-center"> -->
                                    <div class="col-md-6 mb-3"> 
                                        <label for="struct_pnm"> Service ou Structure : </label>                                    
                                        <input id="struct_pnm" name="struct_pnm" 
                                        class="form-control" type="text" required
                                        <?php
                                            if ($pnm != null) {
                                                echo ' value="' . $pnm->struct_pnm . '"';
                                            }
                                        ?>                                        
                                        > <br>
                                    </div>
                                </div>

                                    <!-- PORTABLE  / penser à ctype_digit() -->
                                <div class="form-row justify-content-center">
                                    <div class="col-md-6 mb-4">
                                        <label for="tel_pnm ">
                                            Téléphone PNM : 
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text justify-content-center form-tel-icon">
                                                    <i class="fas fa-mobile-alt"></i>
                                                </span>
                                            </div>
                                            <input pattern="[0-9]{10}" maxlength="10" type="tel"
                                                name="tel_pnm" id="tel_pnm"
                                                class="has-icon form-control"
                                                <?php
                                                    if ($pnm != null) {
                                                        echo ' value="' . $pnm->tel_pnm . '"';
                                                    }
                                                ?>                                        

                                                >
                                        </div>
                                        <small class="form-text">* Tout attaché (ex. : 0605040302)</small>
                                    </div>
                                </div>

                                <div class="form-row justify-content-center">
                                    <div class="col-md-6 mb-3"> 
                                        <label for="mail_pnm">
                                            Mail PNM : 
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text justify-content-center form-tel-icon">
                                                    <i class="fas fa-at"></i>
                                                </span>
                                            </div>
                                            <input id="mail_pnm" name="mail_pnm" 
                                            type="text" class="has-icon form-control"
                                            <?php
                                                if ($pnm != null) {
                                                    echo ' value="' . $pnm->mail_pnm . '"';
                                                }
                                            ?>                                              
                                            > 
                                            <br>                                                
                                        </div>
                                    </div>
                                <!-- </div> -->
                                <!-- <div class="form-row justify-content-center"> -->
                                    <div class="col-md-6 mb-3"> 
                                        <label for="site_pnm">
                                            Site PNM : 
                                        </label>                                    
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text justify-content-center form-tel-icon">
                                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input id="site_pnm" name="site_pnm" 
                                            type="text"class="has-icon form-control"
                                            <?php
                                                if ($pnm != null) {
                                                    echo ' value="' . $pnm->site_pnm . '"';
                                                }
                                            ?>                                             
                                            >
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <!-- ADRESSE -->
                                <div class="form-row justify-content-center mt-5">
                                    <div class="col-md-7 my-auto">
                                        <label for="adr_pnm">
                                           <b> Adresse : </b>
                                        </label>
                                  
                                        <div class="input-group">
                                            <input type="text" name="adr_pnm" 
                                            id="adr_pnm" class="form-control" required
                                            <?php
                                                if ($pnm != null) {
                                                    echo ' value="' . $pnm->adr_pnm . '"';
                                                }
                                            ?>                                             

                                            >
                                         
                                        </div>
                                    </div>
                                </div>                               

                                <div class="form-row mt-3">
                                    <!-- CODE POSTAL -->
                                    <div class="col-md-2 offset-md-3">
                                        <label for="cp_pnm">Code Postal : </label>
                                        <input pattern="[0-9]{5}" maxlength="5" type="text" name="cp_pnm"
                                            id="cp_pnm" class="form-control" required disabled
                                            <?php
                                                if ($pnm != null) {
                                                    echo ' value="' . $pnm->cp_pnm . '"';
                                                }
                                            ?>                                             

                                            >
                                    </div>

                                    <!-- COMMUNE -->
                                    <div class="col-md-4">
                                        <label for="ville_pnm">Commune : </label>
                                            <select style="width:100%" id="ville_pnm" name="ville_pnm" class="p-2"
                                                class="form-control" required
                                                onchange="onSelectCommune(this)">
                                            <?php
                                            $loadCommune = App::getInstance()->getTable('Commune');
                                            $communes = $loadCommune->selectCommunes(); 
                                            foreach($communes as $commune) {
                                                if ($commune->id < 10000) {
                                                    echo '<option value="' . $commune->id . ',' . $commune->code_postal . '"';
                                                    if ($pnm != null) {
                                                        if ($commune->id == $pnm->ville_pnm) {
                                                            echo ' selected ';
                                                        }
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
                                            document.getElementById("cp_pnm").value = values[1];
                                            console.log("onSelectCommune", values);
                                        }
                                    </script>
                                </div>
                                <?php 
                                    if ($pnm == null) {
                                ?>
                                <input type="submit" for="enreg-Pnm" class="btn btn-primary mt-5" value="Enregistrer ce PNM">
                                <?php } else {
                                ?>
                                <a href="enrPnmPost.<?=$pnm->id_pnm?>">Modifier ce PNM</a>              
                                <!-- <input type="submit" for="enreg-Pnm" class="btn btn-primary mt-5" value="Modifier ce PNM">                         -->
                                <?php }
                                ?>
                            </form>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function onSelectCommune(ctrl) {
    let values = ctrl.value.split(','); 
    document.getElementById("cp_pnm").value = values[1];
    console.log("onSelectCommune", values);
}
</script>