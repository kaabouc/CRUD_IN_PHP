<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des règlements</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Liste des règlements</h2>
        <a href="create.php" class="btn btn-primary mb-3">Ajouter un règlement</a>

        <form class="form-inline mb-3" method="GET">
            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Rechercher...">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Réparation</th>
                    <th>Montant</th>
                    <th>Date de règlement</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../config.php';
                include_once 'Reglement.php';

                // if (isset($_GET['search'])) {
                //     $searchTerm = $_GET['search'];
                //     $reglements = Reglement::searchReglements($searchTerm);
                // } else {
                    $reglements = Reglement::getAllReglements();
                // }

                foreach ($reglements as $reglement) {
                    echo "<tr>";
                    echo "<td>" . $reglement->getIdReglement() . "</td>";
                    echo "<td>" . $reglement->getIdReparation() . "</td>";
                    echo "<td>" . $reglement->getMontant() . "</td>";
                    echo "<td>" . $reglement->getDateReglement() . "</td>";
                    echo "<td><a href='update.php?id=" . $reglement->getIdReglement() . "' class='btn btn-primary'>Modifier</a>
                            <a href='delete.php?id=" . $reglement->getIdReglement() . "' class='btn btn-danger'>Supprimer</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
