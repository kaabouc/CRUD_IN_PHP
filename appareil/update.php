<?php
include_once '../config.php';
include_once 'Appareil.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $IdClient = $_POST['IdClient'];
    $typeAppareil = $_POST['typeAppareil'];
    $modele = $_POST['modele'];
   

    $appareil = new Appareil($IdClient, $typeAppareil, $modele);
    $appareil->setIdAppareil($id);
    $appareil->update();
    header("Location: index.php");
    exit();
}

if(isset($_GET['idAppareil'])) {
    $id = $_GET['idAppareil'];
    $appareil = Appareil::getAppareilById($id);
    if(!$appareil) {
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
        <h2>Modifier un Appareil</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="id" value="<?php echo $appareil->getIdAppareil(); ?>">
            <div class="form-group">
                <label for="nom">IdClient:</label>
                <input type="text" class="form-control" id="nom" name="IdClient" value="<?php echo $appareil->getIdClient(); ?>" required>
            </div>
            <div class="form-group">
                <label for="prenom">Type appareil :</label>
                <input type="text" class="form-control" id="prenom" name="typeAppareil" value="<?php echo $appareil->getTypeAppareil(); ?>" required>
            </div>
            <div class="form-group">
                <label for="text">Module:</label>
                <input type="text" class="form-control" id="email" name="modele" value="<?php echo $appareil->getModele(); ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
        </div>
     </div>
     </div>
</section>
</div>
    <?php include('../admin/includes/footer_user.php') ?>