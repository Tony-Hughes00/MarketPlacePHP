
<?php
var_dump($boutique);
var_dump($_SESSION);
?>
<form class="backoffice" method="post" action="<?=ROUTE?>boutique">
  <fieldset>
    <input type="hidden" id="id_boutique" name="id_boutique" value="0">
    <div class="row"> 
      <div class="col-12 text-center">
        <h1>Boutique</h1>
      </div> 
      <div class="col-12">
        <div class="form-card p-3 p-md-5">
          <label for="ins_nom">NOM</label>
          <input type="text" name="nom_boutique" id="nom_boutique" class="form-control"
                 required
            <?php
            if ($boutique != null) {
              echo ' value = "' . $boutique->nom_boutique . '"';
            }
            ?>
            >
        <!-- < ?php var_dump($boutique); ?> -->
        </div>
      </div>
      <div class="col-12">
        <button type="submit" name="submit" id="submit" class="action-button">
              Confirmer la création
        </button>
      </div>
    </div>
  </fieldset>
</form>