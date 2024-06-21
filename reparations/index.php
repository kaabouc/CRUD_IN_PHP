<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réparations</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changeEtat'])) {
    $idReparation = $_POST['idReparation'];
    $nouvelEtat = $_POST['nouvelEtat'];
    $dateFinR = $_POST['dateFinR'];

    $reparation = Reparation::getReparationById($idReparation);
    if ($reparation) {
        $reparation->setEtatR($nouvelEtat);
        $reparation->setDateFinR($dateFinR);
        $reparation->update();
    }
}

$reparations = Reparation::getAllReparations();
?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <h2>Liste des Réparations</h2>
                    <?php if ($userType == 'admin' || $userType == 'agent') { ?>
                        <a href="create.php" class="btn btn-primary mb-3">Ajouter Réparation</a>
                    <?php } ?>
                    <form class="form-inline mb-3" method="GET">
                        <input class="form-control mr-sm-2" type="text" name="search" placeholder="Rechercher...">
                        <button class="btn btn-outline-success" type="submit">Rechercher</button>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID Agent</th>
                                <th>ID Appareil</th>
                                <th>Description</th>
                                <th>Date de début</th>
                                <th>Date de fin prévue</th>
                                <th>Date de fin réelle</th>
                                <th>Coût estimé</th>
                                <th>État</th>
                                <?php if ($userType == 'admin' || $userType == 'agent') { ?>
                                    <th colspan="4">Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reparations as $reparation): ?>
                                <tr>
                                    <td><?php echo $reparation->getIdReparation(); ?></td>
                                    <td><?php echo $reparation->getIdAgentReparation(); ?></td>
                                    <td><?php echo $reparation->getIdAppareil(); ?></td>
                                    <td><?php echo $reparation->getDescription(); ?></td>
                                    <td><?php echo $reparation->getDateDebut(); ?></td>
                                    <td><?php echo $reparation->getDateFinP(); ?></td>
                                    <td><?php echo $reparation->getDateFinR(); ?></td>
                                    <td><?php echo $reparation->getCoutEstime(); ?></td>
                                    <td><?php echo $reparation->getEtatR(); ?></td>
                                    <?php if ($userType == 'admin' || $userType == 'agent') { ?>
                                        <td><a href="update.php?id=<?php echo $reparation->getIdReparation(); ?>" class="btn btn-primary">Modifier</a></td>
                                        <td><a href="delete.php?id=<?php echo $reparation->getIdReparation(); ?>" class="btn btn-danger">Supprimer</a></td>
                                    <?php } ?>
                                    <?php if ($userType == 'client') { ?>
                                        <td>
                                            <form method="post" style="display:inline;">
                                                <input type="hidden" name="idReparation" value="<?php echo $reparation->getIdReparation(); ?>">
                                                <input type="hidden" name="nouvelEtat" value="validé">
                                                <button type="submit" name="changeEtat" class="btn btn-success">Valider</button>
                                            </form>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#annulerModal" data-id="<?php echo $reparation->getIdReparation(); ?>">Annuler</button>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="annulerModal" tabindex="-1" role="dialog" aria-labelledby="annulerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="annulerModalLabel">Annuler Réparation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idReparation" id="idReparationModal">
                    <input type="hidden" name="nouvelEtat" value="annulé">
                    <div class="form-group">
                        <label for="dateFinR">Date de fin réelle</label>
                        <input type="date" name="dateFinR" id="dateFinRModal" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" name="changeEtat" class="btn btn-warning">Confirmer Annulation</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('../admin/includes/footer_user.php') ?>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $('#annulerModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var idReparation = button.data('id'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('#idReparationModal').val(idReparation);
    });
</script>
</body>
</html>
