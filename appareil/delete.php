<?php
include_once '../config.php';
include_once 'Appareil.php';

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
