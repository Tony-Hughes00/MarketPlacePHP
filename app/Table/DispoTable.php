<?php

namespace App\Table;

use Core\Table\Table;

class DispoTable extends Table {
    
    protected $table = 'dispo';

    /**
     * SELECT query Dispos
     *
     * @param int $id
     * @return object
     */
    public function selectDispoPnm(int $id) {
        return $this->query("SELECT * FROM {$this->table} WHERE id_pnm = ".$id . " ORDER BY jour_dispo, h_dbt ASC");
    }
      /**
     * SELECT query Lundi
     *
     * @param int $id
     * @return object
     */
    public function selectDispoLun(int $id) {
        return $this->query("SELECT * FROM {$this->table} WHERE id_pnm = ".$id . " && jour_dispo = 1 ORDER BY h_dbt ASC ");
    }

          /**
     * SELECT query Mardi
     *
     * @param int $id
     * @return object
     */
    public function selectDispoMar(int $id) {
        return $this->query("SELECT * FROM {$this->table} WHERE id_pnm = ".$id . " && jour_dispo = 2 ORDER BY h_dbt ASC ");
    }

    
          /**
     * SELECT query Mercredi
     *
     * @param int $id
     * @return object
     */
    public function selectDispoMer(int $id) {
        return $this->query("SELECT * FROM {$this->table} WHERE id_pnm = ".$id . " && jour_dispo = 3 ORDER BY h_dbt ASC ");
    }

    
          /**
     * SELECT query Jeudi
     *
     * @param int $id
     * @return object
     */
    public function selectDispoJeu(int $id) {
        return $this->query("SELECT * FROM {$this->table} WHERE id_pnm = ".$id . " && jour_dispo = 4 ORDER BY h_dbt ASC ");
    }

    
          /**
     * SELECT query Vendredi
     *
     * @param int $id
     * @return object
     */
    public function selectDispoVen(int $id) {
        return $this->query("SELECT * FROM {$this->table} WHERE id_pnm = ".$id . " && jour_dispo = 5 ORDER BY h_dbt ASC ");
    }
     /**
     * SELECT query Samedi
     *
     * @param int $id
     * @return object
     */
    public function selectDispoSam(int $id) {
        return $this->query("SELECT * FROM {$this->table} WHERE id_pnm = ".$id . " && jour_dispo = 6 ORDER BY h_dbt ASC ");
    }
     /**
     * SELECT query Samedi
     *
     * @param int $id
     * @return object
     */
    public function selectDispoTrajet(int $id) {
        // var_dump("SELECT * FROM {$this->table} WHERE id_trajet = ".$id . " ORDER BY jour_dispo ASC ");
        return $this->query("SELECT * FROM {$this->table} WHERE id_trajet = ".$id . " ORDER BY jour_dispo ASC ");
    }
     /**
     * SELECT query Samedi
     *
     * @param int $id
     * @return object
     */
    public function selectDispoParcours(int $idParcours) {
        $query = "SELECT d.*, t.direction FROM dispo d ";
        $query = $query . " JOIN trajet t ON t.id = d.id_trajet ";
        $query = $query . " JOIN parcours p on t.parcours = p.id ";
        $query = $query . " WHERE p.id = " . $idParcours . " ";
        $query = $query . " ORDER BY jour_dispo ASC ";

        return $this->query($query);
    }
    /**
     * SELECT query Samedi
     *
     * @param int $id
     * @return object
     */
    public function selectDispoUsers() {
        $query = "SELECT a.commune as commune, ";
        $query = $query . " d.jour_dispo as jour_dispo, ";
        $query = $query . " d.h_dbt as h_dbt, ";
        $query = $query . " d.h_fin as h_fin, ";
        $query = $query . " m.civilite as civilite, u.nom as nom, u.id as user_id ";
        $query = $query . " FROM dispo d ";
        $query = $query . " JOIN membres m ON m.users_id = d.id_user ";
        $query = $query . " JOIN adresses a ON m.adresse = a.id ";
        $query = $query . " JOIN users u ON u.id = m.users_id ";
        $query = $query . " WHERE id_user > 0 ";
        $query = $query . " ORDER BY id_user ";
        $query = $query . " , jour_dispo ASC ";
// var_dump($query);
// echo $query;
        return $this->query($query);
    }
    /**
     * SELECT query Samedi
     *
     * @param int $id
     * @return object
     */
    public function selectDispoUser($userId) {
        $query = "SELECT a.commune as commune, ";
        $query = $query . " d.jour_dispo as jour_dispo, ";
        $query = $query . " d.h_dbt as h_dbt, ";
        $query = $query . " d.h_fin as h_fin, ";
        $query = $query . " m.civilite as civilite, u.nom as nom, u.id as user_id ";
        $query = $query . " FROM dispo d ";
        $query = $query . " JOIN membres m ON m.users_id = d.id_user ";
        $query = $query . " JOIN adresses a ON m.adresse = a.id ";
        $query = $query . " JOIN users u ON u.id = m.users_id ";
        $query = $query . " WHERE id_user = " . $userId;
        $query = $query . " ORDER BY jour_dispo ASC ";

// var_dump($query);
// echo $query;
        return $this->query($query);
    }
     /**
     * SELECT query Samedi
     *
     * @param int $id
     * @return object
     */
    public function selectDispoParcoursInfoBlock(int $idParcours) {
        $query = "SELECT d.*, t.direction FROM dispo d ";
        $query = $query . " JOIN trajet t ON t.id = d.id_trajet ";
        $query = $query . " JOIN parcours p on t.parcours = p.id ";
        $query = $query . " WHERE p.id = " . $idParcours . " ";
        $query = $query . " ORDER BY jour_dispo ASC ";

        return $this->query($query);
    }    
    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insertDispo(array $data) {
        return $this->query("INSERT INTO {$this->table} (
            id_pnm,
            -- id_user,
            jour_dispo,
            h_dbt,
            h_fin
        ) VALUES (
            :id_pnm,
            -- :id_user,
            :jour_dispo,
            :h_dbt,
            :h_fin
        )",
        [
            'id_pnm' => $data['id_pnm'],
            // 'id_user' => $data['id_user'],
            'jour_dispo' => $data['jour_dispo'],
            'h_dbt' => $data['h_dbt'],
            'h_fin' => $data['h_fin']
        ],
        get_called_class(),
        true);
    }
        /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insertDispoTrajet(array $data) {
        return $this->query("INSERT INTO {$this->table} (
            id_trajet,
            -- id_user,
            jour_dispo,
            h_dbt,
            h_fin
        ) VALUES (
            :id_trajet,
            -- :id_user,
            :jour_dispo,
            :h_dbt,
            :h_fin
        )",
        [
            'id_trajet' => $data['id_trajet'],
            // 'id_user' => $data['id_user'],
            'jour_dispo' => $data['jour_dispo'],
            'h_dbt' => $data['h_dbt'],
            'h_fin' => $data['h_fin']
        ],
        get_called_class(),
        true);
    }

    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insertDispoUser(array $data) {
        return $this->query("INSERT INTO {$this->table} (
            id_user,
            jour_dispo,
            h_dbt,
            h_fin
        ) VALUES (
            :id_user,
            :jour_dispo,
            :h_dbt,
            :h_fin
        )",
        [
            'id_user' => $data['id_user'],
            'jour_dispo' => $data['jour_dispo'],
            'h_dbt' => $data['h_dbt'],
            'h_fin' => $data['h_fin']
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
    public function updateDispo(string $name, int $id) {
        // return $this->query("UPDATE {$this->table} SET nom = :nom WHERE id = :id",
        // ['id' => $id, 'name' => $name],
        // get_called_class(),
        // true);
    }

    /**
     * DELETE query
     *
     * @param int $id
     * @return object
     */
    public function delete(int $id) {
        // return $this->query("DELETE FROM {$this->table} WHERE id = :id",
        // ['id' => $id],
        // get_called_class(),
        // true);
    }
        /**
     * DELETE query
     *
     * @param int $id
     * @return object
     */
    public function deletePnm(int $id) {
        return $this->query("DELETE FROM {$this->table} WHERE id_pnm = :id",
        ['id' => $id],
        get_called_class(),
        true);
    }
    /**
     * DELETE query
     *
     * @param int $id
     * @return object
     */
    public function deleteDispoTrajet(int $trajetId) {
        return $this->query("DELETE FROM {$this->table} WHERE id_trajet = " . $trajetId);
        // ['id' => $id],
        // get_called_class(),
        // true);
    }
        /**
     * DELETE query
     *
     * @param int $id
     * @return object
     */
    public function deleteUserTrajet(int $userId) {
        return $this->query("DELETE FROM {$this->table} WHERE id_user = " . $userId);
        // ['id' => $id],
        // get_called_class(),
        // true);
    }
    /*
    * DELETE query
    *
    * @param int $id
    * @return object
    */
   public function deleteUser(int $userId) {
    $query = "DELETE FROM {$this->table} WHERE id_user = " . $userId;
    //    var_dump($query);
    //    echo $query;
       return $this->query($query);
       // ['id' => $id],
       // get_called_class(),
       // true);
   }

}