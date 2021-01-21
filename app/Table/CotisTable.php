<?php

namespace App\Table;

use Core\Table\Table;

use DateTime;
use DatePeriod;
use DateInterval;
use DateTimeZone;

class CotisTable extends Table {
    
    protected $table = 'cotis';

    /**
     * SELECT query by user
     *
     * @param int $id
     * @return object
     */
    public function selectCotis(int $id) {
        return $this->query("SELECT * FROM {$this->table} WHERE id_user = :id",
        ['id' => $id],
        true);
    }

    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insertCotis(array $data) {
        return $this->query("INSERT INTO {$this->table} (
            id_user,
            cotis_type,
            date_cotis,
            date_cotis_valid,
            id_tech
        ) VALUES (
            :id_user,
            :cotis_type,
            :date_cotis,
            :date_cotis_valid,
            :id_tech
        )",
        [
            'id_user' => $data['id_user'],
            'cotis_type' => $data['cotis_type'],
            'date_cotis' => $data['date_cotis'],
            'date_cotis_valid' => $data['date_cotis_valid'],
            'id_tech' => $data['id_tech']
        ],
        true);
    }

    /**
     * UPDATE query
     *
     * @param int $id_user
     * @param array $data
     * @return object
     */
    public function updateCotis(int $id_user, array $data) {
        return $this->query("UPDATE {$this->table} SET
            cotis_type = :cotis_type,
            date_cotis = :date_cotis
        WHERE id_user = :id_user",
        [
            'id_user' => $id_user,
            'cotis_type' => $data['cotis_type'],
            'date_cotis' => $data['date_cotis']
        ],
        true);
    }

    /**
     * UPDATE query by PNM
     *
     * @param int $id_user
     * @param array $data
     * @return object
     */
    public function updateCotisAdmin(int $id_user, array $data) {
        return $this->query("UPDATE {$this->table} SET
            cotis_type = :cotis_type,
            date_cotis = :date_cotis,
            date_cotis_valid = :date_cotis_valid,
            id_tech = :id_tech
        WHERE id_user = :id_user",
        [
            'id_user' => $id_user,
            'cotis_type' => $data['cotis_type'],
            'date_cotis' => $data['date_cotis'],
            'date_cotis_valid' => $data['date_cotis_valid'],
            'id_tech' => $data['id_tech']
        ],
        true);
    }

    /**
     * UPDATE password only
     *
     * @param string $email
     * @param string $mdp
     * @return object
     */
    // public function updateUserCotis(string $email, string $mdp) {
    //     return $this->query("UPDATE {$this->table} SET mdp = :mdp WHERE email = :email",
    //     [
    //         'email' => $email,
    //         'mdp' => $mdp
    //     ],
    //     true);
    // }

    /**
     * DELETE query
     *
     * @param int $id
     * @return object
     */
    public function deleteCotis(int $id) {
        return $this->query("DELETE FROM {$this->table} WHERE id = :id",
        ['id' => $id],
        true);
    }
         /**
     * cotis validation query
     *
     * @param int $id
     * @return object
     */
    private function getQueryCotisValid() {
        $query = "";
        $query = $query . "SELECT c.id as cotis_id, ";
        $query = $query . "c.cotis_type as cotis_type, ";
        $query = $query . "DATE_FORMAT(c.date_cotis, '%d/%m/%Y') as date_cotis, ";
        $query = $query . "DATE_FORMAT(DATE_ADD(c.date_cotis_valid, INTERVAL 1 YEAR), '%d/%m/%Y') as date_exp,";
        $query = $query . " c.id_tech as id_tech, ";
        $query = $query . "u.id as id_user, ";
        $query = $query . "m.civilite as civilite, ";
        $query = $query . "m.membre_type as membre_type, ";
        $query = $query . "DATE_FORMAT(m.created_at, '%d/%m/%Y') as insc_date, ";
        $query = $query . "u.prenom as prenom, ";
        $query = $query . "com.nom as nomCommune, ";
        $query = $query . "com.id as idCommune, ";
        $query = $query . "u.nom as nom, ";
        $query = $query . "pnm.id_pnm as id_pnm, pnm.titre_pnm as titre_pnm, ";
        $query = $query . "DATE_FORMAT(c.date_cotis_valid, '%d/%m/%Y') as date_cotis_valid ";
        $query = $query . "FROM users u ";
        $query = $query . "JOIN membres m on u.id = m.users_id ";
        $query = $query . "JOIN adresses a on a.id = m.adresse ";
        $query = $query . "JOIN commune com on com.id = a.commune ";
        $query = $query . "JOIN pnm ON pnm.id_pnm = com.pnm ";
        $query = $query . "LEFT JOIN cotis c ON u.id = c.id_user ";
        // var_dump($query);
        // echo $query;
        return $query;
    }
     /**
     * cotis validation query
     *
     * @param int $id
     * @return object
     */
    public function selectCotisValid() {
        $query = $this->getQueryCotisValid();

        return $this->query($query);
    }
         /**
     * cotis validation query
     *
     * @param int $id
     * @return object
     */
    public function selectCotisConsult($pnm, $commune) {
        $query = "SELECT DISTINCT 
            com.id, com.nom as nomCommune, 
            c.cotis_type as cotis_type, 
            DATE_FORMAT(c.date_cotis, '%d/%m/%Y') as date_cotis, 
            DATE_FORMAT(c.date_cotis_valid, '%d/%m/%Y') as date_cotis_valid, 
            c.id_tech as id_tech, 
            u.id as id_user, 
            m.civilite as civilite, 
            m.membre_type as membre_type, 
            DATE_FORMAT(m.created_at, '%d/%m/%Y') as insc_date, 
            u.prenom as prenom, 
            com.nom as nomCommune, 
            com.id as idCommune, 
            u.nom as nom, 
            pnm.id_pnm as id_pnm, pnm.titre_pnm
            FROM `cotis` c 
        JOIN membres m ON m.users_id = c.id_user
        JOIN users u ON m.users_id =u.id
        JOIN adresses a ON a.id = m.adresse
        JOIN commune com ON com.id = a.commune
        JOIN pnm pnm ON com.pnm = pnm.id_pnm";

        if ($pnm > 0) {
            $query = $query . " WHERE pnm.id_pnm = " . $pnm . " ";
        }
        if ($commune > 0) {
            if ($pnm > 0) {
                $query = $query . " AND ";
            } else {
                $query = $query . " WHERE ";
            }
            $query = $query . " com.id = " . $commune;
        }
        $query = $query . " ORDER BY id_pnm";
        // var_dump($query);
        // echo '<br>' . $query . '<br>';
        return $this->query($query);
    }
     /**
     * cotis validation query
     *
     * @param int $id
     * @return object
     */
    public function selectCotisManquant($communeId = null, $isChauffeur = null)
    {
        $query = $this->getQueryCotisValid();
        $query = $query . " WHERE date_cotis IS null ";
        if (!($communeId == null)) {
            $query = $query . " AND com.id = " .$communeId . " ";
        }
        if ($isChauffeur == true || $isChauffeur == false) {
            if ($isChauffeur) {
                $query = $query . " AND membre_type = 'chauffeur' ";
            } else {
                $query = $query . " AND membre_type = 'passager' ";
            }
        }
        $query = $query . " ORDER BY pnm.id_pnm";
        // echo "<br>$query<br>";
        // var_dump($query);
        return $this->query($query);
    }
     /**
     * cotis validation query
     *
     * @param int $id
     * @return object
     */
    public function selectCotisRenouveller($communeId = null, $isChauffeur = null) {

        $timeZone = new DateTimeZone('Europe/Paris');
        $now = new DateTime(null, $timeZone);

        $date = $now->sub(new DateInterval('P1Y'));   // subtract 1 year
        $date = $now->add(new DateInterval('P14D'));    // add 14 days
        $date->setTime(0,0);

        $query = $this->getQueryCotisValid();

        $query = $query . " WHERE (date_cotis_valid < '" . $date->format("Y/m/d") . "'";
        $query = $query . " OR (date_cotis IS NOT NULL AND date_cotis_valid IS NULL)) ";
        if (!($communeId == null)) {
            $query = $query . " AND com.id = " .$communeId . " ";
        }
        // if ($isChauffeur == true || $isChauffeur == false) {
        if ($isChauffeur != null) {

            if ($isChauffeur) {
                $query = $query . " AND membre_type = 'chauffeur' ";
            } else {
                $query = $query . " AND membre_type = 'passager' ";
            }
        }
        $query = $query . " ORDER BY pnm.id_pnm";

        // echo "<br>$query<br>";
        // var_dump($query);
        return $this->query($query);
    }
    public function statCotisPeriod($periodeDebut, $periodeFin, $membre_type = '', $pnm = 0) {
        $query = "SELECT COUNT(*) as count, MONTH(c.date_cotis) as month ";
        // $query = "  DAYOFMONTH(p.date_debut_aller) as day_of_month ";
        $query = $query . " FROM cotis c"; 
        $query = $query . " JOIN membres m on c.id_user = m.users_id ";
        $query = $query . " JOIN adresses a on m.adresse = a.id ";
        $query = $query . " JOIN commune com on a.commune = com.id ";
        $query = $query . "WHERE c.date_cotis >= '" . $periodeDebut->format('Y/m/d') . "'"; 
        $query = $query . " AND c.date_cotis <= '" . $periodeFin->format('Y/m/d') . "'"; 
        if ($membre_type != '')
        {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }
        if ($pnm > 0) {
            $query = $query . " AND com.pnm = " . $pnm;
        }
        $query = $query . " GROUP BY MONTH(c.date_cotis)";

        // echo $query;
        // var_dump($query);

        return $this->query($query);
    }
    public function exportCotis($periodeDebut, $periodeFin, $membre_type = "", $pnm = 0) {
        // var_dump($_REQUEST);
        $query = "SELECT c.date_cotis as date_cotis, c.date_cotis_valid as date_valid, ";
        $query = $query . "CONCAT(m.civilite, ' ', u.prenom, ' ',u.nom) AS Membre, ";
        $query = $query . "com.nom as communeMembre, ";
        $query = $query . "m.membre_type AS membre_type, ";
        $query = $query . "m.actif AS actif ";
        $query = $query . " FROM cotis c"; 
        $query = $query . " JOIN membres m on c.id_user = m.users_id ";
        $query = $query . " JOIN users u on c.id_user = u.id ";
        $query = $query . " JOIN adresses a on m.adresse = a.id ";
        $query = $query . " JOIN commune com on a.commune = com.id ";
        $query = $query . "WHERE c.date_cotis >= '" . $periodeDebut . "'"; 
        $query = $query . " AND c.date_cotis <= '" . $periodeFin . "'"; 
        if ($membre_type != '')
        {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }
        if ($pnm > 0) {
            $query = $query . " AND com.pnm = " . $pnm;
        }
        $query = $query . " order BY c.date_cotis";

        // echo $query;
        // var_dump($query);

        return $this->query($query);
    }

    public function statCotisPeriodDay($periodeDebut, $periodeFin, $membre_type = '', $pnm = 0) {
        $query = "SELECT COUNT(*) as count, ";
        $query = $query . " DAYOFWEEK(c.date_cotis) as day_of_week ";
        $query = $query . " FROM cotis c"; 
        $query = $query . " JOIN membres m on c.id_user = m.users_id ";
        $query = $query . " JOIN adresses a on m.adresse = a.id ";
        $query = $query . " JOIN commune com on a.commune = com.id ";
        $query = $query . "WHERE c.date_cotis >= '" . $periodeDebut->format('Y/m/d') . "'"; 
        $query = $query . " AND c.date_cotis <= '" . $periodeFin->format('Y/m/d') . "'"; 
        if ($membre_type != '')
        {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }
        if ($pnm > 0) {
            $query = $query . " AND com.pnm = " . $pnm;
        }
          $query = $query . " GROUP BY DAYOFMONTH(c.date_cotis)";

        // echo $query;
        // var_dump($query);
        return $this->query($query);
    }
    public function statCotisPeriodMonth($periodeDebut, $periodeFin, $membre_type = '', $pnm = 0) {
        $query = "SELECT COUNT(*) as count, ";
        $query = $query . " DAYOFMONTH(c.date_cotis) as day_of_month ";
        $query = $query . " FROM cotis c"; 
        $query = $query . " JOIN membres m on c.id_user = m.users_id ";
        $query = $query . " JOIN adresses a on m.adresse = a.id ";
        $query = $query . " JOIN commune com on a.commune = com.id ";
        $query = $query . "WHERE c.date_cotis >= '" . $periodeDebut->format('Y/m/d') . "'"; 
        $query = $query . " AND c.date_cotis <= '" . $periodeFin->format('Y/m/d') . "'"; 
        if ($membre_type != '')
        {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }
        if ($pnm > 0) {
            $query = $query . " AND com.pnm = " . $pnm;
        }
          $query = $query . " GROUP BY DAYOFMONTH(c.date_cotis)";

        // echo $query;
        // var_dump($query);
        return $this->query($query);
    }
    public function selectCommunesPnm($pnm = 0) {
        // consult/passagers (conseiller) - consultUser (admin)
        $query = "SELECT DISTINCT 
        com.id, com.nom as nomCommune, 
        c.cotis_type as cotis_type, 
        DATE_FORMAT(c.date_cotis, '%d/%m/%Y') as date_cotis, 
        c.id_tech as id_tech, 
        u.id as id_user, 
        m.civilite as civilite, 
        m.membre_type as membre_type, 
        DATE_FORMAT(m.created_at, '%d/%m/%Y') as insc_date, 
        u.prenom as prenom, 
        com.nom as nomCommune, 
        com.id as idCommune, 
        u.nom as nom, 
        pnm.id_pnm as id_pnm, pnm.titre_pnm as titre_pnm, 
        DATE_FORMAT(c.date_cotis_valid, '%d/%m/%Y') as date_cotis_valid 
        FROM `cotis` c 
        JOIN membres m ON m.users_id = c.id_user
        JOIN users u ON m.users_id =u.id
        JOIN adresses a ON a.id = m.adresse
        JOIN commune com ON com.id = a.commune
        JOIN pnm pnm ON com.pnm = pnm.id_pnm";
        if ($pnm > 0) {
            $query = $query . " WHERE com.pnm = '" . $pnm . "'"; 
        }
        $query = $query . " GROUP BY com.nom";
        // echo $query;
        // var_dump($query);
        return $this->query($query);
    }
    public function isActif($userId) {
        $timeZone = new DateTimeZone('Europe/Paris');
        $now = new DateTime(null, $timeZone);
        // $one_week = new DateInterval('P7D');
        // $date = new DateTime(strtotime("-1 week"));

        $date = $now->sub(new DateInterval('P1Y'));   // subtract 1 year
        // $date = $now->add(new DateInterval('P14D'));    // add 14 days
        $date->setTime(0,0);

        $query = "SELECT count(*) as count 
                    FROM users u
                    LEFT JOIN {$this->table} c ON u.id = c.id_user
                    WHERE u.id = {$userId}
                    AND (date_cotis_valid < '" . $date->format("Y/m/d") . "'
                    OR  date_cotis_valid IS NULL) ";

        // echo $query;
        // var_dump($query);
        $cotisCount = $this->query($query);
        // var_dump($cotisCount);
        if ($cotisCount[0]->count > 0) {
            return false;
        } else {
            return true;
        }
    }

}