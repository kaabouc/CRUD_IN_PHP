<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un détail de réparation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Modifier un détail de réparation</h2>
        
        <?php
        include_once '../config.php';
        include_once 'DetailsReparation.php';

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
            $idDetailsReparation = $_GET['id'];
            $detailsReparation = DetailsReparation::getDetailsReparationById($idDetailsReparation);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idDetailsReparation'])) {
            $idDetailsReparation = $_POST['idDetailsReparation'];
            $idReparation = $_POST['idReparation'];
            $idReglement = $_POST['idReglement'];
            $idAppareil = $_POST['idAppareil'];
            $etatSousReparation = $_POST['etatSousReparation'];
            $description = $_POST['description'];
            $cout = $_POST['cout'];

            $detailsReparation = new DetailsReparation($idReparation, $idReglement, $idAppareil, $etatSousReparation, $description, $cout);
            $detailsReparation->setIdDetailsReparation($idDetailsReparation);

            if ($detailsReparation->update()) {
                echo "<div class='alert alert-success mt-3'>Détail de réparation modifié avec succès!</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Erreur lors de la modification du détail de réparation.</div>";
            }
        }
        ?>

        <form method="post" action="update.php">
            <input type="hidden" name="idDetailsReparation" value="<?php echo $detailsReparation->getIdDetailsReparation(); ?>">
            <div class="form-group">
                <label for="idReparation">ID Réparation:</label>
                <input type="text" class="form-control" id="idReparation" name="idReparation" value="<?php echo $detailsReparation->getIdReparation(); ?>" required>
            </div>
            <div class="form-group">
                <label for="idReglement">ID Règlement:</label>
                <input type="text" class="form-control" id="idReglement" name="idReglement" value="<?php echo $detailsReparation->getIdReglement(); ?>" required>
            </div>
            <div class="form-group">
                <label for="idAppareil">ID Appareil:</label>
                <input type="text" class="form-control" id="idAppareil" name="idAppareil" value="<?php echo $detailsReparation->getIdAppareil(); ?>" required>
            </div>
            <div class="form-group">
                <label for="etatSousReparation">État Sous Réparation:</label>
                <input type="text" class="form-control" id="etatSousReparation" name="etatSousReparation" value="<?php echo $detailsReparation->getEtatSousReparation(); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required><?php echo $detailsReparation->getDescription(); ?></textarea>
            </div>
            <div class="form-group">
                <label for="cout">Coût:</label>
                <input type="text" class="form-control" id="cout" name="cout" value="<?php echo $detailsReparation->getCout(); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</body>
</html>
