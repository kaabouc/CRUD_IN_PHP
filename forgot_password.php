<?php
include_once 'config.php';
include_once 'User/User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    // Get user by email
    $user = User::getUserByEmail($email);
    
    if ($user) {
        // Simulate sending the password (in practice, you would reset the password or send a reset link)
        $password = $user->getMotDePasse();  // Don't actually do this in a real application for security reasons
        echo "Votre mot de passe est: $password";
    } else {
        echo "Email non trouvé.";
    }
}
?>