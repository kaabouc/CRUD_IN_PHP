<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Liste des utilisateurs</h2>
        <a href="create.php" class="btn btn-primary mb-3">Ajouter un utilisateur</a>

        <!-- Barre de recherche -->
        <form class="form-inline mb-3" method="GET">
            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Rechercher...">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once 'config.php';
                include_once 'User.php';

                // Si une recherche est effectuée, récupérer les utilisateurs correspondants
                if(isset($_GET['search'])) {
                    $searchTerm = $_GET['search'];
                    $users = User::searchUsers($searchTerm);
                } else {
                    // Sinon, récupérer tous les utilisateurs
                    $users = User::getAllUsers();
                }

                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>" . $user->getIdUtilisateur() . "</td>";
                    echo "<td>" . $user->getNomUtilisateur() . "</td>";
                    echo "<td>" . $user->getPrenomUtilisateur() . "</td>";
                    echo "<td>" . $user->getEmail() . "</td>";
                    echo "<td>" . $user->getTel() . "</td>";
                    echo "<td><a href='update.php?id=" . $user->getIdUtilisateur() . "' class='btn btn-primary'>Modifier</a>
                            <a href='delete.php?id=" . $user->getIdUtilisateur() . "' class='btn btn-danger'>Supprimer</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
