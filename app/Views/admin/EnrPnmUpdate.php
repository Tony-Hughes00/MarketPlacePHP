<?php
    $pnm = null;
    if (isset($data['pnm'])) {
        $pnm = $data['pnm'];
    }
    // var_dump($pnm);
?>
<div class="container-fluid form-bg">
  <?php echo '<span><b><a class="float-left ml-5" href="' . $_SERVER['HTTP_REFERER'] . '"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour</a></b></span><br>'; ?>
    
    <div class="row justify-content-center mt-3">
        <div class="col-11 col-sm-9 col-md-11 col-lg-9 text-center p-0 mb-2">
            <div class="card px-2 pt-4 pb-4 mt-1 mb-3">
                <!-- <div class="row"> -->
                    <!-- <div class="col"> -->
                    <h3 class="text-center bg-success p-2 text-light" style="margin-top:-40px; margin-bottom: -2px; border-radius: 40px;">Modifier l'Antenne de Mobilité</h3>
                    <!-- <hr class="title-underline"> -->
                    <!-- </div> -->
                <!-- </div> -->
                <div class="row mt-3">
                    <div class="col text-center">
                        <!-- <div class="bg-secondary"><h4 class="text-white p-3 mb-3">Informations Structure : </h4></div> -->
                        <form method="post" action="enrPnmPost.<?=$pnm->id_pnm?>"> 
                            <fieldset>
                                <!-- NOM PNM-->
                                <div class="form-row justify-content-center">
                                    <div class="col-md-6 mb-3">            
                                        <label for="titre_pnm"><b>Nom de l'Antenne : </b></label>
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
                                        <label for="struct_pnm"><b> Service ou Structure : </b></label>                                    
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
                                <!-- ADRESSE -->
                                <div class="form-row justify-content-center mb-3">
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
                                <!-- COMMUNE -->
                                <div class="form-row mt-3">
                                    <div class="col-md-4 offset-md-3">
                                        <label for="ville_pnm"><b>Commune : </b></label>
                                        <select style="width:100%" id="ville_pnm" name="ville_pnm" class="p-2"
                                                    class="form-control" required
                                                    onchange="onSelectCommune(this)"
                                                    >
                                                <?php
                                                    $loadCommune = App::getInstance()->getTable('Commune');
                                                    $communes = $loadCommune->selectCommunes(); 
                                                    foreach($communes as $commune) {
                                                        echo '<option value="' . $commune->id . ',' . $commune->code_postal . '"';;
                                                        if ($pnm != null) {
                                                            if ($commune->id == $pnm->ville_pnm) {
                                                                echo ' selected ';
                                                            }
                                                        }
                                                        echo '>' . $commune->nom . "</option>";           
                                                    }
                                                ?>
                                        </select>  
                                    </div>
                                    <!-- CODE POSTAL -->
                                    <div class="col-md-2">
                                        <label for="cp_pnm"><b>Code Postal : </b></label>
                                        <input pattern="[0-9]{5}" maxlength="5" type="text" name="cp_pnm"
                                            id="cp_pnm" class="form-control" disabled required
                                            <?php
                                                if ($pnm != null) {
                                                    echo ' value="' . $pnm->cp_pnm . '"';
                                                }
                                            ?>                                             

                                            >
                                    </div>                                 
                                </div>
<!-- <div class="border border-success mx-5"> -->
                                    <!-- PORTABLE  / penser à ctype_digit() -->
                                <div class="form-row justify-content-center">
                                    <div class="col-md-6 mb-4">
                                        <label for="tel_pnm ">
                                            <b>Téléphone Antenne : </b>
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
                                                    } else { echo ' Non renseigné';}
                                                ?>                                        

                                                >
                                        </div>
                                        <small class="form-text">* Tout attaché (ex. : 0605040302)</small>
                                    </div>
                                </div>

                                <div class="form-row justify-content-center">
                                    <div class="col-md-6 mb-3 "> 
                                        <label for="mail_pnm">
                                           <b> Mail Antenne : </b>
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
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="col-md-6 mb-3"> 
                                        <label for="site_pnm">
                                            <b>Site Antenne: </b>
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
<!-- </div> -->
                                
                                <input type="submit" class="btn btn-lg btn-success my-3" value="Modifier ce PNM">
                            </fieldset>
                        </form>
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
