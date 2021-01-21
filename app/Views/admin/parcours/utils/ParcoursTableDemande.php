<table class="text-center bg-light mx-auto table border-1 table-hover table-sm table-responsive-sm">          
          <tr>
            <!-- <th>Type</th> -->
            <th>Date</th>   
            <th> Trajet</th>
            <th> Passager</th>
            <th>Status</th>
            <th></th>
          </tr>
          <?php
            foreach($demandes as $demande)
            {
              // var_dump($demande['demande']->parcoursId);
          ?>
          <tr class="table-secondary">
            <td> 
            <div><span class="parcoursSmall">Aller : </span>
                <span class="parcoursStrong parcoursSmall">
              <?php 
                $dateObj = new App\Controller\TrajetDate($demande['demande']->date_debut_aller, "", true, "" );
                if ($demande['demande']->date_debut_aller == null) {
                  $dispoObj = new App\Controller\TrajetDispo();
                  ?> 
                  <div>
                  <!-- <span class="parcoursSmall">Aller : </span> -->
                  <?php
                  $dispoObj->afficheConsult($demande, 'aller');
                  ?>
                  </div>
                  <?php
                  } else {
                  $dateObj->afficheFull();
                }
              //  substr(($offre['offre'])->date_debut_aller, 0, 10) ?>
              </span>
              </div>
              <?php
              // echo $demande['demande']->parcoursId;
              // if ($demande['demande']->parcoursId == 654) {
              //   var_dump($demande['demande']);
              // }

              if ($demande['demande']->aller_retour == 'retour') { ?>
                <div><span class="parcoursSmall">Retour : </span>
                <span class="parcoursStrong parcoursSmall">
                <?php
                $dateObj = new App\Controller\TrajetDate($demande['demande']->date_debut_retour, "", true, "" );
                if ($demande['demande']->date_debut_aller == null) {
                  $dispoObj = new App\Controller\TrajetDispo();
                  ?> 
                  <div>
                  <!-- <span class="parcoursSmall">Retour : </span> -->
                  <?php
                  $dispoObj->afficheConsult($demande, 'retour');
                } else {
                  $dateObj->afficheFull();
                }              
                ?>
               </span>
               </div>
              <?php }
            ?>
            </td>
            <td> <?= getNomCommune(($demande['addDepart'])->commune) . ' -> ' . 
                      getNomCommune(($demande['addArrivee'])->commune) ?>&nbsp;&nbsp;
              <!-- <a href="< ?=ROUTE?>detailParcours.< ?=($demande['demande'])->parcoursId?>"> 
                        <i class="fas fa-edit"alt="modifier"></i></a> -->
              <br />
              <?php
                if ($demande['demande']->aller_retour == 'aller') {
                  echo '<span class="parcoursSmall">Aller <strong>simple</strong></span>';
                } else {
                  echo '<span class="parcoursSmall">Aller <strong>retour</strong></span>';
                }
              ?>
            </td>
            <td> <?=$demande['demande']->civilite . ' ' . $demande['demande']->nom?>&nbsp;&nbsp;
            <a href="<?=ROUTE?>ficheUser.<?=($demande['demande'])->membre?> ?>">
                      <i class="fas fa-user-edit"alt="modifier"></i></a>
            </td>
            <td> <?php 
            // echo ($demande['demande'])->valide . " " . ($demande['demande'])->status;
            if((($demande['demande'])->valide > 0) || (($demande['demande'])->status > 0)) {
              if((($demande['demande'])->valide > 0) ) {
                echo "<strong>validé</strong>";
              } else {
                if(($demande['demande'])->status == 1) {
                  echo "<strong>à étudier</strong>";
                  ?>
                  <a href="<?=ROUTE?>misRelation.<?= ($demande['demande'])->parcoursId ?>">
                  <i class="fas fa-link"alt="modifier"></i></a>
                  <?php
                } else {
                  echo "<strong>Programmé</strong>";
                  ?>
                  <a href="<?=ROUTE?>parcoursVal.<?=($demande['demande'])->parcoursId?>">
                  <i class="fas fa-clipboard-check" alt="modifier"></i></a>
                  <?php
                }
              }
            } else {
              echo '<i class="text-secondary">non attribué</>';
              ?>
              <a href="<?=ROUTE?>misRelation.<?= ($demande['demande'])->parcoursId ?>">
              <i class="fas fa-link"alt="modifier"></i></a>           
            <?php
             }
             ?>
              <?php if((($demande['demande'])->valide > 0)) { ?>
              <a href="<?=ROUTE?>parcoursVal.<?=($demande['demande'])->parcoursId?>">
              <i class="fas fa-clipboard-check" alt="modifier"></i></a>
            <?php } else { 
              if(($demande['demande'])->status == 1) {
              ?>
              <!-- <a href="< ?=ROUTE?>misRelation.< ?= ($demande['demande'])->parcoursId ?>">
              <i class="fas fa-link"alt="modifier"></i></a> -->
              <?php
              } else {
              ?>
              <!-- <a href="< ?=ROUTE?>misRelation.< ?= ($demande['demande'])->parcoursId ?>">
              <i class="fas fa-link"alt="modifier"></i></a> -->
            <?php }
            }
            ?>
             </td> 
             <td>
             <?php
              if((($demande['demande'])->valide > 0) || (($demande['demande'])->status > 0)) {
                echo '<td></td>';
              } else {
                ?>
                <td>
                <div data-toggle="modal" data-target="#supModal"
                  onclick="onDelete('parcoursDelete.<?=$demande['demande']->parcoursId?>')">
                  <i 
                    class="fas fa-trash">
                  </i>
                </div>                </td>
              <?php }
            ?>
            </td>
          </tr>
          <?php
            }
          ?>
        </table>
