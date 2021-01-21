<?php
    $matin = null;
    $aprem = null;

    $dispos = [];
    for($i = 1; $i < 7; $i++) {
        $dispoJour = [];
        $dispoJour['matin'] = null;
        $dispoJour['aprem'] = null;
        $dispos[$i] = $dispoJour;
    }
    foreach($dispo as $d) {
        $debut = new DateTime($d->h_dbt);
        $heure = $debut->format("Hi");
        $midi = (new DateTime("12:00"))->format("Hi");
        if ($heure < $midi) {
            $dispos[$d->jour_dispo]['matin'] = $d;
        } else {
            $dispos[$d->jour_dispo]['aprem'] = $d;
        }
    }

?>
<div class="container-fluid form-bg">
    <span class="d-block" style="font-size:18px!important;">
        <?php echo '<b><a class="ml-5 mb-5" href="' . $_SERVER['HTTP_REFERER'] . '"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Retour</a></b><br>'; ?>
    </span>
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-11 col-lg-7 text-center p-0 mb-2">
            <div class="card px-3 pt-4 pb-4 mt-1 mb-3">
                <div class="row">
                    <div class="col text-center">
                    <h3 class="bg-success p-2" style="border-radius:40px; margin-top:-50px;">Horaires d'Ouverture</h3>
                    <!-- <hr class="title-underline"> -->
                    <h4 class="bg-secondary p-2 mx-3 text-light" style="border-radius:40px; margin-top:-10px;"><?= $pnm ->titre_pnm ?></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <fieldset>

                            <form method="post" action="#" id="form-ins"> 
                               
                                <?php $idParts = explode('.', $_GET['url']);
                                    $idClean = array_filter($idParts);
                                    $id = intval(end($idClean)); 
                                    ?>

                                <input id="id_pnm" name="id_pnm" type="hidden" class="form-control" type="text" required value="<?= $id ?>"> <br>
                                               
                                <div class="row">                                 
                                    <div class="col-12 col-md-2">
                                            <b>Lundi</b>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label for="period1"> 
                                                <input type="checkbox" data-toggle="collapse" 
                                                data-target="#collapse1" 
                                                name="period1" value="lun_1"
                                                <?php 
                                                if ($dispos[1]['matin'] != null) {
                                                    echo " checked ";
                                                }
                                                ?>
                                                > Matin
                                        </label>         
                                        <div class="row <?php
                                            if ($dispos[1]['matin'] == null) {
                                                echo " collapse ";
                                            }
                                            ?> mt-2" id="collapse1">   
                                            <div class="col d-inline-flex my-auto">                               
                                                de <input class="text-center" type="time" name="h_dbt_lun_mat" 
                                                /*pattern="[0-2][0-9]:[0-5][0-9]"* /
                                                title="format HH:mm" step="60"
                                                <?php
                                                    if ($dispos[1]['matin'] != null) {
                                                        $time = new DateTime($dispos[1]['matin']->h_dbt);
                                                        echo 'value="' . $time->format("H:i") . '"';
                                                    } 
                                                ?>>
                                            </div> 
                                            <div class="col d-inline-flex my-auto">   
                                                à <input class="text-center" type="time" name="h_fin_lun_mat"
                                                /*pattern="[0-2][0-9]:[0-5][0-9]"*/
                                                title="format HH:mm"
                                                <?php
                                                    if ($dispos[1]['matin'] != null) {
                                                        $time = new DateTime($dispos[1]['matin']->h_fin);
                                                        echo 'value="' . $time->format("H:i") . '"';
                                                    } 
                                                ?>>
                                                </div> 
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md">
                                        <label for="period2">
                                            <input type="checkbox" data-toggle="collapse" 
                                            data-target="#collapse2"  name="period2"
                                            /*pattern="[0-2][0-9]:[0-5][0-9]"*/
                                                title="format HH:mm" value="lun_2"
                                                <?php 
                                                if ($dispos[1]['aprem'] != null) {
                                                    echo " checked ";
                                                }
                                                ?>
                                                > Ap-midi
                                        </label>
                                        <div class="row <?php
                                            if ($dispos[1]['aprem'] == null) {
                                                echo " collapse ";
                                            }
                                            ?>  mt-2" id="collapse2">   
                                            <div class=" col d-inline-flex my-auto">                 
                                            de <input class="text-center" type="time" name="h_dbt_lun_ap"
                                            /*pattern="[0-2][0-9]:[0-5][0-9]"*/ title="format HH:mm"
                                            <?php
                                                if ($dispos[1]['aprem'] != null) {
                                                    $time = new DateTime($dispos[1]['aprem']->h_dbt);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                            </div> 
                                            <div class="col d-inline-flex my-auto">  
                                            à <input class="text-center" type="time" name="h_fin_lun_ap"
                                            <?php
                                                if ($dispos[1]['aprem'] != null) {
                                                    $time = new DateTime($dispos[1]['aprem']->h_fin);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-3">                                 
                                    <div class="col-12 col-md-2">
                                            <b>Mardi</b>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label for="period3"> 
                                                <input type="checkbox" data-toggle="collapse" 
                                                data-target="#collapse3" name="period3" 
                                                value="mar_1"
                                                <?php 
                                                if ($dispos[2]['matin'] != null) {
                                                    echo " checked ";
                                                }
                                                ?>
                                                > Matin
                                        </label>         
                                        <div class="row <?php
                                            if ($dispos[2]['matin'] == null) {
                                                echo " collapse ";
                                            }
                                            ?>  mt-2" id="collapse3">   
                                            <div class="col d-inline-flex my-auto">                              
                                                de <input class="text-center" type="time" name="h_dbt_mar_mat"
                                            <?php
                                                if ($dispos[2]['matin'] != null) {
                                                    $time = new DateTime($dispos[2]['matin']->h_dbt);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                            </div> 
                                            <div class="col d-inline-flex my-auto">   
                                                    à <input class="text-center" type="time" name="h_fin_mar_mat"
                                                    <?php
                                                if ($dispos[2]['matin'] != null) {
                                                    $time = new DateTime($dispos[2]['matin']->h_fin);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                                </div> 
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md">
                                        <label for="period4">
                                            <input type="checkbox" data-toggle="collapse" 
                                            data-target="#collapse4"  name="period4" 
                                            value="mar_2"
                                            <?php 
                                                if ($dispos[2]['aprem'] != null) {
                                                    echo " checked ";
                                                }
                                                ?>
                                                > Ap-midi
                                        </label>
                                        <div class="row <?php
                                            if ($dispos[2]['aprem'] == null) {
                                                echo " collapse ";
                                            }
                                            ?>  mt-2" id="collapse4">   
                                            <div class="col d-inline-flex my-auto">                 
                                                    de <input class="text-center" type="time" name="h_dbt_mar_ap"
                                                    <?php
                                                if ($dispos[2]['aprem'] != null) {
                                                    $time = new DateTime($dispos[2]['aprem']->h_dbt);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                            </div> 
                                            <div class="col d-inline-flex my-auto">  
                                                à <input class="text-center" type="time" name="h_fin_mar_ap"
                                                <?php
                                                if ($dispos[2]['aprem'] != null) {
                                                    $time = new DateTime($dispos[2]['aprem']->h_fin);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-3">                                 
                                    <div class="col-12 col-md-2">
                                            <b>Mercredi</b>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label for="period5"> 
                                                <input type="checkbox" data-toggle="collapse" 
                                                data-target="#collapse5" name="period5" 
                                                value="mer_1"
                                                <?php 
                                                if ($dispos[3]['matin'] != null) {
                                                    echo " checked ";
                                                }
                                                ?>> Matin
                                        </label>         
                                        <div class="row <?php
                                            if ($dispos[3]['matin'] == null) {
                                                echo " collapse ";
                                            }
                                            ?>  mt-2" id="collapse5">   
                                            <div class="col d-inline-flex my-auto">                              
                                                de <input class="text-center" type="time" name="h_dbt_mer_mat"
                                                <?php
                                                if ($dispos[3]['matin'] != null) {
                                                    $time = new DateTime($dispos[3]['matin']->h_dbt);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                            </div> 
                                            <div class="col d-inline-flex my-auto">   
                                                    à <input class="text-center" type="time" name="h_fin_mer_mat"
                                                    <?php
                                                if ($dispos[3]['matin'] != null) {
                                                    $time = new DateTime($dispos[3]['matin']->h_fin);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                                </div> 
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md">
                                        <label for="period6">
                                            <input type="checkbox" data-toggle="collapse" 
                                            data-target="#collapse6" name="period6" 
                                            value="mer_2"
                                            <?php 
                                                if ($dispos[3]['aprem'] != null) {
                                                    echo " checked ";
                                                }
                                                ?>> Ap-midi
                                        </label>
                                        <div class="row <?php
                                            if ($dispos[3]['aprem'] == null) {
                                                echo " collapse ";
                                            }
                                            ?>  mt-2" id="collapse6">   
                                            <div class="col d-inline-flex my-auto">                 
                                                    de <input class="text-center" type="time" name="h_dbt_mer_ap"
                                                    <?php
                                                if ($dispos[3]['aprem'] != null) {
                                                    $time = new DateTime($dispos[3]['aprem']->h_dbt);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                            </div> 
                                            <div class="col d-inline-flex my-auto">  
                                                à <input class="text-center" type="time" name="h_fin_mer_ap"
                                                <?php
                                                if ($dispos[3]['aprem'] != null) {
                                                    $time = new DateTime($dispos[3]['aprem']->h_fin);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-3">                                 
                                    <div class="col-12 col-md-2">
                                            <b>Jeudi</b>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label for="period7"> 
                                                <input type="checkbox" data-toggle="collapse" 
                                                data-target="#collapse7" name="period7" 
                                                value="jeu_1"
                                                <?php 
                                                if ($dispos[4]['matin'] != null) {
                                                    echo " checked ";
                                                }
                                                ?>> Matin
                                        </label>         
                                        <div class="row <?php
                                            if ($dispos[4]['matin'] == null) {
                                                echo " collapse ";
                                            }
                                            ?>  mt-2" id="collapse7">   
                                            <div class="col d-inline-flex my-auto">                              
                                                de <input class="text-center" type="time" name="h_dbt_jeu_mat"
                                                <?php
                                                if ($dispos[4]['matin'] != null) {
                                                    $time = new DateTime($dispos[4]['matin']->h_dbt);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                            </div> 
                                            <div class="col d-inline-flex my-auto">   
                                                    à <input class="text-center" type="time" name="h_fin_jeu_mat"
                                                    <?php
                                                if ($dispos[4]['matin'] != null) {
                                                    $time = new DateTime($dispos[4]['matin']->h_fin);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                                </div> 
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md">
                                        <label for="period8">
                                            <input type="checkbox" data-toggle="collapse" 
                                            data-target="#collapse8" name="period8" 
                                            value="jeu_2"
                                            <?php 
                                                if ($dispos[4]['aprem'] != null) {
                                                    echo " checked ";
                                                }
                                                ?>> Ap-midi
                                        </label>
                                        <div class="row <?php
                                            if ($dispos[4]['aprem'] == null) {
                                                echo " collapse ";
                                            }
                                            ?>  mt-2" id="collapse8">   
                                            <div class="col d-inline-flex my-auto">                 
                                                    de <input class="text-center" type="time" name="h_dbt_jeu_ap"
                                                    <?php
                                                if ($dispos[4]['aprem'] != null) {
                                                    $time = new DateTime($dispos[4]['aprem']->h_dbt);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                            </div> 
                                            <div class="col d-inline-flex my-auto">  
                                                à <input class="text-center" type="time" name="h_fin_jeu_ap"
                                                <?php
                                                if ($dispos[4]['aprem'] != null) {
                                                    $time = new DateTime($dispos[4]['aprem']->h_fin);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-3">                                 
                                    <div class="col-12 col-md-2">
                                            <b>Vendredi</b>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label for="period9"> 
                                                <input type="checkbox" data-toggle="collapse" 
                                                data-target="#collapse9" name="period9" 
                                                value="ven_1"
                                                <?php 
                                                if ($dispos[5]['matin'] != null) {
                                                    echo " checked ";
                                                }
                                                ?>> Matin
                                        </label>         
                                        <div class="row <?php
                                            if ($dispos[5]['matin'] == null) {
                                                echo " collapse ";
                                            }
                                            ?>  mt-2" id="collapse9">   
                                            <div class="col d-inline-flex my-auto">                              
                                                de <input class="text-center" type="time" name="h_dbt_ven_mat"
                                                <?php
                                                if ($dispos[5]['matin'] != null) {
                                                    $time = new DateTime($dispos[5]['matin']->h_dbt);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                            </div> 
                                            <div class="col d-inline-flex my-auto">   
                                                    à <input class="text-center" type="time" name="h_fin_ven_mat"
                                                    <?php
                                                if ($dispos[5]['matin'] != null) {
                                                    $time = new DateTime($dispos[5]['matin']->h_fin);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                                </div> 
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md">
                                        <label for="period10">
                                            <input type="checkbox" data-toggle="collapse" 
                                            data-target="#collapse10" name="period10" 
                                            value="ven_2"
                                            <?php 
                                                if ($dispos[5]['aprem'] != null) {
                                                    echo " checked ";
                                                }
                                                ?>> Ap-midi
                                        </label>
                                        <div class="row <?php
                                            if ($dispos[5]['aprem'] == null) {
                                                echo " collapse ";
                                            }
                                            ?>  mt-2" id="collapse10">   
                                            <div class="col d-inline-flex my-auto">                 
                                                    de <input class="text-center" type="time" name="h_dbt_ven_ap"
                                                    <?php
                                                if ($dispos[5]['aprem'] != null) {
                                                    $time = new DateTime($dispos[5]['aprem']->h_dbt);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                            </div> 
                                            <div class="col d-inline-flex my-auto">  
                                                à <input class="text-center" type="time" name="h_fin_ven_ap"
                                                <?php
                                                if ($dispos[5]['aprem'] != null) {
                                                    $time = new DateTime($dispos[5]['aprem']->h_fin);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-3">                                 
                                    <div class="col-12 col-md-2">
                                            <b>Samedi</b>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label for="period11"> 
                                                <input type="checkbox" data-toggle="collapse" 
                                                data-target="#collapse11" name="period11" 
                                                value="sam_1"
                                                <?php 
                                                if ($dispos[6]['matin'] != null) {
                                                    echo " checked ";
                                                }
                                                ?>> Matin
                                        </label>         
                                        <div class="row <?php
                                            if ($dispos[6]['matin'] == null) {
                                                echo " collapse ";
                                            }
                                            ?>  mt-2" id="collapse11">   
                                            <div class="col d-inline-flex my-auto">                              
                                                de <input class="text-center" type="time" name="h_dbt_sam_mat"
                                                <?php
                                                if ($dispos[6]['matin'] != null) {
                                                    $time = new DateTime($dispos[6]['matin']->h_dbt);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                            </div> 
                                            <div class="col d-inline-flex my-auto">   
                                                    à <input class="text-center" type="time" name="h_fin_sam_mat"
                                                    <?php
                                                if ($dispos[6]['matin'] != null) {
                                                    $time = new DateTime($dispos[6]['matin']->h_fin);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                                </div> 
                                        </div>  
                                    </div>
                                    <div class="col-12 col-md">
                                        <label for="period12">
                                            <input type="checkbox" data-toggle="collapse" 
                                            data-target="#collapse12" name="period12" 
                                            value="sam_2"
                                            <?php 
                                                if ($dispos[6]['aprem'] != null) {
                                                    echo " checked ";
                                                }
                                                ?>> Ap-midi
                                        </label>
                                        <div class="row <?php
                                            if ($dispos[6]['aprem'] == null) {
                                                echo " collapse ";
                                            }
                                            ?>  mt-2" id="collapse12">   
                                            <div class="col d-inline-flex my-auto">                 
                                                    de <input class="text-center" type="time" name="h_dbt_sam_ap"
                                                    <?php
                                                if ($dispos[6]['aprem'] != null) {
                                                    $time = new DateTime($dispos[6]['aprem']->h_dbt);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                            </div> 
                                            <div class="col d-inline-flex my-auto">  
                                                à <input class="text-center" type="time" name="h_fin_sam_ap"
                                                <?php
                                                if ($dispos[6]['aprem'] != null) {
                                                    $time = new DateTime($dispos[6]['aprem']->h_fin);
                                                    echo 'value="' . $time->format("H:i") . '"';
                                                } 
                                            ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                        
                                <input type="submit" for="enreg-Houv" class="btn btn-block mt-5 p-2 text-light" style="background-color:#28a745; border:none; font-size:20px;" value="Enregistrer">                        
                            </form>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// function lundiFunction() {
//   var checkBox = document.getElementById("LundiCheck");
//   var text = document.getElementById("lun_h");
//   if (checkBox.checked == true){
//     text.style.display = "block";
//   } else {
//      text.style.display = "none";
//   }
// }
</script>
