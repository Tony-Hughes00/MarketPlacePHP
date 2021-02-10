<?php

var_dump($boutique);
?>
<div class="row">
<?php
  foreach ($boutique as $b) {
    echo '<div class="col">';
      echo $b->nom_boutique;
    echo '</div>';
  }
?>
</div>