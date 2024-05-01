<?php
include_once 'config.php';
include_once 'User.php';

$users = User::getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
</head>
<body>
    <h2>Liste des Utilisateurs</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user) { ?>
        <tr>
            <td><?php echo $user->getId(); ?></td>
            <td><?php echo $user->getName(); ?></td>
            <td><?php echo $user->getEmail(); ?></td>
            <td>
                <a href="update.php?id=<?php echo $user->getId(); ?>">Modifier</a> |
                <a href="delete.php?id=<?php echo $user->getId(); ?>">Supprimer</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <a href="create.php">Ajouter un Utilisateur</a>
</body>
</html>
