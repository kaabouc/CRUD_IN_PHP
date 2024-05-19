<?php
include_once '../config.php';
include_once 'Appareil.php';
include_once '../class/Client.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idClient = $_POST['idClient']; // Correction ici
    $typeAppareil = $_POST['typeAppareil'];
    $modele = $_POST['modele'];

    $appareil = new Appareil($idClient, $typeAppareil, $modele);
    $appareil->save();

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
        <h2>Créer un Appareil</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
        <label for="idClient">ID Client:</label>
        <select class="form-control" id="idClient" name="idClient" required>
            <?php
            // Inclure le fichier de configuration et la classe Client
            include_once '../config.php';
            include_once '../class/Client.php';

            // Récupérer tous les clients depuis la base de données
            $clients = Client::getAllClients();

            // Afficher chaque client dans la liste déroulante
            foreach ($clients as $client) {
                echo "<option value='" . $client->getIdClient() . "'>" . $client->getIdClient() . "</option>";
            }
            ?>
        </select>
    </div>
            
            <div class="form-group"> 
                <label for="typeAppareil">Type d'appareil:</label>
                <input type="text" class="form-control" id="typeAppareil" name="typeAppareil" required>
            </div>
            <div class="form-group">
                <label for="modele">Modèle:</label>
                <input type="text" class="form-control" id="modele" name="modele" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
        </div>
     </div>
     </div>
</section>
</div>
    <?php include('../admin/includes/footer_user.php') ?>
