<?php
include_once '../config.php';

class PieceRechange {
    private $idPiece;
    private $libPiece;
    private $qteStock;
    private $seuilMin;
    private $seuilMax;

    public function __construct($libPiece, $qteStock, $seuilMin, $seuilMax) {
        $this->libPiece = $libPiece;
        $this->qteStock = $qteStock;
        $this->seuilMin = $seuilMin;
        $this->seuilMax = $seuilMax;
    }

    public function getIdPiece() {
        return $this->idPiece;
    }
    public function setIdPiece($idPiece) {
       $this->idPiece = $idPiece;
    }

    public function getLibPiece() {
        return $this->libPiece;
    }

    public function setLibPiece($libPiece) {
        $this->libPiece = $libPiece;
    }

    public function getQteStock() {
        return $this->qteStock;
    }

    public function setQteStock($qteStock) {
        $this->qteStock = $qteStock;
    }

    public function getSeuilMin() {
        return $this->seuilMin;
    }

    public function setSeuilMin($seuilMin) {
        $this->seuilMin = $seuilMin;
    }

    public function getSeuilMax() {
        return $this->seuilMax;
    }

    public function setSeuilMax($seuilMax) {
        $this->seuilMax = $seuilMax;
    }

    public function save() {
        global $conn;

        $libPiece = $this->libPiece;
        $qteStock = $this->qteStock;
        $seuilMin = $this->seuilMin;
        $seuilMax = $this->seuilMax;

        $sql = "INSERT INTO PieceRechange (LibPiece, QteStock, SeuilMin, SeuilMax) VALUES ('$libPiece', $qteStock, $seuilMin, $seuilMax)";
        return $conn->query($sql);
    }

    public static function getAllPiecesRechange() {
        global $conn;

        $sql = "SELECT * FROM PieceRechange";
        $result = $conn->query($sql);

        $pieces = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $piece = new PieceRechange($row['LibPiece'], $row['QteStock'], $row['SeuilMin'], $row['SeuilMax']);
                $piece->idPiece = $row['IdPiece'];
                $pieces[] = $piece;
            }
        }

        return $pieces;
    }

    public static function getPieceById($idPiece) {
        global $conn;

        $sql = "SELECT * FROM PieceRechange WHERE IdPiece = '$idPiece'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $piece = new PieceRechange($row['LibPiece'], $row['QteStock'], $row['SeuilMin'], $row['SeuilMax']);
            $piece->idPiece = $row['IdPiece'];
            return $piece;
        } else {
            return null;
        }
    }

    public function update() {
        global $conn;

        $idPiece = $this->idPiece;
        $libPiece = $this->libPiece;
        $qteStock = $this->qteStock;
        $seuilMin = $this->seuilMin;
        $seuilMax = $this->seuilMax;

        $sql = "UPDATE PieceRechange SET LibPiece = '$libPiece', QteStock = $qteStock, SeuilMin = $seuilMin, SeuilMax = $seuilMax WHERE IdPiece = '$idPiece'";
        return $conn->query($sql);
    }

    public function delete() {
        global $conn;

        $idPiece = $this->idPiece;

        $sql = "DELETE FROM PieceRechange WHERE IdPiece = '$idPiece'";
        return $conn->query($sql);
    }

    public static function searchPieces($searchTerm) {
        global $conn;

        $sql = "SELECT * FROM PieceRechange WHERE LibPiece LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        $pieces = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $piece = new PieceRechange($row['LibPiece'], $row['QteStock'], $row['SeuilMin'], $row['SeuilMax']);
                $piece->setIdPiece($row['IdPiece']);
                $pieces[] = $piece;
            }
        }

        return $pieces;
    }
}
?>
