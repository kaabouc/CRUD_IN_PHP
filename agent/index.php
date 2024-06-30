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
        <h2>Liste des AgentReparations </h2>
        <?php if ($userType == 'admin' ) { 

       echo' <a href="create.php" class="btn btn-primary mb-3">Ajouter un agent reparation </a>';
         } ?>
        <!-- Barre de recherche -->
        <form class="form-inline mb-3" method="GET">
            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Rechercher...">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID Agent</th>
                    <th>ID User</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Statut</th>
                    <?php if ($userType == 'admin'  ) { 
                    echo' <th colspan="2">Action</th>';
                    } ?>      
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../config.php';
                include_once 'AgentRéparation.php';

                // Si une recherche est effectuée, récupérer les utilisateurs correspondants
                if(isset($_GET['search'])) {
                    $searchTerm = $_GET['search'];
                    $users = AgentRéparation::searchAgentsRéparation($searchTerm);
                } else {
                    // Sinon, récupérer tous les utilisateurs
                    $users = AgentRéparation::getAllAgentsRéparation();
                }

                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>" . $user->getIdAgentRéparation() . "</td>";
                    echo "<td>" . $user->getIdUtilisateur() . "</td>";
                
                    $userInfo = $user->getUserInfo();
                    if ($userInfo !== null) {
                        echo "<td>" . $userInfo->getNomUtilisateur() . "</td>";
                        echo "<td>" . $userInfo->getPrenomUtilisateur() . "</td>";
                        echo "<td>" . $userInfo->getEmail() . "</td>";
                        echo "<td>" . $userInfo->getTel() . "</td>";
                
                        $isActive = $userInfo->isActive();
                        echo "<td>" . ($isActive ? "<span class='badge badge-success'>En service</span>" : "<span class='badge badge-secondary'>Hors service</span>") . "</td>";
                        if ($userType == 'admin'  ) { 

                        echo "<td>
                                <a href='update.php?id=" . $userInfo->getIdUtilisateur() . "' class='btn btn-primary'>Modifier</a>
                                <a href='delete.php?id=" . $user->getIdAgentRéparation() . "' class='btn btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet utilisateur ?\")'>Supprimer</a>
                              </td>";
                        }
                    } else {
                        echo "<td colspan='5'>Utilisateur non trouvé</td>";
                    }
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
