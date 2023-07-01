<?php 
   include "config.php";
   $sql = "select * from users";
    $result = $conn->query($sql);

    if(isset($_POST['delete'])){
      $id = $_GET['id'];
       $sql = " delete from `users` where `id`='$id' ";
       $result = $conn -> query($sql);
       if( $result == true){
         echo "deleted avec sucess ";
       }
       else {
         echo "test non correct de suprission ";
       }
    }
  ?>  
  <!DOCTYPE html>
  <html lang="en">
  <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>view</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  </head>
  <body>
      <div class="container">
         <h2> users 2</h2>
         <table>
            <thead>
               <tr> <th>ID </th>
                  <th> First name </th>
                  <th>Last name  </th>
                  <th>email </th>
                  <th> Gender </th>
                  <th>action </th>
            </tr>
            </thead>
            <tbody>
               <?php 
                 if($result->num_rows>0){
                  while ($row=$result->fetch_assoc()){
                     ?>  
                     <tr>
                        <td> <?php  echo $row['id']?></td>
                        <td> <?php  echo $row['firstname']?></td>
                        <td> <?php  echo $row['lastname']?></td>
                        <td> <?php  echo $row['email']?></td>
                        <td> <?php  echo $row['gender']?></td>
                        <td><a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>" >Edit</a><a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>"  onclick="delete"  >Delete</a></td>
                     </tr>
            <?php      }                                                                                                                                                                                                                                                                                                    
                 }
              ?>
            </tbody>
         </table>
      </div>
      <a href="create.php"> create personnel en base de donnes </a>
  </body>

  </html>
  <script>
    
  </script>