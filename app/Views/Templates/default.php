<?php
if (!isset($_COOKIE['animWatched'])) {
    setcookie("animWatched", "1", time()+60*60*24*100);
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <title><?=App::getInstance()->title?></title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once ROOT . '/app/Views/Templates/links.php'; ?>

    <?php require_once ROOT . '/app/Views/Templates/referencement.php'; ?>

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
                        <img class="logo-hdr" src="<?= RACINE ?>images/MarketIcon.jpg"
                            alt="Logo Antennes Sud Charente Mobilité Icône">
                    </a>
                </div>

                <div class="col-md-8 text-center">
                    <a href="<?=ROUTE?>" style="text-decoration:none;">
                        <h1 class="text-danger">MarketPlace</h1>
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
            
            <?php require_once ROOT . '/app/Views/Templates/footer.php'; ?>
        </div>
        <?php require_once ROOT . '/app/Views/Templates/scripts.php'; ?>

</body>

</html>