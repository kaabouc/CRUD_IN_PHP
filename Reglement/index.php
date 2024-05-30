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
        <h2>Liste des règlements</h2>
        <?php if ($userType == 'admin'|| $userType == 'agent' ) { 

echo' <a href="create.php" class="btn btn-primary mb-3">Ajouter règlements</a>';
  } ?>
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
                    <?php if ($userType == 'admin' || $userType == 'agent' ) { 
                    echo' <th colspan="1">Action</th>';
                    } ?>
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
                    if ($userType == 'admin' || $userType == 'agent' ) { 

                    echo "<td><a href='update.php?id=" . $reglement->getIdReglement() . "' class='btn btn-primary'>Modifier</a>
                            <a href='delete.php?id=" . $reglement->getIdReglement() . "' class='btn btn-danger'>Supprimer</a></td>";
                    echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        </div>
     </div>
     </div>
</section>
</div>
    <?php include('../admin/includes/footer_user.php') ?>
