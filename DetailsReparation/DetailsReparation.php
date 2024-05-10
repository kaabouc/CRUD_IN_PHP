<?php
include_once '../config.php';

class DetailsReparation {
    private $idDetailsReparation;
    private $idReparation;
    private $idReglement;
    private $idAppareil;
    private $etatSousReparation;
    private $description;
    private $cout;

    public function __construct($idReparation, $idReglement, $idAppareil, $etatSousReparation, $description, $cout) {
        $this->idReparation = $idReparation;
        $this->idReglement = $idReglement;
        $this->idAppareil = $idAppareil;
        $this->etatSousReparation = $etatSousReparation;
        $this->description = $description;
        $this->cout = $cout;
    }

    // Getters et setters pour les attributs

    public function getIdDetailsReparation() {
        return $this->idDetailsReparation;
    }

    public function setIdDetailsReparation($idDetailsReparation) {
        $this->idDetailsReparation = $idDetailsReparation;
    }

    public function getIdReparation() {
        return $this->idReparation;
    }

    public function setIdReparation($idReparation) {
        $this->idReparation = $idReparation;
    }

    public function getIdReglement() {
        return $this->idReglement;
    }

    public function setIdReglement($idReglement) {
        $this->idReglement = $idReglement;
    }

    public function getIdAppareil() {
        return $this->idAppareil;
    }

    public function setIdAppareil($idAppareil) {
        $this->idAppareil = $idAppareil;
    }

    public function getEtatSousReparation() {
        return $this->etatSousReparation;
    }

    public function setEtatSousReparation($etatSousReparation) {
        $this->etatSousReparation = $etatSousReparation;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getCout() {
        return $this->cout;
    }

    public function setCout($cout) {
        $this->cout = $cout;
    }

    public function save() {
        global $conn;

        $idReparation = $this->idReparation;
        $idReglement = $this->idReglement;
        $idAppareil = $this->idAppareil;
        $etatSousReparation = $this->etatSousReparation;
        $description = $this->description;
        $cout = $this->cout;

        $sql = "INSERT INTO DetailsReparation (IdReparation, IdReglement, IdAppareil, EtatSousRéparation, Description, Coût) 
                VALUES ('$idReparation', '$idReglement', '$idAppareil', '$etatSousReparation', '$description', '$cout')";
        return $conn->query($sql);
    }

    public function update() {
        global $conn;

        $idDetailsReparation = $this->idDetailsReparation;
        $idReparation = $this->idReparation;
        $idReglement = $this->idReglement;
        $idAppareil = $this->idAppareil;
        $etatSousReparation = $this->etatSousReparation;
        $description = $this->description;
        $cout = $this->cout;

        $sql = "UPDATE DetailsReparation SET IdReparation = '$idReparation', IdReglement = '$idReglement', IdAppareil = '$idAppareil', 
                EtatSousRéparation = '$etatSousReparation', Description = '$description', Coût = '$cout' 
                WHERE IdDetailsReparation = '$idDetailsReparation'";
        return $conn->query($sql);
    }

    public function delete() {
        global $conn;

        $idDetailsReparation = $this->idDetailsReparation;

        $sql = "DELETE FROM DetailsReparation WHERE IdDetailsReparation = '$idDetailsReparation'";
        return $conn->query($sql);
    }

    public static function getAllDetailsReparations() {
        global $conn;

        $sql = "SELECT * FROM DetailsReparation";
        $result = $conn->query($sql);

        $detailsReparations = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $detailsReparation = new DetailsReparation($row['IdReparation'], $row['IdReglement'], $row['IdAppareil'], 
                                                            $row['EtatSousRéparation'], $row['Description'], $row['Coût']);
                $detailsReparation->setIdDetailsReparation($row['IdDetailsReparation']);
                $detailsReparations[] = $detailsReparation;
            }
        }

        return $detailsReparations;
    }

    public static function searchDetailsReparations($searchTerm) {
        global $conn;

        $sql = "SELECT * FROM DetailsReparation WHERE EtatSousRéparation LIKE '%$searchTerm%' OR Description LIKE '%$searchTerm%' OR Coût LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        $detailsReparations = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $detailsReparation = new DetailsReparation($row['IdReparation'], $row['IdReglement'], $row['IdAppareil'], 
                                                            $row['EtatSousRéparation'], $row['Description'], $row['Coût']);
                $detailsReparation->setIdDetailsReparation($row['IdDetailsReparation']);
                $detailsReparations[] = $detailsReparation;
            }
        }

        return $detailsReparations;
    }
}
?>
