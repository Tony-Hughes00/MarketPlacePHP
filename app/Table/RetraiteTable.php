<?php

namespace App\Table;

use Core\Table\Table;

class RetraiteTable extends Table {
    
    protected $table = 'retraites';

    /**
     * SELECT query
     *
     * @param int $users_id
     * @return object
     */
    public function selectCaisseRetraite(int $users_id) {
        return $this->query("SELECT * FROM {$this->table} WHERE users_id = :users_id",
        ['users_id' => $users_id],
        true);
    }

    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insertCaisseRetraite(array $data) {
        return $this->query("INSERT INTO {$this->table} (
            users_id,
            caisse,
            gir
        ) VALUES (
            :users_id,
            :caisse,
            :gir
        )",
        [
            'users_id' => $data['users_id'],
            'caisse' => $data['caisse'],
            'gir' => $data['gir']
        ],
        true);
    }

    /**
     * UPDATE query
     *
     * @param int $users_id
     * @param array $data
     * @return object
     */
    public function updateCaisseRetraite(int $users_id, array $data) {
        return $this->query("UPDATE {$this->table} SET
            caisse = :caisse,
            gir = :gir
        WHERE users_id = :users_id",
        [
            'users_id' => $users_id,
            'caisse' => $data['caisse'],
            'gir' => $data['gir']
        ],
        true);
    }

}