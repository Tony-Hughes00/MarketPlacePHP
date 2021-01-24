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
     * SELECT query by trajet
     *
     * @param int $trajetId
     * parcoursId est vraiment le id du trajet
     * @return object
     */
    public function selectBonByTrajetId(int $trajetId) {
        $query = "SELECT ca.nom as arrivee, cd.nom AS depart, t.id as trajetId,
            t.direction as direction, t.distance as distance, 
            b.fichier as fichier, b.kilometres as kilometres,
            t.conducteur as conducteur,
            DATE_FORMAT(t.date_debut, '%d/%m/%Y') as date_debut, p.created_at, b.id AS bons_id
            FROM parcours p
            JOIN trajet t ON t.parcours = p.id
            JOIN adresses a ON a.id = p.arrivee
            JOIN commune ca ON ca.id = a.commune
            JOIN adresses d ON d.id = p.depart
            JOIN commune cd ON cd.id = d.commune
            LEFT JOIN bons b ON b.parcours_id = t.id
            WHERE t.id = ${trajetId}";
            // var_dump($query);
            // echo $query;
        return $this->query($query);
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
    public function statBonsPeriod($periodeDebut, $periodeFin, $membre_type, $pnm, $paye) {
        $query = "SELECT COUNT(*) as count, MONTH(tc.date_val) as month 
                FROM parcours p 
                JOIN trajet tp ON tp.parcours = p.id 
                JOIN trajet tc ON tp.correspondance = tc.id 
                JOIN membres m ON m.users_id = tc.conducteur 
                JOIN users u ON m.users_id = u.id 
                JOIN adresses ma ON ma.id = m.adresse 
                JOIN commune mc ON mc.id = ma.commune 
                JOIN pnm pnm ON mc.pnm = pnm.id_pnm 
                JOIN adresses a ON a.id = p.arrivee 
                JOIN commune ca ON ca.id = a.commune 
                JOIN adresses d ON d.id = p.depart 
                JOIN commune cd ON cd.id = d.commune 
                LEFT JOIN bons b ON b.parcours_id = tc.id";
        $query = $query . " WHERE tc.date_val >= '" . $periodeDebut->format('Y/m/d') . "'"; 
        $query = $query . " AND tc.date_val <= '" . $periodeFin->format('Y/m/d') . "'"; 
        $query = $query . " AND p.valide = 1 ";
        if ($membre_type != '')
        {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }
        if ($pnm > 0) {
            $query = $query . " AND com.pnm = " . $pnm;
        }
        if ($paye >= 0) {
              $query = $query . " AND b.paye = {$paye} ";            
        } else {
            $query = $query . " AND b.id IS NULL ";            
        }
        $query = $query . " GROUP BY MONTH(tc.date_val)";

        // echo $query;
        // var_dump($query);

        return $this->query($query);
    }
    public function exportBons($periodeDebut, $periodeFin, $membre_type = "", $pnm = 0) {
        // var_dump($_REQUEST);
        $query = "SELECT DATE_FORMAT(tc.date_val,'%d/%m/%Y') as 'date du trajet', 
        CONCAT(m.civilite, ' ', u.prenom, ' ',u.nom) AS Chauffeur, 
        com.nom as Commune, 
        CONCAT(cd.nom, ' -> ', ca.nom) as trajet, 
        b.kilometres as kilometres, 
        (b.kilometres * 0.2) AS montant,
        DATE_FORMAT(b.date_paye,'%d/%m/%Y') AS 'date de paiement',
        b.fichier as 'fichier bons', 
        m.actif AS actif
        FROM parcours p 
        JOIN trajet tp ON tp.parcours = p.id 
        JOIN trajet tc ON tp.correspondance = tc.id 
        JOIN membres m ON m.users_id = tc.conducteur 
        JOIN users u on m.id = u.id 
        JOIN adresses a on m.adresse = a.id 
        JOIN commune com on a.commune = com.id 
        JOIN adresses ad ON tc.depart = ad.id 
        JOIN commune cd ON cd.id = ad.commune 
        JOIN adresses aa ON tc.arrivee = aa.id
        JOIN commune ca ON ca.id = aa.commune 
        LEFT JOIN bons b ON b.parcours_id = tc.id
        WHERE p.valide = 1 
        AND tc.date_val >= '{$periodeDebut}'
        AND tc.date_val <= '{$periodeFin}'"; 
        if ($membre_type != '')
        {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }
        if ($pnm > 0) {
            $query = $query . " AND com.pnm = " . $pnm;
        }
        $query = $query . " order BY tc.date_val";

        // echo $query;
        // var_dump($query);

        return $this->query($query);
    }

    public function statBonsPeriodDay($periodeDebut, $periodeFin, $membre_type, $pnm, $paye) {
        $query = "SELECT COUNT(*) as count,
        DAYOFWEEK(tc.date_debut) as day_of_week  
        FROM parcours p 
        JOIN trajet tp ON tp.parcours = p.id 
        JOIN trajet tc ON tp.correspondance = tc.id 
        JOIN membres m ON m.users_id = tc.conducteur 
        JOIN users u ON m.users_id = u.id 
        JOIN adresses ma ON ma.id = m.adresse 
        JOIN commune mc ON mc.id = ma.commune 
        JOIN pnm pnm ON mc.pnm = pnm.id_pnm 
        JOIN adresses a ON a.id = p.arrivee 
        JOIN commune ca ON ca.id = a.commune 
        JOIN adresses d ON d.id = p.depart 
        JOIN commune cd ON cd.id = d.commune 
        LEFT JOIN bons b ON b.parcours_id = tc.id";

        $query = $query . " WHERE tc.date_val >= '" . $periodeDebut->format('Y/m/d') . "'"; 
        $query = $query . " AND tc.date_val <= '" . $periodeFin->format('Y/m/d') . "'"; 
        $query = $query . " AND p.valide = 1 ";
        if ($membre_type != '')
        {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }
        if ($pnm > 0) {
            $query = $query . " AND cm.pnm = " . $pnm;
        }
        if ($paye >= 0) {
            $query = $query . " AND b.paye = {$paye} ";            
        } else {
            $query = $query . " AND b.id IS NULL ";            
        }
        $query = $query . " GROUP BY DAYOFMONTH(tc.date_val)";

        // echo $query;
        // var_dump($query);
        return $this->query($query);
    }
    public function statBonsPeriodMonth($periodeDebut, $periodeFin, $membre_type, $pnm, $paye) {
        $query = "SELECT COUNT(*) as count,
            DAYOFMONTH(tc.date_debut) as day_of_month
            FROM parcours p 
            JOIN trajet tp ON tp.parcours = p.id 
            JOIN trajet tc ON tp.correspondance = tc.id 
            JOIN membres m ON m.users_id = tc.conducteur 
            JOIN users u ON m.users_id = u.id 
            JOIN adresses ma ON ma.id = m.adresse 
            JOIN commune mc ON mc.id = ma.commune 
            JOIN pnm pnm ON mc.pnm = pnm.id_pnm 
            JOIN adresses a ON a.id = p.arrivee 
            JOIN commune ca ON ca.id = a.commune 
            JOIN adresses d ON d.id = p.depart 
            JOIN commune cd ON cd.id = d.commune 
            LEFT JOIN bons b ON b.parcours_id = tc.id";
        $query = $query . " WHERE tc.date_val >= '" . $periodeDebut->format('Y/m/d') . "'"; 
        $query = $query . " AND tc.date_val <= '" . $periodeFin->format('Y/m/d') . "'"; 
        $query = $query . " AND p.valide = 1 ";
        if ($membre_type != '')
        {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }
        if ($pnm > 0) {
            $query = $query . " AND cm.pnm = " . $pnm;
        }
        if ($paye >= 0) {
            $query = $query . " AND b.paye = {$paye} ";            
        } else {
            $query = $query . " AND b.id IS NULL ";            
        }
        $query = $query . " GROUP BY DAYOFMONTH(tc.date_val)";

        // echo $query;
        // var_dump($query);
        return $this->query($query);
    }
    function bonsEnAttente($pnmId = 0, $communeId = 0) {
        $query = "SELECT u.nom as nom, u.prenom as prenom, b.kilometres as kilometres, tp.distance as distance, 
        u.id as id_user, mc.nom as membreCommune, m.membre_type as membre_type, 
        ca.nom as arrivee, cd.nom AS depart, tp.id as trajetId, tp.direction as direction, 
        mc.pnm as pnmId, pnm.titre_pnm as titre_pnm, DATE_FORMAT(tp.date_debut, '%d/%m/%Y') as date_debut, 
        p.created_at, b.id AS bons_id, DATE_FORMAT(tp.date_val, '%d/%m/%Y') as date_val 
        FROM parcours p 
        JOIN trajet tp ON tp.parcours = p.id 
        JOIN trajet tc ON tp.correspondance = tc.id 
        JOIN membres m ON m.users_id = tc.conducteur 
        JOIN users u ON m.users_id = u.id 
        JOIN adresses ma ON ma.id = m.adresse 
        JOIN commune mc ON mc.id = ma.commune 
        JOIN pnm pnm ON mc.pnm = pnm.id_pnm 
        JOIN adresses a ON a.id = p.arrivee 
        JOIN commune ca ON ca.id = a.commune 
        JOIN adresses d ON d.id = p.depart 
        JOIN commune cd ON cd.id = d.commune 
        LEFT JOIN bons b ON b.parcours_id = tc.id 
        WHERE p.valide = 1 
        AND b.id IS NULL ";
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
        $query = "SELECT u.nom as nom, u.prenom as prenom, u.id as id_user, mc.nom as membreCommune, 
        m.membre_type as membre_type, ca.nom as arrivee, cd.nom AS depart, tc.id as trajetId, 
        b.kilometres as kilometres, tc.distance as distance, tc.direction as direction, 
        mc.pnm as pnmId, pnm.titre_pnm as titre_pnm, DATE_FORMAT(tc.date_debut, '%d/%m/%Y') as date_debut, 
        p.created_at, b.id AS bons_id, DATE_FORMAT(b.date_paye, '%d/%m/%Y') as date_paye, 
        DATE_FORMAT(tc.date_val, '%d/%m/%Y') as date_val 
        FROM parcours p 
        JOIN trajet tp ON tp.parcours = p.id 
        JOIN trajet tc ON tp.correspondance = tc.id 
        JOIN membres m ON m.users_id = tc.conducteur 
        JOIN users u ON m.users_id = u.id 
        JOIN adresses ma ON ma.id = m.adresse 
        JOIN commune mc ON mc.id = ma.commune 
        JOIN pnm pnm ON mc.pnm = pnm.id_pnm 
        JOIN adresses a ON a.id = p.arrivee 
        JOIN commune ca ON ca.id = a.commune 
        JOIN adresses d ON d.id = p.depart 
        JOIN commune cd ON cd.id = d.commune 
        JOIN bons b ON b.parcours_id = tc.id 
        WHERE p.valide = 1 AND b.paye = 0";
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
    function setBonPaye($id, $kilometres) {
        $timeZone = new DateTimeZone('Europe/Paris');
        $now = new DateTime(null, $timeZone);
        $timeStamp = $now->format("Y/m/d H:i:s");

        // var_dump($timeStamp);
        $query = "UPDATE {$this->table} SET
            paye =1,
            date_paye = '{$timeStamp}',
            kilometres = {$kilometres}
        WHERE parcours_id = {$id}";
        var_dump($query);
        return $this->query($query);
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