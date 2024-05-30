<?php
session_start();

if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
    header("Location: ../login.php");
    exit;
}
$userType = $_SESSION['userType'];

include_once '../config.php';
include_once 'Reparation.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $idReparation = $_GET['id'];
    $reparation = Reparation::getReparationById($idReparation);

    if ($reparation) {
        $reparation->delete();
    }

    header('Location: index.php');
    exit();
}
?>
