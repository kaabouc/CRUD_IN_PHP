<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une pièce de rechange</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Ajouter une pièce de rechange</h2>
        <form method="POST" action="process_piece.php">
            <div class="form-group">
                <label for="libPiece">Libellé:</label>
                <input type="text" class="form-control" id="libPiece" name="libPiece" required>
            </div>
            <div class="form-group">
                <label for="qteStock">Quantité en stock:</label>
                <input type="number" class="form-control" id="qteStock" name="qteStock" required>
            </div>
            <div class="form-group">
                <label for="seuilMin">Seuil minimum:</label>
                <input type="number" class="form-control" id="seuilMin" name="seuilMin" required>
            </div>
            <div class="form-group">
                <label for="seuilMax">Seuil maximum:</label>
                <input type="number" class="form-control" id="seuilMax" name="seuilMax" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>
</html>
