<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des détails de réparation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Liste des détails de réparation</h2>
        <a href="create.php" class="btn btn-primary mb-3">Ajouter un détail de réparation</a>

        <!-- Barre de recherche -->
        <form class="form-inline mb-3" method="GET">
            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Rechercher...">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Réparation</th>
                    <th>ID Règlement</th>
                    <th>ID Appareil</th>
                    <th>État Sous Réparation</th>
                    <th>Description</th>
                    <th>Coût</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../config.php';
                include_once 'DetailsReparation.php';

                // Si une recherche est effectuée, récupérer les détails de réparation correspondants
                if (isset($_GET['search'])) {
                    $searchTerm = $_GET['search'];
                    $detailsReparations = DetailsReparation::searchDetailsReparations($searchTerm);
                } else {
                    // Sinon, récupérer tous les détails de réparation
                    $detailsReparations = DetailsReparation::getAllDetailsReparations();
                }

                foreach ($detailsReparations as $detailsReparation) {
                    echo "<tr>";
                    echo "<td>" . $detailsReparation->getIdDetailsReparation() . "</td>";
                    echo "<td>" . $detailsReparation->getIdReparation() . "</td>";
                    echo "<td>" . $detailsReparation->getIdReglement() . "</td>";
                    echo "<td>" . $detailsReparation->getIdAppareil() . "</td>";
                    echo "<td>" . $detailsReparation->getEtatSousReparation() . "</td>";
                    echo "<td>" . $detailsReparation->getDescription() . "</td>";
                    echo "<td>" . $detailsReparation->getCout() . "</td>";
                    echo "<td>
                            <a href='update.php?id=" . $detailsReparation->getIdDetailsReparation() . "' class='btn btn-primary'>Modifier</a>
                            <a href='delete.php?id=" . $detailsReparation->getIdDetailsReparation() . "' class='btn btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce détail de réparation ?\")'>Supprimer</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
