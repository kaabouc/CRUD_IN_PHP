<?php
include_once 'config.php';
include_once 'User.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = User::getUserById($id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user->setName($name);
    $user->setEmail($email);
    $user->setPassword($password);
    $user->update();
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
</head>
<body>
    <h2>Modifier un Utilisateur</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
        Nom: <input type="text" name="name" value="<?php echo $user->getName(); ?>"><br><br>
        Email: <input type="text" name="email" value="<?php echo $user->getEmail(); ?>"><br><br>
        Mot de passe: <input type="password" name="password" value="<?php echo $user->getPassword(); ?>"><br><br>
        <input type="submit" value="Mettre à Jour">
    </form>
</body>
</html>
