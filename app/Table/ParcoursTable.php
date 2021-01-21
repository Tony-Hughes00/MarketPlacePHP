<?php

namespace App\Table;

use Core\Table\Table;

use App;
use DateTime;
use DatePeriod;
use DateInterval;
use DateTimeZone;

use App\Controller\AppController;


class ParcoursTable extends Table {
    
    protected $table = 'parcours';

    /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectParcours(int $id, $actif = 1) {
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
    public function exeQuery($query) {
      return $this->query($query);
    }
    /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    private function getParcoursCommuneQuery() {
        $query = 'SELECT DISTINCT ';
        $query = $query . ' c.id as communeId, c.nom as nomCommune ';
        $query = $query . ' FROM `parcours` p ';
        $query = $query . ' JOIN membres m ON m.users_id = p.membre ';
        $query = $query . ' JOIN users u ON u.id = p.membre ';
        $query = $query . ' JOIN adresses a ON a.id = p.depart ';
        $query = $query . ' JOIN commune c ON c.id = a.commune';
        $query = $query . ' JOIN pnm ON pnm.id_pnm = c.pnm ';
        $query = $query . ' JOIN trajet t ON t.parcours = p.id ';

        return $query;
    }
        /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    private function getParcoursQuery() {
        $query = 'SELECT DISTINCT ';
        $query = $query . ' p.id as parcoursId, p.date_debut_aller as date_debut_aller, ';
        $query = $query . ' p.date_fin_aller as date_fin_aller, p.aller_retour as aller_retour, ';
        $query = $query . ' p.date_debut_retour as date_debut_retour, ';
        $query = $query . ' p.date_fin_retour as date_fin_retour, ';
        $query = $query . ' p.depart as depart, p.arrivee as arrivee, p.membre as membre, ';
        $query = $query . ' m.membre_type as membre_type, m.actif as actif, ';
        $query = $query . ' m.users_id as users_id, ';
        $query = $query . ' pnm.id_pnm as id_pnm, ';
        $query = $query . ' p.valide as valide, MAX(t.status) as status, ';
        $query = $query . ' u.nom as nom, u.prenom as prenom, m.civilite as civilite ';
        $query = $query . ' FROM `parcours` p ';
        $query = $query . ' JOIN membres m ON m.users_id = p.membre ';
        $query = $query . ' JOIN adresses a ON p.depart = a.id ';
        $query = $query . ' JOIN commune cd ON cd.id = a.commune ';
        $query = $query . ' JOIN users u ON u.id = p.membre ';
        $query = $query . ' JOIN adresses am on am.id= m.adresse';
        $query = $query . ' JOIN commune c on c.id = am.commune ';
        $query = $query . ' JOIN pnm on pnm.id_pnm = cd.pnm ';
        $query = $query . ' JOIN trajet t ON t.parcours = p.id ';

        return $query;
    }
     /**
     * SELECT query
     * conseiller consult trajets
     * @param int $id
     * @return object
     */
    public function selectParcourCommunesOffert($pnm = 0) {
        $query = $this->getParcoursCommuneQuery();

        $query = $query . ' WHERE m.membre_type = "chauffeur"';
        if ($pnm != 0) {
            $query = $query . ' AND pnm.id_pnm = ' . $pnm;
        }
        $query = $query . " ORDER BY c.nom ";
        // echo '<br /> offert  ' . $query . '<br />';

        return $this->query($query);
    }  
         /**
     * SELECT query
     * conseiller consult trajets
     * @param int $id
     * @return object
     */
    public function selectParcourCommunesDemande($pnm = 0, $actif = 1) {
        $query = $this->getParcoursCommuneQuery();

        $query = $query . ' WHERE m.membre_type = "passager"';
        if ($actif != null) {
            $query = $query . ' AND m.actif = ' . $actif;
        }
        if ($pnm != 0) {
            $query = $query . ' AND pnm.id_pnm = ' . $pnm;
        }
        $query = $query . " ORDER BY c.nom ";
        // echo '<br /> offert  ' . $query . '<br />';

        return $this->query($query);
    }  
     /**
     * SELECT query
     * conseiller consult trajets
     * @param int $id
     * @return object
     */
    public function selectParcoursOffert($communeDepart = 0, $pnm = 0, $actif = 1) {
        $query = $this->getParcoursQuery();

        $query = $query . ' WHERE m.membre_type = "chauffeur"';
        if ($actif != null) {
            $query = $query . ' AND m.actif = ' . $actif;
        }
        if (!($communeDepart == 0)) {
            $query = $query . ' AND a.commune = ' . $communeDepart;
        }
        if (!($pnm == 0)) {
            $query = $query . ' AND pnm.id_pnm = ' . $pnm;
        }
        $query = $query . " GROUP BY p.id ";
        $query = $query . "ORDER BY valide, status, ";
        $query = $query . " p.date_debut_aller DESC ";
        // echo '<br /> offert  ' . $query . '<br />';

        return $this->query($query);
    }  
     /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectParcoursDemandee($communeDepart = 0, $pnm = 0, $actif = 1) {
        $query = $this->getParcoursQuery();

        $query = $query . ' WHERE m.membre_type = "passager"';
        if ($actif != null) {
            $query = $query . ' AND m.actif = ' . $actif;
        }
        if (!($communeDepart == 0)) {
            $query = $query . ' AND a.commune = ' . $communeDepart;
        }
        if (!($pnm == 0)) {
            $query = $query . ' AND pnm.id_pnm = ' . $pnm;
        }
        $query = $query . " GROUP BY p.id ";
        $query = $query . "ORDER BY valide, status, ";
        $query = $query . " p.date_debut_aller DESC ";

// echo '<br />  demandee  ' . $query . '<br />';
        return $this->query($query);
    }     
            /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectParcoursEnAttent($actif = 1) {
        $query = 'SELECT '; 
        $query = $query . " DATE_FORMAT(p.date_debut_aller, '%d/%m/%Y') as date_depart,";
        $query = $query . ' cd.nom as communeDepart, ca.nom as communeArrivee,';
        $query = $query . ' m.civilite as civilite, u.nom as nom, u.prenom as prenom,';
        $query = $query . ' u.id as userId,';
        $query = $query . ' m.membre_type as membre_type,';
        $query = $query . ' c.date_cotis as date_cotis, c.date_cotis_valid as date_cotis_valid ';
        $query = $query . ' FROM `parcours` p ';
        $query = $query . ' LEFT JOIN membres m ON m.users_id = p.membre ';
        $query = $query . ' LEFT JOIN users u ON u.id = m.users_id ';
        $query = $query . ' LEFT JOIN cotis c ON c.id_user = u.id ';
        $query = $query . ' JOIN adresses ad ON p.depart = ad.id ';
        $query = $query . ' JOIN commune cd ON ad.commune = cd.id ';
        $query = $query . ' JOIN adresses aa ON p.arrivee = aa.id ';
        $query = $query . ' JOIN commune ca ON aa.commune = ca.id ';
        $query = $query . " WHERE m.membre_type = 'passager' ";
        $query = $query . ' AND date_cotis IS NULL ';
        $query = $query . ' AND m.actif = ' . $actif;

        // echo '<br>' . $query . '<br>';
        return $this->query($query);
    }
    public function updateValidation($parcoursId, $val) {
        $query = "UPDATE parcours SET valide = " . $val . " ";
        $query = $query . " WHERE id = " . $parcoursId;

        return $this->query($query);
    }
    public function selectParcoursTrajets($id) {
        $query = "SELECT *,t.id as trajetId, cd.nom as nomDepart, ca.nom  as nomArrivee,  ";
        $query = $query . "cd.id as communeDepart, ca.id as communeArrivee ";
        $query = $query . "FROM `parcours` p ";
        $query = $query . "LEFT JOIN trajet t ON p.id = t.parcours ";
        $query = $query . 'LEFT JOIN adresses d on t.depart = d.id ';
        $query = $query . 'LEFT JOIN commune cd ON d.commune = cd.id ';
        $query = $query . 'LEFT JOIN adresses a on t.arrivee = a.id ';
        $query = $query . 'LEFT JOIN commune ca ON a.commune = ca.id ';
        $query = $query . "WHERE p.id = " . $id;
        // echo '<br />' . $query . '<br />';
        return $this->query($query );

   }
    public function selectParcoursTrajetsCorrs($id) {
        $query = "SELECT * ";
        $query = $query . "FROM `parcours` p ";
        $query = $query . "LEFT JOIN trajet t ON p.id = t.parcours ";
        $query = $query . "WHERE p.id = " . $id;
        $data = $this->query($query );

        $trajets = [];
        foreach($data as $trajet) {
            $trajets[$trajet->id] = $trajet;
        }
        return $trajets;
    }
    public function insertParcoursObj($data, $trajet, $direction) {
        $arrivee = $data->arrivee;
        $depart = $data->depart;
        if('retour' == $direction) {
            $arrivee = $data->depart;
            $depart = $data->arrivee;
        }
        // var_dump($data);
        $this->query("INSERT INTO {$this->table} (
            -- nom,
            no_passagers,
            aller_retour,
            date_debut_aller,
            date_fin_aller,
            date_debut_retour,
            date_fin_retour,
            membre,
            depart,
            arrivee,
            motif,
            created_by,
            updated_at,
            updated_by
        ) VALUES (
            -- :nom,
            :no_passagers,
            :aller_retour,
            :date_debut_aller,
            :date_fin_aller,
            :date_debut_retour,
            :date_fin_retour,
            :membre,
            :depart,
            :arrivee,
            :motif,
            :created_by,
            :updated_at,
            :updated_by
        )",
        [
            // 'nom' => $data['nom'],
            'no_passagers' => $data->no_passagers,
            'aller_retour' => 'aller',
            'date_debut_aller' => $trajet->date_debut,
            'date_fin_aller' => $trajet->date_fin,
            'date_debut_retour' => $data->date_debut_retour,
            'date_fin_retour' => $data->date_fin_retour,
            'membre' => $data->membre,
            'depart' => $depart,
            'arrivee' => $arrivee,
            'motif' => $data->motif,
            'created_by' => $_SESSION['transport-solidaire']['users_id'],
            'updated_at' => $data->updated_at,
            'updated_by' => $_SESSION['transport-solidaire']['users_id']
        ],
        true);
        return App::getInstance()->getDb()->lastInsertId();
    }
    public function copyParcours($parcours) {
        $this->query("INSERT INTO {$this->table} (
            -- nom,
            no_passagers,
            aller_retour,
            date_debut_aller,
            date_fin_aller,
            date_debut_retour,
            date_fin_retour,
            membre,
            depart,
            arrivee,
            motif,
            created_by,
            updated_at,
            updated_by
        ) VALUES (
            -- :nom,
            :no_passagers,
            :aller_retour,
            :date_debut_aller,
            :date_fin_aller,
            :date_debut_retour,
            :date_fin_retour,
            :membre,
            :depart,
            :arrivee,
            :motif,
            :created_by,
            :updated_at,
            :updated_by
        )",
        [
            // 'nom' => $data['nom'],
            'no_passagers' => $parcours->no_passagers,
            'aller_retour' => $parcours->aller_retour,
            'date_debut_aller' => $parcours->date_debut_aller,
            'date_fin_aller' => $parcours->date_fin_aller,
            'date_debut_retour' => $parcours->date_debut_retour,
            'date_fin_retour' => $parcours->date_fin_retour,
            'membre' => $parcours->membre,
            'depart' => $parcours->depart,
            'arrivee' => $parcours->arrivee,
            'motif' => $parcours->motif,
            'created_by' => $parcours->created_by,
            'updated_at' => $parcours->updated_at,
            'updated_by' => $parcours->updated_by
        ],
        true);
        return App::getInstance()->getDb()->lastInsertId();
    }

    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function insertParcours(array $data) {
    //   var_dump($data);
        return $this->query("INSERT INTO {$this->table} (
            -- nom,
            no_passagers,
            aller_retour,
            date_debut_aller,
            date_fin_aller,
            date_debut_retour,
            date_fin_retour,
            membre,
            depart,
            arrivee,
            motif,
            created_by,
            updated_at,
            updated_by
        ) VALUES (
            -- :nom,
            :no_passagers,
            :aller_retour,
            :date_debut_aller,
            :date_fin_aller,
            :date_debut_retour,
            :date_fin_retour,
            :membre,
            :depart,
            :arrivee,
            :motif,
            :created_by,
            :updated_at,
            :updated_by
        )",
        [
            // 'nom' => $data['nom'],
            'no_passagers' => $data['no_passagers'],
            'aller_retour' => $data['aller_retour'],
            'date_debut_aller' => $data['date_debut_aller'],
            'date_fin_aller' => $data['date_fin_aller'],
            'date_debut_retour' => $data['date_debut_retour'],
            'date_fin_retour' => $data['date_fin_retour'],
            'membre' => $data['membre'],
            'depart' => $data['depart'],
            'arrivee' => $data['arrivee'],
            'motif' => $data['motif'],
            'created_by' => $_SESSION['transport-solidaire']['users_id'],
            'updated_at' => $data['updated_at'],
            'updated_by' => $_SESSION['transport-solidaire']['users_id']
        ],
        true);
        return App::getInstance()->getDb()->lastInsertId();
    }
    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function updateParcoursObj($data, $id) {
        //   var_dump($data);
        $query = "";
        $query = $query . "UPDATE parcours SET ";
        $query = $query . " no_passagers = " . $data->no_passagers;
        $query = $query . ", aller_retour = '" . $data->aller_retour . "'";
        if ($data->date_debut_aller != null) {
            $query = $query . ", date_debut_aller = '" . $data->date_debut_aller . "'";
            $query = $query . ", date_fin_aller = '" . $data->date_fin_aller . "'";
            $query = $query . ", date_debut_retour = '" . $data->date_debut_retour . "'";
            $query = $query . ", date_fin_retour = '" . $data->date_fin_retour . "'";
        }
        $query = $query . ", membre = " . $data->membre;
        $query = $query . ", depart = " . $data->depart;
        $query = $query . ", arrivee = " . $data->arrivee;
        $query = $query . ", motif = " . $data->motif;
        $query = $query . ", created_by = " . $data->created_by;
        $query = $query . ", updated_at = '" . $data->updated_at . "'";
        $query = $query . ", updated_by = " . $data->updated_by;
        $query = $query . " WHERE id = " . $id;
// var_dump($query);
        $this->query($query);
        return App::getInstance()->getDb()->lastInsertId();
    }
    
    /**
     * UPDATE query
     *
     * @param string $name
     * @param int $id
     * @return object
     */
    public function updateParcours(string $name, int $id) {
        return $this->query("UPDATE {$this->table} SET
            nom = :nom,
            prenom = :prenom,
            email = :email,
            mdp = :mdp
        WHERE id = :id",
        ['id' => $id, 'name' => $name],
        true);
    }

    /**
     * DELETE query
     *
     * @param int $id
     * @return object
     */
    public function deleteParcours(int $id) {
        return $this->query("DELETE FROM {$this->table} WHERE id = :id",
        ['id' => $id],
        true);
    }

    public function selectNouveaux() {
        $timeZone = new DateTimeZone('Europe/Paris');
        $now = new DateTime(null, $timeZone);
        $one_week = new DateInterval('P7D');
        // $date = new DateTime(strtotime("-1 week"));
        $date = $now->sub(new DateInterval('P7D'));
        $date->setTime(0,0);

        $query = "";
        $query = $query . "SELECT DISTINCT ca.nom as arrivee, cd.nom AS depart, "; 
        $query = $query . "p.id as parcoursId, ";
        $query = $query . "DATE_FORMAT(p.date_debut_aller, '%d/%m/%Y') as date_debut, ";
        $query = $query . "DATE_FORMAT(p.date_fin_aller, '%d/%m/%Y') as date_fin, ";
        $query = $query . "p.motif as motif,";
        $query = $query . "t.status as statut,";
        $query = $query . "pnm.id_pnm as id_pnm, pnm.titre_pnm as titre_pnm, ";
        $query = $query . "p.created_at FROM `parcours` p ";
        $query = $query . "JOIN adresses a ON a.id = p.arrivee ";
        $query = $query . "JOIN commune ca ON ca.id = a.commune	";
        $query = $query . "JOIN adresses d ON d.id = p.depart ";
        $query = $query . "JOIN commune cd ON cd.id = d.commune ";
        $query = $query . "JOIN trajet t ON t.parcours = p.id ";
        $query = $query . "LEFT JOIN membres m ON m.users_id = p.membre "; 
        $query = $query . "LEFT JOIN adresses am ON m.adresse = am.id ";
        $query = $query . "LEFT JOIN commune cm ON cm.id = am.commune ";
        $query = $query . "LEFT JOIN pnm ON pnm.id_pnm = cm.pnm ";
        $query = $query . "WHERE p.created_at > '" . $date->format("Y/m/d") . "'";
        $query = $query . " ORDER BY pnm.id_pnm ";
        // echo $query;
        // var_dump($query);

        return $this->query($query);
    }
    public function selectMiseEnRelationUpdated() {
        $timeZone = new DateTimeZone('Europe/Paris');
        $now = new DateTime(null, $timeZone);
        $one_week = new DateInterval('P7D');
        // $date = new DateTime(strtotime("-1 week"));
        $date = $now->sub(new DateInterval('P7D'));
        $date->setTime(0,0);

        $query = "";
        $query = $query . "SELECT DISTINCT ca.nom as arrivee, cd.nom AS depart, "; 
        $query = $query . "p.id as parcoursId, ";
        $query = $query . "pnm.id_pnm as id_pnm, pnm.titre_pnm as titre_pnm, ";
        $query = $query . "DATE_FORMAT(p.date_debut_aller, '%d/%m/%Y') as date_debut, ";
        $query = $query . "p.created_at FROM `parcours` p ";
        $query = $query . "JOIN trajet t ON t.parcours = p.id ";
        $query = $query . "JOIN adresses a ON a.id = p.arrivee ";
        $query = $query . "JOIN commune ca ON ca.id = a.commune	";
        $query = $query . "JOIN adresses d ON d.id = p.depart ";
        $query = $query . "JOIN commune cd ON cd.id = d.commune ";
        $query = $query . "LEFT JOIN membres m ON m.users_id = p.membre "; 
        $query = $query . "LEFT JOIN adresses am ON m.adresse = am.id ";
        $query = $query . "LEFT JOIN commune cm ON cm.id = am.commune ";
        $query = $query . "LEFT JOIN pnm ON pnm.id_pnm = cm.pnm ";
        $query = $query . "WHERE p.created_at > '" . $date->format("Y/m/d") . "' ";
        $query = $query . "AND t.status = 1 ";
        // $query = $query . "WHERE t.status = 1 ";
        $query = $query . " GROUP BY p.id, t.status";
        $query = $query . " ORDER BY pnm.id_pnm";
        // echo $query;
        // var_dump($query);

        return $this->query($query);
    }
    public function statTrajetsPeriod($periodeDebut, $periodeFin, $membre_type = '', $complet = false, $pnmId = 0, $actif = -1) {
        $query = "SELECT COUNT(*) as count, MONTH(p.date_debut_aller) as month ";
        // $query = "  DAYOFMONTH(p.date_debut_aller) as day_of_month ";
        $query = $query . " FROM trajet t"; 
        $query = $query . " JOIN parcours p on p.id = t.parcours ";
        $query = $query . " JOIN membres m on p.membre = m.users_id ";
        $query = $query . " JOIN adresses a on m.adresse = a.id ";
        $query = $query . " JOIN commune c on a.commune = c.id ";
        $query = $query . "WHERE p.date_debut_aller >= '" . $periodeDebut->format('Y/m/d') . "'"; 
        $query = $query . " AND p.date_debut_aller <= '" . $periodeFin->format('Y/m/d') . "'"; 
        if ($membre_type != '')
        {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }
        if ($complet) {
            $query = $query . " AND p.valide = 1 ";
        }
        if ($pnmId > 0 ) {
            $query = $query . " AND c.pnm = " . $pnmId;
        }
        if ($actif >= 0 ) {
            $query = $query . " AND m.actif = " . $actif;
        }
        $query = $query . " GROUP BY MONTH(p.date_debut_aller)";

        // echo $query;
        // var_dump($query);

        return $this->query($query);
    }
    public function statTrajetsPeriodDay($periodeDebut, $periodeFin, $membre_type = '', $complet = false, $pnmId = 0, $actif = -1) {
        $query = "SELECT COUNT(*) as count, ";
        $query = $query . " DAYOFWEEK(p.date_debut_aller) as day_of_week ";
        $query = $query . " FROM trajet t"; 
        $query = $query . " JOIN parcours p on p.id = t.parcours ";
        $query = $query . " JOIN membres m on p.membre = m.users_id ";
        $query = $query . " JOIN adresses a on m.adresse = a.id ";
        $query = $query . " JOIN commune c on a.commune = c.id ";
        $query = $query . " WHERE p.date_debut_aller >= '" . $periodeDebut->format('Y/m/d') . "'"; 
        $query = $query . " AND p.date_debut_aller <= '" . $periodeFin->format('Y/m/d') . "'"; 
        if ($membre_type != '')
        {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }
        if ($complet) {
            $query = $query . " AND p.valide = 1 ";
        }
        if ($pnmId > 0 ) {
            $query = $query . " AND c.pnm = " . $pnmId;
        }
        if ($actif >= 0 ) {
            $query = $query . " AND m.actif = " . $actif;
        }
        $query = $query . " GROUP BY DAYOFMONTH(p.date_debut_aller)";

        // echo $query;
        // var_dump($query);
        return $this->query($query);
    }
    public function statTrajetsPeriodMonth($periodeDebut, $periodeFin, $membre_type = '', $complet = false, $pnmId = 0, $actif = -1) {
        $query = "SELECT COUNT(*) as count, ";
        $query = $query . " DAYOFMONTH(p.date_debut_aller) as day_of_month ";
        $query = $query . " FROM trajet t"; 
        $query = $query . " JOIN parcours p on p.id = t.parcours ";
        $query = $query . " JOIN membres m on p.membre = m.users_id ";
        $query = $query . " JOIN adresses a on m.adresse = a.id ";
        $query = $query . " JOIN commune c on a.commune = c.id ";
        $query = $query . "WHERE p.date_debut_aller >= '" . $periodeDebut->format('Y/m/d') . "'"; 
        $query = $query . " AND p.date_debut_aller <= '" . $periodeFin->format('Y/m/d') . "'"; 
        if ($membre_type != '')
        {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }
        if ($pnmId > 0 ) {
            $query = $query . " AND c.pnm = " . $pnmId;
        }
        if ($complet) {
            $query = $query . " AND p.valide = 1 ";
        }
        if ($actif >= 0 ) {
            $query = $query . " AND m.actif = " . $actif;
        }
        $query = $query . " GROUP BY DAYOFMONTH(p.date_debut_aller)";

        // echo $query;
        // var_dump($query);
        return $this->query($query);
    }

    public function statTrajets($membre_type = '', $complet = false, $actif = -1) {
        $query = "SELECT COUNT(*) as count, MONTH(p.date_debut_aller) as month ";
        $query = $query . " FROM trajet t"; 
        $query = $query . " JOIN parcours p on p.id = t.parcours ";
        $query = $query . " JOIN membres m on p.membre = m.users_id ";
        $query = $query . "WHERE YEAR(p.date_debut_aller) = '2020' "; 
        if ($membre_type != '')
        {
            $query = $query . " AND m.membre_type = '" . $membre_type . "' ";
        }        
        if ($complet) {
            $query = $query . " AND p.valide = 1 ";
        }
        if ($actif >= 0 ) {
            $query = $query . " AND m.actif = " . $actif;
        }
        $query = $query . " GROUP BY MONTH(p.date_debut_aller)";

        // echo $query;
        // var_dump($query);
        return $this->query($query);
    }
    public function exportTrajets($periodeDebut, $periodeFin, $actif) {
        // var_dump($_REQUEST);
        $query = "SELECT ";
        $query = $query . "p.id as parcoursId, t.id as trajetId, ";
        $query = $query . "t.direction AS direction, ";
        $query = $query . "m.actif AS actif, ";
        $query = $query . "t.date_debut AS date_debut, ";
        $query = $query . "t.tra_type AS tra_type, ";
        $query = $query . "t.date_val AS date_val, ";
        $query = $query . "CONCAT(m.civilite, ' ', u.prenom, ' ',u.nom) AS Membre, ";
        $query = $query . "CONCAT(mc.civilite, ' ', uc.prenom, ' ',uc.nom) AS Chauffeur, ";
        $query = $query . "CONCAT(mb.civilite, ' ', ub.prenom, ' ',ub.nom) AS Passager, ";
        $query = $query . "cm.nom as communeMembre, ";
        $query = $query . "cd.nom as communeDepart, ";
        $query = $query . "ca.nom as communeArrivee, ";
        $query = $query . "m.membre_type AS trajet_type ";
        $query = $query . " FROM parcours p";
        $query = $query . " JOIN trajet t ON t.parcours = p.id ";
        $query = $query . " JOIN membres m ON m.users_id = p.membre ";
        $query = $query . " JOIN users u ON u.id = p.membre ";
        $query = $query . " JOIN adresses ad ON ad.id = t.depart ";
        $query = $query . " JOIN commune cd ON cd.id = ad.commune ";
        $query = $query . " JOIN adresses aa ON aa.id = t.arrivee ";
        $query = $query . " JOIN commune ca ON ca.id = aa.commune ";
        $query = $query . " JOIN adresses am ON am.id = m.adresse ";
        $query = $query . " JOIN commune cm ON cm.id = am.commune ";
        $query = $query . " LEFT JOIN membres mc ON mc.users_id = t.conducteur ";
        $query = $query . " LEFT JOIN users uc ON uc.id = mc.users_id ";
        $query = $query . " LEFT JOIN membres mb ON mb.users_id = t.beneficiaire ";
        $query = $query . " LEFT JOIN users ub ON ub.id = mb.users_id ";
        $query = $query . "WHERE p.date_debut_aller >= '" . $periodeDebut . "'"; 
        $query = $query . " AND p.date_debut_aller <= '" . $periodeFin . "'"; 
        if ($actif >= 0) {
            $query = $query . " AND m.actif = " . $actif . " "; 
        }
        $query = $query . " ORDER BY t.id ";
        // var_dump($query);
        // echo $query;
        return $this->query($query);
    }
}
