<?php
include_once 'config.php';

class PièceRechange {
    private $idPièce;
    private $libPièce;
    private $qteStock;

    public function __construct($libPièce, $qteStock) {
        $this->libPièce = $libPièce;
        $this->qteStock = $qteStock;
    }

    public function getIdPièce() {
        return $this->idPièce;
    }

    public function setIdPièce($idPièce) {
        $this->idPièce = $idPièce;
    }

    public function getLibPièce() {
        return $this->libPièce;
    }

    public function getQteStock() {
        return $this->qteStock;
    }

    public function save() {
        global $conn;

        $libPièce = $this->libPièce;
        $qteStock = $this->qteStock;

        $sql = "INSERT INTO PièceRechange (LibPièce, QteStock) VALUES ('$libPièce', '$qteStock')";
        return $conn->query($sql);
    }

    public function update() {
        global $conn;

        $idPièce = $this->idPièce;
        $libPièce = $this->libPièce;
        $qteStock = $this->qteStock;

        $sql = "UPDATE PièceRechange SET LibPièce = '$libPièce', QteStock = '$qteStock' WHERE IdPièce = '$idPièce'";
        return $conn->query($sql);
    }

    public function delete() {
        global $conn;

        $idPièce = $this->idPièce;

        $sql = "DELETE FROM PièceRechange WHERE IdPièce = '$idPièce'";
        return $conn->query($sql);
    }

    public static function getAllPiècesRechange() {
        global $conn;

        $sql = "SELECT * FROM PièceRechange";
        $result = $conn->query($sql);

        $piècesRechange = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $pièceRechange = new PièceRechange($row['LibPièce'], $row['QteStock']);
                $pièceRechange->setIdPièce($row['IdPièce']);
                $piècesRechange[] = $pièceRechange;
            }
        }

        return $piècesRechange;
    }

    public static function getPièceRechangeById($idPièce) {
        global $conn;

        $sql = "SELECT * FROM PièceRechange WHERE IdPièce = '$idPièce'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $pièceRechange = new PièceRechange($row['LibPièce'], $row['QteStock']);
            $pièceRechange->setIdPièce($row['IdPièce']);
            return $pièceRechange;
        } else {
            return null;
        }
    }

    public static function searchPiècesRechange($searchTerm) {
        global $conn;

        $sql = "SELECT * FROM PièceRechange WHERE LibPièce LIKE '%$searchTerm%' OR QteStock LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        $piècesRechange = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $pièceRechange = new PièceRechange($row['LibPièce'], $row['QteStock']);
                $pièceRechange->setIdPièce($row['IdPièce']);
                $piècesRechange[] = $pièceRechange;
            }
        }

        return $piècesRechange;
    }
}
?>
