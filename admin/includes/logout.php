<?php
    include_once '../../config.php';
    include_once '../../User/User.php';
    include_once '../../client/Client.php';
    include_once '../../agent/AgentRéparation.php';
      session_start();

      if (isset($_SESSION['idLogin']) && isset($_SESSION['userType'])) {
          $idLogin = $_SESSION['idLogin'];
          $userType = $_SESSION['userType'];
      
          if ($userType == 'agent') {
              $agent = AgentRéparation::getByUtilisateurId($idLogin);
              if ($agent) {
                  $agent->updateEtat('Hors service');
              }
          } elseif ($userType == 'client') {
              $client = Client::getByUtilisateurId($idLogin);
              if ($client) {
                  $client->updateEtat('inactif');
              }
          }
      
          session_destroy();
          header("Location: ../../index.php");
          exit;
      }
    ?>

