<?php
include_once '../config.php';
include_once 'Reglement.php';
session_start();

if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
    header("Location: ../login.php");
    exit;
}
$userType = $_SESSION['userType'];

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
