<?php

namespace App\Table;

use Core\Table\Table;
use DateTime;

class CommuneTable extends Table {
    
    protected $table = 'commune';

    /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectCommune(int $id) {
        return $this->query("SELECT * FROM {$this->table} WHERE id = :id",
        ['id' => $id],
        get_called_class(),
        true);
    }
        /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectPostCodeCommune(int $id) {
        return $this->query("SELECT code_postal FROM {$this->table} WHERE id = :id",
        ['id' => $id],
        get_called_class(),
        true);
    }

    /**
     * SELECT query
     *
     * @param none
     * @return object
     */
    public function selectCommunes() {
        return $this->query("SELECT * FROM {$this->table} ORDER BY nom");
    }

    /**
     * SELECT query
     *
     * @param none
     * @return object
     */
    public function selectCommunesByPnm($pnmId) {
        return $this->query("SELECT * FROM {$this->table} WHERE pnm = {$pnmId} ORDER BY nom");
    }
     /**
     * SELECT query limit 23
     *
     * @param none
     * @return object
     */
    public function selectCommunes1() {
        return $this->query("SELECT * FROM {$this->table} ORDER BY nom LIMIT 23");
    }

    /**
     * SELECT query limit 23 offset 23
     *
     * @param none
     * @return object
     */
    public function selectCommunes2() {
        return $this->query("SELECT * FROM {$this->table} ORDER BY nom LIMIT 23, 23");
    }

    /**
     * SELECT query limit 23 offset 46
     *
     * @param none
     * @return object
     */
    public function selectCommunes3() {
        return $this->query("SELECT * FROM {$this->table} ORDER BY nom LIMIT 46, 23");
    }
     /**
     * SELECT query limit 22 offset 69
     *
     * @param none
     * @return object
     */
    public function selectCommunes4() {
        return $this->query("SELECT * FROM {$this->table} ORDER BY nom LIMIT 69, 22");
    }
         /**
     * SELECT query limit 22 offset 69
     *
     * @param none
     * @return object
     */
    public function updatePnm($communeId, $pnm) {
        return $this->query("UPDATE {$this->table} SET pnm = " . $pnm . " WHERE id = " . $communeId);
    }
    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insertCommune(array $data) {
        $date = new DateTime();
//        $date=date_create("2013-03-15");
        $timeStamp = date_format($date,"Y/m/d H:i:s");
        return $this->query("INSERT INTO {$this->table} (
            id,
            nom,
            pnm,
            created_at,
            created_by,
            updated_at,
            updated_by
        ) VALUES (
            :id,
            :nom,
            :pnm,
            :created_at,
            :created_by,
            :updated_at,
            :updated_by
        )",
        [
            'id' => $data['id'],
            'nom' => $data['nom'],
            'pnm' => $data['pnm'],
            'created_at' => $timeStamp,    //   #### TODO ######
            'created_by' => 1,
            'updated_at' => $timeStamp,     //   #### TODO ######
            'updated_by' => 1,
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
    public function updateCommune(string $nom, int $id) {
        return $this->query("UPDATE {$this->table} SET nom = :nom WHERE id = :id",
        ['id' => $id, 'nom' => $nom],
        get_called_class(),
        true);
    }

    /**
     * DELETE query
     *
     * @param int $id
     * @return object
     */
    public function deleteCommune(int $id) {
        return $this->query("DELETE FROM {$this->table} WHERE id = :id",
        ['id' => $id],
        get_called_class(),
        true);
    }

}
