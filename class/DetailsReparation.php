<?php
include_once 'config.php';

class DetailsReparation {
    private $idDetailsReparation;
    private $idRéparation;
    private $idPièce;
    private $qte;

    public function __construct($idRéparation, $idPièce, $qte) {
        $this->idRéparation = $idRéparation;
        $this->idPièce = $idPièce;
        $this->qte = $qte;
    }

    public function getIdDetailsReparation() {
        return $this->idDetailsReparation;
    }

    public function setIdDetailsReparation($idDetailsReparation) {
        $this->idDetailsReparation = $idDetailsReparation;
    }

    public function getIdRéparation() {
        return $this->idRéparation;
    }

    public function getIdPièce() {
        return $this->idPièce;
    }

    public function getQte() {
        return $this->qte;
    }

    public function save() {
        global $conn;

        $idRéparation = $this->idRéparation;
        $idPièce = $this->idPièce;
        $qte = $this->qte;

        $sql = "INSERT INTO DetailsReparation (IdRéparation, IdPièce, Qte) VALUES ('$idRéparation', '$idPièce', '$qte')";
        return $conn->query($sql);
    }

    public function update() {
        global $conn;

        $idDetailsReparation = $this->idDetailsReparation;
        $idRéparation = $this->idRéparation;
        $idPièce = $this->idPièce;
        $qte = $this->qte;

        $sql = "UPDATE DetailsReparation SET IdRéparation = '$idRéparation', IdPièce = '$idPièce', Qte = '$qte' WHERE IdDetailsReparation = '$idDetailsReparation'";
        return $conn->query($sql);
    }

    public function delete() {
        global $conn;

        $idDetailsReparation = $this->idDetailsReparation;

        $sql = "DELETE FROM DetailsReparation WHERE IdDetailsReparation = '$idDetailsReparation'";
        return $conn->query($sql);
    }

    public static function getAllDetailsReparation() {
        global $conn;

        $sql = "SELECT * FROM DetailsReparation";
        $result = $conn->query($sql);

        $detailsReparations = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $detailsReparation = new DetailsReparation($row['IdRéparation'], $row['IdPièce'], $row['Qte']);
                $detailsReparation->setIdDetailsReparation($row['IdDetailsReparation']);
                $detailsReparations[] = $detailsReparation;
            }
        }

        return $detailsReparations;
    }

    public static function getDetailsReparationById($idDetailsReparation) {
        global $conn;

        $sql = "SELECT * FROM DetailsReparation WHERE IdDetailsReparation = '$idDetailsReparation'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $detailsReparation = new DetailsReparation($row['IdRéparation'], $row['IdPièce'], $row['Qte']);
            $detailsReparation->setIdDetailsReparation($row['IdDetailsReparation']);
            return $detailsReparation;
        } else {
            return null;
        }
    }

    public static function searchDetailsReparation($searchTerm) {
        global $conn;

        $sql = "SELECT * FROM DetailsReparation WHERE Qte LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        $detailsReparations = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $detailsReparation = new DetailsReparation($row['IdRéparation'], $row['IdPièce'], $row['Qte']);
                $detailsReparation->setIdDetailsReparation($row['IdDetailsReparation']);
                $detailsReparations[] = $detailsReparation;
            }
        }

        return $detailsReparations;
    }
}
?>
