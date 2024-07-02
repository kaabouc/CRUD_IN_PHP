<!DOCTYPE html>
<?php
session_start();

if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
    header("Location: ../login.php");
    exit;
}
$userType = $_SESSION['userType'];


include_once '../config.php';
include_once 'Reparation.php';
include_once '../appareil/Appareil.php';
include_once '../agent/AgentRéparation.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idReparation'])) {
    $idReparation = $_POST['idReparation'];
    $idAgentReparation = $_POST['idAgentReparation'];
    $idAppareil = $_POST['idAppareil'];
    $description = $_POST['description'];
    $dateDebut = $_POST['dateDebut'];
    $dateFinP = $_POST['dateFinP'];
    $dateFinR = $_POST['dateFinR'];
    $coutEstime = $_POST['coutEstime'];
    $etatR = $_POST['etatR'];

    $reparation = Reparation::getReparationById($idReparation);
    if ($reparation) {
        $reparation->setIdAgentReparation($idAgentReparation);
        $reparation->setIdAppareil($idAppareil);
        $reparation->setDescription($description);
        $reparation->setDateDebut($dateDebut);
        $reparation->setDateFinP($dateFinP);
        $reparation->setDateFinR($dateFinR);
        $reparation->setCoutEstime($coutEstime);
        $reparation->setEtatR($etatR);
        $reparation->update();

        header("Location: index.php");
        exit();
    }
}

if (isset($_GET['id'])) {
    $idReparation = $_GET['id'];
    $reparation = Reparation::getReparationById($idReparation);
    if ($reparation) {
        $appareils = Appareil::getAllAppareils();
        $agentrepartion = AgentRéparation::getAllAgentsRéparation();

?>
<?php  include('../admin/includes/header_user.php'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <h2>Modifier une Réparation</h2>
                    <form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                        <input type="hidden" name="idReparation" value="<?php echo $reparation->getIdReparation(); ?>">
                        <div class="form-group">
                            <label for="idAgentReparation">ID Agent:</label>
                            <select name="idAgentReparation" class="form-control" required>
                                <?php foreach ($agentrepartion as $agent) { ?>
                                    <option value="<?php echo $agent->getIdAgentRéparation(); ?>" <?php echo ($reparation->getIdAgentReparation() == $agent->getIdAgentRéparation()) ? 'selected' : ''; ?>>
                                        <?php echo $agent->getIdAgentRéparation() . " " . $agent->getEtatAgent(); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="idAppareil">ID Appareil:</label>
                            <select name="idAppareil" class="form-control" required>
                                <?php foreach ($appareils as $appareil) { ?>
                                    <option value="<?php echo $appareil->getIdAppareil(); ?>" <?php echo ($reparation->getIdAppareil() == $appareil->getIdAppareil()) ? 'selected' : ''; ?>>
                                        <?php echo $appareil->getIdAppareil() . " " . $appareil->getTypeAppareil(); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" class="form-control" required><?php echo $reparation->getDescription(); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="dateDebut">Date de début:</label>
                            <input type="date" name="dateDebut" class="form-control" value="<?php echo $reparation->getDateDebut(); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="dateFinP">Date de fin prévue:</label>
                            <input type="date" name="dateFinP" class="form-control" value="<?php echo $reparation->getDateFinP(); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="dateFinR">Date de fin réelle:</label>
                            <input type="date" name="dateFinR" class="form-control" value="<?php echo $reparation->getDateFinR(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="coutEstime">Coût estimé:</label>
                            <input type="number" name="coutEstime" class="form-control" value="<?php echo $reparation->getCoutEstime(); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="etatR">État:</label>
                            <select name="etatR" class="form-control" required>
                                <option value="en cours" <?php echo ($reparation->getEtatR() == 'en cours') ? 'selected' : ''; ?>>En cours</option>
                                <option value="validé" <?php echo ($reparation->getEtatR() == 'validé') ? 'selected' : ''; ?>>Validé</option>
                                <option value="annulé" <?php echo ($reparation->getEtatR() == 'annulé') ? 'selected' : ''; ?>>Annulé</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
    } else {
        echo "<p>Réparation non trouvée</p>";
    }
} else {
    echo "<p>ID de réparation non fourni</p>";
}
include('../admin/includes/footer_user.php');
?>
