<?php
$title = 'Exercices';
include 'header.php'; 
?>
<h1>Exercices</h1>
<form method="POST" action="/exercice/create">
    <div class="form-group">
        <label for="nom">Nom de l'exercice</label>
        <input type="text" class="form-control" id="nom" name="nom" required>
    </div>
    <div class="form-group">
        <label for="partie_corps_id">Partie du corps</label>
        <select class="form-control" id="partie_corps_id" name="partie_corps_id">
            <?php foreach ($parties as $partie): ?>
                <option value="<?= $partie['id'] ?>"><?= $partie['nom'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
<?php include 'footer.php'; ?>