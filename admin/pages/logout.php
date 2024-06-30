    <?php
   session_start();
   include_once '../../config.php';
   
   if (isset($_SESSION['idLogin']) && isset($_SESSION['userType'])) {
       $idUtilisateur = $_SESSION['idLogin'];
       $userType = $_SESSION['userType'];
   
       // Update the status based on the user type
       if ($userType == 'agent') {
           $sql = "UPDATE AgentRéparation SET etatAgent = 'Hors service' WHERE idUtilisateur = ?";
       } elseif ($userType == 'client') {
           $sql = "UPDATE Client SET etatClient = 'inactif' WHERE idUtilisateur = ?";
       } else {
           $sql = null;
       }
   
       if ($sql) {
           $stmt = $conn->prepare($sql);
           $stmt->bind_param('i', $idUtilisateur);
           $stmt->execute();
           $stmt->close();
       }
   }
   
   // Destroy the session
   session_destroy();
   
   header("Location: ../../index.php");

   exit;
    ?>

