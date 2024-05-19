<?php
include_once '../config.php';

class Reglement {
    private $idReglement;
    private $idReparation;
    private $montant;
    private $dateReglement;

    public function __construct($idReparation, $montant, $dateReglement) {
        $this->idReparation = $idReparation;
        $this->montant = $montant;
        $this->dateReglement = $dateReglement;
    }

    public function getIdReglement() {
        return $this->idReglement;
    }

    public function setIdReglement($idReglement) {
        $this->idReglement = $idReglement;
    }

    public function getIdReparation() {
        return $this->idReparation;
    }

    public function getMontant() {
        return $this->montant;
    }

    public function getDateReglement() {
        return $this->dateReglement;
    }

    public function save() {
        global $conn;

        $idReparation = $this->idReparation;
        $montant = $this->montant;
        $dateReglement = $this->dateReglement;

        $sql = "INSERT INTO Reglement (IdReparation, Montant, DateReglement) VALUES ('$idReparation', '$montant', '$dateReglement')";
        return $conn->query($sql);
    }

    public function update() {
        global $conn;

        $idReglement = $this->idReglement;
        $idReparation = $this->idReparation;
        $montant = $this->montant;
        $dateReglement = $this->dateReglement;

        $sql = "UPDATE Reglement SET IdReparation = '$idReparation', Montant = '$montant', DateReglement = '$dateReglement' WHERE IdReglement = '$idReglement'";
        return $conn->query($sql);
    }

    public function delete() {
        global $conn;

        $idReglement = $this->idReglement;

        $sql = "DELETE FROM Reglement WHERE IdReglement = '$idReglement'";
        return $conn->query($sql);
    }

    public static function getAllReglements() {
        global $conn;

        $sql = "SELECT * FROM Reglement";
        $result = $conn->query($sql);

        $reglements = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $reglement = new Reglement($row['IdReparation'], $row['Montant'], $row['DateReglement']);
                $reglement->setIdReglement($row['IdReglement']);
                $reglements[] = $reglement;
            }
        }

        return $reglements;
    }

    public static function getReglementById($idReglement) {
        global $conn;

        $sql = "SELECT * FROM Reglement WHERE IdReglement = '$idReglement'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $reglement = new Reglement($row['IdReparation'], $row['Montant'], $row['DateReglement']);
            $reglement->setIdReglement($row['IdReglement']);
            return $reglement;
        } else {
            return null;
        }
    }

    public static function searchReglements($searchTerm) {
        global $conn;

        $sql = "SELECT * FROM Reglement WHERE Montant LIKE '%$searchTerm%' OR DateReglement LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        $reglements = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $reglement = new Reglement($row['IdReparation'], $row['Montant'], $row['DateReglement']);
                $reglement->setIdReglement($row['IdReglement']);
                $reglements[] = $reglement;
            }
        }

        return $reglements;
    }
}
?>