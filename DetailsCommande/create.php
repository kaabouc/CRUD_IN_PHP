<?php
include_once '../config.php';
include_once 'DetailsCommande.php';
include_once '../reparations/Reparation.php';
include_once '../piecerechange/PieceRechange.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idReparation = $_POST['idReparation'];
    $idPiece = $_POST['idPiece'];
    $qte = $_POST['qte'];

    try {
        $detail = new DetailsCommande($idReparation, $idPiece, $qte);
        $detail->save();
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Récupérer toutes les réparations et pièces de rechange
$reparations = Reparation::getAllReparations();
$pieces = PieceRechange::getAllPiecesRechange();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Détail de Commande</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Créer un Détail de Commande</h2>
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="idReparation">ID Réparation:</label>
                <select class="form-control" id="idReparation" name="idReparation" required>
                    <?php foreach ($reparations as $reparation) {
                        echo "<option value='". $reparation->getIdReparation(). "'>" . $reparation->getIdReparation() . "</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="idPiece">ID Pièce:</label>
                <select class="form-control" id="idPiece" name="idPiece" required>
                    <?php foreach ($pieces as $piece) {
                        echo "<option value='" . $piece->getIdPiece() . "'>" . $piece->getLibPiece() . "</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="qte">Quantité:</label>
                <input type="number" class="form-control" id="qte" name="qte" required>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
</body>
</html>
