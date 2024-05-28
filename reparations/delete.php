<?php
include_once '../config.php';
include_once 'Reparation.php';

session_start();

if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
    header("Location: ../login.php");
    exit;
}
$userType = $_SESSION['userType'];

if (isset($_GET['id'])) {
    $idReparation = $_GET['id'];
    $reparation = new Reparation(null, null, null, null, null, null, null);
    $reparation->setIdReparation($idReparation);
    if ($reparation->delete()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de la suppression de la réparation.";
    }
} else {
    echo "ID de réparation manquant.";
}
?>
