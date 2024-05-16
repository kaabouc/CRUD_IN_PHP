<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un détail de réparation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Ajouter un détail de réparation</h2>
        <form method="post" action="create.php">
            <div class="form-group">
                <label for="idReparation">ID Réparation:</label>
                <input type="text" class="form-control" id="idReparation" name="idReparation" required>
            </div>
            <div class="form-group">
                <label for="idReglement">ID Règlement:</label>
                <input type="text" class="form-control" id="idReglement" name="idReglement" required>
            </div>
            <div class="form-group">
                <label for="idAppareil">ID Appareil:</label>
                <input type="text" class="form-control" id="idAppareil" name="idAppareil" required>
            </div>
            <div class="form-group">
                <label for="etatSousReparation">État Sous Réparation:</label>
                <input type="text" class="form-control" id="etatSousReparation" name="etatSousReparation" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="cout">Coût:</label>
                <input type="text" class="form-control" id="cout" name="cout" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include_once '../config.php';
            include_once 'DetailsReparation.php';

            $idReparation = $_POST['idReparation'];
            $idReglement = $_POST['idReglement'];
            $idAppareil = $_POST['idAppareil'];
            $etatSousReparation = $_POST['etatSousReparation'];
            $description = $_POST['description'];
            $cout = $_POST['cout'];

            $detailsReparation = new DetailsReparation($idReparation, $idReglement, $idAppareil, $etatSousReparation, $description, $cout);
            if ($detailsReparation->save()) {
                echo "<div class='alert alert-success mt-3'>Détail de réparation ajouté avec succès!</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Erreur lors de l'ajout du détail de réparation.</div>";
            }
        }
        ?>
    </div>
</body>
</html>
