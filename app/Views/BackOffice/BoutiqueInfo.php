<?php
$id_boutique = 0;
$id_vendeur = 0;
$img_boutique = "";
$id_cat = 0;
$id_com = 0;
$rue = "";
$complement = "";
// var_dump($boutique);
if ($boutique) {
  $id_boutique = $boutique->id_boutique;
  $id_vendeur = $boutique->id_vendeur;
  $img_boutique = $boutique->img_boutique;
  $id_cat = $boutique->cat_boutique;
  if ($boutique->adresse) {
    $rue = $boutique->adresse->rue;
    $complement = $boutique->adresse->complement;
  }
}