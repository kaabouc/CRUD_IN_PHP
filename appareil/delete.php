<?php
include_once '../config.php';
include_once 'Appareil.php';
session_start();

if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
    header("Location: ../login.php");
    exit;
}
$userType = $_SESSION['userType'];
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $appareil = appareil::getappareilById($id);
    if($appareil) {
        $appareil->delete();
    }
}
header("Location: index.php");
exit();
?>
