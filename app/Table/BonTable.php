<?php

namespace App\Table;
use DateTime;
use DatePeriod;
use DateInterval;
use DateTimeZone;
use Core\Table\Table;

class BonTable extends Table {

    protected $table = 'bons';

    /**
     * SELECT query by user
     *
     * @param int $id
     * @return object
     */
    public function selectBon(int $id) {
        return $this->query("SELECT * FROM {$this->table} WHERE id = :id",
        ['id' => $id],
        true);
    }

    /**
     * SELECT query by user
     *
     * @param int $id
     * @return object
     */
    // SELECT  ca.nom as arrivee, cd.nom AS depart, t.id as trajetId,
    //         DATE_FORMAT(t.date_debut, '%d/%m/%Y') as date_debut, p.created_at, b.id AS bons_id
    //         FROM parcours p
    //         JOIN trajet t ON t.parcours = p.id
    //         JOIN adresses a ON a.id = p.arrivee
    //         JOIN commune ca ON ca.id = a.commune
    //         JOIN adresses d ON d.id = p.depart
    //         JOIN commune cd ON cd.id = d.commune
    //         LEFT JOIN bons b ON b.parcours_id = p.id
    //         WHERE p.valide = 1 AND b.id IS NULL
    public function selectParcoursUserForBon(int $id) {
        return $this->query("SELECT ca.nom as arrivee, cd.nom AS depart, t.id as trajetId,
            t.direction as direction,
            DATE_FORMAT(t.date_debut, '%d/%m/%Y') as date_debut, p.created_at, b.id AS bons_id
            FROM parcours p
            JOIN trajet t ON t.parcours = p.id
            JOIN adresses a ON a.id = p.arrivee
            JOIN commune ca ON ca.id = a.commune
            JOIN adresses d ON d.id = p.depart
            JOIN commune cd ON cd.id = d.commune
            LEFT JOIN bons b ON b.parcours_id = t.id
            WHERE p.membre = :id AND p.valide = 1 AND b.id IS NULL",
        ['id' => $id],
        false);
    }

    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insertBon(array $data) {
        return $this->query("INSERT INTO {$this->table} (
            parcours_id,
            kilometres,
            fichier
        ) VALUES (
            :parcours_id,
            :kilometres,
            :fichier
        )",
        [
            'parcours_id' => $data['parcours_id'],
            'kilometres' => $data['kilometres'],
            'fichier' => $data['fichier']
        ],
        true);
    }
    public function statBonsPeriod($periodeDebut, $periodeFin, $membre_type = '', $pnm = 0) {
        $query = "SELECT COUNT(*) as count, MONTH(t.date_debut) as month ";
        // $query = "  DAYOFMONTH(p.date_debut_aller) as day_of_month ";
        $query = $query . " FROM bons b ";
        $query = $query . " JOIN trajet t ON b.parcours_id = t.id ";
        $query = $query . " JOIN parcours p ON p.id = t.parcours ";
        $query = $query . " Join membres m ON m.users_id = p.membre ";
        $query = $query . " JOIN adresses am ON m.adresse = am.id ";
        $query = $query . " JOIN commune cm ON cm.id = am.commune ";
        $query = $query . "WHERE t.date_debut >= '" . $periodeDebut->format('Y/m/d') . "'"; 
        $query = $query . " AND t.date_debut <= '" . $periodeFin->format('Y/m/d') . "'"; 
        if ($membre_type != '')
        {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }
        if ($pnm > 0) {
            $query = $query . " AND com.pnm = " . $pnm;
        }
        $query = $query . " GROUP BY MONTH(t.date_debut)";

        // echo $query;
        // var_dump($query);

        return $this->query($query);
    }
    public function exportBons($periodeDebut, $periodeFin, $membre_type = "", $pnm = 0) {
        // var_dump($_REQUEST);
        $query = "SELECT t.date_debut as date_trajet, ";
        $query = $query . "CONCAT(m.civilite, ' ', u.prenom, ' ',u.nom) AS Membre, ";
        $query = $query . "com.nom as communeMembre, ";
        $query = $query . "cd.nom as communeDepart, ";
        $query = $query . "ca.nom as communeArrivee, ";
        $query = $query . "b.kilometres as kilometres, ";
        $query = $query . "m.membre_type AS membre_type, ";
        $query = $query . "m.actif AS actif ";
        $query = $query . " FROM bons b"; 
        $query = $query . " JOIN trajet t ON b.parcours_id = t.id ";
        $query = $query . " JOIN parcours p ON p.id = t.parcours ";
        $query = $query . " JOIN membres m on p.membre = m.users_id ";
        $query = $query . " JOIN users u on p.membre = u.id ";
        $query = $query . " JOIN adresses a on m.adresse = a.id ";
        $query = $query . " JOIN commune com on a.commune = com.id ";
        $query = $query . " JOIN adresses ad ON t.depart = ad.id ";
        $query = $query . " JOIN commune cd ON cd.id = ad.commune ";
        $query = $query . " JOIN adresses aa ON t.arrivee = aa.id ";
        $query = $query . " JOIN commune ca ON ca.id = aa.commune ";
        $query = $query . "WHERE t.date_debut >= '" . $periodeDebut . "'"; 
        $query = $query . " AND t.date_debut <= '" . $periodeFin . "'"; 
        if ($membre_type != '')
        {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }
        if ($pnm > 0) {
            $query = $query . " AND com.pnm = " . $pnm;
        }
        $query = $query . " order BY t.date_debut";

        // echo $query;
        // var_dump($query);

        return $this->query($query);
    }

    public function statBonsPeriodDay($periodeDebut, $periodeFin, $membre_type = '', $pnm = 0) {
        $query = "SELECT COUNT(*) as count, ";
        $query = $query . " DAYOFWEEK(t.date_debut) as day_of_week ";
        $query = $query . " FROM bons b ";
        $query = $query . " JOIN trajet t ON b.parcours_id = t.id ";
        $query = $query . " JOIN parcours p ON p.id = t.parcours ";
        $query = $query . " Join membres m ON m.users_id = p.membre ";
        $query = $query . " JOIN adresses am ON m.adresse = am.id ";
        $query = $query . " JOIN commune cm ON cm.id = am.commune ";

        $query = $query . "WHERE t.date_debut >= '" . $periodeDebut->format('Y/m/d') . "'"; 
        $query = $query . " AND t.date_debut <= '" . $periodeFin->format('Y/m/d') . "'"; 
        if ($membre_type != '')
        {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }
        if ($pnm > 0) {
            $query = $query . " AND cm.pnm = " . $pnm;
        }
          $query = $query . " GROUP BY DAYOFMONTH(t.date_debut)";

        // echo $query;
        // var_dump($query);
        return $this->query($query);
    }
    public function statBonsPeriodMonth($periodeDebut, $periodeFin, $membre_type = '', $pnm = 0) {
        $query = "SELECT COUNT(*) as count, ";
        $query = $query . " DAYOFMONTH(t.date_debut) as day_of_month ";
        $query = $query . " FROM bons b ";
        $query = $query . " JOIN trajet t ON b.parcours_id = t.id ";
        $query = $query . " JOIN parcours p ON p.id = t.parcours ";
        $query = $query . " Join membres m ON m.users_id = p.membre ";
        $query = $query . " JOIN adresses am ON m.adresse = am.id ";
        $query = $query . " JOIN commune cm ON cm.id = am.commune ";
        $query = $query . "WHERE t.date_debut >= '" . $periodeDebut->format('Y/m/d') . "'"; 
        $query = $query . " AND t.date_debut <= '" . $periodeFin->format('Y/m/d') . "'"; 
        if ($membre_type != '')
        {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }
        if ($pnm > 0) {
            $query = $query . " AND cm.pnm = " . $pnm;
        }
          $query = $query . " GROUP BY DAYOFMONTH(t.date_debut)";

        // echo $query;
        // var_dump($query);
        return $this->query($query);
    }
    function bonsEnAttente($pnmId = 0, $communeId = 0) {
        $query = "SELECT 
                u.nom as nom, u.prenom as prenom,
                b.kilometres as kilometres,
                t.distance as distance,
                u.id as id_user, mc.nom as membreCommune, m.membre_type as membre_type,
                ca.nom as arrivee, cd.nom AS depart, t.id as trajetId,
                t.direction as direction, mc.pnm as pnmId, pnm.titre_pnm as titre_pnm,
                DATE_FORMAT(t.date_debut, '%d/%m/%Y') as date_debut, 
                p.created_at, b.id AS bons_id,
                DATE_FORMAT(t.date_val, '%d/%m/%Y') as date_val
                FROM parcours p
                JOIN trajet t ON t.parcours = p.id
                JOIN membres m ON m.users_id = p.membre
                JOIN users u ON m.users_id = u.id
                JOIN adresses ma ON ma.id = m.adresse
                JOIN commune mc ON mc.id = ma.commune
                JOIN pnm pnm ON mc.pnm = pnm.id_pnm 
                JOIN adresses a ON a.id = p.arrivee
                JOIN commune ca ON ca.id = a.commune
                JOIN adresses d ON d.id = p.depart
                JOIN commune cd ON cd.id = d.commune
                LEFT JOIN bons b ON b.parcours_id = t.id
                WHERE p.valide = 1 AND b.id IS NULL ";
        if ($pnmId > 0) {
            $query = $query . " AND mc.pnm = " . $pnmId;
            if ($communeId > 0) {
                $query = $query . " AND mc.id = " . $communeId;
            }
        }
        $query = $query . " ORDER BY mc.pnm";
// var_dump($query);
// echo $query;
        return $this->query($query);
    }
    function bonsNonPaye($pnmId = 0, $communeId = 0) {
        $query = "SELECT 
                u.nom as nom, u.prenom as prenom,
                u.id as id_user, mc.nom as membreCommune, m.membre_type as membre_type,
                ca.nom as arrivee, cd.nom AS depart, t.id as trajetId,
                b.kilometres as kilometres,
                t.distance as distance,
                t.direction as direction, mc.pnm as pnmId, pnm.titre_pnm as titre_pnm,
                DATE_FORMAT(t.date_debut, '%d/%m/%Y') as date_debut, p.created_at, b.id AS bons_id,
                DATE_FORMAT(b.date_paye, '%d/%m/%Y') as date_paye,
                DATE_FORMAT(t.date_val, '%d/%m/%Y') as date_val
                FROM parcours p
                JOIN trajet t ON t.parcours = p.id
                JOIN membres m ON m.users_id = p.membre
                JOIN users u ON m.users_id = u.id
                JOIN adresses ma ON ma.id = m.adresse
                JOIN commune mc ON mc.id = ma.commune
                JOIN pnm pnm ON mc.pnm = pnm.id_pnm 
                JOIN adresses a ON a.id = p.arrivee
                JOIN commune ca ON ca.id = a.commune
                JOIN adresses d ON d.id = p.depart
                JOIN commune cd ON cd.id = d.commune
                JOIN bons b ON b.parcours_id = t.id
                WHERE p.valide = 1 ";
        if ($pnmId > 0) {
            $query = $query . " AND mc.pnm = " . $pnmId;
            if ($communeId > 0) {
                $query = $query . " AND mc.id = " . $communeId;
            }
        }
        $query = $query . " ORDER BY mc.pnm";
// var_dump($query);
// echo $query;
        return $this->query($query);
    }
    function setBonPaye($id) {
        $timeZone = new DateTimeZone('Europe/Paris');
        $now = new DateTime(null, $timeZone);
        $timeStamp = $now->format("Y/m/d H:i:s");

        var_dump($timeStamp);
        $query = "UPDATE {$this->table} SET
            paye =1,
            date_paye = '{$timeStamp}'
        WHERE id = {$id}";
        var_dump($query);
        return $this->query($query);
        // return $this->query("UPDATE {$this->table} SET
        //     paye = :paye,
        //     date_paye = :date_paye
        // WHERE id = :id",
        // [
        //     'id' => $id,
        //     'paye' => 1,
        //     'date_paye' => $timeStamp,
        // ],
        // true);
    }
    function selectCommunesBons($pnmId) {
        $query = "SELECT mc.id as id, mc.nom as nomCommune, pnm.id_pnm as pnm_id
        FROM parcours p
        JOIN trajet t ON t.parcours = p.id
        JOIN membres m ON m.users_id = p.membre
        JOIN users u ON m.users_id = u.id
        JOIN adresses ma ON ma.id = m.adresse
        JOIN commune mc ON mc.id = ma.commune
        JOIN pnm pnm ON mc.pnm = pnm.id_pnm 
        JOIN adresses a ON a.id = p.arrivee
        JOIN commune ca ON ca.id = a.commune
        JOIN adresses d ON d.id = p.depart
        JOIN commune cd ON cd.id = d.commune
        LEFT JOIN bons b ON b.parcours_id = t.id
        WHERE p.valide = 1 AND b.paye = 0 ";
if ($pnmId > 0) {
    $query = $query . " AND mc.pnm = " . $pnmId;

}
$query = $query . " ORDER BY mc.pnm";
// var_dump($query);
// echo $query;
return $this->query($query);
    }
}