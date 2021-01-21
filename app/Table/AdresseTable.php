<?php

namespace App\Table;

use Core\Table\Table;

class AdresseTable extends Table {
    
    protected $table = 'adresses';

    /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectAdresse(int $id) {
        return $this->query("SELECT * FROM {$this->table} WHERE id = :id",
        ['id' => $id],
        true);
    }
        /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectAdresseFull(int $id) {
        $query = "SELECT a.*, c.nom as nomCommune FROM adresses a ";
        $query = $query . " JOIN commune c ON c.id = a.commune ";
        $query = $query . " WHERE a.id = " . $id;
        return $this->query($query);
    }
    /**
     * UPDATE query
     *
     * @param string $name
     * @param int $id
     * @return object
     */
    public function updateAdresse($data, $id, $timestamp, $updated_by) {
        return $this->query("UPDATE {$this->table} SET
            adresse = :adresse,
            complement = :complement,
            commune = :commune,
            updated_at = :updated_at,
            updated_by = :updated_by
        WHERE id = :id",
        [   
            'id' => $id,
            'adresse' => $data->adresse, 
            'complement' => $data->complement,
            'commune' => $data->commune,
            'updated_at' => $timestamp,
            'updated_by' => $updated_by
        ],
        true);
    }

    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insertAdresse(array $data) {
        return $this->query("INSERT INTO {$this->table} (
            adresse,
            complement,
            code_postal,
            commune,
            created_at,
            created_by,
            updated_at,
            updated_by
        ) VALUES (
            :adresse,
            :complement,
            :code_postal,
            :commune,
            :created_at,
            :created_by,
            :updated_at,
            :updated_by
        )",
        [
            'adresse' => $data['adresse'],
            'complement' => $data['complement'],
            'code_postal' => $data['code_postal'],
            'commune' => $data['commune'],
            'created_at' => $data['created_at'],
            'created_by' => $data['created_by'],
            'updated_at' => $data['updated_at'],
            'updated_by' => $data['updated_by']
        ],
        true);
    }
        /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insertAdresseObj($data) {
        // var_dump("insertAdresse", $data);
        return $this->query("INSERT INTO {$this->table} (
            adresse,
            complement,
            commune,
            created_at,
            created_by,
            updated_at,
            updated_by
        ) VALUES (
            :adresse,
            :complement,
            :commune,
            :created_at,
            :created_by,
            :updated_at,
            :updated_by
        )",
        [
            'adresse' => $data->adresse,
            'complement' => $data->complement,
            'commune' => $data->commune,
            'created_at' => $data->created_at,
            'created_by' => $data->created_by,
            'updated_at' => $data->updated_at,
            'updated_by' => $data->updated_by
        ],
        true);
        // return App::getInstance()->getDb()->lastInsertId();
    }

    /**
     * DELETE query
     *
     * @param int $id
     * @return object
     */
    public function deleteAdresse(int $id) {
        return $this->query("DELETE FROM {$this->table} WHERE id = :id",
        ['id' => $id],
        get_called_class(),
        true);
    }

    /**
     * UPDATE query via /modification 
     *
     * @param int $id
     * @param array $data
     * @return object
     */
    public function updateProfilAdresse(int $id, array $data) {
        return $this->query("UPDATE {$this->table} SET
            adresse = :adresse,
            complement = :complement,
            code_postal = :code_postal,
            commune = :commune,
            updated_at = :updated_at,
            updated_by = :updated_by
        WHERE id = :id",
        [
            'id' => $id,
            'adresse' => $data['adresse'],
            'complement' => $data['complement'],
            'code_postal' => $data['code_postal'],
            'commune' => $data['commune'],
            'updated_at' => $data['updated_at'],
            'updated_by' => $data['updated_by']
        ],
        true);
    }

}