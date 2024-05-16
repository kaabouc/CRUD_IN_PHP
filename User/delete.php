<?php
include_once '../config.php';
include_once 'User.php';



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
