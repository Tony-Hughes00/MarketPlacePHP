<?php

namespace App\Table;

use Core\Table\Table;

class AdresseTable extends Table {
    
    protected $table = 'adresse';

       /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insert(object $data) {
      return $this->query("INSERT INTO {$this->table} (
          rue,
          complement,
          id_commune
      ) VALUES (
          :rue,
          :complement,
          :id_commune
      )",
      [
          'rue' => $data->rue,
          'complement' => $data->complement,
          'id_commune' => $data->id_commune
      ],
      true);
  }

  public function update($id, array $data) {

    return $this->query("UPDATE {$this->table} SET
                rue = :rue,
                complement = :complement,
                id_commune = :id_commune
            WHERE id_adresse = :id",
            [
                'id' => $id,
                'rue' => $data['rue'],
                'complement' => $data['complement'],
                'id_commune' => $data['id_commune']
            ],
            true);
    }

}
