<?php
include_once '../config.php';
include_once 'User.php';

session_start();

if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
    header("Location: ../login.php");
    exit;
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = User::getUserById($id);
    if($user) {
        $user->delete();
    }
}
header("Location: index.php");
exit();
?>
