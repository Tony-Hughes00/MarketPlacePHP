<table class="text-center bg-light mx-auto table border-1 table-hover table-sm table-responsive-sm">         
          <tr>
            <th>Date</th>   
            <th> Trajet</th>
            <th> Chauffeur</th>
            <th>Status</th>
            <th></th>
          </tr>
          <?php

            foreach($offres as $offre)
            {
          ?>
          <tr class="table-secondary">
            <td> 
            <?php 
              if ($offre['offre']->date_debut_aller == null) {
                $dispoObj = new App\Controller\TrajetDispo();
                ?> 
                <div><span class="parcoursSmall">Aller : </span>
                <?php
                $dispoObj->afficheConsult($offre, 'aller');
                ?>
                </div><div><span class="parcoursSmall">Retour : </span>
                <?php
                $dispoObj->afficheConsult($offre, 'retour');
                ?></div><?php
              } else {
            ?>
            <div><span class="parcoursSmall">Aller : </span>
                <span class="parcoursStrong parcoursSmall">
              <?php 
                $dateObj = new App\Controller\TrajetDate($offre['offre']->date_debut_aller, "", true, "" );
                $dateObj->afficheFull();
              //  substr(($offre['offre'])->date_debut_aller, 0, 10) ?>
              </span>
              </div>
              <?php
              if ($offre['offre']->aller_retour == 'retour') { ?>
                <div><span class="parcoursSmall">Retour : </span>
                <span class="parcoursStrong parcoursSmall">
                <?php
                $dateObj = new App\Controller\TrajetDate($offre['offre']->date_debut_retour, "", true, "" );
                $dateObj->afficheFull();
                ?>
               </span>
               </div>
              <?php }
              }
            ?>
            </td>
            <?php
            ?>
            <td> <?= getNomCommune(($offre['addDepart'])->commune) . ' -> ' . 
                      getNomCommune(($offre['addArrivee'])->commune) ?>&nbsp;&nbsp;
                  <a href="<?=ROUTE?>detailParcours.<?=($offre['offre'])->parcoursId?>">
                    <i class="fas fa-edit"alt="modifier"></i>
                  </a>
                      <br/>
                    <?php
                      if ($offre['offre']->aller_retour == 'aller') {
                        echo '<span class="parcoursSmall">Aller <strong>simple</strong></span>';
                      } else {
                        echo '<span class="parcoursSmall">Aller <strong>retour</strong></span>';
                      }
                    ?>
                    </td>
            <td> 
              <?=$offre['offre']->civilite . ' ' . $offre['offre']->nom?>&nbsp;&nbsp;
              <a href="<?=ROUTE?>ficheUser.<?=($offre['offre'])->membre?>">
                    <i class="fas fa-user-edit"alt="modifier"></i></a>
            </td>
            <td> <?php             
            if((($offre['offre'])->valide > 0) || (($offre['offre'])->status > 0)) {
              if(($offre['offre'])->valide > 0)  {
                echo "<strong>validé</strong>";
              } else {
                if(($offre['offre'])->status == 1) {
                  echo "<strong>attribué</strong>";
                } else {
                  echo "<strong>confirmé</strong>";
                }
              }
            } else {
              echo '<i class="text-secondary">non attribué</>';
            }
             ?>
            </td>
            <td>
            <?php
            if((($offre['offre'])->valide > 0) || (($offre['offre'])->status > 0)) {
                // echo '<td></td>';
              } else {?>
                <div data-toggle="modal" data-target="#supModal"
                  onclick="onDelete('parcoursDelete.<?=$offre['offre']->parcoursId?>')">
                  <i 
                    class="fas fa-trash">
                  </i>
                </div>
                <!-- <a href="< ?=ROUTE?>parcoursDelete.< ?= ($offre['offre'])->parcoursId ?>"
                onClick="return confirm('Confirmer la suppression ?');"> <i class="fas fa-trash"></i></a> -->
              <?php }
              ?> 
            </td>         
          </tr>
          <?php
            }
          ?>
        </table>
