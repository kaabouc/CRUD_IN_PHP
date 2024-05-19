<?php
include_once '../config.php';
include_once 'PieceRechange.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPiece = $_POST['id'];
    $libPiece = $_POST['libPiece'];
    $qteStock = $_POST['qteStock'];
    $seuilMin = $_POST['seuilMin'];
    $seuilMax = $_POST['seuilMax'];

    $piece = new PieceRechange($libPiece, $qteStock, $seuilMin, $seuilMax);
    $piece->setIdPiece($idPiece);
    $piece->update();
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $idPiece = $_GET['id'];
    $piece = PieceRechange::getPieceById($idPiece);
    if (!$piece) {
        header("Location: index.php");
        exit();
    }
} else {
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
        <h2>Modifier une Pièce de Rechange</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="id" value="<?php echo $piece->getIdPiece(); ?>">
            <div class="form-group">
                <label for="libPiece">Libellé de la Pièce:</label>
                <input type="text" class="form-control" id="libPiece" name="libPiece" value="<?php echo $piece->getLibPiece(); ?>" required>
            </div>
            <div class="form-group">
                <label for="qteStock">Quantité en Stock:</label>
                <input type="number" class="form-control" id="qteStock" name="qteStock" value="<?php echo $piece->getQteStock(); ?>" required>
            </div>
            <div class="form-group">
                <label for="seuilMin">Seuil Minimum:</label>
                <input type="number" class="form-control" id="seuilMin" name="seuilMin" value="<?php echo $piece->getSeuilMin(); ?>" required>
            </div>
            <div class="form-group">
                <label for="seuilMax">Seuil Maximum:</label>
                <input type="number" class="form-control" id="seuilMax" name="seuilMax" value="<?php echo $piece->getSeuilMax(); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
        </div>
     </div>
     </div>
</section>
</div>
    <?php include('../admin/includes/footer_user.php') ?>
