<!DOCTYPE html>
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
        <h2>Liste des Détails de Commande</h2>
        <?php if ($userType == 'admin' || $userType == 'agent' ) { 

echo' <a href="create.php" class="btn btn-primary mb-3">Ajouter Détails de Commande</a>';
  } ?>
        <form class="form-inline mb-3" method="GET">
            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Rechercher...">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID Réparation</th>
                    <th>ID Pièce</th>
                    
                    <th>Quantité</th>
                    <?php if ($userType == 'admin' || $userType == 'agent' ) { 
                    echo' <th >Action</th>';
                    } ?>

                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../config.php';
                include_once 'DetailsCommande.php';

                if (isset($_GET['search'])) {
                    $searchTerm = $_GET['search'];
                    $details = DetailsCommande::searchDetails($searchTerm);
                } else {
                    $details = DetailsCommande::getAllDetails();
                }

                foreach ($details as $detail) {
                    echo "<tr>";
                    echo "<td>" . $detail->getIdReparation() . "</td>";
                    echo "<td>" . $detail->getIdPiece() . "</td>";
                    echo "<td>" . $detail->getQte() . "</td>";
                    if ($userType == 'admin' || $userType == 'agent' ) { 
                    echo "<td>
                            <a href='update.php?idReparation=" . $detail->getIdReparation() . "&idPiece=" . $detail->getIdPiece() . "' class='btn btn-primary'>Modifier</a>
                            <a href='delete.php?idReparation=" . $detail->getIdReparation() . "&idPiece=" . $detail->getIdPiece() . "' class='btn btn-danger'>Supprimer</a>
                          </td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        </div>
    
     </div>
</section>
</div>
    <?php include('../admin/includes/footer_user.php') ?>
