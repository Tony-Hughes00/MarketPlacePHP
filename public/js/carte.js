/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| createName                                                 |
| eventName - nom d'évenement                                |
| mouseEvent - évenement                                     |
\*__________________________________________________________*/
function createName(eventName, mouseEvent) {

    var nom = $("#nom")[0];             // get nom div

    /*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*/   
    nom.style.position = "absolute";    // nom pos est relative à row en index.php                                 |
                                        //<div class="row" style="position: relative;">                            |
                                        //<div class="col-md-7 ml-4 text-center justify-content-center"></div>     |
                                        /*________________________________________________________________________*/

    var mouse = handleMouseMove();      // valider evenement
    
    // "fudge" for firefox
    if (mouse.layerX > 0) {
        nom.style.left = (mouse.layerX - 10) + 'px';
        nom.style.top =  (mouse.layerY - 30) + 'px';
    }
    // fin de "fudge" for firefox

    if (eventName == 'mouseover' ) {                // si mouseover affice nom de commune
        var nomHTML = mouseEvent.target.getAttribute("name");
        // console.log("createName", nom.innerHTML, nomHTML); 
        if (nomHTML == 'Perigueux' ||
            nomHTML == 'Bordeaux' ||
            nomHTML == 'Angouleme') {
            nom.innerHTML = "";
            nom.style.visibility = "hidden"
            // console.log("createName", nom, nomHTML); 
            mouseEvent.stopPropagation(); 
            return;
        } else {
            nom.innerHTML =  nomHTML;
            nom.style.visibility = "visible"
            // console.log("createName", nom.innerHTML, nomHTML); 
        }
    } else {                                        // si pas mouseover cache nom de commune (et donc div nom)
        nom.innerHTML = "";
    }
    // console.log("createName", nom);

    if(mouseEvent.type == "touchstart") {
        nom.innerHTML = nomHTML;
        nom.style.visibility = "hidden"
    }else{
        nom.style.visibility = "visible"
    }
    mouseEvent.stopPropagation();                   // on est finit avec evenement - ne le passe au parent/enfants
}
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| createName - fin                                           |
\*__________________________________________________________*/
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| populateBlock                                              |
| eventName - nom d'évenement                                |
| mouseEvent - évenement                                     |
\*__________________________________________________________*/
function populateBlock(trajetsJSON, communesJSON, color, dispoJSON) {

    // var nom = $("#nom")[0];                             // get nom div
    // var nomHTML = nom.innerHTML;                        // sauveguarder innerHTML - peut-être pas necessaire
    // console.log('carte.js populateBlock');

    var block = $("#blockCommune")[0];                  // get Info block pour commune
    if(!block) {
        return;
    }
                                                        /*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*/   
    nom.style.position = "absolute";                    // nom pos est relative à row en index.php                                 |
                                                        //<div class="row" style="position: relative;">                            |
                                                        //<div class="col-md-7 ml-4 text-center justify-content-center"></div>     |
                                                        /*________________________________________________________________________*/

    var mouse = handleMouseMove();                      // pas utilié mais peut-être on va avoir besoin

// mouseEvent.target.getAttribute("name")
    event.target.style.fill = color;                    // 

    var communeInfo = new CommuneInfo(event.target.id);         // créer contenue pour div blockCommune
    // console.log('carte.js populateBlock', block);
// console.log(trajetsJSON);
    block.innerHTML = communeInfo.getHTML(trajetsJSON, communesJSON, dispoJSON);            // populate blockCommune avec contenue 

}
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| populateBlock - fin                                           |
\*__________________________________________________________*/
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| handleMouseMove                                            |
| si event = null remplace le avec evenement windows         |
\*__________________________________________________________*/   
    document.onmousemove = handleMouseMove();
    function handleMouseMove(event) {
        // si event = null remplace le avec evenement windows
        event = event || window.event;
        return event;
    }
/*‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾*\
| handleMouseMove - fin                                      |
\*__________________________________________________________*/
function getNomCommune(communes, id) {
    let nom = "";
    if(!communes) {
        console.log("getNomCommune erreur : communes est null");
        console.trace();
        return;
    }
    communes.forEach(commune => {
        if(commune.id == id) {
            nom = commune.nom;
            return commune.nom;
        }
        }
    )
    return nom;
  }
