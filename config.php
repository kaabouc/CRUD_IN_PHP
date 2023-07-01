
<?php 
    $servername="localhost" ;
    $username="root";
    $password="";
    $dbname="crud_php";

    $conn = new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error){
        die("connection filied ".$conn->connect_error);
    }
?>