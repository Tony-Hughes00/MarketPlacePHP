<?php
    require_once ROOT ."/app/Views/admin/parcours/utils/CarteLegend.php";
?>
<div class="row">
    <div class="col-12 col-lg-2 d-none d-lg-block">
        <span class="mx-auto">
            <a href="#CarteAncre" class="">
                <img src="<?=RACINE?>images/fleche_bas.png" style="max-height:50px;" class="mx-5 anim-fleche"><br>
                <!-- <img src="<?=RACINE?>images/fleche3.png" style="max-height:50px;"class="mx-5"><br> -->
                <!-- <img src="<?=RACINE?>images/carte.png" style="max-height:50px;"class="mx-5"><br> -->
                <b> Consulter la carte</b>            
            </a>
        </span>
     </div> 
     <div class="col-12 col-lg-7 mb-3 mb-md-0">
        <h2>Ensemble, facilitons nos déplacements</h2>
        <hr class="title-underline mb-2">
    </div>

</div>
<div class="row">
    <div class="container col-lg-9" id="intro">
   

        <!-- <div class="rubriques-cont row justify-content-center">
            <div class="bloc-icon-cont col-4 text-center">
                <img src="assets/images/icon-rubrique-1.png" alt="Icône Rubrique 1"><br>
            </div>
            <div class="bloc-icon-cont col-4 text-center">
                <img src="assets/images/icon-rubrique-2.png" alt="Icône Rubrique 2"><br>
            </div>
            <div class="bloc-icon-cont col-4 text-center">
                <img src="assets/images/icon-rubrique-3.png" alt="Icône Rubrique 3"><br>
            </div>
        </div> -->

        <div class="rubriques-cont row justify-content-center">
            
            <button type="button" class="btn display-bloc display-bloc-quoi" data-toggle="collapse" data-parent="#intro" data-target="#quoi">
                <span class="ts">Le MarketPlace,</span><br>c'est <span class="btn-bloc btn-bloc-quoi">Quoi ?</span>
            </button>

            <button type="button" class="btn display-bloc display-bloc-qui" data-toggle="collapse" data-parent="#intro" data-target="#qui">
                Pour<br><span class="btn-bloc btn-bloc-qui">Qui ?</span>
            </button>
            
            <button type="button" class="btn display-bloc display-bloc-ou" data-toggle="collapse" data-parent="#intro" data-target="#ou">
                Pour aller<br><span class="btn-bloc btn-bloc-ou">Où ?</span>
            </button>
        </div>

        <div class="intro-blocs">
            <div id="quoi" class="collapse show intro-bloc ">
                <p class="intro-bloc bloc-quoi text-center">
                    <img src="<?=RACINE?>images/car3.png" style="max-height:150px;"><br>
                    À l'initiative d'un collectif d'associations regroupées au sein de l'association
                   MOSC,<br><strong>le réseau de transport solidaire en Sud Charente est<br> un service de transport à la demande à vocation sociale et de proximité.</strong>
                </p>
                <div class="row w-20 pl-3 pl-md-5">
                    <div class="col-2 d-none d-md-block"></div>
                    <div class="col pl-5"> Il vise à :
                        <ul>
                            <li> améliorer le quotidien,</li>
                            <li> rompre l'isolement </li>
                            <li>et favoriser les moments d'échange et de convivialité entre les personnes.</li>
                        </ul>
                    </div>
                <div class="col-2 d-none d-md-block"></div>
                </div>
                        <div class="text-center" ><b>Ce service est complémentaire des dispositifs existants </b><br>(assurance Maladie, Artisans taxis,
                    Mutuelles, auto-entrepreneurs mobilité...)</div>
                    <br>
                        <div class="text-center" >
                          <b><a href="fonctionnement">  → Comment ça fonctionne ? ←
                            </a></b>
                        </div>
                        <br>                
            </div>
            <div id="qui" class="collapse intro-bloc">
                <p class="intro-bloc bloc-qui text-center">
                   <img src="<?=RACINE?>images/people6.png" style="max-height:100px;"><br>
                   <b> Pour les habitants du Sud Charente et adhérents de MOSC</b><br>(Territoires des 4B et Lavalette Tude Dronne) 
                   <div class=" row mx-5 px-0 px-lg-5">
                       <div class="col">                 
                            <b><u>Devenez Passager,</u> </b> si vous :
                            <ul class="pl-md-5 ">
                                <li> êtes sans permis de conduire,</li>
                                <li> êtes sans moyen de locomotion,</li>
                                <li> ne pouvez pas utiliser les moyens de transport existants,</li>
                                <li> ne pouvez pas assumer financièrement des frais de transport en raison de faibles revenus.</li>
                            </ul>
                            <br>

                            <b><u> Devenez Chauffeur Bénévole,</u> </b> si vous avez :
                            <ul class="pl-md-5">
                                <li> un véhicule personnel,</li>
                                <li> des disponibilités,</li>
                                <li> la possibilité de proposer des trajets pour participer à la mobilité locale,</li>
                                <li> envie de vous investir dans une action sociale, durable et écologique.</li>
                            </ul>
                        </div>
                    </div>
                     
                </p>
            </div>
            <div id="ou" class="collapse intro-bloc">
                <p class="intro-bloc bloc-ou text-center">
                        <img src="<?=RACINE?>images/car.png" style="max-height:100px;">
                        <!-- <img src="./assets/images/car6.png" style="max-height:100px;">
                        <img src="./assets/images/car5.png" style="max-height:100px;"> -->
                        <br>        
                        <b> Le Transport solidaire propose une solution Locale d'entraide et de solidarité</b>
                        <br>
                        Ce dispositif permet de se déplacer en Sud Charente en suivant certains critères.
                <div class="row px-xl-2">
                    <div class="col-1 d-none d-lg-block"></div>
                    <div class="col-xl-5">
                        <img src="<?=RACINE?>images/valid4.png" style="max-height:50px;">
                        <span class="mx-auto"  style="text-decoration:underline;">
                            <b>Pour tout déplacement occasionnel :</b>
                        </span> 
                        <ul>
                            <li>visites de courtoisie,</li>
                            <li> courses,</li>
                            <li> rendez-vous médicaux,</li>
                            <li> rendez-vous personnels,</li>
                            <li> déplacement formation,</li>
                            <li> démarches administratives et sociales,</li>
                            <li> loisirs...</li> 
                        </ul>
                    </div>
                    <div class="col-1 d-none d-lg-block" style="width:30px;"></div>
                    <div class="col-xl-5">
                        <img src="<?=RACINE?>images/interdit2.png" style="max-height:40px;">
                        <span class="mx-auto" style="text-decoration:underline;">
                            <b>Sont exclus les déplacements :</b>
                        </span>
                        <ul>
                            <li>pris en charge par la sécurité sociale,</li>
                            <li> scolaires ou domicile-travail,</li>
                            <li> pour les enfants mineurs non accompagnés par une personne majeure,</li>
                            <li> pour transporter des matériaux ou animaux même de petite taille.</li>
                        <ul>
                    </div>
                </div>
                </p>
            </div>
        </div>
    </div>

    <aside class="col-lg-3 mt-lg-5 d-none d-lg-block">
        <div class="row mx-5 mx-lg-1 px-2 px-lg-0">
            <br>
            <div class="col-6 col-lg-12 shadow-lg p-3 mb-lg-5 rounded border border-primary" style="background-color:#f0f7a1;border:3px #aaa solid !important;">
                <div class="text-center">
                    <img src="<?= RACINE ?>images/icons8-passager-80.png">
                </div>

                <a href="<?= ROUTE ?>inscription.passager" style="text-decoration:none;">
                    <button class="btn-ins btn btn-primary btn-block" style="font-size:28px;">Devenez<br>Passager !</button>
                </a>
            </div>

            <div class="col-6 col-lg-12 shadow-lg p-3 mb-lg-1 rounded border border-primary" style="background-color:#f0f7a1; border:3px #aaa solid !important;">
                <div class="text-center">
                    <img src="<?= RACINE ?>images/icons8-chauffeur-80.png">
                </div>

                <a href="<?= ROUTE ?>inscription.chauffeur" style="text-decoration:none;">
                    <button class="btn-ins btn btn-primary btn-block" style="font-size:28px;">Devenez<br>Chauffeur Bénévole !</button>
                </a>
            </div>
        </div>
    </aside>
</div>

<?php
// <div class="row m-2">
// <div class="col-lg-9">
//     <div class="row my-2">
//     <div class="col-1"></div>
//         <div class="col-10">
//             <h2>Ensemble, facilitons nos déplacements</h2>
//             <hr class="title-underline">
//             <div class="plaquette text-center">
//                 <img src="RACINEimages/quoi.jpg" class="display-bloc display-bloc-quoi" tabindex="0" autofocus>
//                 <img src="RACINEimages/qui.jpg" class="display-bloc display-bloc-qui" tabindex="0">
//                 <img src="RACINEimages/ou.png" class="display-bloc display-bloc-ou" tabindex="0">
//                 <button class="display-bloc display-bloc-quoi" tabindex="0" autofocus>Transport Solidaire, c'est<br><span class="btn-bloc btn-bloc-quoi">Quoi ?</span></button>
//                 <button class="display-bloc display-bloc-qui" tabindex="0">Pour<br><span class="btn-bloc btn-bloc-qui">Qui ?</span></button>
//                 <button class="display-bloc display-bloc-ou" tabindex="0">Pour aller<br><span class="btn-bloc btn-bloc-ou">Où ?</span></button>
//                 <p class="bloc-quoi">
//                     À l'initiative d'un collectif d'associations regroupées au sein de l'association
//                     <strong>MOSC</strong>, le réseau de transport solidaire en Sud Charente est un service de transport
//                     à la demande à vocation sociale et de proximité.<br> Il vise à améliorer le quotidien, rompre
//                     l'isolement et favoriser les moments d'échange et de convivialité entre les personnes.<br>
//                     Ce service est complémentaire des dispositifs existants (assurance Maladie, Artisans taxis,
//                     Mutuelles, auto-entrepreneurs mobilité...)
//                 </p>
//                 <p class="bloc-qui">
//                     Pour les habitants du Sud Charente (territoires des 4B et Lavalette Tude Dronne) et adhérents de MOSC sans permis de
//                     conduire, sans moyen de locomotion ou ne pouvant utiliser les moyens de transport existants et ne
//                     pouvant assumer financièrement des frais de transport en raison de faibles revenus.
//                 </p>
//                 <p class="bloc-ou">
//                     <span style="text-decoration:underline">Pour tout déplacement occasionnel :</span> visites de courtoisie, courses, rendez-vous médicaux, rendez-vous personnels, déplacement formation, démarches administratives et sociales, loisirs...<br>
//                     <span style="text-decoration:underline">Sont exclus les déplacements :</span> pris en charge par la sécurité sociale, scolaires ou domicile-travail, pour les enfants mineurs non accompagnés par une personne majeure, pour
//                     transporter des matériaux ou animaux même de petite taille.
//                 </p>
//             </div>
//         </div>
//         <div class="col-1"></div>      
//     </div>
?>
<balise id="CarteAncre" class="pt-5 mt-5"></balise>
<div class="row my-3" id="">
    <div class="col">
    <balise id="carteVisu"><h2>Les trajets à votre disposition</h2></balise>
        <hr class="title-underline mb-2">
    </div>
</div>
<?php // <!-- position: relative === important pour la carte SVG --> ?>
<div class="row" style="position: relative;">   
    <div class="col-12" style="padding-top: 30px;"></div>
    <div class="col-12 col-lg-7 ml-3 text-center justify-content-center">
        <div>
            <?php require ROOT . '/app/Views/carte.php'; ?>
        </div>
        <div>
            <?php
            $legendObj = new App\Controller\CarteLegend();
            $legendObj->affiche();
            ?>
        </div>
    </div>
    <?php // <div class="col-1"></div> ?>
    <div class=" col-12 col-lg-4 carte-infos shadow-lg border border-primary rounded my-5 my-lg-auto blockCommune" style="min-height:200px; background-color:#e1ed62;border:3px #aaa solid !important;">
        <div id="blockCommune" class="carte-infos intro-bloc" >
        </div>    
    </div>
    <div class="col col-lg-1" ></div>
</div>


<div class="row mx-5 px-3 d-block d-lg-none">
    <br>
    <div class="col-12 shadow-lg p-3 mb-lg-5 rounded border border-primary" style="margin-bottom: 10px; background-color:#f0f7a1; border:3px #aaa solid !important;">
        <div class="text-center">
            <img src="<?= RACINE ?>images/icons8-passager-80.png">
        </div>
        <a href="<?= ROUTE ?>inscription.passager" style="text-decoration:none;">
        <button class="btn-ins btn btn-primary btn-block" style="font-size:28px; padding: 0.375rem 0.65rem;">Devenez<br>Passager !</button>
        </a>
    </div>

    <div class="col-12 shadow-lg p-3 mb-lg-1 rounded border border-primary" style="background-color:#f0f7a1; border:3px #aaa solid !important;">
        <div class="text-center">
            <img src="<?= RACINE ?>images/icons8-chauffeur-80.png">
        </div>
        <a href="<?= ROUTE ?>inscription.chauffeur" style="text-decoration:none;">
            <button class="btn-ins btn btn-primary btn-block" style="font-size:28px; padding: 0.375rem 0.65rem;">Devenez<br>Chauffeur Bénévole !</button>
        </a>
    </div>
</div>



</div>
<?php //<!-- Résout le bug suite au pull du 7 juillet --> ?>
<!-- <br><br> -->
<!-- <script src="RACINEjs/carte.js"></script>
<script src="RACINEjs/script.js"></script> -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="></script>

<script src="<?= RACINE ?>js/script.js" type="text/javascript"></script>
<script src="<?= RACINE ?>js/carte.js" type="text/javascript"></script>
<script src="<?= RACINE ?>js/parcours.js" type="text/javascript"></script>
<?php include_once ROOT."/app/Views/carte/carteEvents.php"; ?>
