<?php include('../admin/includes/header_user.php') ?>
<div class="content-wrapper">
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
              
             <div class="container">
        <h2>Liste des réparations</h2>
        <a href="create.php" class="btn btn-primary mb-3">Ajouter une réparation</a>

        <!-- Barre de recherche -->
        <form class="form-inline mb-3" method="GET">
            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Rechercher...">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Agent Réparation</th>
                    <th>Description</th>
                    <th>Date Début</th>
                    <th>Date Fin Prévue</th>
                    <th>Date Fin Réelle</th>
                    <th>Coût Estimé</th>
                    <th>État</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../config.php';
                include_once 'Reparation.php';

                // Si une recherche est effectuée, récupérer les réparations correspondantes
                if(isset($_GET['search'])) {
                    $searchTerm = $_GET['search'];
                    $reparations = Reparation::searchReparations($searchTerm);
                } else {
                    // Sinon, récupérer toutes les réparations
                    $reparations = Reparation::getAllReparations();
                }

                foreach ($reparations as $reparation) {
                    echo "<tr>";
                    echo "<td>" . $reparation->getIdReparation() . "</td>";
                    echo "<td>" . $reparation->getIdAgentReparation() . "</td>";
                    echo "<td>" . $reparation->getDescription() . "</td>";
                    echo "<td>" . $reparation->getDateDebut() . "</td>";
                    echo "<td>" . $reparation->getDateFinP() . "</td>";
                    echo "<td>" . $reparation->getDateFinR() . "</td>";
                    echo "<td>" . $reparation->getCoutEstime() . "</td>";
                    echo "<td>" . $reparation->getEtatR() . "</td>";

                    echo "<td>
                            <a href='update.php?id=" . $reparation->getIdReparation() . "' class='btn btn-primary'>Modifier</a>
                            <a href='delete.php?id=" . $reparation->getIdReparation() . "' class='btn btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette réparation ?\")'>Supprimer</a>
                          </td>";
                    echo "</tr>";
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
