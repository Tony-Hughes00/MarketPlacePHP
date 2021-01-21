
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| populateTrajets ajouter les circles au poly communes                |
| trajets array de circles SVG - getSVGTrajets (carteData.php)        |
| communesJSON array de communes - getCommunesCarte (carteData.php)   |
\*___________________________________________________________________*/
  function populateTrajets(trajets, communesJSON) {

    for(var key in trajets) {             // trajet == circle
      var trajet = trajets[key];          // definition de circle

      var commune = trajet["commune"];    // nom de commune

      var classCircle = trajet["class"];        // class (pos et color)
      var cxOffset = 5;                         // pos relative pour class clv-2
      var cyOffset = -5;
      if(classCircle == "clv-3") {              // pos relative pour class clv-3
        cxOffset = -5;
        cyOffset = +5;
      } 
      
      var communePoly = communesJSON[commune];        // commune poly
      communeId = communePoly.class.substr(4);

      var communeRect = $("#" + commune)[0].getBBox();
      // centre du rectangle du commune poly
      var cx = communeRect.x + communeRect.width/2;
      var cy = communeRect.y+ communeRect.height/2; 
      // pos pour circle basé sur class (clv-2 ou clv-3)
      if(communeId < 10000) {
        cx += cxOffset;
        cy += cyOffset;
      } else {
        if( trajet['class'] == 'clv-2') {
          cx += 81;
          cy += 4;
        } else {
          cx += 99;
          cy += 4;
        }
      }

      var divCircle = $("#" + key)[0];
      // set pos circle
      divCircle.setAttribute("cx", cx);      
      divCircle.setAttribute("cy", cy);
    }
    return;
  }
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| populateDispos ajouter les circles dispo au poly communes                |
| trajets array de circles SVG - getSVGTrajets (carteData.php)        |
| communesJSON array de communes - getCommunesCarte (carteData.php)   |
\*___________________________________________________________________*/
function populateDispos(dispos, communesJSON) {
// console.log("dispos", dispos);
  for(var key in dispos) {             // trajet == circle
    var dispo = dispos[key];          // definition de circle
    // console.log("dispos key", dispo);

    var commune = dispo["commune"];    // nom de commune
console.log('populateDispos', commune);
    var classCircle = dispo["class"];        // class (pos et color)
    // var cxOffset = -10;                         // pos relative pour class clv-2
    // var cyOffset = -10;
    var cxOffset = -5;
    var cyOffset = +5;
/*     if(classCircle == "clv-3") {              // pos relative pour class clv-3
      cxOffset = -5;
      cyOffset = +5;
    }  */
    
    // var communePoly = communesJSON[commune];        // commune poly
    // communeId = communePoly.class.substr(4);
    // console.log("populateDispos communePoly", communePoly);

    var communeRect = $("#" + commune)[0].getBBox();
    // centre du rectangle du commune poly
    var cx = communeRect.x + communeRect.width/2;
    var cy = communeRect.y+ communeRect.height/2; 
    // pos pour circle basé sur class (clv-2 ou clv-3)
     if(commune < 10000) {
      cx += cxOffset;
      cy += cyOffset;
    } 
    // console.log("populateDispos communeRect", cx, cy);
    /*else {
      if( trajet['class'] == 'clv-2') {
        cx += 81;
        cy += 4;
      } else {
        cx += 99;
        cy += 4;
      }
    } */

    var divCircle = $("#dispo" + key)[0];
    // console.log("divCircle", divCircle);
    // set pos circle
    divCircle.setAttribute("cx", cx);      
    divCircle.setAttribute("cy", cy);
  }
  return;
}

/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| populateTrajets fin                                          |
| trajets array de circles SVG - getSVGTrajets (carteData.php) | 
\*____________________________________________________________*/
function positionCorr(idDepart, idArrivee, idRoot, idLine) {

  var zoneDepart = $("#" + idDepart)[0];

  var zoneArrivee = $("#" + idArrivee)[0];


  var zoneDepartRect = zoneDepart.getBBox();
  var zoneArriveeRect = zoneArrivee.getBBox();

  var cxDep = zoneDepartRect.x + zoneDepartRect.width/2;
  var cyDep = zoneDepartRect.y+ zoneDepartRect.height/2; 
  var cxArr = zoneArriveeRect.x + zoneArriveeRect.width/2;
  var cyArr = zoneArriveeRect.y+ zoneArriveeRect.height/2; 
  var id = idRoot + idLine;

  lineTrajet = $(id)[0];
  lineTrajet.setAttribute("x1", cxDep); 
  lineTrajet.setAttribute("y1", cyDep); 
  lineTrajet.setAttribute("x2", cxArr); 
  lineTrajet.setAttribute("y2", cyArr); 
  
}
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| populateCorrs ajouter les circles au poly communes                |
| trajets array de circles SVG - getSVGTrajets (carteData.php)        |
| communesJSON array de communes - getCommunesCarte (carteData.php)   |
\*___________________________________________________________________*/
function positionCorrs(trajet, communesJSON) {

  // trajets avec arrivee correspondants
  var arrivees = trajet['corrArr'];
  if(arrivees != "none" ) {
    arrivees.forEach(trajetArr => {
      positionCorr(trajetArr.depart, trajetArr.arrivee, "#corrArr", trajetArr.id);
    }); 
  }
  // trajets avec arrivee correspondants dispo
  var arrivees = trajet['corrArrDispo'];
  if(arrivees != "none" ) {
    arrivees.forEach(trajetArr => {
      positionCorr(trajetArr.depart, trajetArr.arrivee, "#corrArr", trajetArr.id);
    }); 
  }
  
  // trajets avec depart correspondants
  var departs = trajet['corrDep'];
  if(departs != "none" ) {
    departs.forEach(trajetDep => {
      positionCorr(trajetDep.depart, trajetDep.arrivee, "#corrDep", trajetDep.id);
    }); 
  }
  // trajets avec depart correspondants
  var departs = trajet['corrDepDispo'];
  if(departs != "none" ) {
    departs.forEach(trajetDep => {
      positionCorr(trajetDep.depart, trajetDep.arrivee, "#corrDep", trajetDep.id);
    }); 
  }
  // trajet
  positionCorr((trajet['addDepart'])['commune'], (trajet['addArrivee'])['commune'], "#", "corrTrajet");

  var zoneArrivee = $("#" + (trajet['addArrivee'])['commune'])[0];
  var zoneArriveeRect = zoneArrivee.getBBox();

  var cxTarget = zoneArriveeRect.x + zoneArriveeRect.width/2;
  var cyTarget = zoneArriveeRect.y + zoneArriveeRect.height/2 - 50; 

  var transform = "translate(" + cxTarget + " " + cyTarget + "), scale(0.7)";

  corrTarget = $("#corrTarget")[0];
  corrTarget.setAttribute("width", "100"); 
  corrTarget.setAttribute("height", "100"); 
  corrTarget.setAttribute("transform", transform); 

  return;
}
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| populateCorrs fin                                          |
| trajets array de circles SVG - getSVGTrajets (carteData.php) | 
\*____________________________________________________________*/
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| addHandlers ajouter listeners pour les evenements mouse             |
| et les passer au div poly dommune definit par "key"                 |
| trajetsJSON array de circles SVG - getSVGTrajets (carteData.php)    |
\*___________________________________________________________________*/
function addHandlers(key) {
    var zone = $("#" + key)[0];
        
        // Ajouter listener mouseover pour div circle
    zone.addEventListener('mouseover', (thisZone) => {    // thisZone == evenement mouseover

      var trajet = trajetsJSON[key];                      // definition de circle

      const commune = trajet["commune"];                    // definition de poly commune
      
      var svg = $("#svgDiv")[0];
      var p = svg.createSVGPoint();                       // créer SVG point
        // position SVG point basé sur pos de poly commune
      p.x = thisZone.clientX;                             
      p.y = thisZone.clientY;          

      var nom = $("#nom")[0];
      nom.style.position = "absolute";                    // utiliser position "absolute"
        // set pos de nom div
      nom.style.left = p.x;               
      nom.style.top =  p.y;
      // console.log("addEventListener", nom);

      var zoneCommune = $("#" + commune)[0];
      var newEvent = new MouseEvent('mouseover', thisZone);   // clone event
      zoneCommune.dispatchEvent(newEvent);  
    });
    zone.addEventListener('click', (thisZone) => {            // thisZone == evenement click

      var trajet = trajetsJSON[key];                      // definition de circle

      var commune = trajet["commune"];                    // definition de poly commune

      var svg = $("#svgDiv")[0];

      var p = svg.createSVGPoint();                       // créer SVG point
        // position SVG point basé sur pos de poly commune
      p.x = thisZone.clientX;                             
      p.y = thisZone.clientY;          

      var nom = $("#nom")[0];
      nom.style.position = "absolute";                    // utiliser position "absolute"
      // set pos de nom div
      nom.style.left = p.x;               
      nom.style.top =  p.y;

      var zoneCommune = $("#" + commune)[0];
      var newEvent = new MouseEvent('click', thisZone);
      zoneCommune.dispatchEvent(newEvent);
    }
  );
  zone.addEventListener('touchstart', (thisZone) => {            // thisZone == evenement click

    var trajet = trajetsJSON[key];                      // definition de circle
    console.log(" zone.addEventListener touchstart", trajet);
    var commune = trajet["commune"];                    // definition de poly commune
  
    /* 
    var svg = $("#svgDiv")[0];

    var p = svg.createSVGPoint();                       // créer SVG point
      // position SVG point basé sur pos de poly commune
    p.x = thisZone.clientX;                             
    p.y = thisZone.clientY;          

    var nom = $("#nom")[0];
    nom.style.position = "absolute";                    // utiliser position "absolute"
    // set pos de nom div
    nom.style.left = p.x;               
    nom.style.top =  p.y; */
//    createName('mouseover', thisZone);
    var nom = $("#nom")[0];
    nom.innerHTML = commune;
    var zoneCommune = $("#" + commune)[0];
    var newEvent = new MouseEvent('click', thisZone);
    zoneCommune.dispatchEvent(newEvent);
  }
);
}
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| addHandlers fin                                              |
\*____________________________________________________________*/
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| createTrajetHandler ajouter listeners pour les evenements mouse     |
| et les passer au div poly dommunes                                  |
| trajetsJSON array de circles SVG - getSVGTrajets (carteData.php)    |
\*___________________________________________________________________*/
  function createTrajetHandler(trajetsJSON) {

      for(var key in trajetsJSON) {                           // trajet == circle
        addHandlers(key);
     }
  }
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| createTrajetHandler fin                                      |
\*____________________________________________________________*/
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| addAntenneHandler ajouter listeners pour les evenements mouse     |
| et les passer au div poly dommune definit par "key"                 |
| antennesJSON array de circles SVG - getSVGTrajets (GetAntenne.php)  |
\*___________________________________________________________________*/
function addAntenneHandler(key) {
    var zone = $("#" + key)[0];
        
        // Ajouter listener mouseover pour div circle
    zone.addEventListener('mouseover', (thisZone) => {    // thisZone == evenement mouseover

    var antenne = antennesJSON[key];                      // definition d'antenne

    const commune = antenne["commune"];                    // definition de poly commune

    var svg = $("#svgDiv")[0];
    var p = svg.createSVGPoint();                       // créer SVG point
        // position SVG point basé sur pos de poly commune
    p.x = thisZone.clientX;                             
    p.y = thisZone.clientY;          

    var nom = $("#nom")[0];
    nom.style.position = "absolute";                    // utiliser position "absolute"
        // set pos de nom div
    nom.style.left = p.x;               
    nom.style.top =  p.y;
        
    var zoneCommune = $("#" + commune)[0];
    if (zoneCommune) {
      var newEvent = new MouseEvent('mouseover', thisZone);   // clone event
      zoneCommune.dispatchEvent(newEvent);  
    } else {
      console.log('addAntenneHandler mouseover failed : ' + commune + ' not found');
    }

  });
    zone.addEventListener('click', (thisZone) => {            // thisZone == evenement click

      var antenne = antennesJSON[key];                      // definition d'antenne

      const commune = antenne["commune"];                    // nom de commune

      var svg = $("#svgDiv")[0];

      var p = svg.createSVGPoint();                       // créer SVG point
        // position SVG point basé sur pos de poly commune
      p.x = thisZone.clientX;                             
      p.y = thisZone.clientY;          

      var nom = $("#nom")[0];
      nom.style.position = "absolute";                    // utiliser position "absolute"
      // set pos de nom div
      nom.style.left = p.x;               
      nom.style.top =  p.y;

      var zoneCommune = $("#" + commune)[0];
      if (zoneCommune) {
        var newEvent = new MouseEvent('click', thisZone);   // clone event
        zoneCommune.dispatchEvent(newEvent);  
      } else {
        console.log('addAntenneHandler click failed : ' + commune + ' not found');
      }
    }
  );
  zone.addEventListener('touchstart', (thisZone) => {            // thisZone == evenement click

    var antenne = antennesJSON[key];                      // definition d'antenne
    console.log(" zone.addEventListener antenne", antenne);
    const commune = antenne["commune"];                    // nom de commune

    var nom = $("#nom")[0];
    nom.innerHTML = commune;

    var zoneCommune = $("#" + commune)[0];
    var newEvent = new MouseEvent('click', thisZone);
    if (zoneCommune) {
      var newEvent = new MouseEvent('click', thisZone);
      zoneCommune.stopPropagation();
      zoneCommune.preventDefault();
      zoneCommune.dispatchEvent(newEvent);
    } else {
      console.log('addAntenneHandler touchstart failed : ' + commune + ' not found');
    }
  }
);
}
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| addAntenneHandler fin                                              |
\*____________________________________________________________*/

/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| createInfoHandler ajouter listeners pour les evenements mouse    |
| et les passer au div poly dommunes                                  |
| antennes array d'antennes SVG - GetAntenne (carteData.php)          |
\*___________________________________________________________________*/
function createInfoHandler(infoJSON) {

for(var key in infoJSON) {                           // trajet == circle
  addInfoHandler(key);
}
}
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| createAntenneHandler fin                                     |
\*____________________________________________________________*/
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| addInfoHandler (train etc) ajouter listeners pour les evenements mouse     |
| et les passer au div poly dommune definit par "key"                 |
| antennesJSON array de circles SVG - getSVGTrajets (GetAntenne.php)  |
\*___________________________________________________________________*/
function addInfoHandler(key) {

    var zone = $("#" + key)[0];
        
        // Ajouter listener mouseover pour div circle
    zone.addEventListener('mouseover', (thisZone) => {    // thisZone == evenement mouseover

      var info = infoJSON[key];                      // definition d'antenne

      const commune = info["commune"];                    // definition de poly commune

      var svg = $("#svgDiv")[0];
      var p = svg.createSVGPoint();                       // créer SVG point
        // position SVG point basé sur pos de poly commune
      p.x = thisZone.clientX;                             
      p.y = thisZone.clientY;          

      var zoneCommune = $("#nom")[0];
      nom.style.position = "absolute";                    // utiliser position "absolute"
        // set pos de nom div
      nom.style.left = p.x;               
      nom.style.top =  p.y;
      // console.log("addEventListener", nom);
      var zoneCommune = $("#" + commune)[0];
      if (zoneCommune) {
        var newEvent = new MouseEvent('mouseover', thisZone);   // clone event
        zoneCommune.dispatchEvent(newEvent);  
      } else {
        console.log('addInfoHandler click failed : ' + commune + ' not found');
      }

    });

    zone.addEventListener('click', (thisZone) => {            // thisZone == evenement click

      var info = infoJSON[key];                      // definition d'antenne

      const commune = info["commune"];                    // nom de commune

      var svg = $("#svgDiv")[0];

      var p = svg.createSVGPoint();                       // créer SVG point
        // position SVG point basé sur pos de poly commune
      p.x = thisZone.clientX;                             
      p.y = thisZone.clientY;          

      var nom = $("#nom")[0];
      nom.style.position = "absolute";                    // utiliser position "absolute"
      // set pos de nom div
      nom.style.left = p.x;               
      nom.style.top =  p.y;

      var zoneCommune = $("#" + commune)[0];
      if (zoneCommune) {
        var newEvent = new MouseEvent('click', thisZone);   // clone event
        zoneCommune.dispatchEvent(newEvent);  
      } else {
        console.log('addInfoHandler click failed : ' + commune + ' not found');
      }
    }
  );
  zone.addEventListener('touchstart', (thisZone) => {            // thisZone == evenement click

    var info = infoJSON[key];                      // definition d'antenne
    console.log(" zone.addEventListener info", info);

    const commune = info["commune"];                    // nom de commune

    var nom = $("#nom")[0];
    nom.innerHTML = commune;

    var zoneCommune = $("#" + commune)[0];
    if (zoneCommune) {
      thisZone.stopPropagation();
      thisZone.preventDefault();
      var newEvent = new MouseEvent('click', thisZone);   // clone event
      zoneCommune.dispatchEvent(newEvent);  
    } else {
      console.log('addInfoHandler click failed : ' + commune + ' not found');
    }



  }
);
}
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| addInfoandler fin                                              |
\*____________________________________________________________*/

/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| createAntenneHandler ajouter listeners pour les evenements mouse    |
| et les passer au div poly dommunes                                  |
| antennes array d'antennes SVG - GetAntenne (carteData.php)          |
\*___________________________________________________________________*/
function createAntenneHandler(antennesJSON) {

for(var key in antennesJSON) {                           // trajet == circle
  addAntenneHandler(key);
}
}
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| createAntenneHandler fin                                     |
\*____________________________________________________________*/

/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| createDispoHandler ajouter listeners pour les evenements mouse    |
| et les passer au div poly dommunes                                  |
| antennes array d'antennes SVG - GetAntenne (carteData.php)          |
\*___________________________________________________________________*/
function createDispoHandler(disposJSON) {

  for(var key in disposJSON) {                           // trajet == circle
    addDispoHandler(key, disposJSON);
  }
  }
  /*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
  | createDispoHandler fin                                     |
  \*____________________________________________________________*/
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| addDispoHandler ajouter listeners pour les evenements mouse     |
| et les passer au div poly dommune definit par "key"                 |
| antennesJSON array de circles SVG - getSVGTrajets (GetAntenne.php)  |
\*___________________________________________________________________*/
function addDispoHandler(key, disposJSON) {
  var zone = $("#dispo" + key)[0];
  // console.log('addDispoHandler', zone);      
      // Ajouter listener mouseover pour div circle
  zone.addEventListener('mouseover', (thisZone) => {    // thisZone == evenement mouseover

  var dispo = disposJSON[key];                      // definition d'antenne

  const commune = dispo["commune"];                    // definition de poly commune

  var svg = $("#svgDiv")[0];
  var p = svg.createSVGPoint();                       // créer SVG point
      // position SVG point basé sur pos de poly commune
  p.x = thisZone.clientX;                             
  p.y = thisZone.clientY;          

  var nom = $("#nom")[0];
  nom.style.position = "absolute";                    // utiliser position "absolute"
      // set pos de nom div
  nom.style.left = p.x;               
  nom.style.top =  p.y;
    
  var zoneCommune = $("#" + commune)[0];
    
  if (zoneCommune) {
    var newEvent = new MouseEvent('mouseover', thisZone);   // clone event
    zoneCommune.dispatchEvent(newEvent);  
  } else {
    console.log('addAntenneHandler mouseover failed : ' + commune + ' not found');
  }

});
  zone.addEventListener('click', (thisZone) => {            // thisZone == evenement click

    var dispo = disposJSON[key];                      // definition d'antenne

    const commune = dispo["commune"];                    // nom de commune

    var svg = $("#svgDiv")[0];

    var p = svg.createSVGPoint();                       // créer SVG point
      // position SVG point basé sur pos de poly commune
    p.x = thisZone.clientX;                             
    p.y = thisZone.clientY;          

    var nom = $("#nom")[0];
    nom.style.position = "absolute";                    // utiliser position "absolute"
    // set pos de nom div
    nom.style.left = p.x;               
    nom.style.top =  p.y;

    var zoneCommune = $("#" + commune)[0];
    if (zoneCommune) {
      var newEvent = new MouseEvent('click', thisZone);   // clone event
      zoneCommune.dispatchEvent(newEvent);  
    } else {
      console.log('addAntenneHandler click failed : ' + commune + ' not found');
    }
  }
);
zone.addEventListener('touchstart', (thisZone) => {            // thisZone == evenement click

  var dispo = disposJSON[key];                      // definition d'antenne

  const commune = dispo["commune"];                    // nom de commune

  var nom = $("#nom")[0];
  nom.innerHTML = commune;

  var zoneCommune = $("#" + commune)[0];
  var newEvent = new MouseEvent('click', thisZone);
  if (zoneCommune) {
    var newEvent = new MouseEvent('click', thisZone);
    zoneCommune.stopPropagation();
    zoneCommune.preventDefault();
    zoneCommune.dispatchEvent(newEvent);
  } else {
    console.log('addAntenneHandler touchstart failed : ' + commune + ' not found');
  }
}
);
}
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| addDispoHandler fin                                              |
\*____________________________________________________________*/
