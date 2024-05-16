<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des pièces de rechange</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Liste des pièces de rechange</h2>
        <a href="create.php" class="btn btn-primary mb-3">Ajouter une pièce</a>

        <!-- Barre de recherche -->
        <form class="form-inline mb-3" method="GET">
            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Rechercher...">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libellé</th>
                    <th>Quantité en stock</th>
                    <th>Seuil minimum</th>
                    <th>Seuil maximum</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                            include_once '../config.php';

                include_once 'PieceRechange.php';


                // Si une recherche est effectuée, récupérer les pièces correspondantes
                if(isset($_GET['search'])) {
                    $searchTerm = $_GET['search'];
                    $pieces = PieceRechange::searchPieces($searchTerm);
                } else {
                    // Sinon, récupérer toutes les pièces
                    $pieces = PieceRechange::getAllPiecesRechange();
                }

                foreach ($pieces as $piece) {
                    echo "<tr>";
                    echo "<td>" . $piece->getIdPiece() . "</td>";
                    echo "<td>" . $piece->getLibPiece() . "</td>";
                    echo "<td>" . $piece->getQteStock() . "</td>";
                    echo "<td>" . $piece->getSeuilMin() . "</td>";
                    echo "<td>" . $piece->getSeuilMax() . "</td>";
                    echo "<td>
                            <a href='update_piece.php?id=" . $piece->getIdPiece() . "' class='btn btn-primary'>Modifier</a>
                            <a href='delete_piece.php?id=" . $piece->getIdPiece() . "' class='btn btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette pièce ?\")'>Supprimer</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
