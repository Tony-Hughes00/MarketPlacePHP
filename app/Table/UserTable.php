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

class UserTable extends Table {
    
    protected $table = 'user';

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
     * UPDATE query via /modification
     *
     * @param int $id
     * @param array $data
     * @return object
     */

    public function insertProprietaire(array $data) {
        $data['user_type'] = 'prop';
        $data['valide'] = false;
        $data['changeMDP'] = false;
        $data['created_by'] = null;

        return $this->insert($data);
    }

    /**
     * UPDATE query via /modification
     *
     * @param int $id
     * @param array $data
     * @return object
     */
    public function updateProfilUser(int $id, array $data) {
        return $this->query("UPDATE {$this->table} SET
            nom = :nom,
            prenom = :prenom
        WHERE id = :id",
        [
            'id' => $id,
            'nom' => $data['nom'],
            'prenom' => $data['prenom']
        ],
        true);
    }
    /**
     * UPDATE query
     *
     * @param string $name
     * @param int $id
     * @return object
     */
    public function updateUserTech(int $id, string $nom, string $prenom, string $email) {
        return $this->query("UPDATE {$this->table} SET
            nom = :nom,
            prenom = :prenom,
            email = :email
        WHERE id = :id",
        ['id' => $id, 'nom' => $nom, 'prenom' => $prenom, 'email' => $email],
        true);
    }

    /**
     * UPDATE password only
     *
     * @param string $email
     * @param string $mdp
     * @return object
     */
    public function updateUserPassword(string $email, string $mdp) {
        return $this->query("UPDATE {$this->table} SET mdp = :mdp WHERE email = :email",
        [
            'email' => $email,
            'mdp' => $mdp
        ],
        true);
    }

    /**
     * DELETE query
     *
     * @param int $id
     * @return object
     */
    public function deleteUser(int $id) {
        return $this->query("DELETE FROM {$this->table} WHERE id = :id",
        ['id' => $id],
        true);
    }

}
