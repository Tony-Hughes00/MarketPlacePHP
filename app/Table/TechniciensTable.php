<?php

namespace App\Table;

use Core\Table\Table;

class TechniciensTable extends Table {
    
    protected $table = 'techniciens';

    /**
     * Select foreign infos via email
     *
     * @param int $id
     * @return object
     */
    public function selectInfosById(int $id) {
        return $this->query("SELECT techniciens.*, users.*
            FROM (techniciens
            INNER JOIN users ON techniciens.users_id = users.id)
            WHERE users.id = :id",
        ['id' => $id],
        true);
    }
    /**
     * Select foreign infos via email
     *
     * @param int $id
     * @return object
     */
    public function selectAll() {
        return $this->query("SELECT techniciens.*, users.*
            FROM (techniciens
            INNER JOIN users ON techniciens.users_id = users.id)");
    }

    /**
     * Select foreign infos via email
     *
     * @param string $email
     * @return object
     */
    public function selectInfosByEmail(string $email) {
        return $this->query("SELECT techniciens.*, users.*
            FROM (techniciens
            INNER JOIN users ON techniciens.users_id = users.id)
            WHERE users.email = :email",
        ['email' => $email],
        true);
    }

    /**
     * SELECT userbypnm
     *
     * @param int $id
     * @return object
     */
    public function selectUserbyTech(int $id) {
        return $this->query("SELECT techniciens.*,users.*
         FROM users
         INNER JOIN techniciens ON techniciens.users_id  = users.id 
         WHERE techniciens.pnm_id = ".$id);
         }

         

    public function insertTechniciens(array $data) {
        return $this->query("INSERT INTO {$this->table} (
            users_id,
            civilite_tech,
            tel,
            statut,
            pnm_id
          ) VALUES (
            :users_id,
            :civilite_tech,
            :tel,
            :statut,
            :pnm_id
        )",
        [
            'users_id' => $data['users_id'],
            'civilite_tech' => $data['civilite_tech'],
            'tel' => $data['tel'],
            'statut' => $data['statut'],
            'pnm_id' => $data['pnm_id']
            
        ],
        get_called_class(),
        true);
    }
    /**
     * UPDATE query
     *
     * @param string $name
     * @param int $id
     * @return object
     */
    public function updateTech(int $users_id, string $civilite_tech, string $tel, int $pnm_id) {
        return $this->query("UPDATE {$this->table} SET
            civilite_tech = :civilite_tech,
            tel = :tel,
            pnm_id = :pnm_id
        WHERE users_id = :users_id",
        ['users_id' => $users_id, 'civilite_tech' => $civilite_tech, 'tel' => $tel, 'pnm_id' => $pnm_id],
        true);
    }

}