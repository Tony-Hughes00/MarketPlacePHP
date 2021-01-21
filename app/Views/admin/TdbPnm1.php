<?php function date_full(){
  $mois = array(1=>'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
  $jours = array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
  echo ucfirst($jours[date('w')]).' '.date('j').' '.$mois[date('n')].' '.date('Y'); }
?>
<?php
// var_dump($data);
?>
<div class="container">
  <div class="row">
    <div class="col">
      <?php //var_dump($_SESSION)?>
   <h3>TABLEAU DE BORD PNM :</h3>
   <p> Bonjour <?=ucfirst($_SESSION['transport-solidaire']['prenom']).' '. ucfirst($_SESSION['transport-solidaire']['nom'])?>, nous sommes le <?= date_full(); ?></p>
    </div>
  </div>

  <div class="row text-center">
      <div class="col-12 col-md-6 border border-success p-4" style="border-width: 4px !important;">
      <h5> <i class="fas fa-bell text-danger"></i>   NOUVEAUX PASSAGERS</h5>
      <ul class="border border-2">
        <?php
        if (count($data['passagers']) == 0) {
          echo '<span class="">aucune nouveau passager trouvé</span>';
        } else {
          // TableMembre::selectNouveauxPassagers
          foreach($data['passagers'] as $p) { 
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
        }
        ?>
<!--       <li>
          <a href="#">Mr Bourru - Montmoreau- insc PNM : 12/06/2020 </a>
        </li>
        <li>
          <a href="#">Mme Lapique - Aubeterre-sur-Dronne - insc Internet : 12/06/2020 </a>
        </li>
        <li>
          <a href="#">Mr Robert - Chalais - insc PNM : 12/06/2020 </a>
        </li> -->
      </ul>

      </div>
      <div class="col-12 col-md-6 border border-success p-4" style="border-width: 4px !important;">
      <h5> <i class="fas fa-bell text-danger"></i>    NOUVEAUX CONDUCTEURS</h5> 
      <ul class="border border-2">
      <?php
        if (count($data['chauffeurs']) == 0) {
          echo '<span class="">aucune nouveau chauffeur trouvé</span>';
        } else {
          foreach($data['chauffeurs'] as $p) { 
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
        }
        ?>

      </ul>
      </div>    
  </div>
<?php
?>
   <div class="row text-center">
      <div class="col-12 col-md-6 border border-success p-4" style="border-width: 4px !important;">
      <h5> <i class="fas fa-bell text-danger"></i>   NOUVEAUX TRAJETS</h5>
      <ul class="border border-2">
      <?php
        if (count($data['trajets']) == 0) {
          echo '<span class="">aucune nouveau trajet trouvé</span>';
        } else {
          foreach($data['trajets'] as $t) { 
            echo '<li>';
            echo '<a href="' . ROUTE . 'detailParcours.' . $t->parcoursId . '">';
            if ($t->date_debut == null) {
              echo "disponibilité ";
            } else {
              echo $t->date_debut;
            }
            echo ' - ' . $t->depart . ' -> ' . $t->arrivee;
            echo '</a>';
            echo '</li>';
          }
        }
        ?>
<!--         <li>
          <a href="#">12/06/2020 - Aubeterre -> Montmoreau</a>
        </li>
        <li>
          <a href="#">12/06/2020 - Aubeterre -> Montmoreau</a>
        </li>
        <li>
          <a href="#">12/06/2020 - Aubeterre -> Montmoreau</a>
        </li> -->
      </ul>
      <!-- var_dump($data['trajets']); -->
      </div>
      <?php
      ?>
      <div class="col-12 col-md-6 border border-success p-4" style="border-width: 4px !important;">
      <h5> <i class="fas fa-bell text-danger"></i>    NOUVELLES MISES EN RELATION </h5> 
      <ul class="border border-2">
      <?php
        if (count($data['relation']) == 0) {
          echo '<span class="">aucune nouveau mise en relation trouvé</span>';
        } else {
          foreach($data['relation'] as $r) { 
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
        }
        ?>
<!--         <li>
          <a href="#">12/06/2020 - Aubeterre -> Montmoreau</a>
        </li>
        <li>
          <a href="#">12/06/2020 - Aubeterre -> Montmoreau</a>
        </li>
        <li>
          <a href="#">12/06/2020 - Aubeterre -> Montmoreau</a>
        </li> -->
      </ul>
      </div>    
  </div>

  <div class="row text-center" >
    <div class="col-12 col-md-6 border border-success p-4" style="border-width: 4px !important;">
      <h5>DOCUMENTS</h5>
      <i class="fas fa-bell text-danger"></i><b>   Manquants : </b>
      <?php
/*       $nomDocs = array(
        'permis'  => "Permis de conduire",
        'permis_valide' => "Attestation de validité",
        'carte_grise' => "Carte grise",
        'attestation_assurance' => "Attestation d'assurance",
        'controle_technique' => "Contrôle technique",
        'rib' => "Relevé d'Identité Bancaire (RIB)"
      );     */  
      $nomDocs = array(
        'permis'  => "Permis",
        'permis_valide' => "Attestation de validité",
        'carte_grise' => "Carte grise",
        'attestation_assurance' => "Assurance",
        'controle_technique' => "Contrôle technique",
        'rib' => "RIB"
      );
        if (count($data['docManquant']) == 0) {
          echo '<span class="">aucune document manquant trouvé</span>';
        } else {
          echo "<ul>";
          foreach($data['docManquant'] as $d) { 
            echo '<li>';
            echo '<a href="' . ROUTE . 'ficheUser.' . $d->users_id . '">';
            echo $d->civilite . ' ' . $d->nom . ' - ';
            echo $nomDocs[$d->doc_type] . ' - insc : ' . $d->created_at;
            echo '</a>';
            echo '</li>';
          }
          echo "</ul>";
        }
        ?>
      <?php

  ?>
      <i class="fas fa-bell text-danger"></i><b>   A renouveller : </b>

      <?php
        $nomDocs = array(
                  'permis'  => "Permis de conduire",
                  'permis_valide' => "Validité du permis",
                  'carte_grise' => "Carte grise",
                  'attestation_assurance' => "Assurance",
                  'controle_technique' => "Contrôle technique",
                  'rib' => "RIB"
                );
        if (count($data['docRenouveller']) == 0) {
          echo '<span class="">aucune document à renouveller trouvé</span><br><br>';
        } else {
          echo "<ul>";
          foreach($data['docRenouveller'] as $d) { 
            echo '<li>';
            echo '<a href="' . ROUTE . 'ficheUser.' . $d->users_id . '">';
            echo $d->civilite . ' ' . $d->nom . ' - ';
            echo $nomDocs[$d->doc_type] . ' - exp : ' . $d->expiration;
            echo '</a>';
            echo '</li>';
          }
          echo "</ul>";
        }
      ?>
            <i class="fas fa-bell text-danger"></i><b>   A valider : </b>

<?php

  if (count($data['docsInvalide']) == 0) {
    echo '<span class="">aucune document à valider trouvé</span>';
  } else {
    echo "<ul>";
    foreach($data['docsInvalide'] as $d) { 
      echo '<li>';
      echo '<a href="' . ROUTE . 'ficheUser.' . $d->users_id . '">';
      echo $d->civilite . ' ' . $d->nom . ' - ';
      echo $nomDocs[$d->doc_type] . ' - exp : ' . $d->expiration;
      echo '</a>';
      echo '</li>';
    }
    echo "</ul>";
  }
?>

    </div> 
      <div class="col-12 col-md-6 border border-success p-4" style="border-width: 4px !important;">
       <span class="w-100 p-2" ><h5> COTISATIONS </h5></span>
       <i class="fas fa-bell text-danger"></i><b>   Manquantes : </b>
       <?php
       if (count($data['cotisManquant']) == 0) {
          echo '<span class="">aucune cotisation manquant trouvé</span>';
        } else {
          echo "<ul>";
          foreach($data['cotisManquant'] as $c) { 
            echo '<li>';
            echo '<a href="' . ROUTE . 'ficheUser.' . $c->id_user . '">';
            echo $c->civilite . ' ' . $c->nom . ' - ';
            echo 'date d\'expiration : ' . $c->date_cotis_valid;
            echo '</a>';
            echo '</li>';
          }
          echo "</ul>";
        }
        ?>
        <!-- <ul class="border border-2 mx-4" style="list-style:none;">
          <li>
            <a href="#">Mr Piquart - Permis - insc : 12/06/2020 </a>
          </li>
          <li>
            <a href="#">Mr Piquart - Assurance - insc : 12/06/2020 </a>
          </li>
          <li>
            <a href="#">Mr Piquart - Chauffeur - insc : 12/06/2020 </a>
          </li>
        </ul> -->
        <i class="fas fa-bell text-danger"></i><b>   A renouveler : </b>
        <?php
       if (count($data['cotisRenouveller']) == 0) {
          echo '<span class="">aucune cotisation à renouveller trouvé</span>';
        } else {
          echo "<ul>";
          foreach($data['cotisRenouveller'] as $c) { 
            echo '<li>';
            echo '<a href="' . ROUTE . 'ficheUser.' . $c->id_user . '">';
            echo $c->civilite . ' ' . $c->nom . ' - ';
            echo 'date d\'expiration : ' . $c->date_cotis_valid;
            echo '</a>';
            echo '</li>';
          }
          echo "</ul>";
        }
        ?>
        <!-- <ul class="border border-2 mx-4 ">
          <li>
            <a href="#">Mr Piquart - Permis - avant : 12/06/2020 </a>
          </li>
          <li>
            <a href="#">Mr Piquart - Assurance - avant : 12/06/2020 </a>
          </li>
          <li>
            <a href="#">Mr Piquart - Chauffeur - avant : 12/06/2020 </a>
          </li>
        </ul>       -->
      </div>   
  </div>
</div>
