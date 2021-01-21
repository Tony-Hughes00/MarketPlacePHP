<?php 
  require_once ROOT ."/app/Views/stats/statsObject.php";

function date_full(){
  $mois = array(1=>'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
  $jours = array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
  echo ucfirst($jours[date('w')]).' '.date('j').' '.$mois[date('n')].' '.date('Y'); }
?>
<?php
// var_dump($data);
?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

<div class="container">
  <div class="row">
    <div class="col">
      <?php //var_dump($_SESSION)?>
   <h3>TABLEAU DE BORD PNM :</h3>
   <p> Bonjour <?=ucfirst($_SESSION['transport-solidaire']['prenom']).' '. ucfirst($_SESSION['transport-solidaire']['nom'])?>, nous sommes le <?= date_full(); ?></p>
    </div>
  </div>

  <div class="row text-center" style="border-style: none solid none; border-width: 3px; border-radius: 40px;">
    <div class="col-12 p-2 mb-1" style="border-radius: 40px; background-color:#6cbb5e ; border-style: solid; border-width: 3px;">
      <h4>Ces 7 derniers jours :</h4> 
    </div>
    <div class="col-12 col-md-6 p-4">
      <h5> <u> NOUVEAUX PASSAGERS</u></h5>
      <img class="d-block mx-auto mt-2 mb-0" style="height:60px;" src="<?=RACINE?>images/icons8-passager-80.png"> 
      <?php $docPassagerJSON = getNouveuxPassagerChartData($data);
        if (count($data['passagers']) == 0) {
        echo '<span class="text-secondary"><i>Aucun nouveau passager</i></span>';
        } else { ?>
        <!-- <div class="col-8 mx-auto"> -->
        <?php /*********** CHART 1 ************ */ ?>
          <!-- <canvas id="chartPassagers"></canvas> -->
         <!-- </div> -->
        <?php $pnmLabel = "";
        echo '<ul style="padding-left:0px;">';
        echo '<div style="margin-top:-20px">';

        // TableMembre::selectNouveauxPassagers
          foreach($data['passagers'] as $p) { 
            if ($pnmLabel != $p->titre_pnm) {
              $pnmLabel = $p->titre_pnm;
              echo '</div>';
              echo '<br><span data-toggle="collapse" data-target="#tdbPassagers' . $p->id_pnm . '">';
              echo $p->titre_pnm . ' <i class="fas fa-caret-square-down"></i></span>';
              echo '<div class="collapse" id="tdbPassagers' . $p->id_pnm . '">';
            }
            echo '<li>';
            echo '<a href="' . ROUTE . 'ficheUser.' . $p->users_id . '">';
            echo $p->civilite . ' ' . $p->nom . ' - ' . $p->commune . ' - ';
            if ($p->statut == "admin" || $p->statut == "conseiller") {
              echo 'insc PNM : ';
            } else {
              echo 'insc Internet : ';
            }
            echo $p->created_at;
            echo '</a>';
            echo '</li>';
          } ?>
        </div>
        </ul>
        <?php } ?>
    </div>
    <div class="col-12 col-md-6 p-4" >
      <h5><u> NOUVEAUX CHAUFFEURS</u></h5> 
      <img class="d-block mx-auto mt-2 mb-0" style="height:60px;" src="<?=RACINE?>images/icons8-chauffeur-80.png"> 

      <?php $docChauffeurJSON = getNouveuxChauffeurChartData($data);
      if (count($data['chauffeurs']) == 0) {
        echo '<span class="text-secondary"><i>Aucun nouveau chauffeur</i></span>';
      } else { ?>
        <!-- <div class="col-8 mx-auto"> -->
        <?php /*********** CHART 1 ************ */ ?>
          <!-- <canvas id="chartChauffeurs"></canvas> -->
      <!-- </div> -->
      <?php $pnmLabel = "";
        echo '<ul style="padding-left:0px;"><div style="margin-top:-20px">';
        foreach($data['chauffeurs'] as $p) { 
          if ($pnmLabel != $p->titre_pnm) {
            $pnmLabel = $p->titre_pnm;
            echo '</div>';
            echo '<br><span data-toggle="collapse" data-target="#tdbChauffeurs' . $p->id_pnm . '">';
            echo $p->titre_pnm . ' <i class="fas fa-caret-square-down"></i></span>';

            echo '<div class="collapse" id="tdbChauffeurs' . $p->id_pnm . '">';
          }
          echo '<li>';
          echo '<a href="' . ROUTE . 'ficheUser.' . $p->users_id . '">';
          echo $p->civilite . ' ' . $p->nom . ' - ' . $p->commune . ' - ';
          if ($p->statut == "admin" || $p->statut == "conseiller") {
            echo 'insc PNM : ';
          } else {
            echo 'insc Internet : ';
          }
          echo $p->created_at;
          echo '</a>';
          echo '</li>';
        }
        echo '</div>';
        echo "</ul>";
      }
      ?>

    </div>    
  </div>
  <div class="row text-center" style="border-style: none solid solid solid;  border-radius: 40px; border-width: 3px;">
    <div class="col-12 col-md-6 p-4 ">
      <h5> <u> NOUVEAUX TRAJETS</u></h5>
      <img class="d-block mx-auto mt-2 mb-0" style="height:80px;" src="<?=RACINE?>images/car.png"> 
      <ul style="padding-left:0px;">
        <?php $trajetsJSON = getTrajetsChartData($data);
        if (count($data['trajets']) == 0) {
          echo '<span class="text-secondary" ><i style="margin-top:-40px;">Aucun nouveau trajet</i></span>';
        } else { ?>
        <!-- <div class="col-8 mx-auto"> -->
        <?php /*********** CHART 1 ************ */ ?>
          <!-- <canvas id="chartTrajets"></canvas> -->
        <!-- </div> -->
        <?php $pnmLabel = "";
        
        echo '<div style="margin-top:-20px">';
        foreach($data['trajets'] as $t) { 
          if ($pnmLabel != $t->titre_pnm) {
            $pnmLabel = $t->titre_pnm;
            echo '</div>';
            echo '<br><span data-toggle="collapse" data-target="#tdbNvoTraj' . $t->id_pnm . '">';
            echo $t->titre_pnm . ' <i class="fas fa-caret-square-down"></i></span>';

            echo '<div class="collapse" id="tdbNvoTraj' . $t->id_pnm . '">';
          }
          echo '<li>';
          echo '<a href="' . ROUTE . 'detailParcours.' . $t->parcoursId . '">';
          if ($t->date_debut == null) {
            echo "disponibilité ";
          } else {
            if($t->motif == 0) {
              echo '<b>Offre :</b> ' ;
            }else {
              echo '<b>Demande :</b> ' ;
            }
            echo ' <b>' . $t->depart . ' -> ' . $t->arrivee . '</b><br>';
            echo  $t->date_debut . ' au ' . $t->date_fin ;
          if($t->statut == 0) {
            echo ' (Non attribué)';
          } else if($t->statut == 1){
            echo ' (A valider)';
          } else if($t->statut == 2){
          echo ' (Attibué)';
        }
          echo '</a>';
          echo '</li>';
        }
        }
      }
        ?>
      </ul>
    </div>
    <div class="col-12 col-md-6 p-4" >
      <h5><u> NOUVELLES MISES EN RELATION </u></h5> 
      <img class="d-block mx-auto mt-4 mb-0" style="height:50px;" src="<?=RACINE?>images/computer.png">
      <ul style="padding-left:0px;">
        <?php
          $relationsJSON = getMisEnRelationChartData($data);
          if (count($data['relation']) == 0) {
          echo '<span class="text-secondary"><i>Aucune mise en relation à valider</i></span>';
        } else { ?>
          <!-- <div class="col-8 mx-auto"> -->
          <?php /*********** CHART 1 ************ */ ?>
            <!-- <canvas id="chartRelations"></canvas> -->
          <!-- </div> -->
          <?php  $pnmLabel = "" ;
          echo '<div style="margin-top:-20px">';

          foreach($data['relation'] as $r) { 
            if ($pnmLabel != $r->titre_pnm) {
              $pnmLabel = $r->titre_pnm;
              echo '</div>';
              echo '<br><span data-toggle="collapse" data-target="#tdbRelations' . $r->id_pnm . '">';
              echo $r->titre_pnm . ' <i class="fas fa-caret-square-down"></i></span>';

              echo '<div class="collapse" id="tdbRelations' . $r->id_pnm . '">';
            }
            echo '<li>';
            echo '<a href="' . ROUTE . 'detailParcours.' . $r->parcoursId . '">';
            if ($r->date_debut == null) {
              echo "disponibilité ";
            } else {
              echo $r->date_debut;
            }
            echo ' - ' . $r->depart . ' -> ' . $r->arrivee;
            echo '</a>';
            echo '</li>';
          }
        } ?>
      </ul>
    </div>    
  </div>

  <div class="row text-center mt-2" style=" border-style: none solid solid solid; border-radius: 40px; border-width: 3px;">
    <div class="col-12 p-2" style="background-color:#ced9dd; border-style: solid ; border-radius: 40px; border-width: 3px;">
      <h4>MISES À JOUR ATTENDUES : </h4>
    </div>

    <div class="col-12 col-md-6 p-4">
      <h5><u> DOCUMENTS</u></h5>
      <img class="d-block mx-auto mt-2 mb-0" style="height:80px;" src="<?=RACINE?>images/dossier.png">
      <div class="row">        
        <?php
        $nomDocs = array(
          'permis'  => "Permis",
          'permis_valide' => "Attestation de validité",
          'carte_grise' => "Carte grise",
          'attestation_assurance' => "Assurance",
          'controle_technique' => "Contrôle technique",
          'rib' => "RIB"
        );
        $docManquantJSON = getDocManquantChartData($data);
        ?>
      </div>
      <div id="docManquantList">
        <?php
        if (count($data['docManquant']) == 0) {
          echo '<span class="text-secondary"><i>Aucun document manquant</i></span>';
        } else { ?>
          <!-- <div class="col-8 mx-auto"> -->
          <?php /*********** CHART 1 ************ */ ?>
          <b> Document Manquant : </b>
            <!-- <canvas id="chartDocManquant"></canvas> -->
          <!-- </div> -->
          <?php
          $pnmLabel = "";
          $userId = 0;
          echo '<ul style="padding-left:0px;"><div style="margin-top:-20px">';
          foreach($data['docManquant'] as $d) { 
            if ($pnmLabel != $d->titre_pnm) {
              $pnmLabel = $d->titre_pnm;
              echo '</div>';
              echo '<br><span data-toggle="collapse" data-target="#tdbManquant' . $d->id_pnm . '">';
              echo $d->titre_pnm . ' <i class="fas fa-caret-square-down"></i></span>';

              echo '<div class="collapse" id="tdbManquant' . $d->id_pnm . '">';
            }
            if ($userId != $d->users_id) {
              $userId = $d->users_id;
              echo '<li>';
              echo '<a href="' . ROUTE . 'ficheUser.' . $d->users_id . '">';
              echo $d->civilite . ' ' . ucfirst($d->nom) . ' - insc : ' . $d->created_at ;
              echo '</a><br>';
            }
            // echo $nomDocs[$d->doc_type] . '<br>';
            echo '</li>';
          }
          echo '</div>';
          echo "</ul>";
        } ?>
      </div>
      <div id="docRenouvList">
        <b> Document à renouveler : </b>
        <?php
        $docRenouvellerJSON = getDocRenouvellerChartData($data);
        $nomDocs = array(
                    'permis'  => "Permis de conduire",
                    'permis_valide' => "Validité du permis",
                    'carte_grise' => "Carte grise",
                    'attestation_assurance' => "Assurance",
                    'controle_technique' => "Contrôle technique",
                    'rib' => "RIB"
                  );
        if (count($data['docRenouveller']) == 0) {
          echo '<span class="text-secondary"><i>Aucun document à renouveler</i></span><br>';
        } else { ?>
          <!-- <div class="col-8 mx-auto"> -->
          <?php /*********** CHART 1 ************ */ ?>
            <!-- <canvas id="chartDocRenouveller"></canvas> -->
          <!-- </div> -->
          <?php
           $pnmLabel = "";
           $userId = 0;
          echo '<ul style="padding-left:0px;"><div>';
          foreach($data['docRenouveller'] as $d) { 
            if ($pnmLabel != $d->titre_pnm) {
              $pnmLabel = $d->titre_pnm;
              echo '</div>';
              echo '<span data-toggle="collapse" data-target="#tdbRenouv' . $d->id_pnm . '">';
              echo $d->titre_pnm . ' <i class="fas fa-caret-square-down"></i></span>';

              echo '<div class="collapse" id="tdbRenouv' . $d->id_pnm . '">';
            }
            if ($userId != $d->users_id) {
              $userId = $d->users_id;
              echo '<li>';
              echo '<a href="' . ROUTE . 'ficheUser.' . $d->users_id . '">';
              // echo $d->civilite . ' ' . $d->nom . '  exp : ' . $d->expiration;
              echo $d->civilite . ' ' . $d->nom . ' - insc : ' . $d->created_at;

              echo '</a>';
            }
            // echo $nomDocs[$d->doc_type] . '<br>';
            echo '</li>';
          }
          echo "</div>";
          echo "</ul>";
      
        }
        $docInvalideJSON = getDocInvalideChartData($data);
        ?>
      </div>
            <!-- <i class="fas fa-bell text-danger"></i><b>   A valider : </b> -->
  <b>Document à valider : </b>
<?php
  if (count($data['docsInvalide']) == 0) {
    echo '<span class="text-secondary"><i>Aucun document à valider</i></span>';
  } else { ?>
    <div class="col-8 mx-auto">
    <?php /*********** CHART 1 ************ */ ?>
  

      <!-- <canvas id="chartDocInvalide"></canvas> -->
  </div>
  <?php
  $pnmLabel = "";
  $userId = 0;
    echo '<ul style="padding-left:0px;"><div style="margin-top:-20px">';
    foreach($data['docsInvalide'] as $d) { 
      if ($pnmLabel != $d->titre_pnm) {
        $pnmLabel = $d->titre_pnm;
        echo '</div>';
        echo '<br><span data-toggle="collapse" data-target="#tdbInvalide' . $d->id_pnm . '">';
        echo $d->titre_pnm . ' <i class="fas fa-caret-square-down"></i></span>';

        echo '<div class="collapse" id="tdbInvalide' . $d->id_pnm . '">';
      }
      if ($userId != $d->users_id) {
        $userId = $d->users_id;
        echo '<li>';
        echo '<a href="' . ROUTE . 'ficheUser.' . $d->users_id . '">';
        // echo $d->civilite . ' ' . $d->nom . ' - exp : ' . $d->expiration;
        echo $d->civilite . ' ' . $d->nom . ' - insc : ' . $d->created_at ;

        echo '</a><br>';
      }
      // echo $nomDocs[$d->doc_type] . '<br>';
      echo '</li>';
    }
    echo "</ul>";
  }
?>

    </div> 

      <div class="col-12 col-md-6 p-4" style="border-width: 4px !important;">
       <span class="w-100 p-2" >
       <h5><u> COTISATIONS </u></h5>
        <img class="mx-auto" style="height:80px;" src="<?=RACINE?>images/money3.png">
</span>
       <b>   Manquantes : </b>
       <?php
          $cotisManquantJSON = getCotisManquantChartData($data);
          if (count($data['cotisManquant']) == 0) {
          echo '<span class="text-secondary"><i>Aucune cotisation manquante</i></span>';
        } else {
          ?>
          <!-- <div class="col-8 mx-auto"> -->
          <?php /*********** CHART 1 ************ */ ?>
            <!-- <canvas id="chartCotisManquant"></canvas> -->
        <!-- </div> -->
        <?php
          $pnmLabel = "";
          echo '<ul style="padding-left:0px;"><div style="margin-top:-20px">';
          foreach($data['cotisManquant'] as $c) { 
            if ($pnmLabel != $d->titre_pnm) {
              $pnmLabel = $d->titre_pnm;
              echo '</div>';
              echo '<br><span data-toggle="collapse" data-target="#tdbCotisManquant' . $d->id_pnm . '">';
              echo $d->titre_pnm . ' <i class="fas fa-caret-square-down"></i></span>';

              echo '<div class="collapse" id="tdbCotisManquant' . $d->id_pnm . '">';
            }
            echo '<li>';
            echo '<a href="' . ROUTE . 'ficheUser.' . $c->id_user . '">';
            echo $c->civilite . ' ' . $c->nom . ' - insc : ' . $c->insc_date ;
            // echo 'date d\'expiration : ' . $c->date_cotis_valid;
            echo '</a>';
            echo '</li>';
          }
          echo "</ul>";
        }
   
        ?>
           
          <b> A renouveler</b>
        <?php
          $cotisRenouvellerJSON = getCotisRenouvellerChartData($data);
          // var_dump($data['cotisRenouveller']);
          if (count($data['cotisRenouveller']) == 0) {
          echo '<span class="text-secondary"><i>Aucune cotisation à renouveler</i></span>';
        } else { 

          ?>
          <!-- <div class="col-8 mx-auto"> -->
          <?php /*********** CHART 1 ************ */ ?>
       
            <!-- <canvas id="chartCotisRenouveller"></canvas> -->
        <!-- </div> -->
        <?php
          $pnmLabel = "";
          echo '<ul style="padding-left:0px;"> <div style="margin-top:-20px;">';
          foreach($data['cotisRenouveller'] as $c) { 
            if ($pnmLabel != $d->titre_pnm) {
              $pnmLabel = $d->titre_pnm;
              echo '</div>';
              echo '<br><span data-toggle="collapse" data-target="#tdbCotisRenouveller' . $d->id_pnm . '">';
              echo $d->titre_pnm . ' <i class="fas fa-caret-square-down"></i></span>';

              echo '<div class="collapse" id="tdbCotisRenouveller' . $d->id_pnm . '">';
            }
            echo '<li>';
            echo '<a href="' . ROUTE . 'ficheUser.' . $c->id_user . '">';
            echo $c->civilite . ' ' . $c->nom ;

            echo ' - Exp : ';
            if ($c->date_cotis_valid != null) {
              echo $c->date_exp;
              // echo date('d-m-Y', strtotime('+1 year', $c->date_cotis_valid));
            } else {
              echo $c->date_cotis;
            }
            echo '</a>';
            echo '</li>';
          }
      
          echo "</ul>";
        }
        ?>
      </div>
      </div>   
  </div>
</div>
<script type="text/javascript">
  var docManquantJSON = <?php echo json_encode($docManquantJSON); ?>;
  var docManquant = JSON.parse(docManquantJSON);
                
  var docManquantElement = document.getElementById('chartDocManquant');

  if (docManquantElement) {   
    try {
      var ctx = docManquantElement.getContext('2d');
      var chartDocManquant = new Chart(ctx, docManquant);
      console.log('chartDocManquant', chartDocManquant.options);
      chartDocManquant.options.legend.display = false;
      chartDocManquant.options.title.text = "Manquant";
      chartDocManquant.options.title.display = true;
    }
    catch(err) {
      console.log("chartDocManquant Error: ", err);
    }
  }
  var docInvalideJSON = <?php echo json_encode($docInvalideJSON); ?>;
  var docInvalide = JSON.parse(docInvalideJSON);
                
  var docInvalideElement = document.getElementById('chartDocInvalide');
            
  if (docInvalideElement) {
    try {
      var ctx = docInvalideElement.getContext('2d');
      var chartDocInvalide = new Chart(ctx, docInvalide);
      console.log('chartDocInvalide', chartDocInvalide.options);
      chartDocInvalide.options.legend.display = false;
      chartDocInvalide.options.title.text = "A Valider";
      chartDocInvalide.options.title.display = true;
    }
    catch(err) {
      console.log("chartDocInvalide Error: ", err);
    }
  }
  var cotisManquantJSON = <?php echo json_encode($cotisManquantJSON); ?>;
  var cotisManquant = JSON.parse(cotisManquantJSON);
                
  var cotisManquantElement = document.getElementById('chartCotisManquant');

  if (cotisManquantElement) {
    try {
      var ctx = cotisManquantElement.getContext('2d');
      var chartCotisManquant = new Chart(ctx, cotisManquant);
      console.log('chartCotisManquant', chartDocInvalide.options);
      chartCotisManquant.options.legend.display = false;
      chartCotisManquant.options.title.text = "Manquant";
      chartCotisManquant.options.title.display = true;
    }
    catch(err) {
      console.log("chartCotisManquant Error: ", err);
    }
  }

  var cotisRenouvellerJSON = <?php echo json_encode($cotisRenouvellerJSON); ?>;
  var cotisRenouveller = JSON.parse(cotisRenouvellerJSON);
                
  var cotisRenouvellerElement = document.getElementById('chartCotisRenouveller');
  if (cotisRenouvellerElement) {
    try {
      var ctx = cotisRenouvellerElement.getContext('2d');
      var chartCotisRenouveller = new Chart(ctx, cotisRenouveller);
      console.log('chartCotisRenouveller', chartCotisRenouveller.options);
      chartCotisRenouveller.options.legend.display = false;
      chartCotisRenouveller.options.title.text = "A Renouveler";
      chartCotisRenouveller.options.title.display = true;
    }
    catch(err) {
      console.log("chartCotisRenouveller Error: ", err);
    }
  }
  var docChauffeurJSON = <?php echo json_encode($docChauffeurJSON); ?>;
  var docChauffeur = JSON.parse(docChauffeurJSON);
                
  var chartChauffeursElement = document.getElementById('chartChauffeurs');

  if (chartChauffeursElement) {
    var ctx = chartChauffeursElement.getContext('2d');
    try {
      var chartChauffeur = new Chart(ctx, docChauffeur);
      console.log('chartChauffeur', chartChauffeur.options);
      chartChauffeur.options.legend.display = false;
      chartChauffeur.options.title.text = "Nouveaux Chauffeurs";
      chartChauffeur.options.title.display = true;
    }
    catch(err) {
      console.log("chartChauffeur Error: ", err);
    }
  }

  var docPassagerJSON = <?php echo json_encode($docPassagerJSON); ?>;
  var docPassager = JSON.parse(docPassagerJSON);
                
  var chartPassagersElement = document.getElementById('chartPassagers');
  if (chartPassagersElement) {
    var ctx = chartPassagersElement.getContext('2d');
    try {
      var chartPassager = new Chart(ctx, docPassager);
      console.log('chartPassagers', chartPassager.options);
      chartPassager.options.legend.display = false;
      chartPassager.options.title.text = "Nouveaux Passagers";
      chartPassager.options.title.display = true;
    }
    catch(err) {
      console.log("chartPassagers Error: ", err);
    }
  }
  var trajetsJSON = <?php echo json_encode($trajetsJSON); ?>;
  var trajets = JSON.parse(trajetsJSON);
                
  var trajetsElement = document.getElementById('chartTrajets');
  if (trajetsElement) {
    var ctx = trajetsElement.getContext('2d');
    try {
      var chartTrajets = new Chart(ctx, trajets);
      console.log('chartTrajets', chartTrajets.options);
      chartTrajets.options.legend.display = false;
      chartTrajets.options.title.text = "Nouveaux Trajets";
      chartTrajets.options.title.display = true;
    }
    catch(err) {
      console.log("chartTrajets Error: ", err);
    }
  }
  var relationJSON = <?php echo json_encode($relationsJSON); ?>;
  var relations = JSON.parse(relationJSON);
                
  var relationElement = document.getElementById('chartRelations');
  if (relationElement) {
    var ctx = relationElement.getContext('2d');
    try {
      var chartRelations = new Chart(ctx, relations);
      console.log('chartRelations', chartRelations.options);
      chartRelations.options.legend.display = false;
      chartRelations.options.title.text = "Nouveaux Trajets";
      chartRelations.options.title.display = true;
    }
    catch(err) {
      console.log("chartRelations Error: ", err);
    }
  }
  var renouvellerJSON = <?php echo json_encode($docRenouvellerJSON); ?>;
  var renouveller = JSON.parse(relationJSON);
                
  var renouvellerElement = document.getElementById('chartDocRenouveller');
  if (renouvellerElement) {
    var ctx = renouvellerElement.getContext('2d');
    try {
      var chartRenouvelller = new Chart(ctx, renouveller);
      console.log('chartRelations', chartRenouvelller.options);
      chartRenouvelller.options.legend.display = false;
      chartRenouvelller.options.title.text = "A Renouveler";
      chartRenouvelller.options.title.display = true;
    }
    catch(err) {
      console.log("chartRelations Error: ", err);
    }
  }

  
</script>