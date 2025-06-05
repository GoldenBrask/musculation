<?php
$title = 'Connexion';
include 'header.php';
?>
<h1>Connexion</h1>
<?php if (isset($error)): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>
<form method="POST" action="/login">
    <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary my-2">Se connecter</button>
</form>
<p>Pas encore de compte ? <a href="/register">Inscrivez-vous</a></p>
<?php include 'footer.php'; ?>
