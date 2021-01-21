<?php

namespace App\Table;

use Core\Table\Table;
use DateTime;
use DatePeriod;
use DateInterval;
use DateTimeZone;

class MembreTable extends Table {
    
    protected $table = 'membres';

    /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectMembre(int $id) {
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
    public function selectUserMembre(int $id) {
        return $this->query("SELECT * FROM {$this->table} WHERE users_id = :id",
        ['id' => $id],
        true);
    }
    public function selectPassagers($actif = 1, $pnm = 0) {
        // views - ConsultUser (Admin)/consult?consultPass (conseiller)
        $query = "SELECT m.*, u.*, a.commune, c.nom as nomCommune, p.titre_pnm as nomPnm,  ";
        $query = $query . " p.id_pnm as idPnm  ";
        $query = $query . " FROM {$this->table} m ";
        $query = $query . " JOIN users u ON m.users_id = u.id ";
        $query = $query . " JOIN adresses a ON m.adresse = a.id ";
        $query = $query . " JOIN commune c ON a.commune = c.id ";
        $query = $query . " JOIN pnm p ON p.id_pnm = c.pnm ";
        $query = $query . " WHERE membre_type = 'passager'";
        $query = $query . " AND actif = " . $actif;
        if ($pnm > 0) {
            $query = $query . " AND p.id_pnm = " . $pnm;
        }
        $query = $query . " ORDER BY c.pnm, u.nom, u.prenom";
        // echo $query;
        // var_dump($query);
        return $this->query($query);
    }
    public function selectCommunesPassagers($actif = 1, $pnm = 0) {
        // consult/passagers (conseiller) - consultUser (admin)
        $query = "SELECT DISTINCT c.id, c.nom as nomCommune FROM {$this->table} m ";
        $query = $query . " JOIN users u ON m.users_id = u.id ";
        $query = $query . " JOIN adresses a ON m.adresse = a.id ";
        $query = $query . " JOIN commune c ON a.commune = c.id ";
        $query = $query . " JOIN pnm p ON p.id_pnm = c.pnm ";
        $query = $query . " WHERE membre_type = 'passager' ";
        $query = $query . " AND actif = " . $actif;
        if ($pnm > 0) {
            $query = $query . " AND p.id_pnm = " . $pnm;
        }
        $query = $query . " ORDER BY c.nom";
        return $this->query($query);
    }
    public function selectCommunesChauffeurs($actif = 1, $pnm = 0) {
        // consult/passagers (conseiller) - consultUser (admin)
        $query = "SELECT DISTINCT c.id, c.nom as nomCommune FROM {$this->table} m ";
        $query = $query . " JOIN users u ON m.users_id = u.id ";
        $query = $query . " JOIN adresses a ON m.adresse = a.id ";
        $query = $query . " JOIN commune c ON a.commune = c.id ";
        $query = $query . " WHERE membre_type = 'chauffeur' ";
        $query = $query . " AND actif = " . $actif;
        if ($pnm > 0) {
            $query = $query . " AND p.id_pnm = " . $pnm;
        }
        $query = $query . " ORDER BY c.nom";
        // var_dump($query);
        // echo $query;
        return $this->query($query);
    }
    public function selectCommunesPnm($pnm = 0) {
        // consult/passagers (conseiller) - consultUser (admin)
        $query = "SELECT DISTINCT c.id, c.nom as nomCommune FROM {$this->table} m ";
        $query = $query . " JOIN users u ON m.users_id = u.id ";
        $query = $query . " JOIN adresses a ON m.adresse = a.id ";
        $query = $query . " JOIN commune c ON a.commune = c.id ";
        if ($pnm > 0) {
            $query = $query . " WHERE c.pnm = '" . $pnm . "'"; 
        }
        // $query = $query . " ORDER BY c.nom";
        // return $this->query($query);
    }
    public function selectPassagersCommune($commune, $actif = 1, $pnm = 0) {
        // consult/passagers (conseiller) - consultUser (admin)
        $query = "SELECT m.*, u.*, c.nom as nomCommune, ";
        $query = $query . " p.id_pnm as idPnm, p.titre_pnm as nomPnm ";
        $query = $query . " FROM {$this->table} m ";
        $query = $query . " JOIN users u ON m.users_id = u.id ";
        $query = $query . " JOIN adresses a ON m.adresse = a.id ";
        $query = $query . " JOIN commune c ON a.commune = c.id ";
        $query = $query . " JOIN pnm p ON p.id_pnm = c.pnm ";
        $query = $query . " WHERE membre_type = 'passager' ";
        $query = $query . " AND actif = " . $actif;
        $query = $query . " and a.commune = " . $commune;
        if ($pnm > 0) {
            $query = $query . " AND p.id_pnm = " . $pnm;
        }
        $query = $query . " ORDER BY u.nom, u.prenom";
        return $this->query($query);
    }
    public function selectChauffeursCommune($commune, $actif = 1, $pnm = 0) {
        $query = "SELECT m.*, u.*, a.commune as commune, c.nom as nomCommune, ";
        $query = $query . " p.id_pnm as idPnm, p.titre_pnm as nomPnm, ";
        $query = $query . " m.actif as actif ";
        $query = $query . " FROM {$this->table} m ";
        $query = $query . " JOIN users u ON m.users_id = u.id ";
        $query = $query . " JOIN adresses a ON m.adresse = a.id ";
        $query = $query . " JOIN commune c ON a.commune = c.id ";
        $query = $query . " JOIN pnm p ON p.id_pnm = c.pnm ";
        $query = $query . " WHERE membre_type = 'chauffeur' ";
        $query = $query . " and a.commune = " . $commune;
        if ($actif != null) {
            $query = $query . " AND actif = " . $actif;
        }
        if ($pnm > 0) {
            $query = $query . " AND p.id_pnm = " . $pnm;
        }
        $query = $query . " ORDER BY u.nom, u.prenom";
        // var_dump($query);
        // echo $query;
        return $this->query($query);
    }
    
    public function selectChauffeurs($actif = 1, $pnm = 0) {
        $query = "SELECT m.*, u.*, a.commune, c.nom as nomCommune, p.titre_pnm as nomPnm,  ";
        $query = $query . " p.id_pnm as idPnm  ";
        $query = $query . " FROM {$this->table} m ";
        $query = $query . " JOIN users u ON m.users_id = u.id ";
        $query = $query . " JOIN adresses a ON m.adresse = a.id ";
        $query = $query . " JOIN commune c ON a.commune = c.id ";
        $query = $query . " JOIN pnm p ON p.id_pnm = c.pnm ";
        $query = $query . " WHERE membre_type = 'chauffeur' ";
        $query = $query . " AND actif = " . $actif;
        if ($pnm > 0) {
            $query = $query . " AND p.id_pnm = " . $pnm;
        }

        $query = $query . " ORDER BY p.id_pnm, u.nom, u.prenom";

// var_dump($query);
// echo $query;
        return $this->query($query);        
    }
    public function selectMembresCotis($pnm, $commune) {
        $query = "SELECT m.*, u.*, co.*, a.commune, c.nom as nomCommune, p.titre_pnm as nomPnm,  ";
        $query = $query . " p.id_pnm as idPnm  ";
        $query = $query . " FROM {$this->table} m ";
        $query = $query . " JOIN users u ON m.users_id = u.id ";
        $query = $query . " JOIN adresses a ON m.adresse = a.id ";
        $query = $query . " JOIN commune c ON a.commune = c.id ";
        $query = $query . " LEFT JOIN cotis co ON u.id = co.id_user ";
        $query = $query . " JOIN pnm p ON p.id_pnm = c.pnm ";
        if ($pnm > 0) {
            $query = $query . " WHERE p.id_pnm = " . $pnm . " ";
        }
        if ($commune > 0) {
            if ($pnm > 0) {
                $query = $query . " AND ";
            } else {
                $query = $query . " WHERE ";
            }
            $query = $query . " c.id = " . $commune;
        }
        $query = $query . " ORDER BY p.id_pnm, u.nom, u.prenom";

// echo $query;
// var_dump($query);
        return $this->query($query);        
    }
    public function selectAll() {
        return $this->all();
    }
    private function getMembresExport($cotis, $adresses, $includeTelephone) {
        $query = "";
        $query = $query . "SELECT ";
        $query = $query . "m.id as idMembre, ";
        $query = $query . "m.actif as actif, ";
        $query = $query . "m.civilite as civilite, u.prenom as prenom, u.nom as nom, ";
        $query = $query . "m.membre_type as membre_type, ";
        $query = $query . "c.pnm as idPnm, c.nom as nomCommune, ";
        $query = $query . "m.created_at as dateCreation, ";
        $query = $query . "CONCAT(uc.nom, ' ', uc.prenom) as createdBy, ";
        $query = $query . "m.date_naissance as date_naissance ";
        if ($adresses) {
            $query = $query . ", a.adresse as adresse ";
            $query = $query . ", a.complement as complement ";
            $query = $query . ", a.code_postal as code_postal ";
        }
        if ($cotis) {
            $query = $query . ", cotis.cotis_type as cotis_type ";
            $query = $query . ", cotis.date_cotis as date_cotis ";
            $query = $query . ", cotis.date_cotis_valid as date_cotis_valid ";
        }
        if ($includeTelephone) {
            $query = $query . ", m.tel as tel, m.mobile as mobile ";
        } 

        $query = $query . "FROM membres m ";
        $query = $query . "JOIN users u ON m.users_id = u.id ";
        $query = $query . "JOIN users uc ON m.created_by = uc.id ";
        $query = $query . "JOIN adresses a ON a.id = m.adresse ";
        $query = $query . "JOIN commune c ON c.id = a.commune ";
        $query = $query . ' LEFT JOIN cotis ON cotis.id_user = u.id ';

        return $query;
    }
    public function selectPassagersExport($pnmId, $periodeDebut, $periodeFin, $actif) {
        $query = $this->getMembresExport(true, true, true);
        $query = $query . " WHERE membre_type = " . "'passager'";
        if ($pnmId > 0) {
            $query = $query . " AND c.pnm = " . $pnmId;
        }
        if ($actif >= 0) {
            $query = $query . " AND m.actif = " . $actif . " ";
        }
        $query = $query . " AND m.created_at >= '" . $periodeDebut . "'"; 
        $query = $query . " AND m.created_at <= '" . $periodeFin . "'"; 
         // var_dump($query);
        // echo $query;

        return $this->query($query);
    }
    public function selectChauffeursExport($pnmId, $periodeDebut, $periodeFin, $actif) {
    // public function selectChauffeursExport($pnmId, $cotis, $adresses, $includeTelephone) {
        $query = $this->getMembresExport(true, true, true);
        $query = $query . " WHERE membre_type = " . "'chauffeur'";
        if ($pnmId > 0) {
            $query = $query . " AND c.pnm = " . $pnmId;
        }
        if ($actif >= 0) {
            // var_dump($actif);
            $query = $query . " AND m.actif = " . $actif . " ";
        } else {
            // var_dump($actif);
        }
        $query = $query . " AND  m.created_at >= '" . $periodeDebut . "'"; 
        $query = $query . " AND m.created_at <= '" . $periodeFin . "'"; 

        return $this->query($query);
    }
    /**
     * Select foreign infos via email
     *
     * @param string $email
     * @return object
     */
    public function selectInfosByEmail(string $email) {
        // id est id user pas id membre
        return $this->query("SELECT membres.*, adresses.*, users.*
            FROM ((membres
            INNER JOIN adresses ON membres.adresse = adresses.id)
            INNER JOIN users ON membres.users_id = users.id)
            WHERE users.email = :email",
        ['email' => $email],
        true);
    }

    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insertMembre(array $data) {
        return $this->query("INSERT INTO {$this->table} (
            users_id,
            membre_type,
            valide,
            actif,
            civilite,
            date_naissance,
            lieu_naissance,
            dep_naissance,
            tel,
            mobile,
            evaluation,
            caisse_retraite,
            conditions,
            created_at,
            created_by,
            updated_at,
            updated_by,
            adresse
        ) VALUES (
            :users_id,
            :membre_type,
            :valide,
            :actif,
            :civilite,
            :date_naissance,
            :lieu_naissance,
            :dep_naissance,
            :tel,
            :mobile,
            :evaluation,
            :caisse_retraite,
            :conditions,
            :created_at,
            :created_by,
            :updated_at,
            :updated_by,
            :adresse
        )",
        [
            'users_id' => $data['users_id'],
            'membre_type' => $data['membre_type'],
            'valide' => $data['valide'],
            'actif' => $data['actif'],
            'civilite' => $data['civilite'],
            'date_naissance' => $data['date_naissance'],
            'lieu_naissance' => $data['lieu_naissance'],
            'dep_naissance' => $data['dep_naissance'],
            'tel' => $data['tel'],
            'mobile' => $data['mobile'],
            'evaluation' => $data['evaluation'],
            'caisse_retraite' => $data['caisse_retraite'],
            'conditions' => $data['conditions'],
            'created_at' => $data['created_at'],
            'created_by' => $data['created_by'],
            'updated_at' => $data['updated_at'],
            'updated_by' => $data['updated_by'],
            'adresse' => $data['adresse']
        ],
        true);
    }

    /**
     * UPDATE query via /modification
     *
     * @param int $users_id
     * @param array $data
     * @return object
     */
    public function updateProfilMembre(int $users_id, array $data) {
        return $this->query("UPDATE {$this->table} SET
            civilite = :civilite,
            date_naissance = :date_naissance,
            lieu_naissance = :lieu_naissance,
            dep_naissance = :dep_naissance,
            tel = :tel,
            mobile = :mobile,
            -- caisse_retraite = :caisse_retraite,
            updated_at = :updated_at,
            updated_by = :updated_by
        WHERE users_id = :users_id",
        [
            'users_id' => $users_id,
            'civilite' => $data['civilite'],
            'date_naissance' => $data['date_naissance'],
            'lieu_naissance' => $data['lieu_naissance'],
            'dep_naissance' => $data['dep_naissance'],
            'tel' => $data['tel'],
            'mobile' => $data['mobile'],
            // 'caisse_retraite' => $data['caisse_retraite'],
            'updated_at' => $data['updated_at'],
            'updated_by' => $data['updated_by']
        ],
        true);
    }

    // public function updateMembre(string $name, int $id) {
    //     return $this->query("UPDATE {$this->table} SET
    //         id = null,
    //         users_id = :users_id,
    //         membre_type = :membre_type,
    //         valide = :valide,
    //         actif = :actif,
    //         civilite = :civilite,
    //         date_naissance = :date_naissance,
    //         lieu_naissance = :lieu_naissance,
    //         dep_naissance = :dep_naissance,
    //         tel = :tel,
    //         mobile = :mobile,
    //         evaluation = :evaluation,
    //         caisse_retraite = :caisse_retraite,
    //         conditions = :conditions,
    //         created_at = :created_at,
    //         created_by = :created_by,
    //         updated_at = :updated_at,
    //         updated_by = :updated_by,
    //         adresse = :adresse
    //     WHERE id = :id",
    //     ['id' => $id, 'name' => $name],
    //     true);
    // }

    /**
     * DELETE query
     *
     * @param int $id
     * @return object
     */
    public function deleteMembre(int $id) {
        return $this->query("DELETE FROM {$this->table} WHERE id = :id",
        ['id' => $id],
        true);
    }
    // pnm
        /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectNouveauxPassagers() {
        // tdb - consultUser(admin)
        return $this->selectNouveauxMembres('passager');
      }
          /**
       * SELECT query
       *
       * @param int $id
       * @return object
       */
      public function selectNouveauxChauffeurs() {
        return $this->selectNouveauxMembres('chauffeur');
      }
  
      /**
       * SELECT query
       *
       * @param int $id
       * @return object
       */
      public function selectNouveauxMembres($membreType) {
        $timeZone = new DateTimeZone('Europe/Paris');
        $now = new DateTime(null, $timeZone);
        $one_week = new DateInterval('P7D');
        // $date = new DateTime(strtotime("-1 week"));
        $date = $now->sub(new DateInterval('P7D'));
        $date->setTime(0,0);
  
        $query = "";
        $query = $query . "SELECT ";
  
        $query = $query . " m.civilite as civilite, u.prenom as prenom, u.nom as nom, ";
        $query = $query . "c.nom as commune, m.created_by as created_by, ";
        $query = $query . "DATE_FORMAT(m.created_at, '%d/%m/%Y') as created_at, "; 
        $query = $query . "m.membre_type as membre_type, u.id as users_id, ";
        $query = $query . "pnm.id_pnm as id_pnm, pnm.titre_pnm as titre_pnm, ";
        $query = $query . "t.statut as statut ";
        $query = $query . "FROM membres m ";
        $query = $query . "LEFT JOIN users u ON u.id = m.users_id ";
        $query = $query . "LEFT JOIN adresses a ON m.adresse = a.id ";
        $query = $query . "LEFT JOIN commune c ON a.commune = c.id ";
        $query = $query . "JOIN pnm ON pnm.id_pnm = c.pnm ";
        $query = $query . "LEFT JOIN techniciens t ON t.users_id = m.created_by  ";
        $query = $query . "WHERE m.created_at > '" . $date->format("Y/m/d");
        $query = $query . "' AND m.membre_type = '" . $membreType . "' ";
        $query = $query . " ORDER BY pnm.id_pnm";
  
        // echo $query;
        // var_dump($query);
  
        return $this->query($query);
      }
    public function statMembres($membre_type = '') {
        $query = "SELECT COUNT(*) as count, MONTH(created_at) as month ";
        $query = $query . " FROM membres "; 
        $query = $query . "WHERE YEAR(created_at) = '2020' "; 
        if (!($membre_type == '')) {
            $query = $query . " AND membre_type = '" . $membre_type . "' ";
        }
        $query = $query . "GROUP BY MONTH(created_at)";

        // echo $query;
        // var_dump($query);
        return $this->query($query);
    }
    
    public function statMembresInscrType($tablePnm) {
        $pnms = $tablePnm->selectPnms();
        $dataPnms = [];
        foreach($pnms as $pnm) {
            $dataPnm = [];
            $dataPnm['total'] = $this->statMembresInscrTypeByPnm($pnm->id_pnm);
            $dataPnm['passager'] = $this->statMembresInscrTypeByPnm($pnm->id_pnm, 'passager');
            $dataPnm['chauffeur'] = $this->statMembresInscrTypeByPnm($pnm->id_pnm, 'chauffeur');
            $dataPnms[$pnm->id_pnm] = $dataPnm;
        }
        // var_dump($dataPnms);
        return $dataPnms;
    }
    public function statMembresPnm($tablePnm, $periodeDebut = null, $periodeFin = null, $actif = 1) {
        $pnms = $tablePnm->selectPnms();
        $dataPnms = [];
        foreach($pnms as $pnm) {
            $dataPnm = [];
            $dataPnm['total'] = $this->statMembresByPnm($pnm->id_pnm, '', $periodeDebut, $periodeFin, $actif);
            $dataPnm['passager'] = $this->statMembresByPnm($pnm->id_pnm, 'passager', $periodeDebut, $periodeFin, $actif);
            $dataPnm['chauffeur'] = $this->statMembresByPnm($pnm->id_pnm, 'chauffeur', $periodeDebut, $periodeFin, $actif);
            $dataPnms[$pnm->id_pnm] = $dataPnm;
        }
        // var_dump($dataPnms);
        return $dataPnms;
    }
    public function statMembresByPnm($pnm, $membre_type = '', $periodeDebut, $periodeFin, $actif = 1) {

        $query = "SELECT COUNT(*) as count, ";
        $query = $query . "m.civilite as civilite, u.prenom as prenom, u.nom as nom, ";
        $query = $query . "m.membre_type as membre_type, ";
        $query = $query . "m.users_id as user_id, m.created_by as created_by, ";
        $query = $query . "c.nom as communeNom, p.titre_pnm as titre, p.id_pnm as id_pnm ";
        $query = $query . " FROM membres m "; 
        $query = $query . " JOIN users u ON m.users_id = u.id ";
        $query = $query . " JOIN adresses a ON a.id = m.adresse ";
        $query = $query . " JOIN commune c ON a.commune = c.id ";
        $query = $query . " JOIN pnm p ON p.id_pnm = c.pnm ";
        $query = $query . " WHERE p.id_pnm = " . $pnm . " ";
        if (strlen($membre_type) > 0) {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }
        if ($periodeDebut != null && $periodeFin != null) {
            $query = $query . " AND  m.created_at >= '" . $periodeDebut->format("Y/m/d") . "'"; 
            $query = $query . " AND m.created_at <= '" . $periodeFin->format("Y/m/d") . "'"; 
        }
        if ($actif >= 0) {
            $query = $query . " And m.actif = " . $actif;
        }
       $query = $query . " GROUP BY p.id_pnm ";
        // if (!($membre_type == '')) {
        //     $query = $query . " AND membre_type = '" . $membre_type . "' ";
        // }
        // $query = $query . "GROUP BY MONTH(created_at)";

        // echo $query;
        // var_dump($query);
        return $this->query($query);
    }
    public function statMembresInscrTypeByPnm($pnm, $membre_type = '') {

        $query = "SELECT ";
        $query = $query . "m.civilite as civilite, u.prenom as prenom, u.nom as nom, ";
        $query = $query . "m.membre_type as membre_type, ";
        $query = $query . "m.actif as actif, ";
        $query = $query . "m.users_id as user_id, m.created_by as created_by, ";
        $query = $query . "c.nom as communeNom, p.titre_pnm as titre, p.id_pnm as id_pnm ";
        $query = $query . " FROM membres m "; 
        $query = $query . " JOIN users u ON m.users_id = u.id ";
        $query = $query . " JOIN adresses a ON a.id = m.adresse ";
        $query = $query . " JOIN commune c ON a.commune = c.id ";
        $query = $query . " JOIN pnm p ON p.id_pnm = c.pnm ";
        $query = $query . " WHERE p.id_pnm = " . $pnm . " ";
        if (strlen($membre_type) > 0) {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }
        // $query = $query . " GROUP BY p.id_pnm ";

        return $this->query($query);
    }
//     public function activate($id) {
//         $activation = 0;

//         $query = "UPDATE {$this->table} SET actif = " . $activation;
//         $query = $query . " WHERE users_id = " . $id;
// // var_dump($query);
// // echo $query;
//         return $this->query($query);
//     }
    public function activateAdmin($id, $activation) {
        $query = "UPDATE {$this->table} SET actifAdmin = " . $activation;
        $query = $query . " WHERE users_id = " . $id;
// var_dump($query);
// echo $query;
        $returnVal =  $this->query($query);
        // $this->activate($userId);
        return $returnVal;
    }
    public function systemActivate($userId, $isActif) {
        $this->query("UPDATE {$this->table} SET
                actifSystem = :actifSystem
                WHERE users_id = :users_id",
                [
                    'users_id' => $userId,
                    'actifSystem' => $isActif
                ],
                true);
        // $this->activate($userId);
    }
    public function ValidateActif($userId, $tableDocuments, $cotisDocuments) {
        $query = "SELECT membre_type FROM {$this->table} WHERE users_id = {$userId}";
        // var_dump($query);
        $membre_type = $this->query($query);

        $docsOK = true;
        if ($membre_type == 'chauffeur') {
            $docsOK = $tableDocuments->isActif($userId);
        }
       if ( $docsOK &&
                $cotisDocuments->isActif($userId)) {
            $this->systemActivate($userId, 1);
            // var_dump("systemActif is true");
            return true;
        } else {
            $this->systemActivate($userId, 0);
            // var_dump("systemActif is false");
            return false;
        }
    }
}
