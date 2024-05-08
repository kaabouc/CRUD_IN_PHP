<?php
include_once 'config.php';
include_once 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User($name, $email, $password);
    $user->save();
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
</head>
<body>
    <h2>Créer un Utilisateur</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Nom: <input type="text" name="name"><br><br>
        Email: <input type="text" name="email"><br><br>
        Mot de passe: <input type="password" name="password"><br><br>
        <input type="submit" value="Créer">
    </form>
</body>
</html>
