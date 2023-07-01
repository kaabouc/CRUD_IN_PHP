<?php 
  
  include "config.php";
  if(isset($_GET['id'])){
    $user_id =$_GET['id'];
    $sql = " delete from `users` where `id` = '$user_id ' ";
    $res = $conn->query($sql);
   
    header( 'localtion: view.php');
}

?>