<?php 
session_start();

if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
    header("Location: ../login.php");
    exit;
}
$userType = $_SESSION['userType'];

include('../admin/includes/header_user.php') ?>
<div class="content-wrapper">
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
              
             <div class="container">
        <h2>Liste des Pièces de Rechange</h2>
        <?php if ($userType == 'admin' ) { 

echo' <a href="create.php" class="btn btn-primary mb-3">Ajouter Pièces de Rechange</a>';
  } ?>
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
                    <?php if ($userType == 'admin' || $userType == 'agent' ) { 
                    echo' <th colspan="1">Action</th>';
                    } ?>

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
                    if ($userType == 'admin' || $userType == 'agent' ) { 

                    echo "<td><a href='update.php?id=" . $piece->getIdPiece() . "' class='btn btn-primary'>Modifier</a>
                            <a href='delete.php?id=" . $piece->getIdPiece() . "' class='btn btn-danger'>Supprimer</a></td>";
                    echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        </div>
 
     </div>
</section>
</div>
    <?php include('../admin/includes/footer_user.php') ?>