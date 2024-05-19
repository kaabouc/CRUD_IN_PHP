<?php
include_once '../config.php';
include_once 'Reglement.php';

if (isset($_GET['id'])) {
    $idReglement = $_GET['id'];
    $reglement = Reglement::getReglementById($idReglement);
    if ($reglement) {
        $reglement->delete();
    }
}
header("Location: index.php");
exit();
?>
