/**
 * Formulaire - Smart Wizard
 */
$(document).ready(function () {
    $('#form-backoffice').smartWizard({
        selected: 0, // Initial selected step, 0 = first step
        theme: 'default', // theme for the wizard, related css need to include for other than default theme
        justified: true, // Nav menu justification. true/false
        darkMode: false, // Enable/disable Dark Mode if the theme supports. true/false
        autoAdjustHeight: false, // Automatically adjust content height
        cycleSteps: false, // Allows to cycle the navigation of steps
        backButtonSupport: true, // Enable the back button support
        enableURLhash: false, // Enable selection of the step based on url hash
        transition: {
            animation: 'fade', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
            speed: '100', // Transion animation speed
            easing: '' // Transition animation easing. Not supported without a jQuery easing plugin
        },
        toolbarSettings: {
            toolbarPosition: 'bottom', // none, top, bottom, both
            toolbarButtonPosition: 'center', // left, right, center
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true, // show/hide a Previous button
            toolbarExtraButtons: [] // Extra buttons to show on toolbar, array of jQuery input/buttons elements
        },
        anchorSettings: {
            anchorClickable: true, // Enable/Disable anchor navigation
            enableAllAnchors: false, // Activates all anchors clickable all times
            markDoneStep: true, // Add done state on navigation
            markAllPreviousStepsAsDone: false, // When a step selected by url hash, all previous steps are marked done
            removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
            enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
        },
        keyboardSettings: {
            keyNavigation: false, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
            keyLeft: [37], // Left key code
            keyRight: [39] // Right key code
        },
        lang: {
            next: 'Étape suivante',
            previous: 'Étape précédente'
        },
        disabledSteps: [], // Array Steps disabled
        errorSteps: [], // Highlight step with errors
        hiddenSteps: [] // Hidden steps
    });
});



/**
 * Espace utilisateur
 */
$(document).ready(function () {
    $('#profil').smartWizard({
        selected: 0, // Initial selected step, 0 = first step
        theme: 'default', // theme for the wizard, related css need to include for other than default theme
        justified: true, // Nav menu justification. true/false
        darkMode: false, // Enable/disable Dark Mode if the theme supports. true/false
        autoAdjustHeight: false, // Automatically adjust content height
        cycleSteps: false, // Allows to cycle the navigation of steps
        backButtonSupport: false, // Enable the back button support
        enableURLhash: false, // Enable selection of the step based on url hash
        transition: {
            animation: 'fade', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
            speed: '100', // Transion animation speed
            easing: '' // Transition animation easing. Not supported without a jQuery easing plugin
        },
        toolbarSettings: {
            toolbarPosition: 'bottom', // none, top, bottom, both
            toolbarButtonPosition: 'center', // left, right, center
            showNextButton: false, // show/hide a Next button
            showPreviousButton: false, // show/hide a Previous button
            toolbarExtraButtons: [] // Extra buttons to show on toolbar, array of jQuery input/buttons elements
        },
        anchorSettings: {
            anchorClickable: true, // Enable/Disable anchor navigation
            enableAllAnchors: true, // Activates all anchors clickable all times
            markDoneStep: false, // Add done state on navigation
            markAllPreviousStepsAsDone: false, // When a step selected by url hash, all previous steps are marked done
            removeDoneStepOnNavigateBack: false, // While navigate back done step after active step will be cleared
            enableAnchorOnDoneStep: false // Enable/Disable the done steps navigation
        },
        keyboardSettings: {
            keyNavigation: false, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
            keyLeft: [37], // Left key code
            keyRight: [39] // Right key code
        },
        lang: {
            next: 'Étape suivante',
            previous: 'Étape précédente'
        },
        disabledSteps: [], // Array Steps disabled
        errorSteps: [], // Highlight step with errors
        hiddenSteps: [] // Hidden steps
    });
});



/**
 * Désactiver le bouton "Étape suivante" si les champs de l'étape ne sont pas valides
 */
$(document).ready(function () {
    // Désactiver le bouton par défaut
    $('.sw-btn-next').prop('disabled', true);

    // Activer le bouton via clic, touche ou souris si les champs sont valides
    for (let i = 1; i < $('.step').length; i++) {
        $('#form-backoffice #step-' + i).on('click keyup mousemove', checkInputs);
        function checkInputs() {
            if ($('#step-' + i + ' input').valid()) {
                $('.sw-btn-next').prop('disabled', false);
            } else {
                $('.sw-btn-next').prop('disabled', true);
            }
        }
    }

    // Désactiver le bouton lorsque l'on quitte une étape
    for (let i = 1; i < $('.step').length; i++) {
        $('#form-backoffice').on('leaveStep', checkInputs);
        function checkInputs() {
            if ($('#step-' + (i + 1) + ' input').valid()) {
                $('.sw-btn-next').prop('disabled', true);
            } else {
                $('.sw-btn-next').prop('disabled', false);
            }
        }
    }
});



/**
 * Désactiver le copier/coller pour les champs suivants :
 * 1. Confirmation adresse e-mail
 * 2. Confirmation mot de passe
 */
$(document).ready(function () {
    $('#ins_email_confirm').on('paste', function (e) {
        e.preventDefault();
    });

    $('#ins_mdp_confirm').on('paste', function (e) {
        e.preventDefault();
    });
});



/**
 * Afficher le nom des fichiers téléversés dans les champs
 */
$(document).ready(function () {
    $("input[type=file]").change(function (e) {
        $(this).next('.custom-file-label').text(e.target.files[0].name);
    });
});



/**
 * Toggle les options de disponibilité selon si l'évaluation a été effectuée
 */
// $(document).ready(function () {
//     $("#ins_eval").click(function(){
//         $('#dispo-eval').toggle();
//     });
// });

// $(document).ready(function () {
//     $("#ins_date_eval_check").click(function(){
//         $('#ins_date_eval').toggle();
//     });
// });

// $(document).ready(function () {
//     $("#ins_apt_check").click(function(){
//         $('#ins_date_eval').toggle();
//     });
// });

/**
 * Ajouter un espace tous les 4 caractères pour la lisibilité du code IBAN
 */
// $(document).ready(function () {
//     $('#iban').on('input', function (e) {
//         let target = e.target, position = target.selectionEnd, length = target.value.length;
        
//         target.value = target.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
//         target.selectionEnd = position += ((target.value.charAt(position - 1) === ' ' && target.value.charAt(length - 1) === ' ' && length !== target.value.length) ? 1 : 0);
//     });
// });



/**
 * Activer le bouton submit
 */
$(document).ready(function () {
    $('#ins_submit').prop('disabled', true);

    let step = $('.step');
    let stepLength = step.length;
    let finalStep = $('#form-backoffice #step-' + stepLength);
    let finalStepInputs = $('#form-backoffice #step-' + stepLength + ' input');

    if (step.last()) {
        finalStep.on('click keyup mousemove', activateSubmit);
        function activateSubmit() {
            if (finalStepInputs.valid()) {
                $('#ins_submit').prop('disabled', false);
            } else {
                $('#ins_submit').prop('disabled', true);
            }
        }
    }

});
