<?php
  $timeZone = new DateTimeZone('Europe/Paris');
  $now = new DateTime(null, $timeZone);
    
  // $date = $now->sub(new DateInterval('P1Y'));   // subtract 1 year
  // $date = $now->add(new DateInterval('P14D'));    // add 14 days
  $now->setTime(0,0);

  require_once ROOT ."/app/Views/stats/statsObject.php";

// var_dump($data);
  $JSON = "{}";
  $titre = 'Export Passagers';
  $JSON = getPassagerJSON($data);
  $periodeDebut = new DateTime($data['periodeDebut']);
  $periodeFin = new DateTime($data['periodeFin']);
  $mois = array(0=>'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');

  $legend = "";

  if ($data['periodeRadio'] == 'annee') {
    $legend = 'année' . " " . $periodeDebut->format("Y");
  } else {
    if ($data['periodeRadio'] == 'semaine') {
      $legend = 'semaine' . ' - ' . $periodeDebut->format("d/m/Y") . ' à ' .$periodeFin->format("d/m/Y");
    } else {
      $month = $periodeDebut->format("m") - 1;
      $legend = $mois[$month] . " " . $periodeDebut->format("Y");
    }
  }
  ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

  <form method="post" action="exportPassagers" id="formExport"> 
<div class="container">
  <div class="row">
    <div class="col-12">
      <h3 class="text-center">  <?= $titre ?> </h3>
    </div>
    <?php 
?>
    <div class="col-2 text-right"  >
    </div>
    <div class="col-1 text-center"  >
    <a 
    onclick="submitForm('exportPassagers.prev')">
    <h1><i class="fa fa-arrow-left" aria-hidden="true"></i></h1></a>
    </div>
    <div class="col-6">
      <?php /*********** CHART 1 ************ */ ?>
        <canvas id="myChart"></canvas>
    </div>
    <div class="col-1 text-center" >
    <a 
    onclick="submitForm('exportPassagers.next')">
    <h1><i class="fa fa-arrow-right" aria-hidden="true" ></i></h1></a>
    </div>
    <div class="col-2" >
    </div>
    <div class="col-12 text-center">
      <span class="legend"><?=$legend?>
    </span>
    </div>
    <div class="col-12 exportBox">
      <!-- <form method="post" action="#" id="form-export">  -->
      <!-- <fieldset> -->
      <div class="row custom-control custom-radio custom-control-inline" style="width:100%">
      <div class="col-12 text-center">
        <h1>Options d'exportation</h1>
      </div>

      <!-- <div class="col-12">
        <legend for="technicienId">Envoyer à : </legend>  
        <select id="technicienId" name="technicienId"
          < ?php if ($data['pnmSelect'] != 'tous') {
              echo 'value=' . $data['pnmId'];
            }
          ?>
        >
        < ?php
          foreach($data['techniciens'] as $tech) {
            echo '<option value="' . $tech->users_id . '"';
            if ($data['technicienId'] == $tech->users_id) {
              echo ' selected ';
            }
            echo '>';
            echo $tech->prenom . " " . $tech->nom;
            echo '</option>';
          }
        ?>
        </select>     
      </div> -->
          <div class="col-12 col-md-4">
        <fieldset class="form-card">
          <legend>Pôle numerique</legend>
          <input type="radio" id="exportTypeTous" name="pnmSelect" value="tous" checked
              onclick="onClickRadioPnmStat(this)" 
              <?php if ($data['pnmSelect'] == 'tous') {
                echo 'checked';
              }
              ?>
              >
          <label for="exportTypeTous">Tous</label>
        <br>

        <input type="radio" id="exportTypePnm" name="pnmSelect" value="pnm"
              onclick="onClickRadioPnmStat(this)" 
              <?php if ($data['pnmSelect'] != 'tous') {
                echo 'checked';
              }
              ?>
              >
        <label for="exportTypePnm">par pnm</label>
          <div id="selectPnm" 
          <?php if ($data['pnmSelect'] == 'tous') {
            echo 'style="display:none"';
          }
          ?>
          >
            <select id="pnmId" name="pnmId"
            <?php if ($data['pnmSelect'] != 'tous') {
                echo 'value=' . $data['pnmId'];
              }
              ?>
              >
              <?php
                foreach($data['pnms'] as $pnm) {
                  echo '<option value="' . $pnm->id_pnm . '"';
                  if ($data['pnmId'] == $pnm->id_pnm) {
                    echo ' selected ';
                  }
                  echo ' onclick="onChangeRadioPnmStat(this)"';
                  echo '>';
                  echo $pnm->titre_pnm;
                  echo '</option>';
                }
              ?>
            </select>
            <br>
          </div>
          </fieldset>
          </div>
          <div class="col-12 col-md-8">
          <fieldset class="form-card">
          <legend>Période</legend>
          <div class="row">
            <div class="col-12 col-md-4">
            <input type="radio" id="periodeSemaine" name="periodeRadio" value="semaine"
                onclick="onClickRadioPeriode(this)"
                <?php if ($data['periodeRadio'] == 'semaine') {
                  echo 'checked';
                }
                ?>
                >
            <label for="periodeSemaine">Semaine en cours</label>
            </div>
            <div class="col-12 col-md-4">
            <input type="radio" id="periodeMois" name="periodeRadio" value="mois"
                onclick="onClickRadioPeriode(this)"
                <?php if ($data['periodeRadio'] == 'mois') {
                  echo 'checked';
                }
                ?>
                >
            <label for="periodeMois">Mois en cours</label>
            </div>
            <div class="col-12 col-md-4">
            <input type="radio" id="periodeAnnee" name="periodeRadio" value="annee"
                onclick="onClickRadioPeriode(this)"
                <?php if ($data['periodeRadio'] == 'annee') {
                  echo 'checked';
                }
                ?>
                >
            <label for="periodeAnnee">Année en cours</label>
            </div>
            <div class="col-12 col-md-4">
              <input type="checkbox" id="checkboxActif" name="checkboxActif"
              onclick="refreshForm('exportPassagers.noChange');"
              <?php
                if ($data['checkboxActif'] == 'on') {
                  echo ' checked ';
                }
              ?>
              >
              <label for="checkboxActif">Actif</label>
            </div>
            <div class="col-12 col-md-4">
              <input type="checkbox" id="checkboxInactif" name="checkboxInactif"
              onclick="refreshForm('exportPassagers.noChange');"
              <?php
                if ($data['checkboxInactif'] == 'on') {
                  echo ' checked ';
                }
              ?>
              >
              <label for="checkboxInactif">Inactif</label>
            </div>

          </div>
          <label for="periodeDebut" hidden>
            <strong>Début</strong>
          </label>
          <input type="date" hidden
            id="periodeDebut" name="periodeDebut"
            value="<?=$periodeDebut->format("Y-m-d")?>"> 
          <label for="periodeFin" hidden>
            <strong>Fin</strong>
          </label>
          <input type="date" hidden
            id="periodeFin" name="periodeFin"
            value="<?=$periodeFin->format("Y-m-d")?>"> 
          </fieldset>
          </div>
          <div class="col-12">
          <?php
          if (isset($data['result']['ErrorMessage'])) {
            echo '<div class="border border-danger p-3 m-3 lead">';
            echo '<h2 class="text-danger">';
            echo $data['result']['ErrorMessage'];
            echo '</h2>';
            echo '<br>';
            echo "Les données d'exportation ont été enregistrées sous:";
            echo '<br>';
            echo $data['result']['fichierChemin'];
            echo '</div>';
          } else if (isset($data['result']['SuccessMessage'])) {
            echo '<div class="col-12 border border-success p-3 m-3 w-100 lead">';
            echo '<h2 class="text-success">';
            echo $data['result']['SuccessMessage'];
            echo '</h2>';
            echo '</div>';
          }
          ?>
          </div>
          <!-- </fieldset> -->
          
          <div class="col-12">
            <input type="submit" for="exportPassagers" 
            value="Télécharger les données">                        
          </div>
        </div>
        </form>

    </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var BenefDataJSON = <?php echo json_encode($JSON); ?>;
  var BenefJSON = JSON.parse(BenefDataJSON);
                
  var ctx = document.getElementById('myChart').getContext('2d');
            
  try {
    var myChart = new Chart(ctx, BenefJSON);
  }
  catch(err) {
    console.log("myChart Error: ", err);
  }
  function onChangeSelectPnm(ctrl) {

  }

  function submitForm(action) {
    console.log("form");
    var form = document.getElementById('formExport');
    form.action = action;
    form.method = "post";
    form.submit();
  }

  function refreshForm(action) {

    var form = document.getElementById('formExport');
    form.action = action;
    form.method = "post";
    form.submit();
  }
  function onClickRadioPeriode(ctrl) {
    console.log("onClickRadio", ctrl.value);
    switch (ctrl.value) {
      case 'semaine':
        getCurrentWeek();
        break;
      case 'mois':
        getCurrentMonth();
        break;
      case 'annee':
        getCurrentYear();
        break;
    }
    refreshForm("exportPassagers.noChange");
       // console.log("onClickRadioPeriode");
    // let periodeDebutCtrl = document.getElementById('periodeDebut');

    // dateDebut = getDate("periodeDebut");

    // console.log("dateDebut", dateDebut);

    // dateFin = getDate("periodeFin");

    // console.log("dateFin", dateFin);

  }
  function setDates(firstDay, lastDay) {
    console.log('firstday', firstDay);
    console.log('lastday', lastDay.getFullYear());
    // Y-m-d
    let year = firstDay.getFullYear();
    let month = ("0" + (firstDay.getMonth() + 1)).slice(-2);
    let day = ("0" + firstDay.getDate()).slice(-2);

    let dateDebut = year + "-" + month + "-" + day;
    console.log("dateDebut", dateDebut);
    let periodeDebut = document.getElementById('periodeDebut');
    // periodeDebut.value = firstDay.toISOString().slice(0,10);
    periodeDebut.value = dateDebut;
    console.log('periodeDebut.value', periodeDebut.value);

    year = lastDay.getFullYear();
    month = ("0" + (lastDay.getMonth() + 1)).slice(-2);
    day = ("0" + lastDay.getDate()).slice(-2);

    let dateFin = year + "-" + month + "-" + day;
    console.log("dateFin", dateFin);
    let periodeFin = document.getElementById('periodeFin');
    periodeFin.value = dateFin;
    console.log('periodeFin', periodeFin);
  }
  function getCurrentWeek() {
    var curr = new Date; // get current date
    var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
    var last = first + 6; // last day is the first day + 6

    var firstDay = new Date(curr.setDate(first));
    var lastDay = new Date(curr.setDate(last));

    setDates(firstDay, lastDay);

  }
  function getCurrentMonth() {
    var date = new Date();

    var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

    setDates(firstDay, lastDay);
  }
  function getCurrentYear() {
    var firstDay = new Date(new Date().getFullYear(), 0, 1);
    var lastDay = new Date(new Date().getFullYear(), 11, 31);
    console.log("getCurrentYear firstDay", firstDay);
    console.log("getCurrentYear lastDay", lastDay);
    setDates(firstDay, lastDay);
  }
  function getDate(nomCtrl) {

    date = new Date();

    let ctrl = document.getElementById(nomCtrl);

    year = ctrl.value.substring(0,4);
    month = ctrl.value.substring(8,10) - 1;
    day = ctrl.value.substring(5,7);

    date.setFullYear(year);
    date.setMonth(month);
    date.setDate(day);

    return date;
  }
  function adjustPeriode(direction) {
    console.log("adjustPeriode", direction);
    let periodeDebut = document.getElementById('periodeDebut');
    let periodeFin = document.getElementById('periodeFin');
    let periodeRadio = document.getElementById('periodeRadio');

    switch (periodeRadio.value) {
      case 'semaine':

        break;
      case 'mois':

        break;
      case 'annee':

        break;
    }
 }
  function onClickPrevious() {
    adjustPeriode('previous');
  }
  function onClickNext() {
    adjustPeriode('next');
  }

  function onClickRadioPnmStat(ctrl) {
    console.log('onClickRadioPnmStat');
    let selElement = document.getElementById("selectPnm");

    if (ctrl.value == 'tous' ) {
      selElement.style.display = "none";
      refreshForm("exportPassagers.noChange");
    } else {
      selElement.style.display = "block";
    }
  }
  function onChangeRadioPnmStat(ctrl) {
    console.log('onChangeRadioPnmStat');
    refreshForm("exportPassagers.noChange");
  }
</script>