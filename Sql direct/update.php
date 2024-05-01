<?php 
include "config.php";

if(isset($_POST['update'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];

    $sql = "UPDATE `users` SET `firstname`='$firstname', `lastname`='$lastname', `email`='$email', `password`='$password', `gender`='$gender' WHERE `id`='$id'";
    $result = $conn->query($sql);
    if($result == true ){
        echo "Enregistrement mis à jour avec succès."; 
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
   
}

if(isset($_GET['id'])){
    $user_id = $_GET['id']; // id = 10 
    $sql = "SELECT * FROM `users` WHERE `id`='$user_id'"; // where id = 10 ;
    $result = $conn->query($sql); // executer 
    // return 
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $password = $row['password'];
            $gender = $row['gender']; // Male
            $id = $row['id'];
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Mise à Jour Utilisateur</title>
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
        <h2>Formulaire de Mise à Jour Utilisateur</h2>
        <form method="post">
            <fieldset>
                <legend>Informations Personnelles</legend>
                <input type="hidden" name="id" value="<?php echo $id ; ?>">
                <div class="form-group">
                    <label for="firstname">Prenom :</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $firstname ; ?>">
                </div>
                <div class="form-group">
                    <label for="lastname">Nom :</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $lastname ; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Mot de Passe :</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $password ; ?>">
                </div>
                <div class="form-group">
                    <label>Genre :</label><br>
                    
                    <label class="radio-inline"><input type="radio" name="gender" value="Male" <?php if(strtolower($gender) == 'male'){ echo "checked";} ?>> Homme</label>
                    <label class="radio-inline"><input type="radio" name="gender" value="Female" <?php if(strtolower($gender) == 'female'){ echo "checked";} ?>> Femme</label>
                </div>
                <button type="submit" class="btn btn-primary" name="update">Mettre à Jour</button>
            </fieldset>
        </form>
    </div>
</body>
</html>
<?php
    } else { 
        header('Location: view.php');
    } 
}
?>
