<?php
session_start();

if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
    header("Location: ../login.php");
    exit;
}
$userType = $_SESSION['userType'];

include('../admin/includes/header_user.php');
include_once '../config.php';
include_once 'Reparation.php';
include_once '../appareil/Appareil.php';
include_once '../agent/AgentRéparation.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idAgentReparation = $_POST['idAgentReparation'];
    $idAppareil = $_POST['idAppareil'];
    $description = $_POST['description'];
    $dateDebut = $_POST['dateDebut'];
    $dateFinP = $_POST['dateFinP'];
    $dateFinR = $_POST['dateFinR'];
    $coutEstime = $_POST['coutEstime'];
    $etatR = $_POST['etatR'];

    $reparation = new Reparation($idAgentReparation, $idAppareil, $description, $dateDebut, $dateFinP, $dateFinR, $coutEstime, $etatR);
    $reparation->save();

    header('Location: index.php');
    exit();
}

$appareils = Appareil::getAllAppareils();
$agentrepartion = AgentRéparation::getAllAgentsRéparation();

?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <h2>Ajouter une Réparation</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for="idAgentReparation">ID Agent:</label>
                            <select name="idAgentReparation" class="form-control" required>
                                <?php foreach ($agentrepartion as $agent){ ?>
                                    <option value="<?php echo $agent->getIdAgentRéparation(); ?>"><?php echo $agent->getIdAgentRéparation() . " " . $agent->getEtatAgent(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="idAppareil">ID Appareil:</label>
                            <select name="idAppareil" class="form-control" required>
                                <?php foreach ($appareils as $appareil){ ?>
                                    <option value="<?php echo $appareil->getIdAppareil(); ?>"><?php echo $appareil->getIdAppareil() ." ". $appareil->getTypeAppareil(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="dateDebut">Date de début:</label>
                            <input type="date" name="dateDebut" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="dateFinP">Date de fin prévue:</label>
                            <input type="date" name="dateFinP" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="dateFinR">Date de fin réelle:</label>
                            <input type="date" name="dateFinR" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="coutEstime">Coût estimé:</label>
                            <input type="number" name="coutEstime" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="etatR">État:</label>
                            <select name="etatR" class="form-control" required>
                                <option value="en cours" selected>En cours</option>
                                <option value="validé">Validé</option>
                                <option value="annulé">Annulé</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include('../admin/includes/footer_user.php') ?>
