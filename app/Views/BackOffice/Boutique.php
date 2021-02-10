
<?php
// var_dump($user);
?>
<form class="backoffice">
  <fieldset>
    <div class="row"> 
      <div class="col-12 text-center">
        <h1>Boutique</h1>
      </div> 
      <div class="col-12">
        <div class="form-card p-3 p-md-5">
          <label for="ins_nom">NOM</label>
          <input type="text" name="ins_nom" id="ins_nom" class="form-control"
                 required
            <?php
            if ($boutique != null) {
              // echo ' value = "' . $boutique->nom . '"';
            }
            ?>
            >
 
        <?php var_dump($boutique); ?>
        </div>
      </div>
    </div>
  </fieldset>
</form>