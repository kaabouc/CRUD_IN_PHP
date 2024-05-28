<?php 
session_start();

if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
    header("Location: ../login.php");
    exit;
}
$userType = $_SESSION['userType'];

include('../admin/includes/header_user.php') ?>
<div class="content-wrapper">
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
              
             <div class="container">
        <h2>Modifier une réparation</h2>
        <?php
        include_once '../config.php';
        include_once 'Reparation.php';

        if (isset($_GET['id'])) {
            $idReparation = $_GET['id'];
            $reparation = Reparation::getReparationById($idReparation);

            if ($reparation) {
        ?>
        <form method="post" action="">
            <input type="hidden" name="idReparation" value="<?php echo $reparation->getIdReparation(); ?>">
            <div class="form-group">
                <label for="idAgentReparation">ID Agent Réparation:</label>
                <input type="text" class="form-control" id="idAgentReparation" name="idAgentReparation" value="<?php echo $reparation->getIdAgentReparation(); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required><?php echo $reparation->getDescription(); ?></textarea>
            </div>
            <div class="form-group">
                <label for="dateDebut">Date Début:</label>
                <input type="date" class="form-control" id="dateDebut" name="dateDebut" value="<?php echo $reparation->getDateDebut(); ?>" required>
            </div>
            <div class="form-group">
                <label for="dateFinP">Date Fin Prévue:</label>
                <input type="date" class="form-control" id="dateFinP" name="dateFinP" value="<?php echo $reparation->getDateFinP(); ?>" required>
            </div>
            <div class="form-group">
                <label for="dateFinR">Date Fin Réelle:</label>
                <input type="date" class="form-control" id="dateFinR" name="dateFinR" value="<?php echo $reparation->getDateFinR(); ?>">
            </div>
            <div class="form-group">
                <label for="coutEstime">Coût Estimé:</label>
                <input type="number" class="form-control" id="coutEstime" name="coutEstime" value="<?php echo $reparation->getCoutEstime(); ?>" required>
            </div>
            <div class="form-group">
                <label for="etatR">État:</label>
                <input type="text" class="form-control" id="etatR" name="etatR" value="<?php echo $reparation->getEtatR(); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
        <?php
            } else {
                echo "<div class='alert alert-danger'>Réparation non trouvée.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>ID de réparation manquant.</div>";
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idReparation = $_POST['idReparation'];
            $idAgentReparation = $_POST['idAgentReparation'];
            $description = $_POST['description'];
            $dateDebut = $_POST['dateDebut'];
            $dateFinP = $_POST['dateFinP'];
            $dateFinR = $_POST['dateFinR'];
            $coutEstime = $_POST['coutEstime'];
            $etatR = $_POST['etatR'];

            $reparation = new Reparation($idAgentReparation, $description, $dateDebut, $dateFinP, $dateFinR, $coutEstime, $etatR);
            $reparation->setIdReparation($idReparation);
            if ($reparation->update()) {
                echo "<div class='alert alert-success mt-3'>Réparation mise à jour avec succès!</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Erreur lors de la mise à jour de la réparation.</div>";
            }
        }
        ?>
   </div>
     </div>
     </div>
</section>
</div>
    <?php include('../admin/includes/footer_user.php') ?>
