<?php

namespace App\Table;

use Core\Table\Table;

class PnmTable extends Table {
    
    protected $table = 'pnm';

    /**
     * SELECT query by id
     *
     * @param int $id
     * @return object
     */
    public function selectPnm(int $id) {
        return $this->query("SELECT * FROM {$this->table} WHERE id_pnm = :id",
        ['id' => $id],
        get_called_class(),
        true);
    }

    
     /**
     * SELECT pnm by tech
     *
     * @param int $id
     * @return object
     */
    public function selectPnmByTech(int $id) {
        return $this->query("SELECT techniciens.*,pnm.*
         FROM techniciens
         INNER JOIN pnm ON techniciens.pnm_id  = pnm.id_pnm 
         WHERE techniciens.id = :id",
         ['id' => $id],
        get_called_class(),
        true);
             
         }
     


    /**
     * SELECT all query
     *
     * @return object
     */

    public function selectPnms() {
        return $this->query("SELECT * FROM {$this->table} order by id_pnm");
    }

    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insertPnm(array $data) {
        return $this->query("INSERT INTO {$this->table} (
            titre_pnm,
            struct_pnm,
            tel_pnm,
            mail_pnm,
            site_pnm,
            adr_pnm,
            cp_pnm,
            ville_pnm
        ) VALUES (
            :titre_pnm,
            :struct_pnm,
            :tel_pnm,
            :mail_pnm,
            :site_pnm,
            :adr_pnm,
            :cp_pnm,
            :ville_pnm
        )",
        [
            'titre_pnm' => $data['titre_pnm'],
            'struct_pnm' => $data['struct_pnm'],
            'tel_pnm' => $data['tel_pnm'],
            'mail_pnm' => $data['mail_pnm'],
            'site_pnm' => $data['site_pnm'],
            'adr_pnm' => $data['adr_pnm'],
            'cp_pnm' => $data['cp_pnm'],
            'ville_pnm' => $data['ville_pnm']
        ],
        get_called_class(),
        true);
    }

  /**
     * UPDATE query Terr
     *
     * @param string $communes
     * @param int $id
     * @return object
     */

    // public function updateTerr(string $communes, int $id) {
    //     $query = "UPDATE pnm SET communes ='" . $communes . "' WHERE id_pnm = " .$id ;
    //     // var_dump($query);
    //     return $this->query($query);
    // }

    /**
     * UPDATE query Territoire
     *
     * @param string $name
     * @param int $id
     * @return object
     */
    public function updateTerr(string $communes, int $id) {
        return $this->query("UPDATE {$this->table} SET communes = :communes WHERE id_pnm = :id",
        [':id' => $id, ':communes' => $communes],
        get_called_class(),
        true);
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
    public function updatePnm($pnm_id, array $data) {
        return $this->query("UPDATE {$this->table} SET
        titre_pnm = :titre_pnm,
        struct_pnm = :struct_pnm,
        tel_pnm = :tel_pnm,
        mail_pnm = :mail_pnm,
        site_pnm = :site_pnm,
        adr_pnm = :adr_pnm,
        cp_pnm = :cp_pnm,
        ville_pnm = :ville_pnm
    WHERE id_pnm = :id_pnm",
    [
        'id_pnm' => $pnm_id,
        'titre_pnm' => $data['titre_pnm'],
        'struct_pnm' => $data['struct_pnm'],
        'tel_pnm' => $data['tel_pnm'],
        'mail_pnm' => $data['mail_pnm'],
        'site_pnm' => $data['site_pnm'],
        'adr_pnm' => $data['adr_pnm'],
        'cp_pnm' => $data['cp_pnm'],
        'ville_pnm' => $data['ville_pnm']    
    ],
    true);
    }

}
