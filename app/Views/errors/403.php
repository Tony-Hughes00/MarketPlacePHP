<div class="row">
    <!-- Icône Font Awesome -->
    <div class="col-12 mb-3 text-center">
        <span style="font-size:3em; color:#dc3545;">
            <i class="fas fa-minus-circle"></i> <!-- <i class="fas fa-hand-paper"></i> -->
        </span>
    </div>

    <!-- Heading -->
    <div class="col-12 mb-3 text-center">
        <h2>Erreur 403 : Accès refusé</h2>
        <hr class="title-underline mb-2">
    </div>

    <!-- Message -->
    <div class="col-12 mb-3 text-center">
        <p style="font-size:1.4em;">Vous n'avez pas les droits pour accéder à cette page.</p>
    </div>
</div>

<div class="row">
    <!-- Bouton Retour ou Accueil -->
    <?php if (isset($_SERVER['HTTP_REFERER'])) { ?>
        <div class="offset-4 col-2 mb-3 text-center">
            <a class="btn btn-primary border-primary" href="<?=$_SERVER['HTTP_REFERER']?>"><i class="fas fa-arrow-alt-circle-left"></i> Retour</a>
        </div>
    <?php } else { ?>
        <div class="offset-4 col-2 mb-3 text-center">
            <a class="btn btn-primary border-primary" href="<?=ROUTE?>"><i class="fas fa-home"></i> Accueil</a>
        </div>
    <?php } ?>

    <!-- Bouton Connexion ou Espace -->
    <?php if (isset($_SESSION['marketplace']['statut'])) { ?>
        <div class="col-2 mb-3 text-center">
            <a class="btn btn-primary border-primary" href="<?=ROUTE?>Tdb"><i class="fas fa-user"></i> Espace</a>
        </div>
    <?php } else if (isset($_SESSION['marketplace']['user_type'])) { ?>
        <div class="col-2 mb-3 text-center">
            <a class="btn btn-primary border-primary" href="<?=ROUTE?>profil"><i class="fas fa-user"></i> Profil</a>
        </div>
    <?php } else { ?>
        <div class="col-2 mb-3 text-center">
            <a class="btn btn-primary border-primary" href="<?=ROUTE?>connexion"><i class="fas fa-user"></i> Connexion</a>
        </div>
    <?php } ?>
</div>
