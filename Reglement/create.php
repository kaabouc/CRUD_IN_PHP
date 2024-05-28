<?php
include_once '../config.php';
include_once 'Reglement.php';
include_once '../reparations/Reparation.php';
session_start();

if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
    header("Location: ../login.php");
    exit;
}
$userType = $_SESSION['userType'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idReparation = $_POST['idReparation'];
    $montant = $_POST['montant'];
    $dateReglement = $_POST['dateReglement'];

    $reglement = new Reglement($idReparation, $montant, $dateReglement);
    $reglement->save();

    header("Location: index.php");
    exit();
}
?>

<?php include('../admin/includes/header_user.php') ?>
<div class="content-wrapper">
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
              
             <div class="container">
        <h2>Créer un Règlement</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="idReparation">ID Réparation:</label>
                <select class="form-control" id="idReparation" name="idReparation" required>
                    <?php
                    $reparations = Reparation::getAllReparations();
                    foreach ($reparations as $reparation) {
                        echo "<option value='" . $reparation->getIdReparation() . "'>" . $reparation->getIdReparation() . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="montant">Montant:</label>
                <input type="number" class="form-control" id="montant" name="montant" required>
            </div>
            <div class="form-group">
                <label for="dateReglement">Date de Règlement:</label>
                <input type="date" class="form-control" id="dateReglement" name="dateReglement" required>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
        </div>
     </div>
     </div>
</section>
</div>
    <?php include('../admin/includes/footer_user.php') ?>