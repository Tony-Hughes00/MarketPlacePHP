
        <!-- Ordre des scripts : jQuery -> Popper.js -> Bootstrap -->

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="></script>

        <!-- Smart Wizard (jQuery) -->
        <script src="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js"
            type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"
            type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/additional-methods.min.js"
            type="text/javascript"></script>

        <!-- Popper -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
        </script>

        <!-- <script src="RACINEjs/script.js" type="text/javascript"></script> -->
        <!-- <script src="RACINEjs/carte.js" type="text/javascript"></script> -->
        <!-- include_once ROOT."/app/Views/carte/carteEvents.php"; -->
        <script src="<?= RACINE ?>js/jquery.validate.js" type="text/javascript"></script>
        <script src="<?= RACINE ?>js/form.js" type="text/javascript"></script>
        <script src="<?= RACINE ?>js/backoffice.js" type="text/javascript"></script>

        <?php if (!isset($_COOKIE['animWatched'])) { ?>
        <script src="<?= RACINE ?>js/newcomerAnimation.js" type="text/javascript"></script>
        <?php } ?>
