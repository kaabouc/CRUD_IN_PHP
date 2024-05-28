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
        <h2>Liste des appareils</h2>
        <a href="create.php" class="btn btn-primary mb-3">Ajouter un appareil</a>

        <!-- Barre de recherche -->
        <form class="form-inline mb-3" method="GET">
            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Rechercher...">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type d'appareil</th>
                    <th>Modèle</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../config.php';
                include_once 'Appareil.php';

                // Récupérer l'ID de l'utilisateur à partir de l'URL
                $idUtilisateur = isset($_GET['id']) ? $_GET['id'] : null;

                // Si une recherche est effectuée, récupérer les appareils correspondants
                if(isset($_GET['search'])) {
                    $searchTerm = $_GET['search'];
                    $appareils = Appareil::searchAppareils($searchTerm);
                } else {
                      $appareils =Appareil::getAllAppareils();      
                    if ($idUtilisateur) {
                        $appareils = Appareil::getAllAppareilsByUserId($idUtilisateur);
                    } else {
                        // Si l'ID de l'utilisateur n'est pas fourni, afficher un message d'erreur
                        echo "<tr><td colspan='4'>ID de l'utilisateur non spécifié.</td></tr>";
                        $appareils = array(); // Définir un tableau vide pour éviter les erreurs
                    }
                }

                foreach ($appareils as $appareil) {
                    echo "<tr>";
                    echo "<td>" . $appareil->getIdAppareil() . "</td>";
                    echo "<td>" . $appareil->getTypeAppareil() . "</td>";
                    echo "<td>" . $appareil->getModele() . "</td>";
                    echo "<td><a href='update.php?idAppareil=" . $appareil->getIdAppareil() . "' class='btn btn-primary'>Modifier</a>
                            <a href='delete.php?id=" . $appareil->getIdAppareil() . "' class='btn btn-danger'>Supprimer</a></td>";
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