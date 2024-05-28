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
        <h2>Liste des Admin </h2>
        <a href="create.php" class="btn btn-primary mb-3">Ajouter un utilisateur</a>

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
                    <th>date dernier connection</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../config.php';
                include_once 'Administrateur.php';

                // Si une recherche est effectuée, récupérer les utilisateurs correspondants
                if(isset($_GET['search'])) {
                    $searchTerm = $_GET['search'];
                    $users = Administrateur::searchAdministrateurs($searchTerm);
                } else {
                    // Sinon, récupérer tous les utilisateurs
                    $users = Administrateur::getAllAdministrateurs();
                }

                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>" . $user->getIdAdministrateur() . "</td>";
                    echo "<td>" . $user->getIdUtilisateur() . "</td>";
                
                    $userInfo = $user->getUserInfo();
                    if ($userInfo !== null) {
                        echo "<td>" . $userInfo->getNomUtilisateur() . "</td>";
                        echo "<td>" . $userInfo->getPrenomUtilisateur() . "</td>";
                        echo "<td>" . $userInfo->getEmail() . "</td>";
                        echo "<td>" . $userInfo->getTel() . "</td>";
                        echo "<td >" . $user->getDateDernConnex() . "</td>";
                       
                       
                        echo "<td>
                                <a href='update.php?id=" . $userInfo->getIdUtilisateur() . "' class='btn btn-primary'>Modifier</a>
                                <a href='delete.php?id=" . $user->getIdAdministrateur() . "' class='btn btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet utilisateur ?\")'>Supprimer</a>
                              </td>";
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
