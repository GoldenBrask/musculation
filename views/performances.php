<?php include 'header.php'; ?>
<h1>Performances</h1>
<form method="POST" action="/performance/create">
    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" class="form-control" id="date" name="date" value="<?= date('Y-m-d') ?>" required>
    </div>
    <div class="form-group">
        <label for="exercice_id">Exercice</label>
        <select class="form-control" id="exercice_id" name="exercice_id">
            <option value="">Sélectionnez un exercice</option>
            <?php foreach ($exercices as $exercice): ?>
                <option value="<?= $exercice['id'] ?>"><?= $exercice['nom'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="poids">Poids</label>
        <input type="number" class="form-control" id="poids" name="poids" required>
    </div>
    <div class="form-group">
        <label for="series">Séries</label>
        <input type="number" class="form-control" id="series" name="series" required>
    </div>
    <div class="form-group">
        <label for="repetitions">Répétitions</label>
        <input type="number" class="form-control" id="repetitions" name="repetitions" required>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
<script src="/public/js/popper.min.js"></script>
<script src="/public/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#exercice_id').change(function() {
        var exerciceId = $(this).val();
        if (exerciceId) {
            $.ajax({
                url: '/performance/data',
                type: 'GET',
                data: { exercice_id: exerciceId },
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        $('#poids').val(data.poids);
                        $('#series').val(data.series);
                        $('#repetitions').val(data.repetitions);
                    } else {
                        $('#poids').val('');
                        $('#series').val('');
                        $('#repetitions').val('');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                }
            });
        } else {
            $('#poids').val('');
            $('#series').val('');
            $('#repetitions').val('');
        }
    });
});
</script>
<?php include 'footer.php'; ?>
