<?php
include_once 'config.php';
include_once 'User/User.php';
session_start();

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
        $_SESSION['userType'] = $type;
        
        // Redirection en fonction du type d'utilisateur
        switch ($type) {
            case 'client':
                header("Location: client_interface/appareils.php");
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
            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#forgotPasswordModal">Mot de passe oublié?</button>
        </form>
    </div>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Réinitialiser le mot de passe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="forgotPasswordForm">
                        <div class="form-group">
                            <label for="resetEmail">Email:</label>
                            <input type="email" class="form-control" id="resetEmail" name="resetEmail" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="sendResetEmail()">Envoyer</button>
                    </form>
                    <div id="resetMessage" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function sendResetEmail() {
            var email = $('#resetEmail').val();
            $.post('forgot_password.php', { email: email }, function(response) {
                $('#resetMessage').html(response);
            });
        }
    </script>
</body>
</html>
