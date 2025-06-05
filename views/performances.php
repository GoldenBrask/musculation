<?php include 'header.php'; ?>
<h1>Performances</h1>
<form method="POST" action="/performance/create">
    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" class="form-control" id="date" name="date" value="<?= $date ?>" required>
    </div>
    <div class="form-group">
        <label for="exercice_id">Exercice</label>
        <select class="form-control" id="exercice_id" name="exercice_id" required>
            <option value="">Sélectionnez un exercice</option>
            <?php foreach ($exercices as $exercice): ?>
                <option value="<?= $exercice['id'] ?>"><?= $exercice['nomExos'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="poids">Poids</label>
        <input type="number" class="form-control" id="poids" min="1" name="poids" required>
    </div>
    <div class="form-group">
        <label for="series">Séries</label>
        <input type="number" class="form-control" id="series" name="series" min="1" required>
    </div>
    <div class="form-group">
        <label for="repetitions">Répétitions</label>
        <input type="number" class="form-control" id="repetitions" min="1" name="repetitions" required>
    </div>
    <button type="submit" class="btn btn-primary my-2">Ajouter</button>
</form>
<h2 class="mt-4">Liste des performances</h2>
<form method="POST" action="/performance/filter">
    <div class="form-group my-4">
        <label for="partie_corps_id">Filtrer par partie du corps</label>
        <select class="form-control" id="partie_corps_id" name="partie_corps_id">
            <option value="0">Sélectionnez une partie du corps</option>
            <?php foreach ($parties as $partie): ?>
                <option value="<?= $partie['id'] ?>"><?= $partie['nom'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</form>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Date</th>
            <th>Exercice</th>
            <th>Poids</th>
            <th>Séries</th>
            <th>Répétitions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($performances as $performance): ?>
            <tr>
                <td><?= $performance['idPerf'] ?></td>
                <td><?= $performance['date'] ?></td>
                <td><?= $performance['nomExos'] ?></td>
                <td><?= $performance['poids'] ?></td>
                <td><?= $performance['series'] ?></td>
                <td><?= $performance['repetitions'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

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

    $('#partie_corps_id').change(function() {
        var partieCorpsId = $(this).val();
        var currentDate = $('#date').val() || new URLSearchParams(window.location.search).get('date');

        $.ajax({
            url: '/performance/filter',
            type: 'POST',
            data: { partie_corps_id: partieCorpsId, date: currentDate },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    var performances = data.performances;
                    var tbody = '';
                    performances.forEach(function(performance) {
                        tbody += '<tr>';
                        tbody += '<td>' + performance.idPerf + '</td>';
                        tbody += '<td>' + performance.date + '</td>';
                        tbody += '<td>' + performance.nomExos + '</td>';
                        tbody += '<td>' + performance.poids + '</td>';
                        tbody += '<td>' + performance.series + '</td>';
                        tbody += '<td>' + performance.repetitions + '</td>';
                        tbody += '</tr>';
                    });
                    $('table tbody').html(tbody);
                } else {
                    $('table tbody').html('<tr><td colspan="6">Pas de données disponibles</td></tr>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
            }
        });
    });
});
</script>
<?php include 'footer.php'; ?>
