
<?php
var_dump($boutique);

?>
<?php echo php_ini_loaded_file(); ?>
<form class="form-backoffice" method="post" action="<?=ROUTE?>boutique" enctype="multipart/form-data">
  <fieldset>
    <input type="hidden" id="id_boutique" name="id_boutique" value="<?=$boutique->id_boutique?>">
    <input type="hidden" id="id_vendeur" name="id_vendeur" value="<?=$boutique->id_vendeur?>">
    <div class="row"> 
      <div class="col-12 text-center">
        <h1>Boutique</h1>
      </div> 
      <div class="col-12">
        <div class="form-card p-3 p-md-5"  id="boutique">
          <label for="ins_nom">NOM</label>
          <input type="text" name="nom_boutique" id="nom_boutique" class="form-control"
                 required
            <?php
            if ($boutique != null) {
              echo ' value = "' . $boutique->nom_boutique . '"';
            }
            ?>
            >
            <label for="boutiqueImage">Mon Boutique</label>
            <div class="upload-wrapper">
              <span class="file-name">
              <label for="boutiqueImage">Choisissez un image...
                <input type="file" id="boutiqueImage" name="boutiqueImage" 
                    onchange="onChangeImage(this)" accept="image/*">
                </label>
              </span>
            </div>
            <!-- <input class="form-control" type="file" id="boutiqueImage" name="boutiqueImage"> -->
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
<script>
  function onChangeImage(input) {
    console.log("onChangeImage");
    let img = document.createElement('img');
    let file = document.getElementById('boutiqueImage');
    let boutique = document.getElementById("boutique");
    // img.src = file.value;
    boutique.appendChild(img);

    if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                img.src = e.target.result;
                    // .width(150)
                    // .height(200);
            };

            reader.readAsDataURL(input.files[0]);
    // xhttp.open("POST", "ajax_test.asp", true);
    // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // xhttp.send("fname=Henry&lname=Ford");
    console.log("file", file);
    }
  }
</script>