<?php

namespace App\Controller;
use App;

class ErreurUtils
{
  /**
  * Function render tisane view
  *
  * @return void
  */
  function affiche($erreur) {
    echo '<div class="erreur">';
    echo $erreur['erreur'] . '<br />';
    echo $erreur['location'] . '<br />';
    echo '</div>';
  }
}
?>
<style>
.erreur {
  color: red;
}
</style>