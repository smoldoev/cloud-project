<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise Analytics Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            color: #1a202c;
            font-weight: 700;
        }
        .header p {
            margin: 8px 0 0;
            color: #718096;
            font-size: 14px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border: 1px solid #edf2f7;
        }
        .stat-card {
            text-align: center;
        }
        .stat-label { font-size: 11px; color: #a0aec0; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 8px; font-weight: 600; }
        .stat-value { font-size: 28px; font-weight: 700; color: #2d3748; margin-bottom: 4px; }
        .stat-change { font-size: 13px; font-weight: 500; }
        .text-green { color: #38a169; }
        .text-red { color: #e53e3e; }

        .exchange-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .chart-header h3 { margin: 0; font-size: 16px; font-weight: 600; color: #2d3748; }
        .badge {
            background: #fff;
            color: #718096;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 500;
            border: 1px solid #cbd5e0;
        }
        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }

        .main-charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 20px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Enterprise Analytics Dashboard</h1>
        <p>Cloud Technology Project • PHP • Docker • Render</p>
    </div>

    <div class="stats-grid">
        <div class="card stat-card">
            <div class="stat-label">Total Revenue</div>
            <div class="stat-value">$24,500</div>
            <div class="stat-change text-green">↑ 12% vs last month</div>
        </div>
        <div class="card stat-card">
            <div class="stat-label">Active Users</div>
            <div class="stat-value">1,240</div>
            <div class="stat-change text-green">↑ 5% this week</div>
        </div>
        <div class="card stat-card">
            <div class="stat-label">Conversion Rate</div>
            <div class="stat-value">3.2%</div>
            <div class="stat-change text-red">↓ 0.5% decrease</div>
        </div>
        <div class="card stat-card">
            <div class="stat-label">Avg. Order Value</div>
            <div class="stat-value">$125</div>
            <div class="stat-change text-green">↑ Stable</div>
        </div>
    </div>

    <div class="exchange-grid">
        <div class="card">
            <div class="chart-header">
                <h3>USD Exchange Rate (Last 20)</h3>
                <span class="badge">JSON Source</span>
            </div>
            <div class="chart-container">
                <canvas id="chartUSD"></canvas>
            </div>
        </div>
        <div class="card">
            <div class="chart-header">
                <h3>CHF Exchange Rate (Last 20)</h3>
                <span class="badge">JSON Source</span>
            </div>
            <div class="chart-container">
                <canvas id="chartCHF"></canvas>
            </div>
        </div>
    </div>

    <div class="main-charts-grid">
        
        <div class="card">
            <div class="chart-header">
                <h3>Monthly Sales</h3>
                <span class="badge">Live Data</span>
            </div>
            <div class="chart-container">
                <canvas id="chartSales"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="chart-header">
                <h3>User Growth</h3>
                <span class="badge">Live Data</span>
            </div>
            <div class="chart-container">
                <canvas id="chartGrowth"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="chart-header">
                <h3>Traffic Sources</h3>
                <span class="badge">Live Data</span>
            </div>
            <div class="chart-container">
                <canvas id="chartTraffic"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="chart-header">
                <h3>Product Inventory</h3>
                <span class="badge">Live Data</span>
            </div>
            <div class="chart-container">
                <canvas id="chartInventory"></canvas>
            </div>
        </div>

    </div>

    <div style="text-align: center; margin-top: 50px; color: #cbd5e0; font-size: 12px;">
        © 2026 Cloud Project Implementation
    </div>

    <script>
        new Chart(document.getElementById('chartUSD'), {
            type: 'line',
            data: {
                labels: ['Dec 7', 'Dec 10', 'Dec 14', 'Dec 17', 'Dec 21', 'Dec 24', 'Dec 28', 'Jan 4'],
                datasets: [{
                    label: 'USD',
                    data: [3.63, 3.62, 3.60, 3.59, 3.60, 3.58, 3.60, 3.61],
                    borderColor: '#38a169',
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: '#38a169',
                    tension: 0.1,
                    fill: false
                }]
            },
            options: { maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false } } } }
        });

        new Chart(document.getElementById('chartCHF'), {
            type: 'line',
            data: {
                labels: ['Dec 7', 'Dec 10', 'Dec 14', 'Dec 17', 'Dec 21', 'Dec 24', 'Dec 28', 'Jan 4'],
                datasets: [{
                    label: 'CHF',
                    data: [4.53, 4.51, 4.53, 4.50, 4.52, 4.55, 4.53, 4.52],
                    borderColor: '#e53e3e',
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: '#e53e3e',
                    tension: 0.1,
                    fill: false
                }]
            },
            options: { maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false } } } }
        });

        new Chart(document.getElementById('chartSales'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'Sales',
                    data: [120, 150, 180, 140, 210], 
                    backgroundColor: '#3182ce',
                    borderRadius: 4
                }]
            },
            options: { maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
        });

        new Chart(document.getElementById('chartGrowth'), {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
                datasets: [{
                    label: 'Users',
                    data: [10, 12, 8, 15, 11],
                    backgroundColor: '#38a169',
                    borderRadius: 4
                }]
            },
            options: { maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
        });

        new Chart(document.getElementById('chartTraffic'), {
            type: 'doughnut',
            data: {
                labels: ['Google', 'YouTube', 'Instagram', 'Facebook', 'TikTok'],
                datasets: [{
                    data: [27, 21, 19, 15, 17],
                    backgroundColor: ['#e53e3e', '#dd6b20', '#d69e2e', '#3182ce', '#2d3748'],
                    borderWidth: 0
                }]
            },
            options: { maintainAspectRatio: false, plugins: { legend: { position: 'right' } } }
        });

        new Chart(document.getElementById('chartInventory'), {
            type: 'doughnut',
            data: {
                labels: ['Keyboard', 'Phone', 'Monitor', 'Laptop', 'Tablet'],
                datasets: [{
                    data: [28, 24, 18, 12, 17],
                    backgroundColor: ['#718096', '#ecc94b', '#2d3748', '#805ad5', '#dd6b20'],
                    borderWidth: 0
                }]
            },
            options: { maintainAspectRatio: false, plugins: { legend: { position: 'right' } } }
        });
    </script>
</body>
</html>
