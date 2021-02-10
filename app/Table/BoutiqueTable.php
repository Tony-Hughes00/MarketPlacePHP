<?php

namespace App\Table;

use Core\Table\Table;

// `id_user` int(11) NOT NULL AUTO_INCREMENT,
// `email` varchar(255) NOT NULL,
// `password` varchar(255) NOT NULL,
// `user_type` enum('prop','client','gerant','admin') NOT NULL,
// `valide` tinyint(4) DEFAULT NULL,
// `changeMDP` tinyint(4) NOT NULL DEFAULT '1',
// `created_by` int(11) NOT NULL,
// `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

class BoutiqueTable extends Table {
    
    protected $table = 'boutique';

    /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function select(int $id) {
        return $this->query("SELECT * FROM {$this->table} WHERE id = {$id}",
        ['id' => $id],
        true);
    }

    // /**
    //  * SELECT a user with email field
    //  *
    //  * @param string $email
    //  * @return boolean
    //  */
    public function selectBy($col, string $email) {
        // var_dump("SELECT * FROM {$this->table} WHERE {$col} = '{$email}'");

        return $this->query("SELECT * FROM {$this->table} WHERE {$col} = '{$email}'");
    }
    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insert(array $data) {
        // var_dump($data);
        return $this->query("INSERT INTO {$this->table} (
            id_vendeur,
            nom_boutique
        ) VALUES (
            :id_vendeur,
            :nom_boutique
        )",
        [
            'id_vendeur' => $data['id_vendeur'],
            'nom_boutique' => $data['nom_boutique']
        ],
        true);
    }
    public function update($id, $data) {
      return $this->query("UPDATE {$this->table} SET
                  id_vendeur = :id_vendeur,
                  nom_boutique = :nom_boutique
              WHERE id_boutique = :id",
              [
                  'id' => $id,
                  'id_vendeur' => $data['id_vendeur'],
                  'nom_boutique' => $data['nom_boutique']
              ],
              true);
      }
    /**
     * DELETE query
     *
     * @param int $id
     * @return object
     */
    public function delete(int $id) {
        return $this->query("DELETE FROM {$this->table} WHERE id = :id",
        ['id' => $id],
        true);
    }

}
