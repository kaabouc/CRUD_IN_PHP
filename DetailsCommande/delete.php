<?php
include_once '../config.php';
include_once 'DetailsCommande.php';
session_start();

if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
    header("Location: ../login.php");
    exit;
}
$userType = $_SESSION['userType'];
if (isset($_GET['idReparation']) && isset($_GET['idPiece'])) {
    $idReparation = $_GET['idReparation'];
    $idPiece = $_GET['idPiece'];
    $detail = DetailsCommande::getDetailById($idReparation, $idPiece);
    if ($detail) {
        $detail->delete();
    }
}
header("Location: index.php");
exit();
?>
