<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un règlement</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Ajouter un règlement</h2>
        <form method="post" action="create.php">
            <div class="form-group">
                <label for="etat">État:</label>
                <input type="text" class="form-control" id="etat" name="etat" required>
            </div>
            <div class="form-group">
                <label for="dateReglement">Date de règlement:</label>
                <input type="date" class="form-control" id="dateReglement" name="dateReglement" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include_once '../config.php';
            include_once 'Reglement.php';

            $etat = $_POST['etat'];
            $dateReglement = $_POST['dateReglement'];

            $reglement = new Reglement($etat, $dateReglement);
            if ($reglement->save()) {
                echo "<div class='alert alert-success mt-3'>Règlement ajouté avec succès!</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Erreur lors de l'ajout du règlement.</div>";
            }
        }
        ?>
    </div>
</body>
</html>
