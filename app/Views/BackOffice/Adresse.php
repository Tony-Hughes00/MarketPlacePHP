<?php
?>
<div class="row">
  <div class="col-12 col-md-12 text-center mt-3">
      <h3>Adresse : </h3>
  </div>
  <div class="col-12 col-md-12">
    <label for="rue">Rue : </label>
    <input type="text" id="rue" name="rue"
      <?php echo 'value="' . $rue . '"'?>>
  </div>
  <div class="col-12 col-md-12">
    <label for="rue">Complement : </label>
    <input type="text" id="complement" name="complement"
    <?php echo 'value="' . $complement . '"'?>>
  </div>
  <div class="col-12">
    <?php require_once ROOT ."/app/Views/BackOffice/Commune.php"; ?>
  </div>
</div>