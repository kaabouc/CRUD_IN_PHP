<?php
include_once '../config.php';

class DetailsCommande {
    private $idReparation;
    private $idPiece;
    private $qte;

    public function __construct($idReparation, $idPiece, $qte) {
        $this->idReparation = $idReparation;
        $this->idPiece = $idPiece;
        $this->qte = $qte;
    }

    public function getIdReparation() {
        return $this->idReparation;
    }

    public function getIdPiece() {
        return $this->idPiece;
    }

    public function getQte() {
        return $this->qte;
    }

    public function save() {
        global $conn;

        $idReparation = $this->idReparation;
        $idPiece = $this->idPiece;
        $qte = $this->qte;

        // Vérification et mise à jour de la quantité en stock
        $sqlCheckStock = "SELECT QteStock FROM PieceRechange WHERE IdPiece = '$idPiece'";
        $resultCheckStock = $conn->query($sqlCheckStock);

        if ($resultCheckStock->num_rows > 0) {
            $row = $resultCheckStock->fetch_assoc();
            if ($row['QteStock'] >= $qte) {
                $newQteStock = $row['QteStock'] - $qte;
                $sqlUpdateStock = "UPDATE PieceRechange SET QteStock = '$newQteStock' WHERE IdPiece = '$idPiece'";
                $conn->query($sqlUpdateStock);

                $sql = "INSERT INTO DetailsCommande (IdReparation, IdPiece, Qte) VALUES ('$idReparation', '$idPiece', '$qte')";
                return $conn->query($sql);
            } else {
                throw new Exception("Quantité en stock insuffisante pour la pièce $idPiece.");
            }
        } else {
            throw new Exception("Pièce $idPiece non trouvée.");
        }
    }

    public function update($newIdReparation, $newIdPiece, $newQte) {
        global $conn;

        // Récupération de l'ancienne quantité
        $sqlOldQte = "SELECT Qte FROM DetailsCommande WHERE IdReparation = '$this->idReparation' AND IdPiece = '$this->idPiece'";
        $resultOldQte = $conn->query($sqlOldQte);

        if ($resultOldQte->num_rows > 0) {
            $rowOldQte = $resultOldQte->fetch_assoc();
            $oldQte = $rowOldQte['Qte'];

            // Mise à jour de la quantité en stock
            $sqlCheckStock = "SELECT QteStock FROM PieceRechange WHERE IdPiece = '$newIdPiece'";
            $resultCheckStock = $conn->query($sqlCheckStock);

            if ($resultCheckStock->num_rows > 0) {
                $row = $resultCheckStock->fetch_assoc();
                $newQteStock = $row['QteStock'] + $oldQte - $newQte;

                if ($newQteStock >= 0) {
                    $sqlUpdateStock = "UPDATE PieceRechange SET QteStock = '$newQteStock' WHERE IdPiece = '$newIdPiece'";
                    $conn->query($sqlUpdateStock);

                    $sql = "UPDATE DetailsCommande SET IdReparation = '$newIdReparation', IdPiece = '$newIdPiece', Qte = '$newQte' WHERE IdReparation = '$this->idReparation' AND IdPiece = '$this->idPiece'";
                    return $conn->query($sql);
                } else {
                    throw new Exception("Quantité en stock insuffisante pour la pièce $newIdPiece.");
                }
            } else {
                throw new Exception("Pièce $newIdPiece non trouvée.");
            }
        } else {
            throw new Exception("Détail de commande non trouvé.");
        }
    }

    public function delete() {
        global $conn;

        $idReparation = $this->idReparation;
        $idPiece = $this->idPiece;

        // Récupération de la quantité pour mise à jour du stock
        $sqlOldQte = "SELECT Qte FROM DetailsCommande WHERE IdReparation = '$idReparation' AND IdPiece = '$idPiece'";
        $resultOldQte = $conn->query($sqlOldQte);

        if ($resultOldQte->num_rows > 0) {
            $rowOldQte = $resultOldQte->fetch_assoc();
            $oldQte = $rowOldQte['Qte'];

            $sqlUpdateStock = "UPDATE PieceRechange SET QteStock = QteStock + '$oldQte' WHERE IdPiece = '$idPiece'";
            $conn->query($sqlUpdateStock);

            $sql = "DELETE FROM DetailsCommande WHERE IdReparation = '$idReparation' AND IdPiece = '$idPiece'";
            return $conn->query($sql);
        } else {
            throw new Exception("Détail de commande non trouvé.");
        }
    }

    public static function getAllDetails() {
        global $conn;

        $sql = "SELECT * FROM DetailsCommande";
        $result = $conn->query($sql);

        $details = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $detail = new DetailsCommande($row['IdReparation'], $row['IdPiece'], $row['Qte']);
                $details[] = $detail;
            }
        }

        return $details;
    }

    public static function getDetailById($idReparation, $idPiece) {
        global $conn;

        $sql = "SELECT * FROM DetailsCommande WHERE IdReparation = '$idReparation' AND IdPiece = '$idPiece'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $detail = new DetailsCommande($row['IdReparation'], $row['IdPiece'], $row['Qte']);
            return $detail;
        } else {
            return null;
        }
    }

    public static function searchDetails($searchTerm) {
        global $conn;

        $sql = "SELECT * FROM DetailsCommande WHERE IdReparation LIKE '%$searchTerm%' OR IdPiece LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        $details = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $detail = new DetailsCommande($row['IdReparation'], $row['IdPiece'], $row['Qte']);
                $details[] = $detail;
            }
        }

        return $details;
    }
}
?>
