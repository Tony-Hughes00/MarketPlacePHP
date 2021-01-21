<div class="container mt-4">
    <div class="row justify-content-center">
      <h3> ESPACE PASSAGER : </h3>
    </div>
    <div class="row mx-5">
        <div class="col">
          <a class="btn btn-block btn-info <?php if (isset($_GET['consultPass'])){ echo 'active';} ?>" href="consult?consultPass" role="button">Consulter les Passagers</a>
        </div> 
        <div class="col">
          <a class="btn btn-block btn-info <?php if (isset($_GET['inscrPass'])){ echo 'active';} ?>" href="inscr?inscrPass" role="button">Enregistrer un Passager</a>     
        </div>
        <!-- <div class="col">
          <a class="btn btn-block btn-info" href="?PassDoc" role="button">Document</a>     
        </div> -->
          <div class="col">
          <a class="btn btn-block btn-info <?php if (isset($_GET['PassAdh'])){ echo 'active';} ?>" href="cotis?PassAdh" role="button">Adhésions</a>     
          </div>
    </div>
  </div>