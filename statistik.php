<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Pengunjung</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-300 to-indigo-400 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center p-4">

    <div class="w-full max-w-3xl bg-white/50 dark:bg-gray-800/60 backdrop-blur-md p-8 rounded-2xl shadow-xl space-y-6">
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white">Statistik Pengunjung</h2>
        
        <div class="flex justify-between items-center">
            <label for="periode" class="text-lg text-gray-700 dark:text-gray-300">Pilih Periode:</label>
            <select id="periode" class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="harian">Harian</option>
                <option value="bulanan">Bulanan</option>
            </select>
        </div>

        <canvas id="pengunjungChart" width="600" height="300"></canvas>
        <a href="index.php" style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Kembali ke Index</a>

    </div>

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
