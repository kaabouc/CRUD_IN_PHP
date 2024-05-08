<?php
include_once '../config.php';
include_once 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $motDePasse = $_POST['motDePasse'];

    $type = $_POST['type']; // Récupération du type d'utilisateur sélectionné
    $user = new User($nom, $prenom, $email, $tel, $motDePasse);
    $user->save($type);

    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Utilisateur</title>
    <!-- Intégration de Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Créer un Utilisateur</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group"> 
                <label for="prenom">Prénom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="tel">Téléphone:</label>
                <input type="tel" class="form-control" id="tel" name="tel">
            </div>
            <div class="form-group">
        <label for="type">Type d'utilisateur:</label>
        <select class="form-control" id="type" name="type" required>
            <option value="client">Client</option>
            <option value="agent">Agent de Réparation</option>
            <option value="admin">Administrateur</option>
        </select>
    </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="motDePasse" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
</body>
</html>
