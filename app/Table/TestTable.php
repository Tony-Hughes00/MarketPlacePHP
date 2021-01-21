<?php

namespace App\Table;

use Core\Table\Table;

class TestTable extends Table {
    
    protected $table = 'test';

    /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectTest(int $id) {
        return $this->query("SELECT * FROM {$this->table} WHERE id = :id",
        ['id' => $id],
        get_called_class(),
        true);
    }

    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insertTest(array $data) {
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
    public function updateTest(string $name, int $id) {
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
    public function deleteTest(int $id) {
        return $this->query("DELETE FROM {$this->table} WHERE id = :id",
        ['id' => $id],
        get_called_class(),
        true);
    }

}
