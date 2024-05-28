<?php
include_once '../config.php';
include_once 'Administrateur.php';
include_once '../User/User.php';
session_start();

if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
    header("Location: ../login.php");
    exit;
}
$userType = $_SESSION['userType'];

if ( isset($_GET['id'])) {
    $idClient = $_GET['id'];
    $client = Administrateur::getAdministrateurById($idClient);
    if ($client) {
        
        // $idUser = $client->getUserInfo()->getId();
        $client->delete();
        // $user = User::getUserById($idUser);
        // $user->delete();
    }
    
    header("Location: index.php");
    exit();
}
?>
