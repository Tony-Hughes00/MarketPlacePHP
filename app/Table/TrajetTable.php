<?php

namespace App\Table;

use Core\Table\Table;

use App;
use App\Controller\AppController;

use DateTime;
use DatePeriod;
use DateInterval;
use DateTimeZone;


class TrajetTable extends Table {
    
    protected $table = 'trajet';

    /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectQuery($query) {

        return $this->query($query);
    }
        /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectTrajet($id) {

        return $this->query("SELECT * FROM {$this->table} WHERE id = :id",
        ['id' => $id],
        get_called_class(),
        true);
    }
         /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function updateCorrespondanceReverse($parcoursId, $correspondance, $direction, $trajetId, $status) {

        $query = "UPDATE " . $this->table . " SET `correspondance` = " . $trajetId;
        $query = $query . " , status = '" . $status;
        $query = $query . "' WHERE direction = '" . $direction . "'";
        $query = $query . " AND id = " . $correspondance;
        // echo $query . '<br />';
        return $this->query($query);

    }
     /**
     * UPDATE trajet WHERE parcours = $parcoursId AND direction = $direction 
     *
     * @param int $id
     * @return object
     */
    public function updateCorrespondance($parcoursId, $correspondance, $direction, $trajetId, $status) {
        $query = "UPDATE " . $this->table . " SET `correspondance` = " . $correspondance;
        $query = $query . " , status = '" . $status;
        $query = $query . "' WHERE direction = '" . $direction . "'";
        $query = $query . " AND parcours = " . $parcoursId;
        // echo $query . '<br />';
        return $this->query($query);

    }
         /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function updateValidation($dateTime, $trajetInfo, $status, $distance) {

        $query = "";
        if ($dateTime == "null") {
            $query = $query . "UPDATE " . $this->table . " SET `date_val`= " . $dateTime . " ";
        } else {
            $query = $query . "UPDATE " . $this->table . " SET `date_val` = '" . $dateTime . "' ";
        }
        $query = $query . " , status = '" . $status . "'";
        $query = $query . " , distance = '" . $distance . "'";
        $query = $query . " WHERE id = " . $trajetInfo->id;
        // echo $query . '<br />';
        $this->query($query);

        $query = "";
        if ($dateTime == "null") {
            $query = $query . "UPDATE " . $this->table . " SET `date_val`= " . $dateTime . " ";
        } else {
            $query = $query . "UPDATE " . $this->table . " SET `date_val` = '" . $dateTime . "' ";
        }
        $query = $query . " , status = '" . $status . "'";
        $query = $query . " WHERE id = " . $trajetInfo->correspondance;
        // echo $query . '<br />';
        $this->query($query);
    }
     /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectTrajetEtape($idTrajet, $actif) {
        $query = 'SELECT p.id as parcours, t.id as trajetId, t.direction, t.id as trajetId, ';
        $query = $query . 'cd.id as departCommuneId, ca.id as arriveeCommuneId, ';
        $query = $query . 't.depart as departEtape, t.arrivee as arriveeEtape, t.conducteur as conducteur, ';
        $query = $query . 't.date_debut as date_debut, t.date_fin as date_fin, t.tra_type as tra_type, ';
        $query = $query . 'p.depart as depart, p.arrivee as arrivee, ';
        $query = $query . 't.direction, cd.nom as nomDepart, ca.nom  as nomArrivee ';
        $query = $query . 'FROM `trajet` t ';
        $query = $query . 'LEFT JOIN parcours p on t.parcours = p.id ';
        $query = $query . 'JOIN membres m on p.membre = m.users_id ';
        $query = $query . 'LEFT JOIN adresses d on t.depart = d.id ';
        $query = $query . 'LEFT JOIN commune cd ON d.commune = cd.id ';
        $query = $query . 'LEFT JOIN adresses a on t.arrivee = a.id ';
        $query = $query . 'LEFT JOIN commune ca ON a.commune = ca.id ';
        $query = $query . 'WHERE t.id = ';
        $query = $query .  $idTrajet;
        if ($actif != null) {
            $query = $query . ' AND m.actif = ';
            $query = $query .  $actif;
        }
        $query = $query .  ' ORDER BY t.direction';
        // echo $query;
        // var_dump($query);
        return $this->query($query);
    }
    /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectTrajetOffert() {

        return $this->query("SELECT * FROM {$this->table}  WHERE tra_type = 'chauffeur'");
    }   
        /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectTrajetDemandee() {

        return $this->query("SELECT * FROM {$this->table} WHERE tra_type = 'passager'");
    }     
    /**
     * SELECT query
     *
     * @param int $id
     * @return object
     */
    public function selectAll(int $id) {
        return $this->all();
    }
    public function copyTrajet($trajet) {

        return $this->query("INSERT INTO {$this->table} (
            parcours,
            direction,
            sequenceNo,
            motif,
            arrivee,
            depart,
            tra_type,
            conducteur,
            beneficiaire,
            distance,
            date_debut,
            date_fin,
            updated_at
        ) VALUES (
            :parcours,
            :direction,
            :sequenceNo,
            :motif,
            :arrivee,
            :depart,
            :tra_type,
            :conducteur,
            :beneficiaire,
            :distance,
            :date_debut,
            :date_fin,
            :updated_at      
        )",
        [
            'parcours' => $trajet->parcours,
            'direction' => $trajet->direction,
            'sequenceNo' => $trajet->sequenceNo,
            'motif' => $trajet->motif,
            'arrivee' => $trajet->arrivee,
            'depart' => $trajet->depart,
            'tra_type' => $trajet->tra_type,
            'conducteur' => $trajet->conducteur,
            'beneficiaire' => $trajet->beneficiaire,
            'distance' => $trajet->distance,
            'date_debut' => $trajet->date_debut,
            'date_fin' => $trajet->date_fin,
            'updated_at' => $trajet->updated_at
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
    public function insertTrajetObj($data) {

        return $this->query("INSERT INTO {$this->table} (
            parcours,
            direction,
            sequenceNo,
            motif,
            arrivee,
            depart,
            tra_type,
            conducteur,
            beneficiaire,
            distance,
            date_debut,
            date_fin,
            updated_at
        ) VALUES (
            :parcours,
            :direction,
            :sequenceNo,
            :motif,
            :arrivee,
            :depart,
            :tra_type,
            :conducteur,
            :beneficiaire,
            :distance,
            :date_debut,
            :date_fin,
            :updated_at      
        )",
        [
            'parcours' => $data->parcours,
            'direction' => $data->direction,
            'sequenceNo' => $data->sequenceNo,
            'motif' => $data->motif,
            'arrivee' => $data->arrivee,
            'depart' => $data->depart,
            'tra_type' => $data->tra_type,
            'conducteur' => $data->conducteur,
            'beneficiaire' => $data->beneficiaire,
            'distance' => $data->distance,
            'date_debut' => $data->date_debut,
            'date_fin' => $data->date_fin,
            'updated_at' => $data->updated_at
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
    public function insertTrajet(array $data) {

        return $this->query("INSERT INTO {$this->table} (
            id,
            parcours,
            direction,
            sequenceNo,
            motif,
            arrivee,
            depart,
            tra_type,
            conducteur,
            beneficiaire,
            distance,
            date_debut,
            date_fin,
            updated_at
        ) VALUES (
            :id,
            :parcours,
            :direction,
            :sequenceNo,
            :motif,
            :arrivee,
            :depart,
            :tra_type,
            :conducteur,
            :beneficiaire,
            :distance,
            :date_debut,
            :date_fin,
            :updated_at      
        )",
        [
            'id' => $data['id'],
            'parcours' => $data['parcours'],
            'direction' => $data['direction'],
            'sequenceNo' => $data['sequenceNo'],
            'motif' => $data['motif'],
            'arrivee' => $data['arrivee'],
            'depart' => $data['depart'],
            'tra_type' => $data['tra_type'],
            'conducteur' => $data['chauffeur'],
            'beneficiaire' => $data['passager'],
            'distance' => $data['distance'],
            'date_debut' => $data['date_debut'],
            'date_fin' => $data['date_fin'],
            'updated_at' => $data['updated_at']
        ],        
        get_called_class(),
        true);
    }
    /**
     * INSERT new trajet if corresponding trajet is is dispo
     *
     * @param array $id = trajet id pour correspondance
     *              $trajet = current trajet 
     *              parcoursId$ = nouveau parcours
     * @return object
     */
    public function insertTrajetCorr($id, $trajet, $parcoursId, $direction) {
        $trajetCorr = $this->selectTrajet($id);
        $arrivee = $trajetCorr->arrivee;
        $depart = $trajetCorr->depart;
        if('retour' == $direction) {
            // $arrivee = $trajetCorr->depart;
            // $depart = $trajetCorr->arrivee;
        }
        $timeZone = new DateTimeZone('Europe/Paris');
        $now = new DateTime(null, $timeZone);
        $timeStamp = $now->format("Y/m/d H:i:s");
  
        if($trajetCorr->date_debut == null) {
            $this->query("INSERT INTO {$this->table} (
                id,
                parcours,
                direction,
                sequenceNo,
                motif,
                arrivee,
                depart,
                tra_type,
                conducteur,
                beneficiaire,
                correspondance,
                distance,
                date_debut,
                date_fin,
                updated_at
            ) VALUES (
                :id,
                :parcours,
                :direction,
                :sequenceNo,
                :motif,
                :arrivee,
                :depart,
                :tra_type,
                :conducteur,
                :beneficiaire,
                :correspondance,
                :distance,
                :date_debut,
                :date_fin,
                :updated_at      
            )",
            [
                'id' => null,
                'parcours' => $parcoursId,
                'direction' => $trajet->direction,
                'sequenceNo' =>$trajet->sequenceNo,
                'motif' => $trajet->motif,
                'arrivee' => $arrivee,
                'depart' => $depart,
                'tra_type' => 'aller',
                'conducteur' => $trajetCorr->conducteur,
                'beneficiaire' => $trajet->passager,
                'correspondance' => $trajet->trajetId,
                'distance' => $trajet->distance,
                'date_debut' => $trajet->date_debut,
                'date_fin' => $trajet->date_fin,
                // 'date_debut' => $trajet->date_debut,
                // 'date_fin' => $trajet->date_fin,
                'updated_at' => $timeStamp
            ],        
            get_called_class(),
            true);
            return App::getInstance()->getDb()->lastInsertId();
        } else {
            return $trajetCorr->id;
        }
    }
    /**
     * UPDATE query
     *
     * @param string $name
     * @param int $id
     * @return object
     */
    public function updateTrajet($query) {
        return $this->query($query);
    }
    /**
     * INSERT query
     *
     * @param array $data
     * @return object
     */
    public function updateTrajetObj($data, $id, $timestamp, $updated_by) {

        return $this->query("UPDATE {$this->table} SET
            parcours = :parcours,
            direction = :direction,
            sequenceNo = :sequenceNo,
            motif = :motif,
            arrivee = :arrivee,
            depart = :depart,
            tra_type = :tra_type,
            conducteur = :conducteur,
            beneficiaire = :beneficiaire,
            distance = :distance,
            date_debut = :date_debut,
            date_fin = :date_fin,
            updated_at = :updated_at
        WHERE id = :id",
        [
            'id' => $id,
            'parcours' => $data->parcours,
            'direction' => $data->direction,
            'sequenceNo' => $data->sequenceNo,
            'motif' => $data->motif,
            'arrivee' => $data->arrivee,
            'depart' => $data->depart,
            'tra_type' => $data->tra_type,
            'conducteur' => $data->conducteur,
            'beneficiaire' => $data->beneficiaire,
            'distance' => $data->distance,
            'date_debut' => $data->date_debut,
            'date_fin' => $data->date_fin,
            'updated_at' => $timestamp
        ],
        true);
    }
    /**
     * DELETE query
     *
     * @param int $id
     * @return object
     */
    public function deleteTrajet(int $id) {
        return $this->query("DELETE FROM {$this->table} WHERE id = " . $id);
    }
    public function deleteTrajetsparcours(int $parcoursId) {
        var_dump("DELETE FROM {$this->table} WHERE parcours=" . $parcoursId);
        return $this->query("DELETE FROM {$this->table} WHERE parcours = " . $parcoursId);
    }


}
