<?php
include_once '../config.php';
include_once 'Reglement.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $idReglement = $_GET['id'];
    $reglement = Reglement::getReglementById($idReglement);

    if ($reglement && $reglement->delete()) {
        echo "<div class='alert alert-success mt-3'>Règlement supprimé avec succès!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Erreur lors de la suppression du règlement.</div>";
    }
}
?>
