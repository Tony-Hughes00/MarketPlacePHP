<?php
// var_dump($boutique->produits);
  if (isset($boutique->produits)) {
    foreach($boutique->produits as $pr) { ?>
    <div class="row text-left" id="produitDetail">
      <div class="col-12 col-md-5">
        Nom : 
        <label id="nom_produit"><?=$pr->nom_produit?></label>
      </div>
      <div class="col-12 col-md-5">
        Code produit : 
        <label id="code_produit"><?=$pr->code_produit?></label>
      </div>
      <div class="col-12 col-md-2">
        Categorie : 
        <label id="id_prod_categorie"><?=$pr->id_prod_categorie?></label>
      </div>
      <div class="col-12 col-md-12">
        Description
        <label id="desc_produit"><?=$pr->desc_produit?></label>
      </div>
    </div>
    <div class="row collapse" id="produitEdit">
      <div class="col-12 col-md-5">
        <label for="nom_produit<?=$pr->id_produit?>">Nom</label>
        <label id="nom_produit" name="nom_produit" placeholder="<?=$pr->nom_produit?>">
      </div>
      <div class="col-12 col-md-5">
        <label for="code_produit<?=$pr->id_produit?>">Nom</label>
        <input type="text" id="code_produit" name="code_produit" placeholder="<?=$pr->code_produit?>">
      </div>
      <div class="col-12 col-md-2">
        <label for="id_prod_categorie<?=$pr->id_produit?>">Nom</label>
        <input type="text" id="id_prod_categorie" name="id_prod_categorie" value="0">
      </div>
      <div class="col-12 col-md-12">
        <label for="desc_produit<?=$pr->id_produit?>">Nom</label>
        <textarea type="textarea" id="desc_produit" name="desc_produit" placeholder="<?=$pr->desc_produit?>"></textarea>
      </div>
    </div>
    <input type="hidden" id="id_boutique<?=$pr->id_produit?>" name="id_boutique" value="<?=$id_boutique?>">
    <input type="hidden" id="statut_produit<?=$pr->id_produit?>" name="statut_produit" value="0">
    <?php
    }
  }
?>

<!-- <input type="text" id="produit_detail" name="produit_detail" placeholder="Détail"> -->

<!-- <i class="far fa-copy"></i> -->
</div>
