<!DOCTYPE html>
<?php include('../admin/includes/navbar.php') ?>

<?php
session_start();

if (!isset($_SESSION['idLogin']) || $_SESSION['userType'] != 'client') {
    header("Location: ../login.php");
    exit;
}

include_once '../config.php';
include_once '../appareil/Appareil.php';

$idUser = $_SESSION['idLogin'];
$query = "SELECT IdClient FROM Client WHERE IdUtilisateur = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $idUser);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $idClient = (int)$row['IdClient'];
    $appareils = Appareil::getAppareilsByClientId($idClient);
} else {
    // Gérer le cas où aucun client n'est trouvé pour cet utilisateur
    $idClient = null;
    $appareils = [];
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Appareils</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="container">
                        <h2>Liste de vos Appareils</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Appareil</th>
                                    <th>Type Appareil</th>
                                    <th>Modèle</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($appareils as $appareil){ ?>
                                    <tr>
                                        <td><?php echo $appareil->getIdAppareil(); ?></td>
                                        <td><?php echo $appareil->getTypeAppareil(); ?></td>
                                        <td><?php echo $appareil->getModele(); ?></td>
                                        <td>
                                            <a href="reparations.php?idAppareil=<?php echo $appareil->getIdAppareil(); ?>" class="btn btn-info">Voir</a>
                                        </td>
                                    </tr>
                                <?php } ?>
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
