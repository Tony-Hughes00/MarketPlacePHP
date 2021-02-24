<?php

var_dump($boutique);
?>
<div class="row">
<?php
  // foreach ($boutique as $b) {
    echo '<div class="col">';
      echo $boutique->nom_boutique;
    echo '</div>';
  // }
?>
</div>
<div class="row">
  <div class="col-12 col-md-4">
    Vents
  </div>
  <div class="col-12 col-md-4">
    Stock
  </div>
  <div class="col-12 col-md-4">
    produits
    <div>
    <?php
      echo '<div class="col"><a href="produit.' . $boutique->id_boutique . '">';
      echo '<i class="far fa-edit" alt="modifier"></i>';
      echo '</a>';
    ?>
  </div>
  </div>

</div>