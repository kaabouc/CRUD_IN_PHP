<?php
include_once '../config.php';

class Reglement {
    private $idReglement;
    private $etat;
    private $dateReglement;

    public function __construct($etat, $dateReglement) {
        $this->etat = $etat;
        $this->dateReglement = $dateReglement;
    }

    // Getters et setters pour les attributs

    public function getIdReglement() {
        return $this->idReglement;
    }

    public function setIdReglement($idReglement) {
        $this->idReglement = $idReglement;
    }

    public function getEtat() {
        return $this->etat;
    }

    public function setEtat($etat) {
        $this->etat = $etat;
    }

    public function getDateReglement() {
        return $this->dateReglement;
    }

    public function setDateReglement($dateReglement) {
        $this->dateReglement = $dateReglement;
    }

    public function save() {
        global $conn;

        $etat = $this->etat;
        $dateReglement = $this->dateReglement;

        $sql = "INSERT INTO Règlement (Etat, DateRèglement) VALUES ('$etat', '$dateReglement')";
        return $conn->query($sql);
    }

    public function update() {
        global $conn;

        $idReglement = $this->idReglement;
        $etat = $this->etat;
        $dateReglement = $this->dateReglement;

        $sql = "UPDATE Règlement SET Etat = '$etat', DateRèglement = '$dateReglement' WHERE IdRèglement = '$idReglement'";
        return $conn->query($sql);
    }

    public function delete() {
        global $conn;

        $idReglement = $this->idReglement;

        $sql = "DELETE FROM Règlement WHERE IdRèglement = '$idReglement'";
        return $conn->query($sql);
    }

    public static function getAllReglements() {
        global $conn;

        $sql = "SELECT * FROM Règlement";
        $result = $conn->query($sql);

        $reglements = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $reglement = new Reglement($row['Etat'], $row['DateRèglement']);
                $reglement->setIdReglement($row['IdRèglement']);
                $reglements[] = $reglement;
            }
        }

        return $reglements;
    }

    public static function searchReglements($searchTerm) {
        global $conn;

        $sql = "SELECT * FROM Règlement WHERE Etat LIKE '%$searchTerm%' OR DateRèglement LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        $reglements = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $reglement = new Reglement($row['Etat'], $row['DateRèglement']);
                $reglement->setIdReglement($row['IdRèglement']);
                $reglements[] = $reglement;
            }
        }

        return $reglements;
    }
}
?>
