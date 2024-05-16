<?php
include_once '../config.php';
include_once 'DetailsReparation.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $idDetailsReparation = $_GET['id'];
    $detailsReparation = DetailsReparation::getDetailsReparationById($idDetailsReparation);

    if ($detailsReparation && $detailsReparation->delete()) {
        echo "<div class='alert alert-success mt-3'>Détail de réparation supprimé avec succès!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Erreur lors de la suppression du détail de réparation.</div>";
    }
}
?>
