<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Pièces de Rechange</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Liste des Pièces de Rechange</h2>
        <a href="create.php" class="btn btn-primary mb-3">Ajouter une pièce de rechange</a>

        <form class="form-inline mb-3" method="GET">
            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Rechercher...">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libellé de la Pièce</th>
                    <th>Quantité en Stock</th>
                    <th>Seuil Minimum</th>
                    <th>Seuil Maximum</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../config.php';
                include_once 'PieceRechange.php';

                if (isset($_GET['search'])) {
                    $searchTerm = $_GET['search'];
                    $pieces = PieceRechange::searchPieces($searchTerm);
                } else {
                    $pieces = PieceRechange::getAllPiecesRechange();
                }

                foreach ($pieces as $piece) {
                    echo "<tr>";
                    echo "<td>" . $piece->getIdPiece() . "</td>";   
                    echo "<td>" . $piece->getLibPiece() . "</td>";
                    echo "<td>" . $piece->getQteStock() . "</td>";
                    echo "<td>" . $piece->getSeuilMin() . "</td>";
                    echo "<td>" . $piece->getSeuilMax() . "</td>";
                    echo "<td><a href='update.php?id=" . $piece->getIdPiece() . "' class='btn btn-primary'>Modifier</a>
                            <a href='delete.php?id=" . $piece->getIdPiece() . "' class='btn btn-danger'>Supprimer</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
