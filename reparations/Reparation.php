<?php
include_once '../config.php';

class Reparation {
    private $idReparation;
    private $idAgentReparation;
    private $description;
    private $dateDebut;
    private $dateFinP;
    private $dateFinR;
    private $coutEstime;
    private $etatR;

    public function __construct($idAgentReparation, $description, $dateDebut, $dateFinP, $dateFinR, $coutEstime, $etatR) {
        $this->idAgentReparation = $idAgentReparation;
        $this->description = $description;
        $this->dateDebut = $dateDebut;
        $this->dateFinP = $dateFinP;
        $this->dateFinR = $dateFinR;
        $this->coutEstime = $coutEstime;
        $this->etatR = $etatR;
    }

    // Getters et setters pour les attributs

    public function getIdReparation() {
        return $this->idReparation;
    }

    public function setIdReparation($idReparation) {
        $this->idReparation = $idReparation;
    }

    public function getIdAgentReparation() {
        return $this->idAgentReparation;
    }

    public function setIdAgentReparation($idAgentReparation) {
        $this->idAgentReparation = $idAgentReparation;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDateDebut() {
        return $this->dateDebut;
    }

    public function setDateDebut($dateDebut) {
        $this->dateDebut = $dateDebut;
    }

    public function getDateFinP() {
        return $this->dateFinP;
    }

    public function setDateFinP($dateFinP) {
        $this->dateFinP = $dateFinP;
    }

    public function getDateFinR() {
        return $this->dateFinR;
    }

    public function setDateFinR($dateFinR) {
        $this->dateFinR = $dateFinR;
    }

    public function getCoutEstime() {
        return $this->coutEstime;
    }

    public function setCoutEstime($coutEstime) {
        $this->coutEstime = $coutEstime;
    }

    public function getEtatR() {
        return $this->etatR;
    }

    public function setEtatR($etatR) {
        $this->etatR = $etatR;
    }

    public function save() {
        global $conn;

        $idAgentReparation = $this->idAgentReparation;
        $description = $this->description;
        $dateDebut = $this->dateDebut;
        $dateFinP = $this->dateFinP;
        $dateFinR = $this->dateFinR;
        $coutEstime = $this->coutEstime;
        $etatR = $this->etatR;

        $sql = "INSERT INTO Réparation (IdAgentRéparation, Description, DateDebut, DateFinP, DateFinR, CoutEstime, EtatR) 
                VALUES ('$idAgentReparation', '$description', '$dateDebut', '$dateFinP', '$dateFinR', '$coutEstime', '$etatR')";
        return $conn->query($sql);
    }

    public function update() {
        global $conn;

        $idReparation = $this->idReparation;
        $idAgentReparation = $this->idAgentReparation;
        $description = $this->description;
        $dateDebut = $this->dateDebut;
        $dateFinP = $this->dateFinP;
        $dateFinR = $this->dateFinR;
        $coutEstime = $this->coutEstime;
        $etatR = $this->etatR;

        $sql = "UPDATE Réparation SET IdAgentRéparation = '$idAgentReparation', Description = '$description', 
                DateDebut = '$dateDebut', DateFinP = '$dateFinP', DateFinR = '$dateFinR', CoutEstime = '$coutEstime', 
                EtatR = '$etatR' WHERE IdRéparation = '$idReparation'";
        return $conn->query($sql);
    }

    public function delete() {
        global $conn;

        $idReparation = $this->idReparation;

        $sql = "DELETE FROM Réparation WHERE IdRéparation = '$idReparation'";
        return $conn->query($sql);
    }

    public static function getAllReparations() {
        global $conn;

        $sql = "SELECT * FROM Réparation";
        $result = $conn->query($sql);

        $reparations = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $reparation = new Reparation($row['IdAgentRéparation'], $row['Description'], $row['DateDebut'], 
                                              $row['DateFinP'], $row['DateFinR'], $row['CoutEstime'], $row['EtatR']);
                $reparation->setIdReparation($row['IdRéparation']);
                $reparations[] = $reparation;
            }
        }

        return $reparations;
    }

    public static function searchReparations($searchTerm) {
        global $conn;

        $sql = "SELECT * FROM Réparation WHERE Description LIKE '%$searchTerm%' OR CoutEstime LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        $reparations = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $reparation = new Reparation($row['IdAgentRéparation'], $row['Description'], $row['DateDebut'], 
                                              $row['DateFinP'], $row['DateFinR'], $row['CoutEstime'], $row['EtatR']);
                $reparation->setIdReparation($row['IdRéparation']);
                $reparations[] = $reparation;
            }
        }

        return $reparations;
    }
}
?>
