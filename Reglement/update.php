<?php
include_once '../config.php';
include_once 'Reglement.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idReglement = $_POST['id'];
    $idReparation = $_POST['idReparation'];
    $montant = $_POST['montant'];
    $dateReglement = $_POST['dateReglement'];

    $reglement = new Reglement($idReparation, $montant, $dateReglement);
    $reglement->setIdReglement($idReglement);
    $reglement->update();
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $idReglement = $_GET['id'];
    $reglement = Reglement::getReglementById($idReglement);
    if (!$reglement) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Règlement</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Modifier un Règlement</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="id" value="<?php echo $reglement->getIdReglement(); ?>">
            <div class="form-group">
                <label for="idReparation">ID Réparation:</label>
                <input type="text" class="form-control" id="idReparation" name="idReparation" value="<?php echo $reglement->getIdReparation(); ?>" required>
            </div>
            <div class="form-group">
                <label for="montant">Montant:</label>
                <input type="number" class="form-control" id="montant" name="montant" value="<?php echo $reglement->getMontant(); ?>" required>
            </div>
            <div class="form-group">
                <label for="dateReglement">Date de Règlement:</label>
                <input type="date" class="form-control" id="dateReglement" name="dateReglement" value="<?php echo $reglement->getDateReglement(); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</body>
</html>
