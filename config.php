
<?php 
    $servername="localhost" ;
    // par defaut donnees par xampp
    $username="root";
    $password="";
    $dbname="db_reparation_appareil";

    $conn = new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error){
        die("connection filied ".$conn->connect_error);
    }
?>