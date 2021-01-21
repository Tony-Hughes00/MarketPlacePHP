<?php    
  require_once ROOT ."/app/Views/stats/statsObject.php";
// TrajetUtils::selectParcoursListe
$JSON = getBonNonPayePnmData($data);
// $JSON = "";
?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

<?php
// var_dump($data);
?>

<div class="row mt-5">
  <div class="col-12 text-center">
    <h4>VALIDER BONS DE TRANSPORT</h4>
    <div class="mx-auto mt-3 mb-3" style="width:40%;">
      <?php /*********** CHART 1 ************ */ ?>
        <canvas id="chartCotis"></canvas>
    </div>
    <div>
      <form method="post" action="<?=ROUTE?>validateBons" id="filtre-cotis">
        <fieldset>
          <input type="hidden" id="idPnmFiltreBons" name="idPnmFiltreBons" 
              value="<?php echo $data['idPnmFiltreBons']?>">
          <input type="hidden" id="idCommuneFiltreBons" name="idCommuneFiltreBons" 
              value="<?php echo $data['idCommuneFiltreBons']?>">
          <div class="row">
            <div class="col-12">
              <label class="" for="CommuneFiltreCotis"> Filtrer par Commune : </label> 
              <select id="CommuneFiltreCotis" name="CommuneFiltreCotis"
                    value="<?php echo $data['idCommuneFiltreBons']?>"
                    onChange="onCommuneFiltreCotis(this)">
                <option value="0">Tous</option>"<?php
                  // MembreTable::selectCommunesPassagers
                    foreach($data['communes'] as $commune) {
                      echo '<option value="' . $commune->id . '"';
                      if ($data['idCommuneFiltreBons'] == $commune->id) {
                        echo ' selected ';
                      }
                      echo '>' . $commune->nomCommune;
                      echo '</option>';    

                    }
                  ?>
              </select>
            </div>
            <div class="col-12 col-md-12">
              <label class="" for="PnmFiltreCotis"> Filtrer par Pnm : </label> 
              <select id="PnmFiltreCotis" name="PnmFiltreCotis"
                  value="<?php echo $data['idPnmFiltreBons']?>"
                  onChange="onPnmFiltreCotis(this)">
                <option value="0">Tous</option>"<?php
                // MembreTable::selectCommunesPassagers
                  foreach($data['pnms'] as $pnm) {
                    echo '<option value="' . $pnm->id_pnm . '"';
                    if ($data['idPnmFiltreBons'] == $pnm->id_pnm) {
                      echo ' selected ';
                    }
                    echo '>' . $pnm->titre_pnm;
                    echo '</option>';           
                  }
                ?>
              </select>
            </div>
            <div class="col-12 col-md-12">
              <button class="btn btn-secondary px-2 py-1" type="submit" style="padding:0px;margin-bottom:10px;" 
                >Selectionner
              </button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
  <div class="col-12 text-center">
    <div class="text-center">
      <b><u>  Les Bons de Transports attendus </u></b><br>
    </div>
    <?php
        $pnm = 0;
        foreach($data['bons'] as $bon)
        {
          // var_dump($bon);
          if ($pnm != $bon->pnmId) {
            if ($pnm > 0) {
              echo '</table></div>';
            }
            $pnm = $bon->pnmId;
            ?>
            <br>
            <span data-toggle="collapse" data-target="#pnmMembres<?=$bon->pnmId?>">
            <h4>
            <?= $bon->titre_pnm ?>
            
            <i class="fas fa-caret-square-down"></i></h4></span>

            <br>
  
      <div class="collapse" id="pnmMembres<?=$bon->pnmId?>">
      <table class="text-center bg-light mx-auto table border-1 table-hover table-sm table-responsive-md">
        <tr>
          <th> Nom</th>
          <th> Commune</th>
          <th> Membre Type</th>
          <th> Trajet</th>
          <!-- <th> Date</th> -->
          <!-- <th> Date Valide</th> -->
          <th> Valider</th> 
        </tr>
            <?php
          }
          echo '<tr>';
          echo '<td>';
          echo $bon->nom . ", " . $bon->prenom;
          ?>
          <a href="<?=ROUTE?>ficheUser.<?=$bon->id_user ?>">
                      <i class="fas fa-user-edit"alt="modifier"></i></a>
          <?php
          echo '</td>';
          echo '<td>';
          echo $bon->membreCommune;
          echo '</td>';
          echo '<td>';
          echo $bon->membre_type;
          echo '</td>';
          echo '<td>';
          echo $bon->depart . " -> " . $bon->arrivee;
          echo '</td>';
          echo '<td>';
          echo '<a href="' . ROUTE . 'valbon.' . $bon->bons_id . '"><i class="fas fa-clipboard-check" alt="modifier"></i></a>';

          echo '</td>';
          echo '</tr>';
        }
        ?>
        </table>
       </div>
    </div>
  </div>
  <div class="col-12 text-center">
    <div class="text-center">
      <b><u>  Les Bons de Transports à valider </u></b><br>
    </div>
    <?php
        $pnm = 0;
        foreach($data['bonsNonPaye'] as $bon)
        {
          // var_dump($bon);
          if ($pnm != $bon->pnmId) {
            if ($pnm > 0) {
              echo '</table></div>';
            }
            $pnm = $bon->pnmId;
            ?>
            <br>
            <span data-toggle="collapse" data-target="#pnmMembres<?=$bon->pnmId?>">
            <h4>
            <?= $bon->titre_pnm ?>
            
            <i class="fas fa-caret-square-down"></i></h4></span>

            <br>
  
      <div class="collapse" id="pnmMembres<?=$bon->pnmId?>">
      <table class="text-center bg-light mx-auto table border-1 table-hover table-sm table-responsive-md">
        <tr>
          <th> Nom</th>
          <th> Commune</th>
          <th> Membre Type</th>
          <th> Trajet</th>
          <!-- <th> Date</th> -->
          <!-- <th> Date Valide</th> -->
          <th> Valider</th> 
        </tr>
            <?php
          }
          echo '<tr>';
          echo '<td>';
          echo $bon->nom . ", " . $bon->prenom;
          ?>
          <a href="<?=ROUTE?>ficheUser.<?=$bon->id_user ?>">
                      <i class="fas fa-user-edit"alt="modifier"></i></a>
          <?php
          echo '</td>';
          echo '<td>';
          echo $bon->membreCommune;
          echo '</td>';
          echo '<td>';
          echo $bon->membre_type;
          echo '</td>';
          echo '<td>';
          echo $bon->depart . " -> " . $bon->arrivee;
          echo '</td>';
          echo '<td>';
          echo '<a href="' . ROUTE . 'valbon.' . $bon->bons_id . '"><i class="fas fa-clipboard-check" alt="modifier"></i></a>';

          echo '</td>';
          echo '</tr>';
        }
        ?>
        </table>
       </div>
    </div>
  </div>

  <script>
  function onPnmFiltreCotis(ctrl) {
    console.log(ctrl);
    $("#idPnmFiltreBons")[0].value = ctrl.value;
    $("#idCommuneFiltreBons")[0].value = 0;
    $("#CommuneFiltreCotis")[0].value = 0;

    // console.log(ctrl.value);    
  }
  function onCommuneFiltreCotis(ctrl) {
    // console.log(ctrl);
    $("#idCommuneFiltreBons")[0].value = ctrl.value;

  }

  var JSONChartCotis = <?php echo json_encode($JSON); ?>;
  var cotisJSON = JSON.parse(JSONChartCotis);
                
  var ctx = document.getElementById('chartCotis').getContext('2d');
                
  try {
    var chartCotis = new Chart(ctx, cotisJSON);
  }
  catch(err) {
    console.log("myChart Error: ", err);
  }

</script>