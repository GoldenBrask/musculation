<?php
$title = 'Détails de l\'exercice';
include 'header.php'; 
?>
<h1>Détails de l'exercice</h1>
<p><strong>Nom :</strong> <?= $details['nomExos'] ?></p>
<p><strong>Partie du corps :</strong> <?= $details['nomPartieCorps'] ?></p>

<h2 class="mt-4">Performances</h2>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="/js/canvasjs.min.js"></script>
<script>
window.onload = function () {
    var dataPoints = [
        <?php foreach ($performances as $performance): ?>
            { x: new Date("<?= $performance['date'] ?>"), y: <?= $performance['poids'] ?> },
        <?php endforeach; ?>
    ];

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2",
        title: {
            text: "Suivi des performances pour <?= $details['nomExos'] ?>"
        },
        axisX: {
            valueFormatString: "DD MMM YY"
        },
        axisY: {
            title: "Poids (kg)",
            includeZero: true
        },
        data: [{
            type: "spline",
            dataPoints: dataPoints
        }]
    });
    chart.render();
}
</script>

<table class="table mt-4">
    <thead>
        <tr>
            <th>Date</th>
            <th>Poids</th>
            <th>Séries</th>
            <th>Répétitions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($performances as $performance): ?>
            <tr>
                <td><?= $performance['date'] ?></td>
                <td><?= $performance['poids'] ?></td>
                <td><?= $performance['series'] ?></td>
                <td><?= $performance['repetitions'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>
