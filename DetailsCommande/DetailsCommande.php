<?php
include_once '../config.php';

class DetailsCommande {
    private $idReparation;
    private $idPiece;
    private $qte;
    private $dateCommande;

    public function __construct($idReparation, $idPiece, $qte, $dateCommande) {
        $this->idReparation = $idReparation;
        $this->idPiece = $idPiece;
        $this->qte = $qte;
        $this->dateCommande = $dateCommande;
    }

    // Getters et setters pour les attributs

    public function getIdReparation() {
        return $this->idReparation;
    }

    public function getIdPiece() {
        return $this->idPiece;
    }

    public function getQte() {
        return $this->qte;
    }

    public function setQte($qte) {
        $this->qte = $qte;
    }

    public function getDateCommande() {
        return $this->dateCommande;
    }

    public function setDateCommande($dateCommande) {
        $this->dateCommande = $dateCommande;
    }

    public function save() {
        global $conn;

        $idReparation = $this->idReparation;
        $idPiece = $this->idPiece;
        $qte = $this->qte;
        $dateCommande = $this->dateCommande;

        $sql = "INSERT INTO DetailsCommande (IdReparation, IdPiece, Qte, DateCommande) VALUES ('$idReparation', '$idPiece', '$qte', '$dateCommande')";
        return $conn->query($sql);
    }

    public function update() {
        global $conn;

        $idReparation = $this->idReparation;
        $idPiece = $this->idPiece;
        $qte = $this->qte;
        $dateCommande = $this->dateCommande;

        $sql = "UPDATE DetailsCommande SET Qte = '$qte', DateCommande = '$dateCommande' WHERE IdReparation = '$idReparation' AND IdPiece = '$idPiece'";
        return $conn->query($sql);
    }

    public function delete() {
        global $conn;

        $idReparation = $this->idReparation;
        $idPiece = $this->idPiece;

        $sql = "DELETE FROM DetailsCommande WHERE IdReparation = '$idReparation' AND IdPiece = '$idPiece'";
        return $conn->query($sql);
    }

    public static function getAllDetails() {
        global $conn;

        $sql = "SELECT * FROM DetailsCommande";
        $result = $conn->query($sql);

        $details = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $detail = new DetailsCommande($row['IdReparation'], $row['IdPiece'], $row['Qte'], $row['DateCommande']);
                $details[] = $detail;
            }
        }

        return $details;
    }

    public static function searchDetails($searchTerm) {
        global $conn;

        $sql = "SELECT * FROM DetailsCommande WHERE IdReparation LIKE '%$searchTerm%' OR IdPiece LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        $details = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $detail = new DetailsCommande($row['IdReparation'], $row['IdPiece'], $row['Qte'], $row['DateCommande']);
                $details[] = $detail;
            }
        }

        return $details;
    }
}
?>
