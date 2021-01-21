<div class="container mt-5">
    <div class="row justify-content-center">
        <h3> ESPACE TRAJET : </h3>
    </div>
    <div class="row mx-5">
        <div class="col">
            <a class="btn btn-block btn-info <?php if(isset($_GET['consultTraj'])){ echo'active';} ?>" href="consult?consultTraj" role="button">Consulter les Trajets</a>
        </div> 
        <div class="col">
                <a class="btn btn-block btn-info <?php if(isset($_GET['inscrTraj'])){ echo'active';} ?>" href="enr?inscrTraj" role="button">Creer un Trajet</a>     
        </div>
        <div class="col">
            <a class="btn btn-block btn-info" href="?TrajMis" role="button">Mis en relation</a>     
        </div>
        <div class="col">
            <a class="btn btn-block btn-info" href="?TrajValid" role="button">Valider</a>     
        </div>
        <div class="col">
            <a class="btn btn-block btn-info" href="?TrajExport" role="button">Exporter</a>     
        </div>
    </div>
</div>