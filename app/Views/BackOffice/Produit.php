<?php
  // var_dump($user);
  require_once ROOT ."/app/Views/BackOffice/BoutiqueInfo.php"; 

?>
<form class="form-backoffice container" method="post" action="<?=ROUTE?>produit.0">
  <fieldset>
    <div class="row">
      <div class="col-12">
        <h3>Produits</h3>
      </div>
      <div class="col-12">
        <?php require_once ROOT ."/app/Views/BackOffice/ProduitList.php"; ?>
      </div>
      <div class="col-12">
      <i class="far fa-plus-square" data-toggle="collapse" data-target="#produitDetail"></i>
        <?php require_once ROOT ."/app/Views/BackOffice/ProduitNouveau.php"; ?>
      </div>
      <div class="col-12 text-center">
        <button type="submit">Ajouter</button>
      </div>
    </div>
  </fieldset>
</form>

<?php
// 'id_produit' => null,
//       'nom_produit' => "",
//       'desc_produit' => "",
//       'id_boutique' => "0",
//       'statut_produit' => "0",
//       'produit_detail' => "",
//       'id_prod_categorie' => "0",
//       'id_supplier' => "0"   
      
?>