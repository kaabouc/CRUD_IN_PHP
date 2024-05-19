<?php
include_once '../config.php';
include_once 'Reglement.php';
include_once '../reparations/Reparation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idReparation = $_POST['idReparation'];
    $montant = $_POST['montant'];
    $dateReglement = $_POST['dateReglement'];

    $reglement = new Reglement($idReparation, $montant, $dateReglement);
    $reglement->save();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Règlement</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Créer un Règlement</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="idReparation">ID Réparation:</label>
                <select class="form-control" id="idReparation" name="idReparation" required>
                    <?php
                    $reparations = Reparation::getAllReparations();
                    foreach ($reparations as $reparation) {
                        echo "<option value='" . $reparation->getIdReparation() . "'>" . $reparation->getIdReparation() . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="montant">Montant:</label>
                <input type="number" class="form-control" id="montant" name="montant" required>
            </div>
            <div class="form-group">
                <label for="dateReglement">Date de Règlement:</label>
                <input type="date" class="form-control" id="dateReglement" name="dateReglement" required>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
</body>
</html>
