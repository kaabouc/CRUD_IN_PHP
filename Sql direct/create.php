<?php 
include "config.php";

if(isset($_POST['submit'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $sql = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `password`, `gender`) VALUES ('$firstname','$lastname','$email','$password','$gender')";
    
    $result = $conn->query($sql);

    if($result === true){
        echo "Créé avec succès.";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Utilisateur</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        /* Ajoutez votre propre style ici */
        .container {
            margin-top: 50px;
        }
        legend {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Créer un Utilisateur</h2>
        <form method="post">
            <fieldset>
                <legend>Informations Personnelles</legend>
                <div class="form-group">
                    <label for="firstname">Prénom :</label>
                    <input type="text" class="form-control" id="firstname" name="firstname">
                </div>
                <div class="form-group">
                    <label for="lastname">Nom :</label>
                    <input type="text" class="form-control" id="lastname" name="lastname">
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" id="email" name="test">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label>Genre :</label><br>
                    <label class="radio-inline"><input type="radio" name="gender" value="male"> Homme</label>
                    <label class="radio-inline"><input type="radio" name="gender" value="female"> Femme</label>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Créer</button>
            </fieldset>
        </form>
        <a href="view.php" class="btn btn-default">Liste des Utilisateurs</a>
    </div>
</body>
</html>
