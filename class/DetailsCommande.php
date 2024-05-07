<?php
include_once 'config.php';

class DetailsCommande {
    private $idDetailsCommande;
    private $idRèglement;
    private $qte;
    private $dateCommande;

    public function __construct($idRèglement, $qte, $dateCommande) {
        $this->idRèglement = $idRèglement;
        $this->qte = $qte;
        $this->dateCommande = $dateCommande;
    }

    public function getIdDetailsCommande() {
        return $this->idDetailsCommande;
    }

    public function setIdDetailsCommande($idDetailsCommande) {
        $this->idDetailsCommande = $idDetailsCommande;
    }

    public function getIdRèglement() {
        return $this->idRèglement;
    }

    public function getQte() {
        return $this->qte;
    }

    public function getDateCommande() {
        return $this->dateCommande;
    }

    public function save() {
        global $conn;

        $idRèglement = $this->idRèglement;
        $qte = $this->qte;
        $dateCommande = $this->dateCommande;

        $sql = "INSERT INTO DetailsCommande (IdRèglement, Qte, DateCommande) VALUES ('$idRèglement', '$qte', '$dateCommande')";
        return $conn->query($sql);
    }

    public function update() {
        global $conn;

        $idDetailsCommande = $this->idDetailsCommande;
        $idRèglement = $this->idRèglement;
        $qte = $this->qte;
        $dateCommande = $this->dateCommande;

        $sql = "UPDATE DetailsCommande SET IdRèglement = '$idRèglement', Qte = '$qte', DateCommande = '$dateCommande' WHERE IdDetailsCommande = '$idDetailsCommande'";
        return $conn->query($sql);
    }

    public function delete() {
        global $conn;

        $idDetailsCommande = $this->idDetailsCommande;

        $sql = "DELETE FROM DetailsCommande WHERE IdDetailsCommande = '$idDetailsCommande'";
        return $conn->query($sql);
    }

    public static function getAllDetailsCommandes() {
        global $conn;

        $sql = "SELECT * FROM DetailsCommande";
        $result = $conn->query($sql);

        $detailsCommandes = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $detailsCommande = new DetailsCommande($row['IdRèglement'], $row['Qte'], $row['DateCommande']);
                $detailsCommande->setIdDetailsCommande($row['IdDetailsCommande']);
                $detailsCommandes[] = $detailsCommande;
            }
        }

        return $detailsCommandes;
    }

    public static function getDetailsCommandeById($idDetailsCommande) {
        global $conn;

        $sql = "SELECT * FROM DetailsCommande WHERE IdDetailsCommande = '$idDetailsCommande'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $detailsCommande = new DetailsCommande($row['IdRèglement'], $row['Qte'], $row['DateCommande']);
            $detailsCommande->setIdDetailsCommande($row['IdDetailsCommande']);
            return $detailsCommande;
        } else {
            return null;
        }
    }

    public static function searchDetailsCommandes($searchTerm) {
        global $conn;

        $sql = "SELECT * FROM DetailsCommande WHERE Qte LIKE '%$searchTerm%' OR DateCommande LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        $detailsCommandes = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $detailsCommande = new DetailsCommande($row['IdRèglement'], $row['Qte'], $row['DateCommande']);
                $detailsCommande->setIdDetailsCommande($row['IdDetailsCommande']);
                $detailsCommandes[] = $detailsCommande;
            }
        }

        return $detailsCommandes;
    }
}
?>
