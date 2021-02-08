<nav class="navbar navbar-expand-md bg-secondary navbar-light sticky-top" id="PNMNavbar">
    <a class="navbar-brand text-light" href="Tdb">TABLEAU DE BORD</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">                       
            <li class="nav-item dropdown">
                <a class="nav-link text-light" data-toggle="dropdown">PNM</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="consultPnm">Consulter</a>
                    <a class="dropdown-item" href="enrCons">Créer un Conseiller</a>
                    <a class="dropdown-item" href="enrPnm">Créer une Antenne de Mobilité</a>

                </div>
            </li>            
            <li class="nav-item dropdown">
                <a class="nav-link text-light" data-toggle="dropdown">UTILISATEURS</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="consultUser">Consulter</a>
                    <a class="dropdown-item" href="exportChauffeurs">Exporter Chauffeurs</a>
                    <a class="dropdown-item" href="exportPassagers">Exporter Passagers</a>
      
                </div>
            </li>
         
            <li class="nav-item dropdown">
                <a class="nav-link text-light" data-toggle="dropdown">COTISATIONS</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="consultCotis">Consulter</a>
                    <!-- <a class="dropdown-item disabled" href="">Enregistrer</a> -->
                    <!-- <a class="dropdown-item disabled" href="">Valider virement</a> -->
                    <a class="dropdown-item" href="exportCotis">Exporter Cotisations</a>
                </div>
            </li> 
            <li class="nav-item dropdown">
                <a class="nav-link text-light" data-toggle="dropdown">BONS DE TRANSPORT</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="consultBons">Consulter</a>                    
                    <a class="dropdown-item" href="validateBons">Valider Bons de Transport</a>
                    <a class="dropdown-item" href="exportBons">Exporter Bons de Transport</a>
                 <!-- <a class="dropdown-item" href="#"></a> -->
                 </div>  
            </li> 
            <li class="nav-item dropdown">
                <a class="nav-link text-light" data-toggle="dropdown">TRAJETS</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="consult?consultTraj">Consulter</a>                    
                    <a class="dropdown-item" href="exportTrajets">Exporter Trajets</a>
                 <!-- <a class="dropdown-item" href="#"></a> -->
                 </div>  
            </li>     
                
            <!-- <li class="nav-item dropdown">
                <a class="nav-link text-light" data-toggle="dropdown">EXPORTS</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="exportChauffeurs">Chauffeurs</a>
                    <a class="dropdown-item" href="exportPassagers">Passagers</a>
                    <a class="dropdown-item" href="exportBdT">Bons de Transports</a>
                </div>
            </li> -->

            <li class="nav-item dropdown">
            <a class="nav-link text-light" data-toggle="dropdown">EDITER SITE</a>
            <div class="dropdown-menu">                
                <a class="dropdown-item" href="<?=ROUTE?>pdf">Documents en Téléchargement</a>
                <a class="dropdown-item disabled" href="">Espace Personnalisable</a>
            </div>

            </li>
            <!-- <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown">CONDUCTEURS</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="consult?consultCond">Consulter</a>
                    <a class="dropdown-item" href="inscr?inscrCond">Créer</a>
                    <a class="dropdown-item" href="doc?docCond">Documents</a>
                    <a class="dropdown-item" href="eval?evalCond">Evaluation</a>
                    <a class="dropdown-item" href="cotis?CondAdh">Adhésions</a>
                </div>
            </li> -->


        </ul>
      
    </div>
    <?php if (isset($_SESSION['marketplace']['user_type']) || isset($_SESSION['marketplace']['statut'])) { ?>
        <!-- ----------- -->
        <!-- SI CONNECTE -->
        <!-- ----------- -->
        <!-- <ul class="float-right" style="display:flex;"> -->
        <div class="dropdown">
            <button class="btn btn-outline-light p-2" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i> &nbsp;Espace utilisateur adm
            </button>
            <div class="dropdown-menu dropdown-menu-lg-right" style="min-width: 15rem!important;">  
                <a class="dropdown-item" href="<?=ROUTE?>"><i class="fas fa-user">&nbsp;&nbsp;</i>Retour au site</a>
                <a class="dropdown-item" href="<?=ROUTE?>logout"> <i class="fas fa-user-slash">&nbsp;&nbsp;</i>Me déconnecter</a>
            </div>
        </div>
        <!-- </ul> -->

        <?php } ?>
</nav>
