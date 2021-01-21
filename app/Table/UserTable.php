<?php

namespace App\Table;

use Core\Table\Table;

class UserTable extends Table {
    
    protected $table = 'users';

    /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectUser(int $id) {
        return $this->query("SELECT * FROM {$this->table} WHERE id = :id",
        ['id' => $id],
        true);
    }

    /**
     * SELECT a user with email field
     *
     * @param string $email
     * @return boolean
     */
    public function selectUserByEmail(string $email) {
        return $this->query("SELECT * FROM users WHERE email = :email",
        ['email' => $email],
        true);
    }

    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insertUser(array $data) {
        return $this->query("INSERT INTO {$this->table} (
            nom,
            prenom,
            email,
            mdp
        ) VALUES (
            :nom,
            :prenom,
            :email,
            :mdp
        )",
        [
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'mdp' => $data['mdp']
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
