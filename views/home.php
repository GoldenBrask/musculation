<?php include 'header.php'; ?>
<h1>Accueil</h1>
<p>Bienvenue sur votre application de suivi de musculation.</p>

<div class="my-4">
    <a href="/exercices" class="btn btn-primary">Voir les Exercices</a>
    <a href="/performances" class="btn btn-secondary">Voir les Performances</a>
</div>

<?php if (!empty($performances)): ?>
    <div id="chartContainer" style="height: 400px; width: 100%;"></div>
    <script src="/js/canvasjs.min.js"></script>
    <script>
        const rawData = <?php echo json_encode($performances); ?>;
        const grouped = {};
        rawData.forEach(p => {
            if (!grouped[p.exercice_id]) {
                grouped[p.exercice_id] = {
                    name: p.nomExos,
                    dataPoints: []
                };
            }
            grouped[p.exercice_id].dataPoints.push({ x: new Date(p.date), y: parseFloat(p.poids) });
        });

        const chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title: { text: "Performances enregistrées" },
            axisX: { valueFormatString: "DD MMM YY" },
            axisY: { title: "Poids (kg)", includeZero: true },
            legend: { cursor: "pointer" }
        });

        chart.options.data = Object.values(grouped).map(g => ({
            type: "spline",
            name: g.name,
            showInLegend: true,
            dataPoints: g.dataPoints.reverse()
        }));

        chart.render();
    </script>
<?php else: ?>
    <p class="mt-4">Aucune performance enregistrée pour le moment. <a href="/performances">Ajoutez vos premières performances</a>.</p>
<?php endif; ?>

<?php include 'footer.php'; ?>
