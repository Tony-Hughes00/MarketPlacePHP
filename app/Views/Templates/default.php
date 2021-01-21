<?php
if (!isset($_COOKIE['animWatched'])) {
    setcookie("animWatched", "1", time()+60*60*24*100);
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <title><?=App::getInstance()->title?></title>
    <!--
            Format optimal pour le référencement :
            <title>Primary Keyword - Secondary Keyword | Brand Name</title> (Google affiche 50–60 caractères)
            Exemple pour la page Chauffeur : <title>Devenir Chauffeur Bénévole | Réseau de Transport Solidaire en Ouest Sud Charente</title>
        -->

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!-- Smart Wizard CSS -->
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="<?= RACINE ?>css/style.css">
    <link rel="stylesheet" href="<?= RACINE ?>css/profil.css">
    <link rel="stylesheet" href="<?= RACINE ?>css/parcours.css">

    <?php
        // Optimisation référencement : JSON for Linked Data (script à tester ici : https://search.google.com/structured-data/testing-tool)
        // JSON-LD meilleur que Microdata

        // (?) Redéfinir "name"
        // (!) Définir "legalName"
        // (!) Définir "url" (index avec nom de domaine)
        // (?) Redéfinir "logo"
        // (?) Redéfinir "founders"
        // (?) Redéfinir "address" :
        // https://www.google.com/maps/place/3+Rue+Henri+Dunant,+16190+Montmoreau-Saint-Cybard/@45.3972041,0.1279319,17z/data=!3m1!4b1!4m5!3m4!1s0x47ffdb14331ac77d:0xab2eebdf68e70ad!8m2!3d45.3972041!4d0.1301259
        // (?) Redéfinir "contactPoint"
        ?>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "Transport Solidaire en Sud Charente",
            // "legalName" : "À DÉFINIR",
            "url": "http://localhost/transport-solidaire/index.php",
            "logo": "assets/images/Antenne_de_mobilite-Sud-Charente.jpg",
            "foundingDate": "2020",
            "founders": [{
                "@type": "Person",
                "name": "Jean-Pierre"
            }, {
                "@type": "Person",
                "name": "Isabelle"
            }],
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "3, avenue Henry Dunant",
                "addressLocality": "Montmoreau",
                "addressRegion": "Nouvelle-Aquitaine",
                "postalCode": "16190",
                "addressCountry": "France"
            },
            "contactPoint": {
                "@type": "ContactPoint",
                "contactType": "customer service",
                "telephone": "+33 7 82 32 76 33",
                "email": "contact@mosc.fr"
            }
        }
    </script>
</head>

<body>
    <?php if (!isset($_COOKIE['animWatched'])) { ?>
    <!-- <div id="car-icon">
            <i class="fas fa-car-side car-anim"></i>
        </div> -->
    <!-- <i class="fas fa-male man-anim"></i> -->
    <div class="container-fluid blur-switch unblur">
        <?php } elseif (isset($_COOKIE['animWatched'])) { ?>
        <div class="container-fluid blur-switch unblur">
            <?php } ?>

            <?php // Header ?>
            <header class="row">
                <div class="col-md-2 text-center my-auto">
                    <a href="<?=ROUTE?>">
                        <img class="logo-hdr" src="<?= RACINE ?>images/logo-antennes-icon.png"
                            alt="Logo Antennes Sud Charente Mobilité Icône">
                    </a>
                </div>

                <div class="col-md-8 text-center">
                    <a href="<?=ROUTE?>" style="text-decoration:none;">
                        <h1 class="text-danger">Le Réseau de&nbsp<br class="d-inline d-sm-none">Transport
                            Solidaire<br>en Sud Charente</h1>
                        <?php // <img src="./assets/images/logo-mobilite-ouest-sud-charente.png" height=70px;> ?>
                    </a>
                    <?php // <img class="percent80" src="./assets/images/Transport Solidaire.PNG"> ?>
                </div>
                <div class="col-md-2"></div>
            </header>

            <?php
            // Barre de navigation
            include_once 'nav-default.php';
            ?>

            <?= $content ?>

            <footer class="mt-5 pt-5" style="background-color:#f8f9fa; box-shadow: 0px -10px 20px 0px rgba(0,0,0,.15);">

                <?php
    // Contact version Microdata (code à tester ici : https://search.google.com/structured-data/testing-tool)
    // JSON-LD meilleur que Microdata

    // Local Business (https://schema.org/LocalBusiness)
    // Describes a physical business, including opening hours, location, and contact information.
    // Example: your favorite bar.

    // Organization (https://schema.org/Organization)
    // Describes an organization, including website address, social media profiles, and contact information.
    // It’s used for organizations that people don’t physically visit. For that we have the Local Business type.
    // Example: Apple.

    // Changer "Organization" en "LocalBusiness" si ça correspond mieux
    // "Organization" semble le plus approprié selon le Testing Tool de Google
    ?>

                <?php
    // <div itemscope itemtype="http://schema.org/Organization" class="row align-items-center">
    //     <div class="col-md-4 text-center">
    //         <a itemprop="url" href="https://mosc.fr/" target="_blank">
    //             <img itemprop="logo" src="assets/images/logo-mosc.png" alt="Logo MOSC" class="contact-logo img-fluid" style="max-width: 500px; width:55%;"><br>
    //         </a>
    //     </div>
    //     <div class="contact-mosc col-md-6 text-center text-primary border border-primary border-4 p-4">
    //         <h3>Contacter <span itemprop="name">MOSC</span></h3>
    //         <span itemprop="telephone">
    //             <a href="tel:+33782327633">+33 7 82 32 76 33</a>
    //         </span>
    //         <span class="d-none d-sm-inline">|</span>
    //         <span itemprop="email">
    //             <a href="mailto:contact@mosc.fr">contact@mosc.fr</a>
    //         </span>
    //     </div>
    // </div>
    ?>
           <balise id="PnmAncre" class="pt-5 mt-5"></balise>
                <div class="row align-items-center justify-content-md-center mb-5">
                    <div class="footer-pnm-main col-md-4 text-center mb-5 mb-md-0">
                        <div class="footer-pnm-a-cont">
                            <b><a href="https://mosc.fr/" target="_blank" style="text-decoration:none; color:black;">
                                    <img src="<?= RACINE ?>images/logo-mosc.png" alt="Logo MOSC"
                                        style="max-width:250px;" class="contact-logo img-fluid mb-3">
                                    <br>
                                    Siège Social
                                </a>
                        </div>

                        <span class="footer-pnm-adr">
                            3, avenue Henry Dunant<br>
                            16190 Montmoreau<br>
                            <i class="fas fa-envelope"></i> <a style="text-decoration:none;font-size:medium;"
                                href="mailto:contact@mosc.fr">contact@mosc.fr</a>
                        </span></b>
                    </div>
                    <div class="contact-mosc col-md-6 text-center">
                        <a class="num-ref text-primary border border-primary border-4 p-4 d-block"
                            href="tel:+33782327633">
                            <h3>Contacter MOSC</h3>
                            <span>au N° unique :</span>
                            <br>
                            <span class="contact-mosc-tel"><i class="fas fa-phone-alt"></i> 07 82 32 76 33</span>
                        </a>
                    </div>
                </div>
                <section id="PNMs">
                <div class="row" >
                    <div class="col">
                        <h2>Vos Antennes de Mobilité<br> en Sud Charente</h2>
                        <hr class="title-underline mb-5">
                    </div>
                </div>

                <div class="pnm-liste row text-center justify-content-center">
                    <div class="footer-pnm footer-pnm-1 col-12 col-md-6 col-lg-3">
                        <i class="fas fa-map-marker-alt"></i>
                        <hr class="footer-pnm-hr footer-pnm-hr-1 mt-0">
                        <div class="footer-pnm-a-cont">
                            <a href="https://cscbarbezieux.com/" target="_blank">
                                Pôle Numérique du Château<br>
                                <!-- <span class="footer-pnm-st">(Centre Socioculturel Barbezilien)</span> -->
                            </a>
                            <span class="footer-pnm-st">- Centre Socioculturel Barbezilien -</span>

                        </div>
                        <?php // <hr class="footer-pnm-hr footer-pnm-hr-2"> ?>
                        <span class="footer-pnm-adr">Place de Verdun, aile n°1, 1er étage<br>16300
                            Barbezieux-Saint-Hilaire</span><br>
                        <small><a type="button" data-toggle="modal" data-target="#myModal2">Horaires
                                d'ouverture</a></small>
                    </div>

                    <div class="footer-pnm footer-pnm-2 col-12 col-md-6 col-lg-3">
                        <i class="fas fa-map-marker-alt"></i>
                        <hr class="footer-pnm-hr footer-pnm-hr-2 mt-0">
                        <div class="footer-pnm-a-cont">
                            <a href="http://centre-socio-culturel-du-pays-de-chalais.fr/" target="_blank">
                                Centre Socioculturel Envol<br>
                                <!-- <span class="footer-pnm-st">(Service Mobilité)</span> -->
                            </a>
                            <span class="footer-pnm-st">- Service Mobilité -</span>

                        </div>
                        <?php // <hr class="footer-pnm-hr footer-pnm-hr-3"> ?>
                        <span class="footer-pnm-adr">7, rue Pascaud Choqueur<br>16210 Chalais</span><br>
                        <small><a type="button" data-toggle="modal" data-target="#myModal3">Horaires
                                d'ouverture</a></small>
                    </div>

                    <div class="footer-pnm footer-pnm-3 col-12 col-md-6 col-lg-3">
                        <i class="fas fa-map-marker-alt"></i>
                        <hr class="footer-pnm-hr footer-pnm-hr-3 mt-0">
                        <div class="footer-pnm-a-cont">
                            <a href="http://numeriquesudcharente.org/" target="_blank">
                                La Parenthèse<br>
                                <!-- <span class="footer-pnm-st">(ENSC)</span> -->
                            </a>
                            <span class="footer-pnm-st">- ENSC -</span>

                        </div>
                        <?php // <hr class="footer-pnm-hr footer-pnm-hr-4"> ?>
                        <span class="footer-pnm-adr">1, avenue de l'Aquitaine<br>16190
                            Montmoreau-Saint-Cybard</span><br>
                        <small><a type="button" data-toggle="modal" data-target="#myModal4">Horaires
                                d'ouverture</a></small>
                    </div>

                    <div class="footer-pnm footer-pnm-4 col-12 col-md-6 col-lg-3">
                        <i class="fas fa-map-marker-alt"></i>
                        <hr class="footer-pnm-hr footer-pnm-hr-4 mt-0">
                        <div class="footer-pnm-a-cont">
                            <a href="http://atleb.fr/" target="_blank">
                                Pôle Multimédia et Mobilité<br>
                                <!-- <span class="footer-pnm-st">(ATLEB)</span> -->
                            </a>
                            <span class="footer-pnm-st">- ATLEB -</span>

                        </div>
                        <?php // <hr class="footer-pnm-hr footer-pnm-hr-5"> ?>
                        <span class="footer-pnm-adr">6, route de Montmoreau<br>16250 Blanzac-Porcheresse</span><br>
                        <small><a type="button" data-toggle="modal" data-target="#myModal5">Horaires
                                d'ouverture</a></small>
                    </div>
                </div>
                <br>
                </section>
                <?php
function getDispos($pnmId) {
    $matin = null;
    $aprem = null;

    $dispos = [];
    for($i = 1; $i < 7; $i++) {
        $dispoJour = [];
        $dispoJour['matin'] = null;
        $dispoJour['aprem'] = null;
        $dispos[$i] = $dispoJour;
    }
    $loadDispo = App::getInstance()->getTable('Dispo');
    $dispo = $loadDispo->selectDispoPnm($pnmId);
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
    return $dispos;
}
function getDispoJour($dispo) {
    $str = "";
    if ($dispo['matin'] != null &&
        $dispo['aprem'] != null) {
            $str = substr($dispo['matin']->h_dbt, 0, 2) . 'h' . substr($dispo['matin']->h_dbt, 3, 2);
            $str = $str . ' à '; 
            $str = $str . substr($dispo['matin']->h_fin, 0, 2) . 'h' . substr($dispo['matin']->h_fin, 3, 2);
            $str = $str . ' - ';
            $str = $str . substr($dispo['aprem']->h_dbt, 0, 2) . 'h' . substr($dispo['aprem']->h_dbt, 3, 2);
            $str = $str . ' à '; 
            $str = $str . substr($dispo['aprem']->h_fin, 0, 2) . 'h' . substr($dispo['aprem']->h_fin, 3, 2);
            return $str;
    }
    if ($dispo['matin'] != null) {
        $str = substr($dispo['matin']->h_dbt, 0, 2) . 'h' . substr($dispo['matin']->h_dbt, 3, 2);
        $str = $str . ' à '; 
        $str = $str . substr($dispo['matin']->h_fin, 0, 2) . 'h' . substr($dispo['matin']->h_fin, 3, 2);
    return $str;
    }
    if ($dispo['aprem'] != null) {
        $str = substr($dispo['aprem']->h_dbt, 0, 2) . 'h' . substr($dispo['aprem']->h_dbt, 3, 2);
        $str = $str . ' à '; 
        $str = $str . substr($dispo['aprem']->h_fin, 0, 2) . 'h' . substr($dispo['aprem']->h_fin, 3, 2);
    return $str;
    }
    return "Fermé";
}
?>
                <div id="myModal2" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <?php // Modal content
                        $dispos = getDispos(43);
                        ?>
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <button type="button" class="close" data-dismiss="modal">&times; Fermer</button>
                            </div>
                            <div class="modal-body mx-auto">
                                <h4> Pôle Numérique du Château: </h4>
                                à Barbezieux St Hilaire<br><br>
                                <h5> <u>Horaires et jours d'ouverture : </u></h5>
                                Lundi : <?php echo getDispoJour($dispos[1])?><br>
                                Mardi : <?php echo getDispoJour($dispos[2])?><br>
                                Mercredi : <?php echo getDispoJour($dispos[3])?><br>
                                Jeudi : <?php echo getDispoJour($dispos[4])?><br>
                                Vendredi : <?php echo getDispoJour($dispos[5])?><br>
                                Samedi : <?php echo getDispoJour($dispos[6])?><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="myModal3" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <?php // Modal content
                        $dispos = getDispos(40);?>
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <button type="button" class="close" data-dismiss="modal">&times; Fermer</button>
                            </div>
                            <div class="modal-body mx-auto">
                                <h4> Centre Socioculturel Envol : </h4>
                                à Chalais<br><br>
                                <h5> <u>Horaires et jours d'ouverture : </u></h5>
                                Lundi : <?php echo getDispoJour($dispos[1])?><br>
                                Mardi : <?php echo getDispoJour($dispos[2])?><br>
                                Mercredi : <?php echo getDispoJour($dispos[3])?><br>
                                Jeudi : <?php echo getDispoJour($dispos[4])?><br>
                                Vendredi : <?php echo getDispoJour($dispos[5])?><br>
                                Samedi : <?php echo getDispoJour($dispos[6])?><br>

                            </div>
                        </div>
                    </div>
                </div>
                <div id="myModal4" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <?php // Modal content
                        $dispos = getDispos(41);?>
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <button type="button" class="close" data-dismiss="modal">&times; Fermer</button>
                            </div>
                            <div class="modal-body mx-auto">
                                <h4> La Parenthèse : </h4>
                                à Montmoreau<br><br>
                                <h5> <u>Horaires et jours d'ouverture : </u></h5>
                                Lundi : <?php echo getDispoJour($dispos[1])?><br>
                                Mardi : <?php echo getDispoJour($dispos[2])?><br>
                                Mercredi : <?php echo getDispoJour($dispos[3])?><br>
                                Jeudi : <?php echo getDispoJour($dispos[4])?><br>
                                Vendredi : <?php echo getDispoJour($dispos[5])?><br>
                                Samedi : <?php echo getDispoJour($dispos[6])?><br>

                            </div>
                        </div>
                    </div>
                </div>
                <div id="myModal5" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <?php // Modal content
                        $dispos = getDispos(46);?>
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <button type="button" class="close" data-dismiss="modal">&times; Fermer</button>
                            </div>
                            <div class="modal-body mx-auto">
                                <h4> Pôle Multimedia et Mobilité: </h4>
                                aux Côteaux Blanzacais<br><br>
                                <h5> <u>Horaires et jours d'ouverture : </u></h5>
                                Lundi : <?php echo getDispoJour($dispos[1])?><br>
                                Mardi : <?php echo getDispoJour($dispos[2])?><br>
                                Mercredi : <?php echo getDispoJour($dispos[3])?><br>
                                Jeudi : <?php echo getDispoJour($dispos[4])?><br>
                                Vendredi : <?php echo getDispoJour($dispos[5])?><br>
                                Samedi : <?php echo getDispoJour($dispos[6])?><br>

                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="row text-center d-block">
                    <div class="copyright">
                        © Transport Solidaire en Sud Charente 2020
                        <span class="d-none d-sm-inline">-</span><?php // Séparateur "-" pour les grandes résolutions 
                                                                    ?>
                        <br class="d-inline d-sm-none"><?php // Balise <br> pour les petites résolutions 
                                                        ?>
                        Tous droits réservés.
                        <span class="d-none d-sm-inline">|</span><?php // Séparateur "|" pour les grandes résolutions 
                                                                    ?>
                        <br class="d-inline d-sm-none"><?php // Balise <br> pour les petites résolutions 
                                                        ?>
                        Site développé par <a href="https://www.lab2dev.fr/" target="_blank">Lab2Dev</a>.
                    </div>
                </div>
            </footer>
            <?php // </div> ?>
        </div>


        <!-- Ordre des scripts : jQuery -> Popper.js -> Bootstrap -->

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="></script>

        <!-- Smart Wizard (jQuery) -->
        <script src="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js"
            type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"
            type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/additional-methods.min.js"
            type="text/javascript"></script>

        <!-- Popper -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
        </script>

        <!-- <script src="RACINEjs/script.js" type="text/javascript"></script> -->
        <!-- <script src="RACINEjs/carte.js" type="text/javascript"></script> -->
        <!-- include_once ROOT."/app/Views/carte/carteEvents.php"; -->
        <script src="<?= RACINE ?>js/jquery.validate.js" type="text/javascript"></script>
        <script src="<?= RACINE ?>js/form.js" type="text/javascript"></script>
        <script src="<?= RACINE ?>js/parcours.js" type="text/javascript"></script>

        <?php if (!isset($_COOKIE['animWatched'])) { ?>
        <script src="<?= RACINE ?>js/newcomerAnimation.js" type="text/javascript"></script>
        <?php } ?>
</body>

</html>