<?php
$title = 'Inscription';
include 'header.php';
?>
<h1>Inscription</h1>
<?php if (isset($error)): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>
<form method="POST" action="/register">
    <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" class="form-control" id="username" name="username" required minlength="3" maxlength="18" pattern="[A-Za-z0-9]{3,18}">
        <small id="username-feedback" class="form-text"></small>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary my-2">S'inscrire</button>
</form>
<p>Déjà un compte ? <a href="/login">Connectez-vous</a></p>
<script src="/js/register.js"></script>
<?php include 'footer.php'; ?>
