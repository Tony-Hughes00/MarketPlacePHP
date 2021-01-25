        <!--
            Format optimal pour le référencement :
            <title>Primary Keyword - Secondary Keyword | Brand Name</title> (Google affiche 50–60 caractères)
            Exemple pour la page Chauffeur : <title>Devenir Chauffeur Bénévole | Réseau de Transport Solidaire en Ouest Sud Charente</title>
        -->
    <?php
        // Optimisation référencement : JSON for Linked Data (script à tester ici : https://search.google.com/structured-data/testing-tool)
        // JSON-LD meilleur que Microdata

        // (?) Redéfinir "name"
        // (!) Définir "legalName"
        // (!) Définir "url" (index avec nom de domaine)
        // (?) Redéfinir "logo"
        // (?) Redéfinir "founders"
        // (?) Redéfinir "address" :
        // https://www.google.com/maps/place/3+Rue+Henri+Dunant,+16190+Montmoreau-Saint-Cybard/@45.3972041,0.1279319,17z/data=!3m1!4b1!4m5!3m4!1s0x47ffdb14331ac77d:0xab2eebdf68e70ad!8m2!3d45.3972041!4d0.1301259
        // (?) Redéfinir "contactPoint"
        ?>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "Transport Solidaire en Sud Charente",
            // "legalName" : "À DÉFINIR",
            "url": "http://localhost/marketplace/index.php",
            "logo": "assets/images/Antenne_de_mobilite-Sud-Charente.jpg",
            "foundingDate": "2020",
            "founders": [{
                "@type": "Person",
                "name": "Jean-Pierre"
            }, {
                "@type": "Person",
                "name": "Isabelle"
            }],
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "3, avenue Henry Dunant",
                "addressLocality": "Montmoreau",
                "addressRegion": "Nouvelle-Aquitaine",
                "postalCode": "16190",
                "addressCountry": "France"
            },
            "contactPoint": {
                "@type": "ContactPoint",
                "contactType": "customer service",
                "telephone": "+33 7 82 32 76 33",
                "email": "contact@mosc.fr"
            }
        }
    </script>
