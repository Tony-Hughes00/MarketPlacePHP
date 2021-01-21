<!-- test consult -->
<?php
  require_once ROOT ."/app/Views/stats/statsObject.php";
  $JSONPassager = getPassagerInscrTypeJSON($data);
  $JSONChauffeur = getChauffeurInscrTypeJSON($data);

?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

<div class="container" onload="onLoad()">
  <div class="row" style="margin-top: -40px;" >
      <div class="col-12 col-md border border-success pb-3 mb-3" style="border-radius:40px;">
   
    <img class="float-left p-2" style="height:70px;" src="<?=RACINE?>images/icons8-passager-80.png"> 
    <h3 class="bg-success" style="border-radius: 30px;">  PASSAGERS </h3>
      <!-- MembreTable::selectPassagers -->

    <span><b>Total : <?= count($data["passagers"])?> pers </b></span>
    <span class="float-right"><u>Nouveaux inscrits/semaine :</u>
        <b class="text-primary"><a href="consult?consultPass"><?= count($data['nouveauxPassagers'])?></a></b>
    </span>
    <div>
  
    <div class="my-3">
      <?php /*********** CHART 1 ************ */ ?>
        <canvas id="chartPassager"></canvas>
    </div>
    <br>
    <div  id="collapsePassagers">
    <form method="get" action="<?=ROUTE?>consultUser" id="filtre-passagers"
    class="mb-3">
    <fieldset>
    <input type="hidden" id="idCommuneFiltrePassager" name="idCommuneFiltrePassager" value="<?=$data['idFiltrePassager']?>">
    <input type="hidden" id="idCommuneFiltrePassagerChauffeur" name="idCommuneFiltrePassagerChauffeur" value="<?=$data['idFiltreChauffeur']?>">
    <div class="row bg-light">
      <div class="col-12 text-center">
        <label class="" for="CommuneFiltre"> Filtrer par Commune : </label> 
        <select id="CommuneFiltre" name="CommuneFiltre"
            value="0"
            onChange="onCommuneFiltrePassager(this)">
          <option value="0">Tous</option>"<?php
            foreach($data['communeFiltrePassagers'] as $commune) {
              echo '<option value="' . $commune->id . '">' . $commune->nomCommune . '</option>';           
            }
          ?>
        </select>
      </div>
      <div class="col-12">
        <div class="row bg-light">
          <div class="col-md-4 col-4 offset-md-2 offset-1">
            <label class="" for="passagerStatus"> Filtrer par Statut : </label> 
          </div>
          <div class="col-md-2 col-3 float-left">
            <input type="radio" id="passagerStatusActive" name="passagerStatus"
              value="actif" class=""
              <?= (isset($data['passagerStatus']) && $data['passagerStatus'] == 'actif') ? 'checked' : false; ?>
              >
              <label class="" for="passagerStatusActive">Actif</label> 
          </div>
          <div class="col-md-2 col-3 float-left">
            <input type="radio" id="passagerStatusInactive" name="passagerStatus"
              value="inactif" class=""
              <?= (isset($data['passagerStatus']) && $data['passagerStatus'] == 'inactif') ? 'checked' : false; ?>
              >
              <label class="" for="passagerStatusInactive">Inactif</label> 
          </div>
        </div>
      </div>
      <div class="col-12 text-center bg-light">
        <button class="btn btn-secondary px-2 py-1" type="submit" style="padding:0px;margin-bottom:10px;">Selectionner</button>
      </div>
    </div>
    </fieldset>

    </form>
        
      <?php 
      $pnm = 0;
      // var_dump($data['passagers']);
      foreach($data["passagers"] as $passager) { 
        if ($pnm != $passager->idPnm) {
          if ($pnm > 0) {
            echo '</table></div>';
          }
          $pnm = $passager->idPnm;
          ?>
          <!-- <br> -->
          <div class="text-center">
            <span data-toggle="collapse" data-target="#pnmPassagers<?=$passager->idPnm?>">
            <b><?= $passager->nomPnm?></b>
            <i class="fas fa-caret-square-down"></i>
            </span>
          </div>
          <!-- <br> -->
          <div class="collapse" id="pnmPassagers<?=$passager->idPnm?>">
    <table class="align-center text-center bg-light mx-auto table border-1 table-hover responsive-sm">
      <tr>
        <!-- <th> PASSAGERS </th> -->
        <th> </th>
        <th> Nom</th>
        <th> Inscription</th>   
        <th> Commune</th>
      </tr>
          <?php
        }
        ?>
      <tr class="table-secondary">
        <td><a href="ficheUser.<?=$passager->users_id?>"><i class="fas fa-edit"alt="modifier"></i></a></td>
        <td> <?= $passager->nom . ', ' . $passager->prenom ?></td>
        <td> <?php
        if ( $passager->users_id == $passager->created_by) {
          echo 'en ligne';
        } else {
          echo 'pnm';
        }
          ?></td>   
        <!-- <td> < ?= $passager->prenom ?></td>    -->
        <td> <?= $passager->nomCommune ?></td> 
      </tr>
      <?php } 
      if (count($data["passagers"])) {
        echo '</table></div></div>';
      } else {
        echo '</div>';
      }
      ?>
    <!-- </table> -->
    <!-- </div> -->
      <!-- </div> -->
    
      </div>
    <!-- < ?php var_dump($data['cotisManquantPassager']); ?> -->
   
 
    

    </div>
    <div class="col-12 col-md border border-success pb-2 mb-3" style="border-radius:40px;">
      <img class="float-left p-2" style="height:70px;" src="<?=RACINE?>images/icons8-chauffeur-80.png"> 
      <h3 class="bg-success" style="border-radius: 30px;"> CHAUFFEURS </h3>
      <span><b>Total : <?= count($data["chauffeurs"])?> pers </b></span>
      <span class="float-right"><u>Nouveaux inscrits / semaine :</u>
      <b class="text-primary"><a href="consult?consultCond"> <?= count($data['nouveauxChauffeurs'])?></a></b></span>
   
      <div class="my-3">
        <?php /*********** CHART 1 ************ */ ?>
          <canvas id="chartChauffeur"></canvas>
      </div>
      <br>
      <div class="" id="collapseChauffeur">
        <form method="get" action="<?=ROUTE?>consultUser" id="filtre-chauffeurs"
        class="mb-3">
          <fieldset>
            <input type="hidden" id="idCommuneFiltreChauffeur" name="idCommuneFiltreChauffeur" value="<?=$data['idFiltreChauffeur']?>">
            <input type="hidden" id="idCommuneFiltreChauffeurPassager" name="idCommuneFiltreChauffeurPassager" value="<?=$data['idFiltrePassager']?>">
            <div class="row bg-light">
              <div class="col-12 text-center">
                <label class="" for="CommuneFiltreChauffeur"> Filtrer par Commune : </label> 
                <select id="CommuneFiltreChauffeur" name="CommuneFiltreChauffeur"
                    value="0"
                    onChange="onCommuneFiltreChauffeur(this)">
                  <option value="0">Tous</option>"<?php
                    foreach($data['communeFiltreChauffeurs'] as $commune) {
                      echo '<option value="' . $commune->id . '">' . $commune->nomCommune . '</option>';           
                    }
                  ?>
                </select>
              </div>
              <div class="col-12 bg-light">
                <div class="row">
                  <div class="col-md-4 col-4 offset-md-2 offset-1"> 
                    <label class="" for="chauffeurStatus"> Filtrer par Statut : </label> 
                  </div>
                  <div class="col-md-2 col-3 float-left">
                    <input type="radio" id="chauffeurStatusActive" name="chauffeurStatus"
                    value="actif" class=""
                    <?= (isset($data['chauffeurStatus']) && $data['chauffeurStatus'] == 'actif') ? 'checked' : false; ?>
                    >
                    <label class="" for="chauffeurStatusActive">Actif</label> 
                  </div>
                  <div class="col-md-2 col-3 float-left">
                    <input type="radio" id="chauffeurStatusInactive" name="chauffeurStatus"
                      value="inactif" class=""
                      <?= (isset($data['chauffeurStatus']) && $data['chauffeurStatus'] == 'inactif') ? 'checked' : false; ?>
                      >
                      <label class="" for="chauffeurStatusInactive">Inactif</label> 
                  </div>
                </div>
              </div>
              <div class="col-12 text-center bg-light">
                <button class="btn btn-secondary px-2 py-1" type="submit" style="padding:0px;margin-bottom:10px;" 
                    >Selectionner</button>
              </div>
            </div>
          </fieldset>
        </form>

        <?php 
        $pnm = 0;
        foreach($data["chauffeurs"] as $chauffeur) { 
          
          if ($pnm != $chauffeur->idPnm) {
            if ($pnm > 0) {
              echo '</table></div>';
            }
            $pnm = $chauffeur->idPnm;
            ?>
            <!-- <br> -->
            <div class="text-center">
            <span data-toggle="collapse" data-target="#pnmChauffeurs<?=$chauffeur->idPnm?>">
              <b><?= $chauffeur->nomPnm?></b>
              <i class="fas fa-caret-square-down"></i>
            </span>
            </div>
            <!-- <br> -->

        <div class="collapse" id="pnmChauffeurs<?=$chauffeur->idPnm?>">
          <table class="text-center bg-light mx-auto table border-1 table-hover table-responsive-md">
            <tr>
              <!-- <th> PASSAGERS </th> -->
              <th> </th>
              <th> Nom</th>
              <th> Inscription</th>   
              <th> Commune</th>
            </tr>
                <?php
              }
              ?>
            <tr class="table-secondary">
              <td><a href="ficheUser.<?=$chauffeur->users_id?>"><i class="fas fa-edit"alt="modifier"></i></a></td>
              <td> <?= ucfirst($chauffeur->nom) . ', ' . ucfirst($chauffeur->prenom) ?></td>
              <td> <?php
              if ( $chauffeur->users_id == $chauffeur->created_by) {
                echo 'en ligne';
              } else {
                echo 'pnm';
              }
                ?></td>  
              <td> <?= $chauffeur->nomCommune?></td> 
            </tr>
            <?php } 
            if (count($data["chauffeurs"])) {
              echo '</table>';
            }
            ?>

        </div>
      </div>
    </div>
    </div>

    <div class="row mt-4">
      <div class="col mx-2 bg-secondary text-center" style="border-radius:30px;">
       <a href="inscr?inscrPass" type="button" class=" m-2 btn btn-md btn-outline-light">Enregistrer un nouveau passager</a>
      </div>
      <div class="col mx-2 bg-secondary text-center" style="border-radius:30px;">
       <a href="inscr?inscrCond" type="button" class="m-2 btn btn-md btn-outline-light">Enregistrer un nouveau chauffeur</a>
      </div>
    </div>
    <!-- </table> -->


    </div>
</div>
</div>
<script>
  function onLoad() {
    console.log('onload');
    let selectCommunePassager = document.getElementById("CommuneFiltre");
    selectCommunePassager.value = <?=$data['idFiltrePassager']?>;
    let selectCommuneChauffeur = document.getElementById("CommuneFiltreChauffeur");
    selectCommuneChauffeur.value = <?=$data['idFiltreChauffeur']?>;

    onCommuneFiltrePassager(selectCommunePassager);
    onCommuneFiltreChauffeur(selectCommuneChauffeur);
  }
  function onCommuneFiltrePassager(ctrl) {
    console.log(ctrl);
    document.getElementById("idCommuneFiltrePassager").value = ctrl.value;
    document.getElementById("idCommuneFiltreChauffeurPassager").value = ctrl.value;
    console.log(ctrl.value);
  }
  function onCommuneFiltreChauffeur(ctrl) {
    console.log(ctrl);
    document.getElementById("idCommuneFiltreChauffeur").value = ctrl.value;
    document.getElementById("idCommuneFiltrePassagerChauffeur").value = ctrl.value;
    console.log(ctrl.value);
  }
  onLoad();
  var JSONPassager = <?php echo json_encode($JSONPassager); ?>;
  var passagerJSON = JSON.parse(JSONPassager);
                
  var ctx = document.getElementById('chartPassager').getContext('2d');
                
  try {
    var chartPassager = new Chart(ctx, passagerJSON);
  }
  catch(err) {
    console.log("myChart Error: ", err);
  }

  var JSONChauffeur = <?php echo json_encode($JSONChauffeur); ?>;
  var chauffeurJSON = JSON.parse(JSONChauffeur);

  var ctxChauffeur = document.getElementById('chartChauffeur').getContext('2d');

  try {
    var chartChauffeur = new Chart(ctxChauffeur, chauffeurJSON);
  }
  catch(errChauffeur) {
    console.log('chart chauffeur error', errChauffeur);
  }

</script>