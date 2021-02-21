This is the backoffice profile

<div class="row">
<?php
var_dump($user->boutique);

    foreach ($user->boutique as $b) {
      echo '<div class="col"><a href="boutiqueById.' . $b->id_boutique . '"><i class="far fa-edit" alt="modifier"></i></a>';
      echo $b->nom_boutique;
      echo '<a href="tdb.' . $b->id_boutique . '"><i class="fas fa-store" alt="modifier"></i></a>';
      echo '</div>';
    } 


?>
</div>
            <a class="btn-ins btn btn-secondary" style="font-size: 18px;" 
            href="boutique">
            créer votre boutique           
            </a>