<?php
session_start();

if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
    header("Location: ../login.php");
    exit;
}
$userType = $_SESSION['userType'];

include_once '../config.php';
include_once 'AgentRéparation.php';
include_once '../User/User.php';

if ( isset($_GET['id'])) {
    $idClient = $_GET['id'];
    $client = AgentRéparation::getAgentRéparationById($idClient);
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
