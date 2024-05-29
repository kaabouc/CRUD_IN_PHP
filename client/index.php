<?php 
session_start();

if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
    header("Location: ../login.php");
    exit;
}
$userType = $_SESSION['userType'];
include('../admin/includes/header_user.php'); 



?>
<div class="content-wrapper">
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
              
             <div class="container">
        <h2>Liste des Clients</h2>
        <?php if ($userType == 'admin' || $userType == 'agent' ) { 

       echo' <a href="create.php" class="btn btn-primary mb-3">Ajouter un utilisateur</a>';
         } ?>
        <!-- Barre de recherche -->
        <form class="form-inline mb-3" method="GET">
            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Rechercher...">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID client</th>
                    <th>ID User</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Statut</th>
                   <?php if ($userType == 'admin' || $userType == 'agent' ) { 
                    echo' <th colspan="2">Action</th>';
                    } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../config.php';
                include_once 'Client.php';

                // Si une recherche est effectuée, récupérer les utilisateurs correspondants
                if(isset($_GET['search'])) {
                    $searchTerm = $_GET['search'];
                    $users = Client::searchClients($searchTerm);
                } else {
                    // Sinon, récupérer tous les utilisateurs
                    $users = Client::getAllClients();
                }

                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td > ". $user->getIdClient() . "</td>";
                    echo "<td > ". $user->getIdUtilisateur() . "</td>";

                    echo "<td>" . $user->getUserInfo()->getNomUtilisateur() . "</td>";
                    echo "<td>" . $user->getUserInfo()->getPrenomUtilisateur() . "</td>";
                    echo "<td>" . $user->getUserInfo()->getEmail() . "</td>";
                    echo "<td>" . $user->getUserInfo()->getTel() . "</td>";

                    // Vérifier si l'utilisateur est actif et afficher une icône ou le mot "actif"
                    $isActive = $user->getUserInfo()->isActive(); // Supposons que vous ayez une méthode isActive() dans la classe User
                    echo "<td>" . ($isActive ? "<span class='badge badge-success'>Actif</span>" : "<span class='badge badge-secondary'>Inactif</span>") . "</td>";
                   if ($userType == 'admin' || $userType == 'agent' ) { 
                    echo "<td>
                            <a href='update.php?id=" . $user->getUserInfo()->getIdUtilisateur() . "' class='btn btn-primary'>Modifier</a>
                            <a href='../appareil/index.php?id=" . $user->getIdClient() . "' class='btn btn-info'>voir</a>
                    
                            <a href='delete.php?id=" . $user->getIdClient() . "' class='btn btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet utilisateur ?\")'>Supprimer</a>
                          </td>";
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
