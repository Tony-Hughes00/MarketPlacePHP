<script src="<?=RACINE?>js/carteEvents.js"></script>
<?php
    $loadCommune = App::getInstance()->getTable('Commune');
    $communesInfo = $loadCommune->selectCommunes(); 
    $communes = getCommunesCarte();
    $trajets = getSVGTrajets();  
    $dispos = getSVGDispos();  
    $trajetsInfo = getTrajets();
    $antennes = GetAntenne();
    $info = GetInfo();
?>
<script>
    var trajetsJSON = <?php echo json_encode($trajets); ?>;
    var dispoJSON = <?php echo json_encode($dispos); ?>;
    var trajetsInfoJSON = <?php echo json_encode($trajetsInfo); ?>;   
    var communesJSON = <?php echo json_encode($communes); ?>;
    var communesInfoJSON = <?php echo json_encode($communesInfo); ?>;      
    var antennesJSON = <?php echo json_encode($antennes); ?>;
    var infoJSON = <?php echo json_encode($info); ?>;

    // console.log(antennesJSON);
    // console.log(dispoJSON);
    populateTrajets(trajetsJSON, communesJSON);
    populateDispos(dispoJSON, communesJSON);
    createTrajetHandler(trajetsJSON);
    createAntenneHandler(antennesJSON);
    createInfoHandler(infoJSON);
    createDispoHandler(dispoJSON);

    for(var key in communesJSON) {

    var zone = $("#" + key)[0];
    if(zone) { 
        zone.addEventListener('mouseover', (thisZone) => {
            createName('mouseover', thisZone);
        });
        zone.addEventListener('mouseout', (thisZone) => {
            zone.style.fill = '#7aaaaa';
            createName('mouseout', thisZone);
        });
        zone.addEventListener('click', (event) => {
            for(var key in communesJSON) {
                var zone = $("#" + key)[0];
                zone.style.fill = '#7aaaaa';
            }
            populateBlock(trajetsInfoJSON, communesInfoJSON, '#d4ffa8', dispoJSON);
            event.stopPropagation();
        });
        zone.addEventListener('touchstart', (thisZone) => {
            console.log("touchstart", thisZone);
            for(var key in communesJSON) {
                var zone = $("#" + key)[0];
                zone.style.fill = '#7aaaaa';
            }
            console.log("touchstart");
            createName('mouseover', thisZone);
            populateBlock(trajetsInfoJSON, communesInfoJSON, '#d4ffa8', dispoJSON);

        });
    }
};
    var block = $("#blockCommune")[0];                // get Info block pour commune
    var communeInfo = new CommuneInfo("");         // créer contenue pour div blockCommune (carte.js)
    block.innerHTML = communeInfo.getHTML(trajetsInfoJSON, null, dispoJSON);       // populate blockCommune avec contenue 
</script>