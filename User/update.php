<?php
include_once 'config.php';
include_once 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $motDePasse = $_POST['motDePasse'];

    $user = new User($nom, $prenom, $email, $tel, $motDePasse);
    $user->setIdUtilisateur($id);
    $user->update();
    header("Location: index.php");
    exit();
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = User::getUserById($id);
    if(!$user) {
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
    <title>Modifier un Utilisateur</title>
    <!-- Intégration de Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Modifier un Utilisateur</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="id" value="<?php echo $user->getIdUtilisateur(); ?>">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $user->getNomUtilisateur(); ?>" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $user->getPrenomUtilisateur(); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user->getEmail(); ?>" required>
            </div>
            <div class="form-group">
                <label for="tel">Téléphone:</label>
                <input type="tel" class="form-control" id="tel" name="tel" value="<?php echo $user->getTel(); ?>">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="motDePasse" value="<?php echo $user->getMotDePasse(); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</body>
</html>
