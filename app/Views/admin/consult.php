<?php
require_once ROOT ."/app/Views/admin/parcours/utils/Commune.php";  

// AFFICHAGE CONTENU CONSULTATION PASSAGER
if (isset($_GET['consultPass'])){  
// include "menuPassager.php" ;?>

<div class="container border-success border mt-5" style="border-radius:40px;">
  <div class="col-12 parcoursTitre" style="text-align:center;">
    <h3 class="bg-success p-2 text-light" style="border-radius:40px; margin-top:-50px;"><b> Consulter les Passagers</b></h3>
  </div>   
  <div>
    <form method="post" action="<?=ROUTE?>consult?consultPass" id="filtre-passagers">
    <fieldset>
    <input type="hidden" id="idCommuneFiltre" name="idCommuneFiltre" value="<?=$data['idCommuneFiltre']?>">
    <input type="hidden" id="idPnmFiltre" name="idPnmFiltre" value="<?=$data['idPnmFiltre']?>">
      <div class="row">
        <div class="col-12 col-md-4 text-center">
          <label class="" for="pnmFiltre"> Filtrer par PNM : </label> 
            <select id="pnmFiltre" name="pnmFiltre"
                value="0"
                onChange="onPnmFiltre(this)">
                >
              <option value="0">Tous</option>"<?php
              // MembreTable::selectCommunesPassagers
                foreach($data['pnms'] as $pnm) {
                  echo '<option value="' . $pnm->id_pnm . '"';
                  if ($pnm->id_pnm == $data['idPnmFiltre']) {
                    echo ' selected ';
                  }
                  echo '>' . $pnm->titre_pnm . '</option>';           
                }
              ?>
            </select>
        </div>
        
        <div class="col-12 col-md-4 text-center">
           <label class="" for="CommuneFiltre"> Filtrer par Commune : </label> 
            <select id="CommuneFiltre" name="CommuneFiltre"
                value="0"
                onChange="onCommuneFiltre(this)">
              <option value="0">Tous</option>"<?php
              // MembreTable::selectCommunesPassagers
                foreach($communeFiltre as $commune) {
                  echo '<option value="' . $commune->id . '"';
                  echo '>' . $commune->nomCommune;
                  echo '</option>';           
                }
              ?>
            </select>
          </div>
          <div class="col-12 col-md-4 ">
              <div class="row">
                  <div class="col-8 text-right">
                  <label class="" for="passagerStatus"> Filtrer par Statut: </label> 
                    <input type="radio" id="passagerStatusActive" name="passagerStatus"
                      value="actif" class=""
                      <?= (isset($data['passagerStatus']) && $data['passagerStatus'] == 'actif') ? 'checked' : false; ?>
                      >
                      <label class="" for="passagerStatusActive">Actif</label> 
                  </div>
                  <div class="col-4 text-left">
                    <input type="radio" id="passagerStatusInactive" name="passagerStatus"
                      value="inactif" class=""
                      <?= (isset($data['passagerStatus']) && $data['passagerStatus'] == 'inactif') ? 'checked' : false; ?>
                      >
                      <label class="" for="passagerStatusInactive">Inactif</label> 
                  </div>
              </div>
          </div>
        <div class="col-12 text-center">
        <button class="btn btn-secondary px-2 py-1 mt-2 mb-4" type="submit" 
            >Selectionner</button>
        </div>
        </div>
          </fieldset>
      </form>
  </div>
  <table class="text-center bg-light mx-auto table border-1 table-hover table-sm table-responsive-md">
    <tr>
      <th> Nom</th>
      <th> Commune</th>
      <!-- <th> Document</th> -->
      <th> Adhesion</th>
      <th> Créer Demande...</th>
      <th> Activation</th>
    </tr>
    <?php
    // MembreTable::selectPassagers 
      foreach($dataMembres as $dataMembre)
      {
        $docsManquant = false;
        foreach($docManquant as $doc) {
          if($doc->users_id == ($dataMembre['membre'])->users_id) {
            $docsManquant = true;
          }
        }
        $docExpired = false;
        foreach($docRenouveller as $doc) {
          if($doc->users_id == ($dataMembre['membre'])->users_id) {
            $docExpired = true;
          }
        }        
      ?>
      <tr class="table-secondary">
        <td> 
          <?= ($dataMembre['membre'])->civilite ?>
            <?= ($dataMembre['user'])->nom ?>
            <?= ($dataMembre['user'])->prenom ?> &nbsp;&nbsp;
            <a href="<?=ROUTE?>ficheUser.<?=($dataMembre['user'])->id?>"><i class="fas fa-edit" alt="modifier"></i></a>
        </td>  
        <td> <?= getNomCommune(($dataMembre['adresse'])->commune) ?></td>
        <!-- < ?php
            if ($docsManquant) {
                echo '<td> document manquant</td>';
            } else if ($docExpired) {
              echo '<td> document à renouveler</td>';
            } else {
              echo '<td> ok </td>';
            }
          ?> -->
        <td> ok</td> 
        <td>
          <a href="enr?inscrTraj&user=<?= ($dataMembre['user'])->id ?>"><i class="fas fa-car" alt="modifier"></i></a></td>
        </td>
        <td>
          <div>
            <?php
            echo '<button class="btn btn-secondary px-2 py-1" ';
            echo ' data-toggle="modal" data-target="#activateModal" ';
            if (($dataMembre['membre'])->actif == 1) {
              echo ' onclick="onDesactivater(\'desactUser.' . $dataMembre["user"]->id . '\')">Désactiver';
            } else {
              echo ' onclick="onActivate(\'actUser.' . $dataMembre["user"]->id . '\')">Activer';
            }
            echo '</button>';
            ?>
          </div>
          </td>
      </tr>
      <?php
        }
      ?>
    </table>
  </div>
  <script>
  function onCommuneFiltre(ctrl) {
    console.log(ctrl);
    $("#idCommuneFiltre")[0].value = ctrl.value;
  }
  function onPnmFiltre(ctrl) {
    console.log(ctrl);
    $("#idPnmFiltre")[0].value = ctrl.value;
    $("#idCommuneFiltre")[0].value = 0;
    $("#CommuneFiltre")[0].value = 0;
  }
  function onLoad() {
    console.log('onload');
    let selectCommunePassager = document.getElementById("CommuneFiltre");
    selectCommunePassager.value = <?=$idCommuneFiltre?>;

  }
  onLoad();

</script>
<?php } 


// AFFICHAGE CONTENU CONSULTATION CHAUFFEUR

if (isset($_GET['consultCond'])){ 
  // var_dump($docManquant);
  ?>
  <div class="container border-success border mt-5" style="border-radius:40px;">
  <div class="col-12 parcoursTitre" style="text-align:center;">
    <h3 class="bg-success p-2 text-light" style="border-radius:40px; margin-top:-50px;"> Consulter les Chauffeurs</h3>
  </div> 
  <div>
    <form method="post" action="<?=ROUTE?>consult?consultCond" id="filtre-passagers">
    <fieldset>
    <input type="hidden" id="idCommuneFiltre" name="idCommuneFiltre" value="<?=$data['idCommuneFiltre']?>">
    <input type="hidden" id="idPnmFiltre" name="idPnmFiltre" value="<?=$data['idPnmFiltre']?>">
      <div class="row">
        <div class="col-12 col-md-4 text-center">
          <label class="" for="pnmFiltre"> Filtrer par PNM : </label> 
            <select id="pnmFiltre" name="pnmFiltre"
                value="0"
                onChange="onPnmFiltre(this)">
                >
              <option value="0">Tous</option>"<?php
              // MembreTable::selectCommunesPassagers
                foreach($data['pnms'] as $pnm) {
                  echo '<option value="' . $pnm->id_pnm . '"';
                  if ($pnm->id_pnm == $data['idPnmFiltre']) {
                    echo ' selected ';
                  }
                  echo '>' . $pnm->titre_pnm . '</option>';           
                }
              ?>
            </select>
        </div>
        
        <div class="col-12 col-md-4 text-center">
          <label class="" for="CommuneFiltre"> Filtrer par Commune : </label> 
            <select id="CommuneFiltre" name="CommuneFiltre"
                value="0"
                onChange="onCommuneFiltre(this)">
              <option value="0">Tous</option>"<?php
              // MembreTable::selectCommunesPassagers
                foreach($communeFiltre as $commune) {
                  echo '<option value="' . $commune->id . '"';
                  echo '>' . $commune->nomCommune;
                  echo '</option>';           
                }
              ?>
            </select>
          </div>
        <div class="col-12 col-md-4 ">
            <div class="row">
              <div class="col-8 text-right">
              <label class="" for="chauffeurStatus"> Filtrer par Statut: </label> 

                <input type="radio" id="chauffeurStatusActive" name="chauffeurStatus"
                  value="actif" class=""
                  <?= (isset($data['chauffeurStatus']) && $data['chauffeurStatus'] == 'actif') ? 'checked' : false; ?>
                  >
                  <label class="" for="chauffeurStatusActive">Actif</label> 
              </div>
              <div class="col-4 text-left">
                <input type="radio" id="chauffeurStatusInactive" name="chauffeurStatus"
                  value="inactif" class=""
                  <?= (isset($data['chauffeurStatus']) && $data['chauffeurStatus'] == 'inactif') ? 'checked' : false; ?>
                  >
                  <label class="" for="chauffeurStatusInactive">Inactif</label> 
                </div>
            </div>
          </div>  
        
        <div class="col-12 text-center">
        <button class="btn btn-secondary px-2 py-1 mt-2 mb-4" type="submit"
            >Selectionner</button>
        </div>
        </div>
          </fieldset>
      </form>
  </div>
      <table class="text-center bg-light mx-auto table border-1 table-hover table-sm table-responsive-md">
        <tr>
          <th> Nom</th>
          <th> Commune</th>
          <th> Documents</th>
          <th> Adhesion</th>
          <th> Créer Offre...</th>
          <th> Activation</th>
        </tr>
      <?php
        foreach($dataMembres as $dataMembre)
        {
          $docsManquant = false;
          foreach($docManquant as $doc) {
            if($doc->users_id == ($dataMembre['membre'])->users_id) {
              $docsManquant = true;
            }
          }
          $docExpired = false;
          foreach($docRenouveller as $doc) {
            if($doc->users_id == ($dataMembre['membre'])->users_id) {
              $docExpired = true;
            }
          }
          $docInvalide = false;
          foreach($docsInvalide as $doc) {
            if ($doc->users_id == ($dataMembre['membre'])->users_id) {
              $docInvalide = true;
            }
          };
      ?>
        <tr class="table-secondary">
          <td> 
            <?= ($dataMembre['membre'])->civilite ?>
            <?= ($dataMembre['user'])->nom ?>
            <?= ($dataMembre['user'])->prenom ?> &nbsp;&nbsp;
            <a href="<?=ROUTE?>ficheUser.<?=($dataMembre['user'])->id?>"><i class="fas fa-edit" alt="modifier"></i></a>
          </td> 
          <td> 
            <?= getNomCommune(($dataMembre['adresse'])->commune) ?>
          </td>
          <?php
            if ($docsManquant) {
                echo '<td> document manquant</td>';
            } else if ($docInvalide) {
              echo '<td> document à valider</td>';
            } else if ($docExpired) {
              echo '<td> document à renouveler</td>';
            } else {
              echo '<td> ok </td>';
            }
          ?>
             
          <td> ok</td> 
          <td>
          <a href="enr?inscrTraj&user=<?= ($dataMembre['user'])->id ?>">
          <i class="fas fa-car" alt="modifier"></i></a>
          </td>
          <td>
          <div>
            <?php
            echo '<button class="btn btn-secondary px-2 py-1" ';
            echo ' data-toggle="modal" data-target="#activateModal" ';
            if (($dataMembre['membre'])->actif == 1) {
              echo ' onclick="onDesactivater(\'desactUser.' . $dataMembre["user"]->id . '\')">Désactiver';
            } else {
              echo ' onclick="onActivate(\'actUser.' . $dataMembre["user"]->id . '\')">Activer';
            }
            echo '</button>';
            ?>
          </div>
          </td>
        </tr>
      <?php
        }
      ?>
    </table>
  </div>
  <script>
  function onCommuneFiltre(ctrl) {
    console.log(ctrl);
    $("#idCommuneFiltre")[0].value = ctrl.value;
  }
  function onPnmFiltre(ctrl) {
    console.log(ctrl);
    $("#idPnmFiltre")[0].value = ctrl.value;
    $("#idCommuneFiltre")[0].value = 0;
    $("#CommuneFiltre")[0].value = 0;
  }
  function onLoad() {
    console.log('onload');
    let selectCommunePassager = document.getElementById("CommuneFiltre");
    selectCommunePassager.value = <?=$idCommuneFiltre?>;

  }
  onLoad();
  // function onActivate(id) {
  //   console.log("onActivate, id");

  //   // delModal = document.getElementById("supModal");
  //   hrefActivate = document.getElementById("linkActivate");
  //   messageActivate = document.getElementById("activateMessage");
  //   messageActivate.innerHTML = "Êtes-vous sûrs de vouloir activer cet utilisateur.";
  //   console.log(hrefActivate);
  //   hrefActivate.setAttribute("href", id);
  //   console.log(document.getElementById("linkActivate").href);
  //   // delModal.modal('show');
  // }
</script>
<?php } 



// AFFICHAGE CONTENU CONSULTATION TRAJET
if (isset($_GET['consultTraj'])){  
  require ROOT ."/app/Views/admin/parcours/parcoursConsult.php";
}
?>

<div id="activateModal" class="modal hide fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h2 class="text-white" id="activateMessage">
          Êtes-vous sûrs de vouloir désactiver cet utilisateur.
        </h2>
        <button type="button" class="close" data-dismiss="modal">&times; Fermer</button> 
      </div>
      <div class="row modal-body mx-auto text-center">
        <div class="col-12 col-md-12">
          <a class="btn-ins btn btn-secondary px-2" href="" id="linkActivate">
          Confirmer</a>
        </div>
        <!-- <div class="col-12 col-md-6">
          <a class="btn-ins btn btn-secondary px-2" href="#" class="close" data-dismiss="modal">Annuler</a>
        </div> -->
      </div>
    </div>
  </div>
</div>
<script>
  function onActivate(id) {
    console.log("onActivate, id");

    // delModal = document.getElementById("supModal");
    hrefActivate = document.getElementById("linkActivate");
    console.log(hrefActivate);
    messageActivate = document.getElementById("activateMessage");
    messageActivate.innerHTML = "Êtes-vous sûrs de vouloir activer cet utilisateur.";
    hrefActivate.setAttribute("href", id);
    console.log(document.getElementById("linkActivate").href);
    // delModal.modal('show');
  }
  function onDesactivater(id) {
    console.log("onDesctivater, id");

    // delModal = document.getElementById("supModal");
    hrefActivate = document.getElementById("linkActivate");
    console.log(hrefActivate);
    messageActivate = document.getElementById("activateMessage");
    messageActivate.innerHTML = "Êtes-vous sûrs de vouloir désactiver cet utilisateur.";
    hrefActivate.setAttribute("href", id);
    console.log(document.getElementById("linkActivate").href);
    // delModal.modal('show');
  }
</script>