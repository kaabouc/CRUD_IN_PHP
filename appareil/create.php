<?php
include_once '../config.php';
include_once 'Appareil.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idClient = $_POST['idClient']; // Correction ici
    $typeAppareil = $_POST['typeAppareil'];
    $modele = $_POST['modele'];

    $appareil = new Appareil($idClient, $typeAppareil, $modele);
    $appareil->save();

    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Appareil</title>
    <!-- Intégration de Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Créer un Appareil</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="idClient">ID Client:</label>
                <input type="text" class="form-control" id="idClient" name="idClient" required value="<?php  echo $_GET['user']; ?>" readonly>
            </div>
            <div class="form-group"> 
                <label for="typeAppareil">Type d'appareil:</label>
                <input type="text" class="form-control" id="typeAppareil" name="typeAppareil" required>
            </div>
            <div class="form-group">
                <label for="modele">Modèle:</label>
                <input type="text" class="form-control" id="modele" name="modele" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
</body>
</html>
