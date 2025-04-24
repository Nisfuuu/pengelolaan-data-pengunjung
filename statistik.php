<!DOCTYPE html>
<html>
<head>
    <title>Statistik Pengunjung</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Statistik Pengunjung</h2>
    
    <select id="periode">
        <option value="harian">Harian</option>
        <option value="bulanan">Bulanan</option>
    </select>

    <canvas id="pengunjungChart" width="600" height="300"></canvas>

    <script>
        const ctx = document.getElementById('pengunjungChart').getContext('2d');
        let chart;

        function loadChart(periode = 'harian') {
            fetch(`data_statistik.php?periode=${periode}`)
                .then(res => res.json())
                .then(data => {
                    const labels = data.map(item => item.label);
                    const totals = data.map(item => item.total);

                    if (chart) chart.destroy();

                    chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: `Jumlah Pengunjung (${periode})`,
                                data: totals,
                                backgroundColor: '#04a777',
                                borderRadius: 5
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        }

        // Load default chart
        loadChart();

        document.getElementById('periode').addEventListener('change', (e) => {
            loadChart(e.target.value);
        });
    </script>
</body>
</html>
