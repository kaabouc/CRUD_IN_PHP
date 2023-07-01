<?php 
 include "config.php";

 if(isset($_POST['submit'])){
    $firstname=$_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $sql="insert into `users`(`firstname`,`lastname`,`email`,`password`,`gender`)  values('$firstname','$lastname','$email','$password','$gender')";

    $result = $conn->query($sql);

    if($result==true){
      echo " created with sucess ";
    }
    else {
      echo " error : ".$sql." <br>".$conn->error ; 
    }
    $conn->close();
 }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create produit </title>
</head>
<body>
    
   <form action="" method="post">

   <fieldset>
     <legend>
        personel information 
     </legend>
     first name : 
     <input type="text" name="firstname"><br>
     last name : 
     <input type="text" name="lastname"><br>
     Email : <input type="email" name="email"><br>
     password :
     <input type="password" name="password"><br>
     gender :
     <input type="radio" name="gender" value="male" >male 
     <input type="radio" name="gender" value="female">female 
     <br><br>
     <input type="submit" name="submit" id="submit">
   </fieldset>
   </form>
   <a href="view.php"> liste de perssone </a>
   
</body>
</html>