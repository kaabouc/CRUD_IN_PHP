<?php
include_once 'config.php';

class Règlement {
    private $idRèglement;
    private $idRéparation;
    private $etat;
    private $dateRèglement;
    private $coût;

    public function __construct($idRéparation, $etat, $dateRèglement, $coût) {
        $this->idRéparation = $idRéparation;
        $this->etat = $etat;
        $this->dateRèglement = $dateRèglement;
        $this->coût = $coût;
    }

    public function getIdRèglement() {
        return $this->idRèglement;
    }

    public function setIdRèglement($idRèglement) {
        $this->idRèglement = $idRèglement;
    }

    public function getIdRéparation() {
        return $this->idRéparation;
    }

    public function getEtat() {
        return $this->etat;
    }

    public function getDateRèglement() {
        return $this->dateRèglement;
    }

    public function getCoût() {
        return $this->coût;
    }

    public function save() {
        global $conn;

        $idRéparation = $this->idRéparation;
        $etat = $this->etat;
        $dateRèglement = $this->dateRèglement;
        $coût = $this->coût;

        $sql = "INSERT INTO Règlement (IdRéparation, Etat, DateRèglement, Coût) VALUES ('$idRéparation', '$etat', '$dateRèglement', '$coût')";
        return $conn->query($sql);
    }

    public function update() {
        global $conn;

        $idRèglement = $this->idRèglement;
        $idRéparation = $this->idRéparation;
        $etat = $this->etat;
        $dateRèglement = $this->dateRèglement;
        $coût = $this->coût;

        $sql = "UPDATE Règlement SET IdRéparation = '$idRéparation', Etat = '$etat', DateRèglement = '$dateRèglement', Coût = '$coût' WHERE IdRèglement = '$idRèglement'";
        return $conn->query($sql);
    }

    public function delete() {
        global $conn;

        $idRèglement = $this->idRèglement;

        $sql = "DELETE FROM Règlement WHERE IdRèglement = '$idRèglement'";
        return $conn->query($sql);
    }

    public static function getAllRèglements() {
        global $conn;

        $sql = "SELECT * FROM Règlement";
        $result = $conn->query($sql);

        $règlements = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $règlement = new Règlement($row['IdRéparation'], $row['Etat'], $row['DateRèglement'], $row['Coût']);
                $règlement->setIdRèglement($row['IdRèglement']);
                $règlements[] = $règlement;
            }
        }

        return $règlements;
    }

    public static function getRèglementById($idRèglement) {
        global $conn;

        $sql = "SELECT * FROM Règlement WHERE IdRèglement = '$idRèglement'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $règlement = new Règlement($row['IdRéparation'], $row['Etat'], $row['DateRèglement'], $row['Coût']);
            $règlement->setIdRèglement($row['IdRèglement']);
            return $règlement;
        } else {
            return null;
        }
    }

    public static function searchRèglements($searchTerm) {
        global $conn;

        $sql = "SELECT * FROM Règlement WHERE Etat LIKE '%$searchTerm%' OR DateRèglement LIKE '%$searchTerm%' OR Coût LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        $règlements = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $règlement = new Règlement($row['IdRéparation'], $row['Etat'], $row['DateRèglement'], $row['Coût']);
                $règlement->setIdRèglement($row['IdRèglement']);
                $règlements[] = $règlement;
            }
        }

        return $règlements;
    }
}
?>
