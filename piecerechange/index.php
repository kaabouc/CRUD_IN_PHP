

<?php
include_once 'config.php';
include_once 'piècerechange.php';

$piècerechanges = piecerechange::getAllPiecesRechange();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des pieces</title>
</head>
<body>

    <a href="indexPiec.php">Gestion des pieces</a>
    <a href="indexRep.php">Gestion des reparation</a>
    <a href="indexReg.php"> Reglement</a>
    <a href="indexDel.php"> Details Reparation</a>
    <a href="indexDC.php">Details de commande </a>
    <a href="indexAP.php"> Appareils</a>
    <br>
    <br>
    <h3>Liste des pieces</h3>
    <br>
     <!-- Formulaire de recherche -->
<form action="rechercherP.php" method="GET">
    <input type="text" name="term" placeholder="Rechercher une pièce" >
    <input type="submit" value="Chercher">
</form>
    
    <br>
    <br>
    <table border="1">
        <tr>
            
            <th>Lib Pièce</th>
            <th>Qte Stock</th>
            <th>Seuil Min</th>
            <th> Seuil Max</th>
            
            <th>Actions</th>
        </tr>
       

        <?php  foreach ($piècerechanges as $piècerechange) { ?>
        <tr>
        
            <td><?php echo $piècerechange-> getLibPiece(); ?></td>
            <td><?php echo $piècerechange->getQteStock(); ?></td>
            <td><?php echo $piècerechange->getSeuilMin(); ?></td>
            <td><?php echo $piècerechange->getSeuilMax(); ?></td>
          
           
            <td>
                <a href="updateP.php?id=<?php echo $piècerechange-> getIdPiece(); ?>">Modifier</a> 
                <a href="deleteP1.php?id=<?php echo $piècerechange-> getIdPiece(); ?>">Supprimer</a>
            </td>
        </tr>
        <?php } ?>
    </table><br>
    <br>
 
    <br><br>
    <a href="createP1.php">Ajouter </a>
    <br>
    <br>
    <a href="deconnection.php">Se deconnecter</a>
</body>
</html>

















 