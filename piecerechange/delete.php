<?php
include_once '../config.php';
include_once 'PieceRechange.php';

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
