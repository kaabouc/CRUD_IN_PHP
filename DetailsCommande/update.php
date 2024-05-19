<?php
include_once '../config.php';
include_once 'DetailsCommande.php';
include_once '../reparations/Reparation.php';
include_once '../piecerechange/PieceRechange.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldIdReparation = $_POST['oldIdReparation'];
    $oldIdPiece = $_POST['oldIdPiece'];
    $newIdReparation = $_POST['newIdReparation'];
    $newIdPiece = $_POST['newIdPiece'];
    $newQte = $_POST['newQte'];

    try {
        $detail = new DetailsCommande($oldIdReparation, $oldIdPiece, 0);
        $detail->update($newIdReparation, $newIdPiece, $newQte);
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

if (isset($_GET['idReparation']) && isset($_GET['idPiece'])) {
    $idReparation = $_GET['idReparation'];
    $idPiece = $_GET['idPiece'];
    $detail = DetailsCommande::getDetailById($idReparation, $idPiece);
    if (!$detail) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

// Récupérer toutes les réparations et pièces de rechange
$reparations = Reparation::getAllReparations();
$pieces = PieceRechange::getAllPiecesRechange();
?>

<?php include('../admin/includes/header_user.php') ?>
<div class="content-wrapper">
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
              
             <div class="container">
        <h2>Modifier un Détail de Commande</h2>
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="oldIdReparation" value="<?php echo $detail->getIdReparation(); ?>">
            <input type="hidden" name="oldIdPiece" value="<?php echo $detail->getIdPiece(); ?>">

            <div class="form-group">
                <label for="newIdReparation">Nouveau ID Réparation:</label>
                <select class="form-control" id="newIdReparation" name="newIdReparation" required>
                    <?php foreach ($reparations as $reparation) {
                        echo "<option value='" . $reparation->getIdReparation() . "'";
                        if ($reparation->getIdReparation() == $detail->getIdReparation()) echo " selected";
                        echo ">" . $reparation->getIdReparation() . "</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="newIdPiece">Nouveau ID Pièce:</label>
                <select class="form-control" id="newIdPiece" name="newIdPiece" required>
                    <?php foreach ($pieces as $piece) {
                        echo "<option value='" . $piece->getIdPiece() . "'";
                        if ($piece->getIdPiece() == $detail->getIdPiece()) echo " selected";
                        echo ">" . $piece->getLibPiece() . "</option>";
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="newQte">Nouvelle Quantité:</label>
                <input type="number" class="form-control" id="newQte" name="newQte" value="<?php echo $detail->getQte(); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
        </div>
     </div>
     </div>
</section>
</div>
    <?php include('../admin/includes/footer_user.php') ?>