<?php function getNomCommune($id) {
  $loadCommune = App::getInstance()->getTable('Commune');
  $communes = $loadCommune->selectCommunes(); 
  foreach($communes as $commune) {
    if($commune->id == $id) {
      return $commune->nom;
    }
  }
} ?>

<div class="container">
    <div class="row my-2">
    <h4 class="mx-auto justify-content-center">Les Antennes de Mobilité en Sud Charente</h4>
    </div>
    <table class="text-center bg-light mx-auto table border-1 table-hover table-sm table-responsive-md">
      <tr>
        <th> PNM</th>
        <th> Nom</th>
        <th> Service</th>   
        <th> Commune</th>
        <th> Suppression</th>
      </tr>
      <?php
      
        $loadPnm = App::getInstance()->getTable('Pnm');
        $Pnms = $loadPnm->selectPnms(); 
        foreach($Pnms as $Pnm) {
        
      ?>
      <tr class="table-secondary">
        <td>
          <a href="fichePnm.<?= $Pnm->id_pnm ?>">
            <i class="fas fa-edit" alt="modifier"></i>
          </a>
        </td>
       <td> <?= $Pnm->titre_pnm ?></td>
        <td> <?= $Pnm->struct_pnm ?></td>  
         <td> <?= getNomCommune($Pnm->ville_pnm) ?></td>
  
        <td>
          <div data-toggle="modal" data-target="#supModal"
            onclick="onDelete('deletePnm.<?=$Pnm->id_pnm?>')">
            <i 
                class="fas fa-trash">
            </i>
          </div>
        </td> 
      </tr>
      <?php
        }
      ?>
    </table>
    <div></div>

 </div>
 <div id="supModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h2 class="text-white">Confirmation de la suppression.</h2>
        <button type="button" class="close" data-dismiss="modal">&times; Fermer</button> 
      </div>
      <div class="row modal-body mx-auto text-center">
        <div class="col-12 col-md-6">
          <a class="btn-ins btn btn-secondary px-2" href=""
          id="supLink">Supprimer</a>
        </div>
        <div class="col-12 col-md-6">
          <a class="btn-ins btn btn-secondary px-2" href="#" class="close" data-dismiss="modal">Annuler</a>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function onDelete(id) {
    console.log("onDelete, id");

    hrefSup = document.getElementById("supLink");
    console.log(hrefSup);
    hrefSup.setAttribute("href", id);
    console.log(document.getElementById("supLink").href);
  }
</script>