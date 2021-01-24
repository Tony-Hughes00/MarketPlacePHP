/**
 * Toggle rubriques
 */

// let blocQuoi = document.querySelector('.display-bloc-quoi');
// let blocQui = document.querySelector('.display-bloc-qui');
// let blocOu = document.querySelector('.display-bloc-ou');
let blocQuoi = document.querySelector('.display-bloc-quoi');
let blocQui = document.querySelector('.display-bloc-qui');
let blocOu = document.querySelector('.display-bloc-ou');

// Propriétés par défaut du premier bloc
$('.display-bloc-quoi').prop('disabled', true);
blocQuoi.style.borderWidth = '5px 1px 1px 5px';
blocQuoi.style.borderColor = '#9ac526';

$(document).ready(function(){
    // Bloc "Quoi ?"
    $("#quoi").on("show.bs.collapse", function(){
        // Désactiver le clic si le paragraphe est affiché
        // Réactiver les autres
        $('.display-bloc-quoi').prop('disabled', true);
        $('.display-bloc-qui').prop('disabled', false);
        $('.display-bloc-ou').prop('disabled', false);
        // Cacher les autres paragraphes
        $("#qui").collapse('hide');
        $("#ou").collapse('hide');
        // Changer la taille et la couleur des bordures des boutons
        // Tailles
        blocQuoi.style.borderWidth = '5px 1px 1px 5px';
        blocQui.style.borderWidth = '1px 5px 5px 1px';
        blocOu.style.borderWidth = '1px 5px 5px 1px';
        // Couleurs
        blocQuoi.style.borderColor = '#9ac526';
        blocQui.style.borderColor = '#339ed6';
        blocOu.style.borderColor = '#339ed6';
    });

    // Bloc "Qui ?"
    $("#qui").on("show.bs.collapse", function(){
        // Désactiver le clic si le paragraphe est affiché
        // Réactiver les autres
        $('.display-bloc-quoi').prop('disabled', false);
        $('.display-bloc-qui').prop('disabled', true);
        $('.display-bloc-ou').prop('disabled', false);
        // Cacher les autres paragraphes
        $("#quoi").collapse('hide');
        $("#ou").collapse('hide');
        // Changer la taille et la couleur des bordures des boutons
        // Tailles
        blocQuoi.style.borderWidth = '1px 5px 5px 1px';
        blocQui.style.borderWidth = '5px 1px 1px 5px';
        blocOu.style.borderWidth = '1px 5px 5px 1px';
        // Couleurs
        blocQuoi.style.borderColor = '#339ed6';
        blocQui.style.borderColor = '#9ac526';
        blocOu.style.borderColor = '#339ed6';
    });

    // Bloc "Où ?"
    $("#ou").on("show.bs.collapse", function(){
        // Désactiver le clic si le paragraphe est affiché
        // Réactiver les autres
        $('.display-bloc-quoi').prop('disabled', false);
        $('.display-bloc-qui').prop('disabled', false);
        $('.display-bloc-ou').prop('disabled', true);
        // Cacher les autres paragraphes
        $("#quoi").collapse('hide');
        $("#qui").collapse('hide');
        // Changer la taille et la couleur des bordures des boutons
        // Tailles
        blocQuoi.style.borderWidth = '1px 5px 5px 1px';
        blocQui.style.borderWidth = '1px 5px 5px 1px';
        blocOu.style.borderWidth = '5px 1px 1px 5px';
        // Couleurs
        blocQuoi.style.borderColor = '#339ed6';
        blocQui.style.borderColor = '#339ed6';
        blocOu.style.borderColor = '#9ac526';
    });
    
    // Assurer la disparition des autres paragraphes lors d'un collapse
    $("#quoi").on("shown.bs.collapse", function(){
        $("#qui").collapse('hide');
        $("#ou").collapse('hide');
    });
    $("#qui").on("shown.bs.collapse", function(){
        $("#quoi").collapse('hide');
        $("#ou").collapse('hide');
    });
    $("#ou").on("shown.bs.collapse", function(){
        $("#quoi").collapse('hide');
        $("#qui").collapse('hide');
    });
});

/**
 * Switch display selon l'option d'envoi choisie
 * (temporaire car même cachés les 2 sont présents dans le code source)
 * (=> inscription par étapes en PHP)
 */

function optionEnvoi() {
    // Get l'id du bouton radio
    let option1 = document.getElementById("ins-opt-1");
    
    // Get les id des blocs à afficher/cacher
    let bloc1 = document.getElementById("ins-opt-1-bloc");
    let bloc2 = document.getElementById("ins-opt-2-bloc");

    // Si un bloc est affiché, cacher l'autre
    if (option1.checked == true) {
        bloc1.style.display = "block";
        bloc2.style.display = "none";
    } else {
        bloc1.style.display = "none";
        bloc2.style.display = "block";
    }
}