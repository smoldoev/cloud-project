<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cortex System Monitor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        
        :root {
            --bg-body: #0f172a;       
            --bg-card: #1e293b;       
            --text-main: #f8fafc;     
            --text-muted: #94a3b8;    
            --accent-main: #38bdf8;   
            --accent-pink: #f472b6;   
            --accent-green: #4ade80;  
            --accent-purple: #c084fc; 
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            margin: 0;
            padding: 40px;
        }

        
        .header {
            text-align: center;
            margin-bottom: 50px;
        }
        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            background: linear-gradient(90deg, var(--accent-main), var(--accent-pink));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent; 
            letter-spacing: 2px; 
            text-transform: uppercase;
        }
        .header p {
            margin: 10px 0 0;
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 300;
            letter-spacing: 1px;
        }

        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-bottom: 35px;
        }
        .card {
            background: var(--bg-card);
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); 
            border: 1px solid rgba(255, 255, 255, 0.05); 
            transition: transform 0.2s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .stat-card { text-align: center; }
        .stat-label { 
            font-size: 11px; 
            color: var(--text-muted); 
            text-transform: uppercase; 
            letter-spacing: 1.5px; 
            margin-bottom: 10px; 
            font-weight: 600; 
        }
        .stat-value { 
            font-size: 32px; 
            font-weight: 700; 
            color: var(--text-main); 
            margin-bottom: 5px; 
        }
        .stat-change { font-size: 13px; font-weight: 500; }
        .text-green { color: var(--accent-green); }
        .text-red { color: #ef4444; }

        
        .exchange-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 25px;
            margin-bottom: 35px;
        }
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .chart-header h3 { 
            margin: 0; 
            font-size: 16px; 
            font-weight: 600; 
            color: var(--text-main); 
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .badge {
            background: rgba(255, 255, 255, 0.1);
            color: var(--accent-main);
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }

        .main-charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 25px;
        }

        .footer {
            text-align: center;
            margin-top: 60px;
            color: rgba(255,255,255,0.2);
            font-size: 12px;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>CORTEX MONITORING SYSTEM</h1>
        <p>PHP • Cloud Cluster • Real-time Data</p>
    </div>

    <div class="stats-grid">
        <div class="card stat-card">
            <div class="stat-label">Total Earnings</div>
            <div class="stat-value">$24,500</div>
            <div class="stat-change text-green">▲ 12% growth</div>
        </div>
        <div class="card stat-card">
            <div class="stat-label">Active Sessions</div>
            <div class="stat-value">1,240</div>
            <div class="stat-change text-green">▲ 5% load</div>
        </div>
        <div class="card stat-card">
            <div class="stat-label">System Uptime</div>
            <div class="stat-value">99.8%</div>
            <div class="stat-change text-red">▼ 0.2% latency</div>
        </div>
        <div class="card stat-card">
            <div class="stat-label">Avg. Transaction</div>
            <div class="stat-value">$125</div>
            <div class="stat-change text-green">▲ Stable</div>
        </div>
    </div>

    <div class="exchange-grid">
        <div class="card">
            <div class="chart-header">
                <h3>USD Market Trend</h3>
                <span class="badge">Live API</span>
            </div>
            <div class="chart-container">
                <canvas id="chartUSD"></canvas>
            </div>
        </div>
        <div class="card">
            <div class="chart-header">
                <h3>CHF Market Trend</h3>
                <span class="badge">Live API</span>
            </div>
            <div class="chart-container">
                <canvas id="chartCHF"></canvas>
            </div>
        </div>
    </div>

    <div class="main-charts-grid">
        
        <div class="card">
            <div class="chart-header">
                <h3>Revenue Velocity</h3> <span class="badge">Financials</span>
            </div>
            <div class="chart-container">
                <canvas id="chartSales"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="chart-header">
                <h3>New Subscribers</h3> <span class="badge">User Base</span>
            </div>
            <div class="chart-container">
                <canvas id="chartGrowth"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="chart-header">
                <h3>Lead Acquisition</h3> <span class="badge">Channels</span>
            </div>
            <div class="chart-container">
                <canvas id="chartTraffic"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="chart-header">
                <h3>Asset Distribution</h3> <span class="badge">Logistics</span>
            </div>
            <div class="chart-container">
                <canvas id="chartInventory"></canvas>
            </div>
        </div>

    </div>

    <div class="footer">
        © 2026 Cortex Systems Inc. | Cloud Technology Final Project
    </div>

    <script>
        
        Chart.defaults.color = '#94a3b8';
        Chart.defaults.borderColor = 'rgba(255, 255, 255, 0.05)';
        Chart.defaults.font.family = "'Poppins', sans-serif";

        
        new Chart(document.getElementById('chartUSD'), {
            type: 'line',
            data: {
                labels: ['Dec 7', 'Dec 10', 'Dec 14', 'Dec 17', 'Dec 21', 'Dec 24', 'Dec 28', 'Jan 4'],
                datasets: [{
                    label: 'USD',
                    data: [3.63, 3.62, 3.60, 3.59, 3.60, 3.58, 3.60, 3.61],
                    borderColor: '#4ade80',
                    backgroundColor: 'rgba(74, 222, 128, 0.1)',
                    borderWidth: 3,
                    pointBackgroundColor: '#0f172a',
                    pointBorderColor: '#4ade80',
                    tension: 0.4,
                    fill: true
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
                    borderColor: '#f472b6',
                    backgroundColor: 'rgba(244, 114, 182, 0.1)',
                    borderWidth: 3,
                    pointBackgroundColor: '#0f172a',
                    pointBorderColor: '#f472b6',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: { maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false } } } }
        });

        
        new Chart(document.getElementById('chartSales'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'Revenue',
                    data: [120, 150, 180, 140, 210], 
                    backgroundColor: '#38bdf8',
                    borderRadius: 6,
                    barPercentage: 0.6
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
                    backgroundColor: '#c084fc',
                    borderRadius: 6,
                    barPercentage: 0.6
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
                    backgroundColor: ['#f472b6', '#fb923c', '#fbbf24', '#38bdf8', '#a78bfa'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: { maintainAspectRatio: false, plugins: { legend: { position: 'right', labels: { usePointStyle: true, boxWidth: 8 } } } }
        });

        
        new Chart(document.getElementById('chartInventory'), {
            type: 'doughnut',
            data: {
                labels: ['Keyboard', 'Phone', 'Monitor', 'Laptop', 'Tablet'],
                datasets: [{
                    data: [28, 24, 18, 12, 17],
                    backgroundColor: ['#94a3b8', '#38bdf8', '#22d3ee', '#818cf8', '#c084fc'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: { maintainAspectRatio: false, plugins: { legend: { position: 'right', labels: { usePointStyle: true, boxWidth: 8 } } } }
        });
    </script>
</body>
</html>

