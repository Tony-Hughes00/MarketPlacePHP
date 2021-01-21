<?php namespace App\Controller\Admin; ?>
<?php use App; ?>
<style>
  /* styles pour les circles sur la carte SVG */
  polygon:hover {
    cursor: pointer;
  }
  .clv-2 {
    fill: #3fa047;
    stroke: #4c7536;
  }
  .clv-3, .clv-2, clv-4 {
    stroke-miterlimit: 10;
    stroke-width: 3px;
  }
  .clv-3 {
    fill: #f04f3a;
    stroke: #c1272d;
  }
  .clv-4 {
    fill: #f04f3a;
    stroke: #c1272d;
  }
  /* fin de styles pour les circles sur la carte SVG */
</style>
<!--‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| Div pour afficher le nom de commune sur la carte SVG          |
\*____________________________________________________________-->
<div id="nom"
    style="color: black; font-weight: bold; font-size: 14px; text-shadow: 1px 1px 1px rgb(255, 255, 255); border: 1px solid white; background-color: rgba(255,255,255,0.85); z-index:10;">
</div>
<!-- fin de div 'nom'     -->

<!-- Generator: Adobe Illustrator 16.0.3, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<!DOCTYPE  
  svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
  <xml version="1.0" encoding="utf-8"
>

<?php require ROOT."/app/Views/carte/carteData.php"; ?>

<?php
  function getCarteSVG($page) {
    $communes = getCommunesCarte();
    echo '<svg id="svgDiv" version="1.1" xmlns:bx="https://boxy-svg.com" xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 600" enable-background="new 0 0 1000 600" xml:space="preserve">';

    foreach ($communes as $key => $commune) {
      echo '<polygon id="' . $key . '" name="' . $commune["nom"] . '" class="' . $commune["class"] . '" fill="' . $commune["fill"] . '"';
      echo ' stroke="' . $commune["stroke"] . '" stroke_width="' . $commune["stroke_width"] . '"';
      echo ' points="' . $commune["points"] . '"/>';
    }
    echo '<g id="Calque_3" data-name="Calque 3">';

    $antennes = GetAntenne();
    foreach ($antennes as $id => $antenne) {
      echo '<image name="antenne' . $antenne['commune'] . '" id="' .$id . '" width="' . $antenne["width"] . '" height="' . $antenne["height"] . '" transform="' . $antenne["transform"] . '" href="' . $antenne["href"] . '" commune="' . $antenne["commune"] . '" style="background: transparent;"/>';
    } 

    if($page == "index") {
      $trajets = getSVGTrajets();
      foreach ($trajets as $id => $trajet) {
        echo '<circle id="' . $id . '" class="' . $trajet["class"] . '" cx="' . $trajet["cx"] . '" cy="' . $trajet["cy"] . '" r="' . $trajet["r"] . '" textContent="' . $trajet["commune"] . '" style="z-index: 10;"/>';
      }    

      $dispos = getSVGDispos(); 
      foreach ($dispos as $id => $dispo) {
        echo '<circle id="dispo' . $id . '" class="clv-4" cx="0" cy="0" r="8.0" textContent="' . $dispo->commune . '" style="z-index: 10;"/>';
        // echo '<circle id="' . $id . '" class="' . $dispo["class"] . '" cx="' . $dispo["cx"] . '" cy="' . $dispo["cy"] . '" r="' . $dispo["r"] . '" textContent="' . $dispo["commune"] . '" style="z-index: 10;"/>';
      } 
    }

    $info = GetInfo();
    foreach ($info as $id => $i) {
      echo '<image id="' .$id . '" width="' . $i["width"] . '" height="' . $i["height"] . '" transform="' . $i["transform"] . '" href="' . $i["href"] . '" commune="' . $i["commune"] . '"/>';
    }  
    echo '</g>';
    echo '</svg>';
  }
  /*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| pnm - cet array doit venir du BDD                          |
\*__________________________________________________________*/

  $pnmTable = App::getInstance()->getTable('Pnm');
  $pnms = $pnmTable->selectPnms();

?>
<?php getCarteSVG("index"); ?>
<script>
  /*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| CommuneInfo  - objet                                               |
| nomCommune - nom de commune                                |
\*__________________________________________________________*/   
function CommuneInfo(nomCommune) {
        this.nomCommune = "";               // sauvegarder le nom de commune au niveau objet
        this.idCommune = nomCommune;               // sauvegarder le nom de commune au niveau objet
        var pnms = <?php echo json_encode($pnms); ?>;

        // créer inner HTML pour div blockCommune
        this.getHTML = function (trajetsJSON, communesJSON, dispoJSON) {
// console.log("dispoJSON", dispoJSON);
            if (this.idCommune.length > 0) {
                this.nomCommune = getNomCommune(communesJSON, this.idCommune);
            } 

            var html = '<div>';
            html += '<div class="carte-detail-commune">'
            if (this.nomCommune.length > 0) {
              if (this.idCommune >= 10000) {
                html += '<h3>Direction <span>' + this.nomCommune + '</span></h3>';
              } else {
                html += '<h3>Commune de <span>' + this.nomCommune + '</span></h3>';
              }
            } else {
                html += '<h3 style="font-style: italic">Veuillez sélectionner une commune sur la carte</h3>';
            }
            html += '</div>'
            html += '<div class="p-4">'
            html += '<h3 class="text-success">Trajets disponibles</h3>';
            html += this.getTrajets(trajetsJSON, communesJSON, dispoJSON);


            // html += this.getDispos(dispoJSON);

            html += '</p>';
            html += this.getTransportSolidaire();
            html += '</div>';
            html += this.getAntenne(communesJSON);
            html += '</div>';     

            return html;
        }
        // créer section antenne
        this.getAntenne = function(communesJSON) {
            var html = '';
            if(this.nomCommune && this.nomCommune.length > 0) {
                communesJSON.forEach((commune) => {
                    var pnmID = 0;
                    if(commune.nom == this.nomCommune) {
                        pnmID = commune.pnm;

                        // var pnm = pnms[pnmID];
                        var pnm = pnms[0];
                        var ville = "";

                        pnms.forEach ((p) => {
                          if(p.id_pnm == pnmID) {
                            pnm = p;
                          }
                        }) ;
                        communesJSON.forEach((commune) => {
                          if (commune.id == pnm.ville_pnm) {
                            ville = commune.nom;
                          }
                        })
        
                        html += '<div class="carte-detail-antenne p-2" style="border: 3px solid #aaa;">';
                        html += '<h4 style="text-decoration:underline;">Votre Antenne de Mobilité de proximité</h4>';
                        html += '<strong>' + pnm.titre_pnm + '</strong><br>';
                        html += pnm.adr_pnm + '<br>';
                        html += pnm.cp_pnm + " " + ville;    //adresse.ville;
                        html += '</div>'                     }
                });
            } 
            return html;
        }
        // dispos
        this.getDispos = function(dispoJSON) {
          <?php if (isset($_SESSION['transport-solidaire']['statut']) && !isset($_SESSION['transport-solidaire']['membre_type'])) { ?>
            isPnm = true;
          <?php } else if (isset($_SESSION['transport-solidaire']['membre_type']) && !isset($_SESSION['transport-solidaire']['statut'])) { ?>
            isPnm = false;
          <?php } ?>
          var html = "";
          // console.log("infoBlock dispo", dispoJSON);
          var dispos = [];
          dispoJSON.forEach((dispo) => {
            // console.log(this.idCommune, dispo);
            if (this.idCommune == dispo.commune) {
              dispos.push(dispo);
            }
          })
          // console.log("dispos", dispos);
          if(dispos.length > 0) {
            if (isPnm === true) {
              linkHref = '<a>';
              linkEnd = "</a>";
            } else {
              linkHref = "";
              linkEnd = "";
            }
            html += '<ul><strong>Disponibilités</strong>';
            joursLong = ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
            lastDispo = dispos[0];
            html += '<li>';
            <?php if (ROUTE == '/') { ?>
              html += '<a href="enrDispo.' + dispos[0].user_id + '">';
            <?php } else { ?>
              html += '<a href="' + <?=ROUTE?> + 'enrDispo.' + dispos[0].user_id + '">';
            <?php } ?>
            html += 'départ ' + this.nomCommune + ' tous les '; 
            // console.log("dispos", dispos);
            // console.log("lastDispo", lastDispo);   
            var joursDispo = [];
            joursDispo.length = 7;
            joursDispo[dispos[0].jour_dispo] = joursLong[dispos[0].jour_dispo];   
            // console.log("joursDispo", joursDispo, joursLong[dispos[0].jour_dispo]);      
            dispos.forEach((dispo) => {
              // console.log("joursDispo", joursDispo.join(" ")); 
              // console.log("dispo", dispo);      
              if (lastDispo.user_id != dispo.user_id) {
                html += joursDispo.join(" ");     
                joursDispo = [];
                joursDispo.length = 7;
                html += linkEnd + '</li><li>';
                <?php if (ROUTE == '/') { ?>
                  html += '<a href="enrDispo.' + dispo.user_id + '">';
                <?php } else { ?>
                  html += '<a href="' + <?=ROUTE?> + 'enrDispo.' + dispo.user_id + '">';
                <?php } ?>
                html += 'départ ' + this.nomCommune + ' tous les '; 
                lastDispo = dispo;
              }
              joursDispo[dispo.jour_dispo] = joursLong[dispo.jour_dispo];   
              // html += joursLong[dispo.jour_dispo] + " ";
            } ) 
            // console.log("joursDispo", joursDispo.join(" "));      
            html += joursDispo.join(" ");     
            html += linkEnd + '</li>';
            html += '</ul>'        
          }

          return html;
        }
        // créer section trajets - circles
        this.getTrajets =function(trajetsJSON, communesJSON, dispoJSON) {
            var offres = [];
            var demandes = [];
            var html = "";

            for (var key in trajetsJSON){
                var trajet = trajetsJSON[key];
                if(trajet.type == "chauffeur" && 
                        (trajet.depart == this.idCommune || trajet.arrivee == this.idCommune)) {
                    offres.push(trajet);
                }
            }
            for (var key in trajetsJSON){
                var trajet = trajetsJSON[key];
                if(trajet.type == "passager" && 
                        (trajet.depart == this.idCommune || trajet.arrivee == this.idCommune)) {
                    demandes.push(trajet);
                }
            }
            isPnm = false;
            linkHref = "";
            linkEnd = "";
            var data = sessionStorage.getItem('transport-solidaire');
            // console.log('session', data);
             <?php 
            // if(isset($_SESSION)) {
            //   var_dump($_SESSION);
            // } else {
            //   var_dump("no session set");
            // }
            if (isset($_SESSION['transport-solidaire']['statut']) && !isset($_SESSION['transport-solidaire']['membre_type'])) { ?>
              isPnm = true;
            <?php } else if (isset($_SESSION['transport-solidaire']['membre_type']) && !isset($_SESSION['transport-solidaire']['statut'])) { ?>
              isPnm = false;
            <?php } ?>
            if(offres.length > 0) {
                html += '<ul><strong>Offres</strong>';
                offres.forEach((trajet) => {
                  if (isPnm === true) {
                    // if (ROUTE == '/') {
                    <?php if (ROUTE == '/') { ?>
                      linkHref = '<a href="detailParcours.' + trajet.id + '">';
                    // } else {
                    <?php } else { ?>
                      linkHref = '<a href="' + <?=ROUTE?> + 'detailParcours.' + trajet.id + '">';
                    // }
                    <?php } ?>
                    linkEnd = "</a>";
                  } else {
                    linkHref = "";
                    linkEnd = "";
                  }
                  if (trajet.date_debut_aller == null) {
                    if(this.idCommune == trajet.depart) {
                      html += '<li>' + linkHref + getNomCommune(communesJSON, trajet.depart) + ' -> ' + getNomCommune(communesJSON, trajet.arrivee) + '&nbsp;les&nbsp;' + trajet.dispoAller + linkEnd + '</li>';
                      // html += '<li>' + linkHref + 'Direction ' +  getNomCommune(communesJSON, trajet.arrivee) + '&nbsp;les&nbsp;' + trajet.dispoAller + linkEnd + '</li>';
                    }else{
                        html += '<li>' + linkHref + getNomCommune(communesJSON, trajet.depart) + ' -> ' + getNomCommune(communesJSON, trajet.arrivee) + '&nbsp;les&nbsp;' + trajet.dispoRetour + linkEnd + '</li>';
                    }
                  } else {
                    date = new Date(trajet.date_debut_aller);
                    dateStr = date.getDate() + "/" + ("0" + (date.getMonth() + 1)).slice(-2) + "/" + date.getFullYear() + " à " + date.getHours() + "h" + ("0" + (date.getMinutes() + 1)).slice(-2);
                    // console.log('trajet : ', trajet);
                    if(this.idCommune == trajet.depart) {
                      html += '<li>' + linkHref + getNomCommune(communesJSON, trajet.depart) + ' -> ' + getNomCommune(communesJSON, trajet.arrivee) + '&nbsp;le&nbsp;' + dateStr + linkEnd + '</li>';
                      // html += '<li>' + linkHref + 'Direction ' +  getNomCommune(communesJSON, trajet.arrivee) + '&nbsp;le&nbsp;' + date.substring(0, 16) + linkEnd + '</li>';
                    }else{
                      html += '<li>' + linkHref + getNomCommune(communesJSON, trajet.depart) + ' -> ' + getNomCommune(communesJSON, trajet.arrivee) + '&nbsp;le&nbsp;' + dateStr + linkEnd + '</li>';
                      // html += '<li>' + linkHref + 'Départ ' +  getNomCommune(communesJSON, trajet.depart) + '&nbsp;le&nbsp;' + date.substring(0, 16) + linkEnd + '</li>';
                    }
                  }
                }
                );
            }
            // console.log("display dispos", dispos);
                  joursLong = ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
                  var dispos = [];
                  dispoJSON.forEach((dispo) => {
                    // console.log(this.idCommune, dispo);
                    if (this.idCommune == dispo.commune) {
                      dispos.push(dispo);
                    }
                  })      
                  if (dispos != null && dispos.length > 0) {
                  console.log("dispos", dispos.length);
                  if (isPnm === true) {
                      // if (ROUTE == '/') {
                      <?php if (ROUTE == '/') { ?>
                        linkHref = '<a href="enrDispo.' + dispos[0].user_id + '">';
                      // } else {
                      <?php } else { ?>
                        linkHref = '<a href="' + <?=ROUTE?> + 'enrDispo.' + dispos[0].user_id + '">';
                      // }
                      <?php } ?>
                      linkEnd = "</a>";
                    } else {
                      linkHref = "";
                      linkEnd = "";
                    } 
                  lastDispo = dispos[0];         
                  if (dispos.length > 0) {
                  var joursDispo = [];
                  joursDispo.length = 7;
                  joursDispo[dispos[0].jour_dispo] = joursLong[dispos[0].jour_dispo];   
                  // console.log("joursDispo", joursDispo, joursLong[dispos[0].jour_dispo]);    
                  html += '<li>';
                  html += linkHref;
                  html += 'départ ' + this.nomCommune + ' tous les ';   
                  dispos.forEach((dispo) => {
                    // console.log("joursDispo", joursDispo.join(" ")); 
                    // console.log("dispo", dispo);      
                    if (lastDispo.user_id != dispo.user_id) {
                      html += joursDispo.join(" ");     
                      joursDispo = [];
                      joursDispo.length = 7;
                      html += linkEnd + '</li><li>';
                      if (isPnm === true) {
                        // if (ROUTE == '/') {
                        <?php if (ROUTE == '/') { ?>
                          linkHref = '<a href="enrDispo.' + dispos[0].user_id + '">';
                        // } else {
                        <?php } else { ?>
                          linkHref = '<a href="' + <?=ROUTE?> + 'enrDispo.' + dispos[0].user_id + '">';
                        // }
                        <?php } ?>
                        linkEnd = "</a>";
                      }
  /*                     <?php if (ROUTE == '/') { ?>
                        html += '<a href="enrDispo.' + dispo.user_id + '">';
                      <?php } else { ?>
                        html += '<a href="' + <?=ROUTE?> + 'enrDispo.' + dispo.user_id + '">';
                      <?php } ?> */
                      html += linkHref;
                      html += 'départ ' + this.nomCommune + ' tous les '; 
                      lastDispo = dispo;
                    }
                    joursDispo[dispo.jour_dispo] = joursLong[dispo.jour_dispo];   
                    // html += joursLong[dispo.jour_dispo] + " ";
                  } ) 
                  // console.log("joursDispo", joursDispo.join(" "));      
                  html += joursDispo.join(" ");     
                  html += linkEnd + '</li>';
                }
                  html += '</ul>';  
              }
            if( (dispos != null && dispos.length > 0) || 
            (offres.length > 0)) {
              html += "</ul>";
            }
            if(demandes.length > 0) {
                html += '<ul><strong>Demandes</strong>';
                demandes.forEach((trajet) => {
                  if (isPnm === true) {

                    // if (ROUTE == '/') {
                    <?php if (ROUTE == '/') { ?>
                      linkHref = '<a href="misRelation.' + trajet.id + '">';
                    // } else {
                    <?php } else { ?>
                      linkHref = '<a href="' + <?=ROUTE?> + 'misRelation.' + trajet.id + '">';
                    // }
                    <?php } ?>
                    linkEnd = "</a>";
                  } else {
                    linkHref = "";
                    linkEnd = "";
                  }
                  if (trajet.date_debut_aller == null) {
                    if(this.idCommune == trajet.depart) {
                        html += '<li>' + linkHref + getNomCommune(communesJSON, trajet.depart) + ' -> ' + getNomCommune(communesJSON, trajet.arrivee) + '&nbsp;les&nbsp;' + trajet.dispoAller + linkEnd + '</li>';
                    }else{
                        html += '<li>' + linkHref + getNomCommune(communesJSON, trajet.depart) + ' -> ' + getNomCommune(communesJSON, trajet.arrivee) + '&nbsp;les&nbsp;' + trajet.dispoRetour + linkEnd + '</li>';
                    }
                  } else {
                    date = new Date(trajet.date_debut_aller);
                    dateStr = date.getDate() + "/" +  ("0" + (date.getMonth() + 1)).slice(-2) + "/" + date.getFullYear() + " à " + date.getHours() + "h" + ("0" + (date.getMinutes() + 1)).slice(-2);
                    if(this.idCommune == trajet.depart) {
                        html += '<li>' + linkHref + getNomCommune(communesJSON, trajet.depart) + ' -> ' + getNomCommune(communesJSON, trajet.arrivee) + '&nbsp;le&nbsp;' + dateStr + linkEnd + '</li>';
                    }else{
                        html += '<li>' + linkHref + getNomCommune(communesJSON, trajet.depart) + ' -> ' + getNomCommune(communesJSON, trajet.arrivee) + '&nbsp;le&nbsp;' + dateStr + linkEnd + '</li>';
                    }
                  }
                }
                );
                html += '</ul>';  
            }
            if (html.length == 0) {
                    html += 'Aucun trajet trouvé';
                    html += '<p>';

            }
            return html;
        }
        this.getTransportSolidaire = function() {
            var html = '';
            html += '<h3 class="text-success transport-header">Les autres moyens de transport</h3>';
            html += '<div class="row transportIconsDiv intro-bloc">';
            html += '  <div class="col-3">'; 
            html += '    <a href="https://mosc.fr/Trains.html" target="_blank"><img class="transportIcons" src="public/images/gare.png"><br/><span class="transport">&nbsp;Trains</span></img></a>';
            html += '    <br />'
            html += '  </div>';
            html += '  <div class="col-3">';
            html += '    <a href="https://mosc.fr/Bus.html" target="_blank"><img class="transportIcons" src="public/images/bus.png"><br/><span class="transport">&nbsp;Bus</span></img></a>';
            html += '    <br />'
            html += '  </div>';
            html += '  <div class="col-3">';
            html += '    <a href="https://mosc.fr/Taxis-ambulances.html" target="_blank"><img class="transportIcons" src="public/images/ambulanceTaxi.png"><br/><span class="transport">&nbsp;Taxis ambulances</span></img></a>';
            html += '    <br />'
            html += '  </div>';
            html += '  <div class="col-3">';
            html += '    <a href="https://mosc.fr/Location-de-vehicules.html" target="_blank"><img class="transportIcons" src="public/images/car-rental.png"><br/><span class="transport">&nbsp;Location de véhicules</span></img></a>';
            html += '    <br />'
            html += '  </div>';
            html += '</div>';
            html += '<br />';
            return html;
        }
        
    }

</script>
