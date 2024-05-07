<?php
include_once 'config.php';

class Réparation {
    private $idRéparation;
    private $idAppareil;
    private $idAgentRéparation;
    private $description;
    private $dateDebut;
    private $dateFinP;
    private $dateFinR;
    private $coutEstime;
    private $etatR;

    public function __construct($idAppareil, $idAgentRéparation, $description, $dateDebut, $dateFinP, $dateFinR, $coutEstime, $etatR) {
        $this->idAppareil = $idAppareil;
        $this->idAgentRéparation = $idAgentRéparation;
        $this->description = $description;
        $this->dateDebut = $dateDebut;
        $this->dateFinP = $dateFinP;
        $this->dateFinR = $dateFinR;
        $this->coutEstime = $coutEstime;
        $this->etatR = $etatR;
    }

    public function getIdRéparation() {
        return $this->idRéparation;
    }

    public function setIdRéparation($idRéparation) {
        $this->idRéparation = $idRéparation;
    }

    public function getIdAppareil() {
        return $this->idAppareil;
    }

    public function getIdAgentRéparation() {
        return $this->idAgentRéparation;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDateDebut() {
        return $this->dateDebut;
    }

    public function getDateFinP() {
        return $this->dateFinP;
    }

    public function getDateFinR() {
        return $this->dateFinR;
    }

    public function getCoutEstime() {
        return $this->coutEstime;
    }

    public function getEtatR() {
        return $this->etatR;
    }

    public function save() {
        global $conn;

        $idAppareil = $this->idAppareil;
        $idAgentRéparation = $this->idAgentRéparation;
        $description = $this->description;
        $dateDebut = $this->dateDebut;
        $dateFinP = $this->dateFinP;
        $dateFinR = $this->dateFinR;
        $coutEstime = $this->coutEstime;
        $etatR = $this->etatR;

        $sql = "INSERT INTO Réparation (IdAppareil, IdAgentRéparation, Description, DateDebut, DateFinP, DateFinR, CoutEstime, EtatR) 
                VALUES ('$idAppareil', '$idAgentRéparation', '$description', '$dateDebut', '$dateFinP', '$dateFinR', '$coutEstime', '$etatR')";
        return $conn->query($sql);
    }

    public function update() {
        global $conn;

        $idRéparation = $this->idRéparation;
        $idAppareil = $this->idAppareil;
        $idAgentRéparation = $this->idAgentRéparation;
        $description = $this->description;
        $dateDebut = $this->dateDebut;
        $dateFinP = $this->dateFinP;
        $dateFinR = $this->dateFinR;
        $coutEstime = $this->coutEstime;
        $etatR = $this->etatR;

        $sql = "UPDATE Réparation SET IdAppareil = '$idAppareil', IdAgentRéparation = '$idAgentRéparation', Description = '$description', 
                DateDebut = '$dateDebut', DateFinP = '$dateFinP', DateFinR = '$dateFinR', CoutEstime = '$coutEstime', EtatR = '$etatR' 
                WHERE IdRéparation = '$idRéparation'";
        return $conn->query($sql);
    }

    public function delete() {
        global $conn;

        $idRéparation = $this->idRéparation;

        $sql = "DELETE FROM Réparation WHERE IdRéparation = '$idRéparation'";
        return $conn->query($sql);
    }

    public static function getAllRéparations() {
        global $conn;

        $sql = "SELECT * FROM Réparation";
        $result = $conn->query($sql);

        $réparations = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $réparation = new Réparation($row['IdAppareil'], $row['IdAgentRéparation'], $row['Description'], $row['DateDebut'], 
                                              $row['DateFinP'], $row['DateFinR'], $row['CoutEstime'], $row['EtatR']);
                $réparation->setIdRéparation($row['IdRéparation']);
                $réparations[] = $réparation;
            }
        }

        return $réparations;
    }

    public static function getRéparationById($idRéparation) {
        global $conn;

        $sql = "SELECT * FROM Réparation WHERE IdRéparation = '$idRéparation'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $réparation = new Réparation($row['IdAppareil'], $row['IdAgentRéparation'], $row['Description'], $row['DateDebut'], 
                                         $row['DateFinP'], $row['DateFinR'], $row['CoutEstime'], $row['EtatR']);
            $réparation->setIdRéparation($row['IdRéparation']);
            return $réparation;
        } else {
            return null;
        }
    }

    public static function searchRéparations($searchTerm) {
        global $conn;

        $sql = "SELECT * FROM Réparation WHERE Description LIKE '%$searchTerm%' OR DateDebut LIKE '%$searchTerm%' OR DateFinP LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        $réparations = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $réparation = new Réparation($row['IdAppareil'], $row['IdAgentRéparation'], $row['Description'], $row['DateDebut'], 
                                              $row['DateFinP'], $row['DateFinR'], $row['CoutEstime'], $row['EtatR']);
                $réparation->setIdRéparation($row['IdRéparation']);
                $réparations[] = $réparation;
            }
        }

        return $réparations;
    }
}
?>
