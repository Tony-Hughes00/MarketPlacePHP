  <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top" id="PNMNavbar">
    <a class="navbar-brand" href="Tdb">TABLEAU DE BORD</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">                       
            <li class="nav-item dropdown">
                <!-- <a class="nav-link" href="ficheAnim">PNM</a> -->
                <a class="nav-link" href="fichePnm.0">PNM</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown">PASSAGERS</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="consult?consultPass">Consulter</a>
                    <a class="dropdown-item" href="<?=ROUTE?>inscr.passager">Créer</a>
                    <!-- <a class="dropdown-item" href="cotis?PassAdh">Adhésions</a> -->
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown">CHAUFFEURS</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="consult?consultCond">Consulter</a>
                    <a class="dropdown-item" href="<?=ROUTE?>inscr.chauffeur">Créer</a>
                    <!-- <a class="dropdown-item" href="<?=ROUTE?>doc">Documents</a> -->
                    <!-- <a class="dropdown-item" href="eval?evalCond">Evaluation</a> -->
                    <!-- <a class="dropdown-item" href="cotis?CondAdh">Adhésions</a> -->
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown">TRAJETS</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="consult?consultTraj">Consulter</a>
                    <!-- <a class="dropdown-item" href="enr?inscrTraj">Créer</a> -->
                    <!-- <a class="dropdown-item" href="?TrajValid">Valider</a> -->
                    <!-- <a class="dropdown-item" href="?TrajExport">Exporter Documents</a> -->
                </div>
            </li>
            <!-- <li class="nav-item dropdown">
                <a class="nav-link" href="#" data-toggle="dropdown">EXPORTS</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Trajets</a>
                    <a class="dropdown-item" href="#">Chauffeurs</a>
                    <a class="dropdown-item" href="#">Passagers</a>
                    <a class="dropdown-item" href="#">Bons de Transports</a>
                </div>
            </li> -->

            <!-- <li class="nav-item dropdown">
                <a class="nav-link" href="#" data-toggle="dropdown">UTILISATEURS</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="consultUser">Consulter</a>
                    <a class="dropdown-item" href="inscr">Créer utilisateur</a>                             
                    <a class="dropdown-item" href="eval?evalCond">Evaluations</a>
                    <a class="dropdown-item" href="doc?docCond">Documents</a>
                    <a class="dropdown-item" href="cotis">Adhésions</a>
                </div>
            </li> -->


        </ul>
      
    </div>
    <?php if (isset($_SESSION['marketplace']['user_type']) || isset($_SESSION['marketplace']['statut'])) { ?>
        <!-- ----------- -->
        <!-- SI CONNECTE -->
        <!-- ----------- -->
        <div class="dropdown">
            <button class="btn btn-outline-info p-2" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i> &nbsp;Espace utilisateur con
            </button>
            <div class="dropdown-menu dropdown-menu-lg-right" style="min-width: 15rem!important;">  
                <a class="dropdown-item" href="<?=ROUTE?>"><i class="fas fa-user">&nbsp;&nbsp;</i>Retour au site</a>
                <a class="dropdown-item" href="<?=ROUTE?>logout"> <i class="fas fa-user-slash">&nbsp;&nbsp;</i>Me déconnecter</a>
            </div>
        </div>
        </ul>

        <?php } ?>
</nav>

<!-- ### A remplacer par Pass -->
<?php if (isset($_GET['inscrPass'])||isset($_GET['consultPass'])||isset($_GET['PassAdh'])||isset($_GET['UPass'])||isset($_GET['Pass'])){
    // include "menuPassager.php" ; 
    }?>

<!-- ### A remplacer par Cond -->
<?php if (isset($_GET['inscrCond'])||isset($_GET['consultCond'])||isset($_GET['docCond'])||isset($_GET['CondAdh'])||isset($_GET['Cond'])){
    // include "menuCond.php" ; 
    }?>

<!-- ### A remplacer par Traj -->
<?php if (isset($_GET['inscrTraj'])||isset($_GET['consultTraj'])||isset($_GET['TrajValid'])||isset($_GET['TrajExport'])||isset($_GET['Traj'])){
    // include "menuTrajet.php" ; 
    }?>

<?php if (isset($_GET['user'])){

// echo '<div class="row mb-0"><div class="col"><h4 class="text-danger text-center mt-4">MENU USER ID ????</h4><br>';

echo '<h5><a class="text-primary ml-5 pl-5" href="'. ROUTE .'ficheUser.'. $_GET['user'] .'"> <i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Retour Dossier</a></h5></div></div>';

}?>