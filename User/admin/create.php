<?php include('../admin/includes/header_user.php') ?>
<div class="content-wrapper">
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
              
             <div class="container">
        <h2>Créer un Utilisateur</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="form-group"> 
                <label for="prenom">Prénom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="tel">Téléphone:</label>
                <input type="tel" class="form-control" id="tel" name="tel">
            </div>
            <div class="form-group">
        <label for="type">Type d'utilisateur:</label>
        <select class="form-control" id="type" name="type" required>
            <option value="client">Client</option>
            <option value="agent">Agent de Réparation</option>
            <option value="admin">Administrateur</option>
        </select>
    </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="motDePasse" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
     </div>
     </div>
</section>
</div>
    <?php include('../admin/includes/footer_user.php') ?>
