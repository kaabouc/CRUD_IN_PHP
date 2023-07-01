<?php 
     include "config.php";
     if(isset($_POST['update'])){
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $id=$_POST['id'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $gender=$_POST['gender'];

        $sql="update `users` set `firstname` ='$firstname' , `lastname`='$lastname' , `email`='$email' , `password`='$password' , `gender`='$gender' where `id`='$id' ";   
       $result=$conn->query($sql);
       if($result == true ){
        echo " record update sucess"; 
       }else {
        echo " error ".$sql."<br>".$conn->error;
       }

    }

    if(isset($_GET['id'])){
        $user_id= $_GET['id'];
        $sql= " select * from `users` where `id`='$user_id'";
        $result= $conn->query($sql);
        if($result->num_rows>0) {
            while($row=$result->fetch_assoc()){
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $email= $row['email'];
                $password = $row['password'];
                $gender=$row['gender'];
                $id=$row['id'];


            }
 ?>
 <h2> user update form </h2>
 <form action="" method="post">
   <fieldset>
    <legend> personnel information  : </legend>
      first name  :  <input type="text" name="firstname" value="<?php echo $firstname ; ?>">
      <input type="hidden" name="id" value="<?php echo $id ; ?>"> <br>
      last name  :  <input type="text" name="lastname" value="<?php echo $lastname ; ?>">
   <br>
   email : <input type="email" name="email" value="<?php echo $email?>"><br>
   password : <input type="password" name="password"  value="<?php echo $password ;?>"><br>
   Gender:

<input type="radio" name="gender" value="Male" <?php if(strtolower($gender)== 'male'){ echo "checked";} ?>  >Male

<input type="radio" name="gender" value="Female" <?php if(strtoupper($gender) == 'FEMALE'){ echo "checked";} ?> >Female
  
<br><br>
 <input type="submit" name="update" name="update">

</fieldset>


 </form>
 <?php
        } 
        else{ 

            header('Location: view.php');
    
        } 
    }
    ?>


