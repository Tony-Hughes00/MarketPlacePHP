<?php

namespace App\Table;

use Core\Table\Table;

use DateTime;
use DatePeriod;
use DateInterval;
use DateTimeZone;

class DocumentTable extends Table {
    
    protected $table = 'documents';

    /**
     * SELECT query
     *
     * @param int $users_id
     * @param string $doc_type
     * @return object
     */
    public function selectDocument(int $users_id, string $doc_type) {
        return $this->query("SELECT * FROM {$this->table} WHERE users_id = :users_id AND doc_type = :doc_type",
        ['users_id' => $users_id, 'doc_type' => $doc_type],
        true);
    }

    /**
     * Select a user's documents via email
     *
     * @param string $email
     * @return object
     */
    public function selectDocsByEmail(string $email) {
        return $this->query("SELECT documents.*, users.*
            FROM (documents
            INNER JOIN users ON documents.users_id = users.id)
            WHERE users.email = :email",
        ['email' => $email],
        true);
    }

    public function selectDocsAJour(string $email, string $doc_type) {
        return $this->query("SELECT documents.*, users.*
            FROM (documents
            INNER JOIN users ON documents.users_id = users.id)
            WHERE users.email = :email
            AND documents.doc_type = :doc_type",
        ['email' => $email, 'doc_type' => $doc_type],
        true);
    }

    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insertDocument(array $data) {
        return $this->query("INSERT INTO {$this->table} (
            users_id,
            doc_type,
            doc_name,
            valide,
            expiration,
            created_at,
            created_by,
            updated_at,
            updated_by
        ) VALUES (
            :users_id,
            :doc_type,
            :doc_name,
            :valide,
            :expiration,
            :created_at,
            :created_by,
            :updated_at,
            :updated_by
        )",
        [
            'users_id' => $data['users_id'],
            'doc_type' => $data['doc_type'],
            'doc_name' => $data['doc_name'],
            'valide' => $data['valide'],
            'expiration' => $data['expiration'],
            'created_at' => $data['created_at'],
            'created_by' => $data['created_by'],
            'updated_at' => $data['updated_at'],
            'updated_by' => $data['updated_by']
        ],
        true);
    }

    /**
     * UPDATE query
     *
     * @param int $users_id
     * @param string $doc_type
     * @param array $data
     * @return object
     */
    public function updateDocument(int $users_id, string $doc_type, array $data) {
        return $this->query("UPDATE {$this->table} SET
            doc_name = :doc_name,
            updated_at = :updated_at,
            updated_by = :updated_by
        WHERE users_id = :users_id
        AND doc_type = :doc_type",
        [
            'users_id' => $users_id,
            'doc_type' => $doc_type,
            'doc_name' => $data['doc_name'],
            'updated_at' => $data['updated_at'],
            'updated_by' => $data['updated_by']
        ],
        true);
    }

    /**
     * Validate a document
     *
     * @param int $users_id
     * @param string $doc_type
     * @param int $valide
     * @return object
     */
    public function validateDocument(int $users_id, string $doc_type, int $valide) {
        return $this->query("UPDATE {$this->table} SET
            valide = :valide
        WHERE users_id = :users_id
        AND doc_type = :doc_type",
        [
            'users_id' => $users_id,
            'doc_type' => $doc_type,
            'valide' => $valide
        ],
        true);
    }

    /**
     * Expiration date
     *
     * @param int $users_id
     * @param string $doc_type
     * @param string $expiration
     * @return object
     */
    public function expirationDocument(int $users_id, string $doc_type, string $expiration) {
        return $this->query("UPDATE {$this->table} SET
            expiration = :expiration
        WHERE users_id = :users_id
        AND doc_type = :doc_type",
        [
            'users_id' => $users_id,
            'doc_type' => $doc_type,
            'expiration' => $expiration
        ],
        true);
    }
    


    public function docsManquant($commune = null, $dossier = false) {
        $query = "";
        $query = $query . "SELECT d.doc_name as doc_name, ";
        $query = $query . "d.doc_type as doc_type, d.users_id as users_id, "; 
        $query = $query . "d.expiration as expiration, d.valide as valide, "; 
        $query = $query . "m.civilite as civilite, "; 
        $query = $query . "u.prenom as prenom, ";
        $query = $query . "u.nom as nom, ";
        $query = $query . "c.nom as nomCommune, ";
        $query = $query . "pnm.id_pnm as id_pnm, pnm.titre_pnm as titre_pnm, ";
        $query = $query . "DATE_FORMAT(m.created_at, '%d/%m/%Y') as created_at ";
        $query = $query . "FROM `users` u ";
        $query = $query . "JOIN membres m ON u.id = m.users_id ";
        $query = $query . "JOIN documents d ON u.id = d.users_id ";
        $query = $query . "JOIN adresses a ON m.adresse = a.id ";
        $query = $query . "JOIN commune c ON a.commune = c.id ";
        $query = $query . "JOIN pnm ON pnm.id_pnm = c.pnm ";
        $query = $query . "WHERE d.doc_name is null ";
        $query = $query . " AND m.membre_type = 'chauffeur' ";
        if ($commune != null) {
            $query = $query . " AND a.commune = " . $commune;
        }
        if ($dossier == true) {
            $query = $query . " ORDER BY pnm.id_pnm, u.id";
        }

        // echo $query;
        // var_dump($query);
        return $this->query($query);
    }
    public function docExpiration($commune = null, $dossier = false) {
        $timeZone = new DateTimeZone('Europe/Paris');
        $now = new DateTime(null, $timeZone);
        // $one_week = new DateInterval('P7D');
        // $date = new DateTime(strtotime("-1 week"));
        $date = $now->add(new DateInterval('P14D'));
        $date->setTime(0,0);

        $query = "";
        $query = $query . "SELECT d.doc_name as doc_name, ";
        $query = $query . "d.doc_type as doc_type, d.users_id as users_id, "; 
        $query = $query . "d.expiration as expiration, d.valide as valide, "; 
        $query = $query . "m.civilite as civilite, "; 
        $query = $query . "u.prenom as prenom, ";
        $query = $query . "u.nom as nom, ";
        $query = $query . "c.nom as nomCommune, ";
        $query = $query . "pnm.id_pnm as id_pnm, pnm.titre_pnm as titre_pnm, ";
        $query = $query . "DATE_FORMAT(m.created_at, '%d/%m/%Y') as created_at ";
        $query = $query . "FROM `users` u ";
        $query = $query . "JOIN membres m ON u.id = m.users_id ";
        $query = $query . "JOIN documents d ON u.id = d.users_id ";
        $query = $query . "JOIN adresses a ON m.adresse = a.id ";
        $query = $query . "JOIN commune c ON a.commune = c.id ";
        $query = $query . "JOIN pnm ON pnm.id_pnm = c.pnm ";
        $query = $query . "WHERE d.valide = 1 AND d.expiration < '" . $date->format("Y/m/d") . "'";
        $query = $query . " AND m.membre_type = 'chauffeur' ";
        if ($commune != null) {
            $query = $query . " AND a.commune = " . $commune;
        }
        if ($dossier == true) {
            $query = $query . " ORDER BY pnm.id_pnm, u.id";
        }
        // echo $query;
        // var_dump($query);
        return $this->query($query);
    }
    public function docInvalide($commune = null, $dossier = false) {
        $timeZone = new DateTimeZone('Europe/Paris');
        $now = new DateTime(null, $timeZone);
        // $one_week = new DateInterval('P7D');
        // $date = new DateTime(strtotime("-1 week"));
        $date = $now->add(new DateInterval('P14D'));
        $date->setTime(0,0);

        $query = "";
        $query = $query . "SELECT d.doc_name as doc_name, ";
        $query = $query . "d.doc_type as doc_type, d.users_id as users_id, "; 
        $query = $query . "d.expiration as expiration, d.valide as valide, "; 
        $query = $query . "m.civilite as civilite, "; 
        $query = $query . "u.prenom as prenom, ";
        $query = $query . "u.nom as nom, ";
        $query = $query . "c.nom as nomCommune, ";
        $query = $query . "pnm.id_pnm as id_pnm, pnm.titre_pnm as titre_pnm, ";
        $query = $query . "DATE_FORMAT(m.created_at, '%d/%m/%Y') as created_at ";
        $query = $query . "FROM `users` u ";
        $query = $query . "JOIN membres m ON u.id = m.users_id ";
        $query = $query . "JOIN documents d ON u.id = d.users_id ";
        $query = $query . "JOIN adresses a ON m.adresse = a.id ";
        $query = $query . "JOIN commune c ON a.commune = c.id ";
        $query = $query . "JOIN pnm ON pnm.id_pnm = c.pnm ";
        $query = $query . "WHERE d.valide = 0 AND d.doc_name IS NOT null";
        $query = $query . " AND m.membre_type = 'chauffeur' ";
        if ($commune != null) {
            $query = $query . " AND a.commune = " . $commune;
        }
        if ($dossier == true) {
            $query = $query . " ORDER BY pnm.id_pnm, u.id";
        }
        // echo $query;
        // var_dump($query);
        return $this->query($query);
    }
    public function isActif($userId) {
        $timeZone = new DateTimeZone('Europe/Paris');
        $now = new DateTime(null, $timeZone);
        // $one_week = new DateInterval('P7D');
        // $date = new DateTime(strtotime("-1 week"));
        // $date = $now->add(new DateInterval('P14D'));
        $now->setTime(0,0);

        $query = "";
        $query = $query . "SELECT COUNT(*) as count
                            FROM membres m 
                            JOIN documents d ON m.users_id = d.users_id 
                            WHERE m.users_id = {$userId}
                             AND (d.expiration < '{$now->format('Y/m/d')}'
                              OR d.valide = 0 
                             OR d.doc_name IS null)";
 
        // echo $query;
        // var_dump($query);
        $documentCount = $this->query($query);
        var_dump($documentCount);
        if ($documentCount[0]->count > 0) {
            return false;
        } else {
            return true;
        }
    }

}