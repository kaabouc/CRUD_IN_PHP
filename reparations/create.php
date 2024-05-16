<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une réparation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Ajouter une réparation</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="idAgentReparation">ID Agent Réparation:</label>
                <input type="text" class="form-control" id="idAgentReparation" name="idAgentReparation" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="dateDebut">Date Début:</label>
                <input type="date" class="form-control" id="dateDebut" name="dateDebut" required>
            </div>
            <div class="form-group">
                <label for="dateFinP">Date Fin Prévue:</label>
                <input type="date" class="form-control" id="dateFinP" name="dateFinP" required>
            </div>
            <div class="form-group">
                <label for="dateFinR">Date Fin Réelle:</label>
                <input type="date" class="form-control" id="dateFinR" name="dateFinR">
            </div>
            <div class="form-group">
                <label for="coutEstime">Coût Estimé:</label>
                <input type="number" class="form-control" id="coutEstime" name="coutEstime" required>
            </div>
            <div class="form-group">
                <label for="etatR">État:</label>
                <input type="text" class="form-control" id="etatR" name="etatR" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include_once '../config.php';
            include_once 'Reparation.php';

            $idAgentReparation = $_POST['idAgentReparation'];
            $description = $_POST['description'];
            $dateDebut = $_POST['dateDebut'];
            $dateFinP = $_POST['dateFinP'];
            $dateFinR = $_POST['dateFinR'];
            $coutEstime = $_POST['coutEstime'];
            $etatR = $_POST['etatR'];

            $reparation = new Reparation($idAgentReparation, $description, $dateDebut, $dateFinP, $dateFinR, $coutEstime, $etatR);
            if ($reparation->save()) {
                echo "<div class='alert alert-success mt-3'>Réparation ajoutée avec succès!</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Erreur lors de l'ajout de la réparation.</div>";
            }
        }
        ?>
    </div>
</body>
</html>
