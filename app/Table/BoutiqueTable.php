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
            email,
            mdp,
            user_type,
            nom,
            prenom,
            civilite,
            valide,
            changeMDP,
            created_by
        ) VALUES (
            :email,
            :mdp,
            :user_type,
            :nom,
            :prenom,
            :civilite,
            :valide,
            :changeMDP,
            :created_by
        )",
        [
            'email' => $data['email'],
            'mdp' => $data['mdp'],
            'user_type' => $data['user_type'],
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'civilite' => $data['civilite'],
            'valide' => $data['valide'],            
            'changeMDP' => $data['changeMDP'],
            'created_by' => $data['created_by']
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
