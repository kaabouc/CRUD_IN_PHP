<?php
 // Inclure le fichier de configuration et la classe Client
 include_once '../config.php';
 include_once '../class/AgentRéparation.php';

 // Récupérer tous les clients depuis la base de données
 $agents = AgentRéparation::getAllAgentsRéparation();

?>

<?php include('../admin/includes/header_user.php') ?>
<div class="content-wrapper">
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
              
             <div class="container">
        <h2>Ajouter une réparation</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="idAgentReparation">ID Agent Réparation:</label>
                <select class="form-control" id="idAgentReparation" name="idAgentReparation" required>
                    <?php
                   
                    // Afficher chaque client dans la liste déroulante
                    foreach ($agents as $agent) {
                        echo "<option value='" . $agent->getIdAgentRéparation() . "'>" . $agent->getIdAgentRéparation() . "</option>";
                    }
                    ?>
                </select>  
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="dateDebut">Date Début:</label>
                <input type="date" class="form-control" id="dateDebut" name="dateDebut" required>
            </div>
            <div class="form-group">
                <label for="dateFinP">Date Fin Prévue:</label>
                <input type="date" class="form-control" id="dateFinP" name="dateFinP" required>
            </div>
            <div class="form-group">
                <label for="dateFinR">Date Fin Réelle:</label>
                <input type="date" class="form-control" id="dateFinR" name="dateFinR">
            </div>
            <div class="form-group">
                <label for="coutEstime">Coût Estimé:</label>
                <input type="number" class="form-control" id="coutEstime" name="coutEstime" required>
            </div>
            <div class="form-group">
                <label for="etatR">État:</label>
                <input type="text" class="form-control" id="etatR" name="etatR" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include_once '../config.php';
            include_once 'Reparation.php';

            $idAgentReparation = $_POST['idAgentReparation'];
            $description = $_POST['description'];
            $dateDebut = $_POST['dateDebut'];
            $dateFinP = $_POST['dateFinP'];
            $dateFinR = $_POST['dateFinR'];
            $coutEstime = $_POST['coutEstime'];
            $etatR = $_POST['etatR'];

            $reparation = new Reparation($idAgentReparation, $description, $dateDebut, $dateFinP, $dateFinR, $coutEstime, $etatR);
            if ($reparation->save()) {
                echo "<div class='alert alert-success mt-3'>Réparation ajoutée avec succès!</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Erreur lors de l'ajout de la réparation.</div>";
            }
        }
        ?>
    </div>
     </div>
     </div>
</section>
</div>
    <?php include('../admin/includes/footer_user.php') ?>
