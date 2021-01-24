$(document).ready(function () {
    /**
     * Paramètres par défaut
     */
    $.validator.setDefaults({
        errorPlacement: function() {} // Désactiver les messages d'erreur

        // errorPlacement: function (error, element) {
        //     if (element.hasClass('has-icon') || element.prop('type') === 'checkbox') {
        //         error.insertAfter(element.parent());
        //     } else if (element.prop('type') === 'radio') {
        //         error.insertAfter(element.parent().parent());
        //     } else {
        //         error.insertAfter(element);
        //     }
        // }
    });

    /**
     * Règles de validation : Formulaire d'inscription
     * inscription.php
     */
    $('#form-backoffice').validate({
        rules: {
            // STEP 1
            ins_type: {
                required: true
            },
            ins_email: {
                required: true,
                email: true
            },
            ins_email_confirm: {
                required: true,
                email: true,
                equalTo: "#ins_email"
            },
            ins_mdp: {
                required: true,
                minlength: 8,
                maxlength: 20,
                pattern: /^[a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/,
                nowhitespace: true
            },
            ins_mdp_confirm: {
                required: true,
                minlength: 8,
                maxlength: 20,
                pattern: /^[a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/,
                nowhitespace: true,
                equalTo: "#ins_mdp"
            },

            // STEP 2
            ins_civilite: {
                required: true
            },
            ins_nom: {
                required: true
                // lettersonly: true
            },
            ins_prenom: {
                required: true
                // lettersonly: true
            },
            ins_date_nais: {
                required: false
            },
            ins_lieu_nais: {
                required: false
            },

            // STEP 3
            ins_tel_dom: {
                required: false
            },
            ins_tel_por: {
                required: false
            },
            ins_adresse: {
                required: false
            },
            ins_cp: {
                required: false
            },
            ins_commune: {
                required: false
            }
        },
        messages: {
            // STEP 1
            ins_type: {
                required: "Ce champ est obligatoire"
            },
            ins_email: {
                required: "Ce champ est obligatoire",
                email: "Adresse e-mail incomplète"
            },
            ins_email_confirm: {
                required: "Ce champ est obligatoire",
                email: "Adresse e-mail incomplète",
                equalTo: "L'adresse e-mail ne correspond pas"
            },
            ins_mdp: {
                required: "Ce champ est obligatoire",
                minlength: "8 caractères minimum",
                maxlength: "20 caractères maximum",
                pattern: "Mot de passe invalide",
                nowhitespace: "Pas d'espace"
            },
            ins_mdp_confirm: {
                required: "Ce champ est obligatoire",
                minlength: "8 caractères minimum",
                maxlength: "20 caractères maximum",
                pattern: "Mot de passe invalide",
                nowhitespace: "Pas d'espace",
                equalTo: "Le mot de passe ne correspond pas"
            },

            // STEP 2
            ins_civilite: {
                required: "Ce champ est obligatoire"
            },
            ins_nom: {
                required: "Ce champ est obligatoire"
                // lettersonly: "Lettres seulement"
            },
            ins_prenom: {
                required: "Ce champ est obligatoire"
                // lettersonly: "Lettres seulement"
            },
            ins_date_nais: {
                required: false
                // required: "Ce champ est obligatoire"
            },
            ins_lieu_nais: {
                required: false
                 // required: "Ce champ est obligatoire"
                },

            // STEP 3
            ins_tel_dom: {
                required: false
            },
            ins_tel_por: {
                required: false
            },
            ins_adresse: {
                required: false
                // required: "Ce champ est obligatoire"
            },
            ins_cp: {
                required: false
                // required: "Ce champ est obligatoire"
            },
            ins_commune: {
                required: false
                // required: "Ce champ est obligatoire"
            }
        }
    });
});


