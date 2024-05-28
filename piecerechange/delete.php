<?php
include_once '../config.php';
include_once 'PieceRechange.php';
session_start();

if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
    header("Location: ../login.php");
    exit;
}
$userType = $_SESSION['userType'];
if (isset($_GET['id'])) {
    $idPiece = $_GET['id'];
    $piece = PieceRechange::getPieceById($idPiece);
    if ($piece) {
        $piece->delete();
    }
}
header("Location: index.php");
exit();
?>
