<?php
include_once 'config.php';

class Appareil {
    private $idAppareil;
    private $idClient;
    private $typeAppareil;
    private $modele;

    public function __construct($idClient, $typeAppareil, $modele) {
        $this->idClient = $idClient;
        $this->typeAppareil = $typeAppareil;
        $this->modele = $modele;
    }

    public function getIdAppareil() {
        return $this->idAppareil;
    }

    public function setIdAppareil($idAppareil) {
        $this->idAppareil = $idAppareil;
    }

    public function getIdClient() {
        return $this->idClient;
    }

    public function getTypeAppareil() {
        return $this->typeAppareil;
    }

    public function getModele() {
        return $this->modele;
    }

    public function save() {
        global $conn;

        $idClient = $this->idClient;
        $typeAppareil = $this->typeAppareil;
        $modele = $this->modele;

        $sql = "INSERT INTO Appareil (IdClient, TypeAppareil, Modèle) VALUES ('$idClient', '$typeAppareil', '$modele')";
        return $conn->query($sql);
    }

    public function update() {
        global $conn;

        $idAppareil = $this->idAppareil;
        $idClient = $this->idClient;
        $typeAppareil = $this->typeAppareil;
        $modele = $this->modele;

        $sql = "UPDATE Appareil SET IdClient = '$idClient', TypeAppareil = '$typeAppareil', Modèle = '$modele' WHERE IdAppareil = '$idAppareil'";
        return $conn->query($sql);
    }

    public function delete() {
        global $conn;

        $idAppareil = $this->idAppareil;

        $sql = "DELETE FROM Appareil WHERE IdAppareil = '$idAppareil'";
        return $conn->query($sql);
    }

    public static function getAllAppareils() {
        global $conn;

        $sql = "SELECT * FROM Appareil";
        $result = $conn->query($sql);

        $appareils = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $appareil = new Appareil($row['IdClient'], $row['TypeAppareil'], $row['Modèle']);
                $appareil->setIdAppareil($row['IdAppareil']);
                $appareils[] = $appareil;
            }
        }

        return $appareils;
    }

    public static function getAppareilById($idAppareil) {
        global $conn;

        $sql = "SELECT * FROM Appareil WHERE IdAppareil = '$idAppareil'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $appareil = new Appareil($row['IdClient'], $row['TypeAppareil'], $row['Modèle']);
            $appareil->setIdAppareil($row['IdAppareil']);
            return $appareil;
        } else {
            return null;
        }
    }

    public static function searchAppareils($searchTerm) {
        global $conn;

        $sql = "SELECT * FROM Appareil WHERE TypeAppareil LIKE '%$searchTerm%' OR Modèle LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        $appareils = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $appareil = new Appareil($row['IdClient'], $row['TypeAppareil'], $row['Modèle']);
                $appareil->setIdAppareil($row['IdAppareil']);
                $appareils[] = $appareil;
            }
        }

        return $appareils;
    }
}
?>
