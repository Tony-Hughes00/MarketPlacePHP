<div class="container mt-4">
    <div class="row justify-content-center">
      <h3> ESPACE CHAUFFEUR BENEVOLE : </h3>
    </div>
    <div class="row mx-5">
      <div class="col">
        <a class="btn btn-block btn-info <?php if (isset($_GET['consultCond'])){ echo 'active';} ?>" href="consult?consultCond" role="button">Consulter</a>
      </div> 
      <div class="col">
        <a class="btn btn-block btn-info <?php if (isset($_GET['inscrCond'])){ echo 'active';} ?>" href="inscr?inscrCond" role="button">Enregistrer</a>     
      </div>
      <div class="col">
        <a class="btn btn-block btn-info <?php if (isset($_GET['doc'])){ echo 'active';} ?>" href="doc?docCond" role="button">Documents</a>     
      </div>
      <div class="col">
        <a class="btn btn-block btn-info <?php if (isset($_GET['eval'])){ echo 'active';} ?>" href="eval?evalCond" role="button">Evaluations</a>     
      </div>
      <div class="col">
      <a class="btn btn-block btn-info <?php if (isset($_GET['CondAdh'])){ echo 'active';} ?>" href="cotis?CondAdh" role="button">Adhésions</a>     
      </div>
    </div>
  </div>