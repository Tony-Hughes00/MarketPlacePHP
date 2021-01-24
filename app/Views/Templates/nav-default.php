<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow p-3 mb-5 rounded">
    <a class="navbar-brand" href="<?=ROUTE?>">
        <?php // <img class="logo-txt" style="max-height: 40px;" src="./assets/images/logo-MOSC-2.PNG"> ?>
        <img class="logo-nav" src="<?= RACINE ?>images/logo-antennes-text.png"
            alt="Logo Antennes Sud Charente Mobilité Texte">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        MENU <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto" style="font-size: 20px;">
            <li class="nav-item active">
                <a class="nav-link" href="<?=ROUTE?>">ACCUEIL<span class="sr-only">(actuel)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdown1" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">COMMENT ÇA FONCTIONNE ?
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown1" style="font-size:20px;">
                    <a class="dropdown-item" href="<?=ROUTE?>fonctionnement">Le Transport Solidaire</a>
                    <a class="dropdown-item" href="<?=ROUTE?>chauffeur">Devenir Chauffeur Bénévole</a>
                    <a class="dropdown-item" href="<?=ROUTE?>passager">Devenir Passager</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    INSCRIPTIONS
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="font-size:20px;">
                    <!-- <a class="dropdown-item" href="chauffeur.php">Devenir Chauffeur Bénévole</a> -->
                    <a class="dropdown-item" href="<?= ROUTE ?>inscription.chauffeur">Chauffeur Bénévole</a>

                    <!-- <a class="dropdown-item" href="passager.php">Devenir Passager</a> -->
                    <a class="dropdown-item" href="<?= ROUTE ?>inscription.passager">Passager</a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item"
                        href="<?= RACINE ?>pdf/doc_conditions_utilisation.pdf"
                        download="Conditions d'utilisation Transport Solidaire.pdf">Conditions
                        d'utilisation</a>
                </div>
            </li>
        </ul>  
    </div>
    <div class="dropdown">
            <button class="btn btn-info p-2" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i> &nbsp;Espace utilisateur
            </button>

            <div class="dropdown-menu dropdown-menu-lg-right" style="min-width: 15rem!important;">   

                <?php if (!isset($_SESSION['MarketPlace'])) { ?>
                    <!-- --------------- -->
                    <!-- SI PAS CONNECTE -->
                    <!-- --------------- -->
                    
                    <!-- Formulaire dans Dropdown spécial Loïc -->
                    <form method="post" action="<?=ROUTE?>profil" id="form-con" class="px-4 py-3">
                        <h5>Connectez-vous :</h5>

                        <div class="form-group">
                            <label for="con_email">Adresse e-mail</label>
                            <input type="email" name="con_email" id="con_email" class="has-icon form-control" placeholder="email@exemple.fr" required>
                        </div>

                        <div class="form-group">
                            <label for="con_mdp">Mot de passe</label><br>
                            <div class="input-group">                                
                                <input type="password" minlength="8" maxlength="20" name="con_mdp" id="con_mdp" class="form-control" placeholder="Mot de passe" required>
                                <div class="input-group-prepend align-items-center">
                                    <!-- <span class="input-group-text justify-content-center form-tel-icon"> -->
                                        &nbsp;<i class="fa fa-eye toggle-eye3" onclick="myFunction3()"></i>
                                    <!-- </span> -->
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-check text-center">
                            <input type="checkbox" class="form-check-input" id="dropdownCheck" name="remember">
                            <label class="form-check-label" for="dropdownCheck">
                                Se rappeller de moi
                            </label>
                        </div>

                        <div class="form-check text-center">
                            <button onclick="window.location = '<?=ROUTE?>connexion'" type="submit" class="btn btn-secondary mt-2" name="con_submit" id="con_submit" class="action-button">Se connecter</button>
                        </div>
                    </form>
                    
                    <hr>
                    <a class="dropdown-item" href="<?= ROUTE ?>insProprietaire"><i class="fas fa-sign-in-alt">&nbsp;&nbsp;</i>Vous n'êtes pas encore inscrit ?</a>
                    <a class="dropdown-item" href="<?= ROUTE ?>request"> <i class="fas fa-user-lock">&nbsp;&nbsp;</i>Mot de passe oublié ?</a>                    
                <?php } else if (isset($_SESSION['transport-solidaire']['membre_type']) || isset($_SESSION['transport-solidaire']['statut'])) { ?>
                    <!-- ----------- -->
                    <!-- SI CONNECTE -->
                    <!-- ----------- -->

                    <a class="dropdown-item" href="<?=ROUTE?>profil"><i class="fas fa-user">&nbsp;&nbsp;</i>Mon profil</a>
                    <a class="dropdown-item" href="<?=ROUTE?>logout"> <i class="fas fa-user-slash">&nbsp;&nbsp;</i>Me déconnecter</a>
                <?php } ?>
            </div>
        </div>
</nav>
<script>
function myFunction3() {
    let y = document.getElementById("con_mdp");
    if (y.type === "password") {
        y.type = "text";
        $('.toggle-eye3').attr('class', 'fa fa-eye-slash toggle-eye3');
    } else {
        y.type = "password";
        $('.toggle-eye3').attr('class', 'fa fa-eye toggle-eye3');
    }
} 
</script>