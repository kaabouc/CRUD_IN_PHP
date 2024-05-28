<?php
include_once '../config.php';
include_once 'PieceRechange.php';
session_start();

if (!isset($_SESSION['idLogin']) || !isset($_SESSION['userType'])) {
    header("Location: ../login.php");
    exit;
}
$userType = $_SESSION['userType'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $libPiece = $_POST['libPiece'];
    $qteStock = $_POST['qteStock'];
    $seuilMin = $_POST['seuilMin'];
    $seuilMax = $_POST['seuilMax'];

    $piece = new PieceRechange($libPiece, $qteStock, $seuilMin, $seuilMax);
    $piece->save();

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
        <h2>Créer une Pièce de Rechange</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="libPiece">Libellé de la Pièce:</label>
                <input type="text" class="form-control" id="libPiece" name="libPiece" required>
            </div>
            <div class="form-group">
                <label for="qteStock">Quantité en Stock:</label>
                <input type="number" class="form-control" id="qteStock" name="qteStock" required>
            </div>
            <div class="form-group">
                <label for="seuilMin">Seuil Minimum:</label>
                <input type="number" class="form-control" id="seuilMin" name="seuilMin" required>
            </div>
            <div class="form-group">
                <label for="seuilMax">Seuil Maximum:</label>
                <input type="number" class="form-control" id="seuilMax" name="seuilMax" required>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
        </div>
     </div>
     </div>
</section>
</div>
    <?php include('../admin/includes/footer_user.php') ?>
