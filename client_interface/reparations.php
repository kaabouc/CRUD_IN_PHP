<?php
session_start();

if (!isset($_SESSION['idLogin']) || $_SESSION['userType'] != 'client') {
    header("Location: ../login.php");
    exit;
}

include_once '../config.php';
include_once '../reparations/Reparation.php';

$idAppareil = $_GET['idAppareil'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeEtat'])) {
    $idReparation = $_POST['idReparation'];
    $nouvelEtat = $_POST['nouvelEtat'];

    $reparation = Reparation::getReparationById($idReparation);
    if ($reparation) {
        $reparation->setEtatR($nouvelEtat);
        $reparation->update();
    }
}

$reparations = Reparation::getReparationsByAppareilId($idAppareil);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réparations de l'Appareil</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="container">
                        <h2>Réparations de l'Appareil</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Réparation</th>
                                    <th>Description</th>
                                    <th>Date de début</th>
                                    <th>Date de fin prévue</th>
                                    <th>Date de fin réelle</th>
                                    <th>Coût estimé</th>
                                    <th>État</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reparations as $reparation): ?>
                                    <tr>
                                        <td><?php echo $reparation->getIdReparation(); ?></td>
                                        <td><?php echo $reparation->getDescription(); ?></td>
                                        <td><?php echo $reparation->getDateDebut(); ?></td>
                                        <td><?php echo $reparation->getDateFinP(); ?></td>
                                        <td><?php echo $reparation->getDateFinR(); ?></td>
                                        <td><?php echo $reparation->getCoutEstime(); ?></td>
                                        <td><?php echo $reparation->getEtatR(); ?></td>
                                        <td>
                                            <form method="post" style="display:inline;">
                                                <input type="hidden" name="idReparation" value="<?php echo $reparation->getIdReparation(); ?>">
                                                <input type="hidden" name="nouvelEtat" value="validé">
                                                <button type="submit" name="changeEtat" class="btn btn-success">Valider</button>
                                            </form>
                                            <form method="post" style="display:inline;">
                                                <input type="hidden" name="idReparation" value="<?php echo $reparation->getIdReparation(); ?>">
                                                <input type="hidden" name="nouvelEtat" value="annulé">
                                                <button type="submit" name="changeEtat" class="btn btn-warning">Annuler</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
