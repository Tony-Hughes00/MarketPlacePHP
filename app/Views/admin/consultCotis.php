<?php    
  require_once ROOT ."/app/Views/stats/statsObject.php";
// TrajetUtils::selectParcoursListe
$JSON = getCotisPnmStatus($data);
?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

<?php
// var_dump($data);
?>

<div class="row mt-5">
  <div class="col-12 text-center">
    <h4>COTISATIONS</h4>
    <div class="mx-auto mt-3 mb-3" style="width:40%;">
      <?php /*********** CHART 1 ************ */ ?>
        <canvas id="chartCotis"></canvas>
    </div>
    <div>
      <form method="post" action="<?=ROUTE?>consultCotis" id="filtre-cotis">
        <fieldset>
        <input type="hidden" id="idPnmFiltreCotis" name="idPnmFiltreCotis" 
            value="<?php echo $data['idPnmFiltreCotis']?>">
        <input type="hidden" id="idCommuneFiltreCotis" name="idCommuneFiltreCotis" 
            value="<?php echo $data['idCommuneFiltreCotis']?>">
        <div class="row">
        <div class="col-12">
          <label class="" for="CommuneFiltreCotis"> Filtrer par Commune : </label> 
            <select id="CommuneFiltreCotis" name="CommuneFiltreCotis"
                value="<?php echo $data['idCommuneFiltreCotis']?>"
                onChange="onCommuneFiltreCotis(this)">
              <option value="0">Tous</option>"<?php
              // MembreTable::selectCommunesPassagers
                foreach($data['communes'] as $commune) {
                  echo '<option value="' . $commune->id . '"';
                  if ($data['idCommuneFiltreCotis'] == $commune->id) {
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
                value="<?php echo $data['idPnmFiltreCotis']?>"
                onChange="onPnmFiltreCotis(this)">
              <option value="0">Tous</option>"<?php
              // MembreTable::selectCommunesPassagers
                foreach($data['pnms'] as $pnm) {
                  echo '<option value="' . $pnm->id_pnm . '"';
                  if ($data['idPnmFiltreCotis'] == $pnm->id_pnm) {
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
      <?php
        $pnm = 0;
        foreach($data['cotis'] as $membre)
        {
          if ($pnm != $membre->id_pnm) {
            if ($pnm > 0) {
              echo '</table></div>';
            }
            $pnm = $membre->id_pnm;
            ?>
            <br>
            <span data-toggle="collapse" data-target="#pnmMembres<?=$membre->id_pnm?>">
            <h4>
            <?= $membre->titre_pnm ?>
            
            <i class="fas fa-caret-square-down"></i></h4></span>

            <br>
  
      <div class="collapse" id="pnmMembres<?=$membre->id_pnm?>">
      <table class="text-center bg-light mx-auto table border-1 table-hover table-sm table-responsive-md">
        <tr>
          <th> Nom</th>
          <th> Commune</th>
          <th> Membre Type</th>
          <th> Type</th>
          <th> Date</th>
          <th> Date Valide</th>
          <th> Valide</th>
        </tr>
            <?php
          }
          echo '<tr>';
          echo '<td>';
          echo $membre->nom . ", " . $membre->prenom;
          ?>
          <a href="<?=ROUTE?>ficheUser.<?=$membre->id_user ?>">
                      <i class="fas fa-user-edit"alt="modifier"></i></a>
          <?php
          echo '</td>';
          echo '<td>';
          echo $membre->nomCommune;
          echo '</td>';
          echo '<td>';
          echo $membre->membre_type;
          echo '</td>';
          echo '<td>';
          echo $membre->cotis_type;
          echo '</td>';
          echo '<td>';
          echo $membre->date_cotis;
          echo '</td>';
          echo '<td>';
          echo $membre->date_cotis_valid;
          echo '</td>';
          echo '<td>';
          if ($membre->date_cotis == null) {
            echo '<span class="text-danger">Manquant</span>';
          } else {
            $timeZone = new DateTimeZone('Europe/Paris');
            $now = new DateTime(null, $timeZone);
    
            $date = $now->sub(new DateInterval('P1Y'));   // subtract 1 year
            $date = $now->add(new DateInterval('P14D'));    // add 14 days
            $date->setTime(0,0);
            if (($membre->date_cotis_valid == null) ||
              ($membre->date_cotis_valid < $date->format("Y/m/d"))) {
                echo '<span class="text-danger">à renouveler</span>';
              }
          }
          // $query = $query . " WHERE (date_cotis_valid < '" . $date->format("Y/m/d") . "'";
          // $query = $query . " OR (date_cotis IS NOT NULL AND date_cotis_valid IS NULL)) ";
          echo '';
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
    $("#idPnmFiltreCotis")[0].value = ctrl.value;
    $("#idCommuneFiltreCotis")[0].value = 0;
    $("#CommuneFiltreCotis")[0].value = 0;

    // console.log(ctrl.value);    
  }
  function onCommuneFiltreCotis(ctrl) {
    // console.log(ctrl);
    $("#idCommuneFiltreCotis")[0].value = ctrl.value;

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