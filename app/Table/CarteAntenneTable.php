<?php

namespace App\Table;

use Core\Table\Table;

class CarteAntenneTable extends Table {
    
    protected $table = 'carteantenne';

    /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectCarteAntenne(int $id) {
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
    public function selectAll() {
        return $this->query("SELECT * FROM {$this->table}");
    }
        /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectAllCarte() {
        return $this->query("SELECT * FROM `carteantenne` JOIN commune ON carteantenne.commune = commune.id WHERE 1");
    }
    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insertCarteAntenne(array $data) {
        return $this->query("INSERT INTO {$this->table} (
            id,
            nom
        ) VALUES (
            :id,
            :nom
        )",
        [
            'id' => $data['id'],
            'nom' => $data['nom']
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
    public function updateCarteAntenne(string $name, int $id) {
        return $this->query("UPDATE {$this->table} SET nom = :nom WHERE id = :id",
        ['id' => $id, 'name' => $name],
        get_called_class(),
        true);
    }

    /**
     * DELETE query
     *
     * @param int $id
     * @return object
     */
    public function deleteCarteAntenne(int $id) {
        return $this->query("DELETE FROM {$this->table} WHERE id = :id",
        ['id' => $id],
        get_called_class(),
        true);
    }

}
