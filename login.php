<?php
include_once 'config.php';
include_once 'User/User.php';
session_start();
    // if (!isset($_SESSION['idLogin'])) {
    //   header("Location: login.php");
    //   exit;
    // }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = User::login($email, $password);

    if (isset($result['error'])) {
        // Erreur de connexion
        $error = $result['error'];
    } else {
        // Connexion réussie
        $type = $result['type'];
        $id = $result['id'];
        $_SESSION['idLogin'] = $id;
        
        // Redirection en fonction du type d'utilisateur
        switch ($type) {
            case 'client':
                header("Location: client_dashboard.php?id=$id");
                break;
            case 'admin':
                header("Location: admin/pages/index.php");
                break;
            case 'agent':
                header("Location: admin/pages/index.php");
                break;
            default:
                // Type d'utilisateur non reconnu
                $error = 'Type d\'utilisateur non reconnu';
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </div>
</body>
</html>
