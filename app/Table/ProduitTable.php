<?php

namespace App\Table;

use Core\Table\Table;

class ProduitTable extends Table {
    
    protected $table = 'produit';

       /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insert(object $data) {

      return $this->query("INSERT INTO {$this->table} (
          nom_produit,
          code_produit,
          desc_produit,
          id_boutique,
          statut_produit,
          produit_detail,
          id_prod_categorie,
          id_supplier
      ) VALUES (
          :nom_produit,
          :code_produit,
          :desc_produit,
          :id_boutique,
          :statut_produit,
          :produit_detail,
          :id_prod_categorie,
          :id_supplier
      )",
      [
          'nom_produit' => $data->nom_produit,
          'code_produit' => $data->code_produit,
          'desc_produit' => $data->desc_produit,
          'id_boutique' => $data->id_boutique,
          'statut_produit' => $data->statut_produit,
          'produit_detail' => $data->produit_detail,
          'id_prod_categorie' => $data->id_prod_categorie,
          'id_supplier' => $data->id_supplier
      ],
      true);
  }
  public function update($id, array $data) {

    return $this->query("UPDATE {$this->table} SET
                nom_produit = :nom_produit,
                code_produit = :code_produit,
                desc_produit = :desc_produit,
                id_boutique = :id_boutique,
                statut_produit = :statut_produit,
                produit_detail = :produit_detail,
                id_prod_categorie = :id_prod_categorie,
                id_supplier = :id_supplier
            WHERE id_produit = :id",
            [
                'id' => $id,
                'nom_produit' => $data['nom_produit'],
                'code_produit' => $data['code_produit'],
                'desc_produit' => $data['desc_produit'],
                'id_boutique' => $data['id_boutique'],
                'statut_produit' => $data['statut_produit'],
                'produit_detail' => $data['produit_detail'],
                'id_prod_categorie' => $data['id_prod_categorie'],
                'id_supplier' => $data['id_supplier']
            ],
            true);
    }
}
