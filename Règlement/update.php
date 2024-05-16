<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un règlement</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Modifier un règlement</h2>
        
        <?php
        include_once '../config.php';
        include_once 'Reglement.php';

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
            $idReglement = $_GET['id'];
            $reglement = Reglement::getReglementById($idReglement);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idReglement'])) {
            $idReglement = $_POST['idReglement'];
            $etat = $_POST['etat'];
            $dateReglement = $_POST['dateReglement'];

            $reglement = new Reglement($etat, $dateReglement);
            $reglement->setIdReglement($idReglement);

            if ($reglement->update()) {
                echo "<div class='alert alert-success mt-3'>Règlement modifié avec succès!</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Erreur lors de la modification du règlement.</div>";
            }
        }
        ?>

        <form method="post" action="update.php">
            <input type="hidden" name="idReglement" value="<?php echo $reglement->getIdReglement(); ?>">
            <div class="form-group">
                <label for="etat">État:</label>
                <input type="text" class="form-control" id="etat" name="etat" value="<?php echo $reglement->getEtat(); ?>" required>
            </div>
            <div class="form-group">
                <label for="dateReglement">Date de règlement:</label>
                <input type="date" class="form-control" id="dateReglement" name="dateReglement" value="<?php echo $reglement->getDateReglement(); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</body>
</html>
