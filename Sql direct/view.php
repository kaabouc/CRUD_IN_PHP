<?php 
include "config.php"; // require
$sql = "SELECT * FROM users";
$result = $conn->query($sql); // query execute requete  sql

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM `users` WHERE `id`='$id'";
    $result = $conn->query($sql);
    if($result === true){
        echo "Suppression réussie.";
    } else {
        echo "Erreur lors de la suppression.";
    }
   header('location:view.php');
}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Vue des Utilisateurs</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<style>
    /* Ajoutez votre propre style ici */
    .container {
        margin-top: 50px;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Liste des Utilisateurs</h2>
    <a href="create.php" class="btn btn-primary">Créer un Nouvel Utilisateur</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Genre</th>
                <th colspan="2">Action</th>
               
                
            </tr>
        </thead>
        <tbody>
            <?php 

            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['lastname']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td>
                        <a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>">Modifier</a>
                           

                            <!-- <form method="post"><a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Supprimer</a></form> -->
                        </td>
                        <td>
                           <form method="post" action="view.php?id=<?php echo $row['id']; ?>">
                               <button type="submit" class="btn btn-danger" >Supprimer</button>
                           </form>
                        </td>
                    </tr>
                <?php } 
            } else { ?>
                <tr>
                    <td colspan="6">Aucun utilisateur trouvé.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
</div>
</body>
</html>