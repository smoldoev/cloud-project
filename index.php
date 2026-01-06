<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard | Dark Edition</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* --- ТЕМНАЯ ТЕМА (DARK MODE) --- */
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

        /* Заголовок */
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
            -webkit-text-fill-color: transparent; /* Градиентный текст */
            letter-spacing: 1px;
        }
        .header p {
            margin: 10px 0 0;
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 300;
        }

        /* Статистика сверху */
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
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Глубокая тень */
            border: 1px solid rgba(255, 255, 255, 0.05); /* Тонкая рамка */
            transition: transform 0.2s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .stat-card { text-align: center; }
        .stat-label { 
            font-size: 12px; 
            color: var(--text-muted); 
            text-transform: uppercase; 
            letter-spacing: 1.5px; 
            margin-bottom: 10px; 
            font-weight: 500; 
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

        /* Графики */
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
            font-size: 18px; 
            font-weight: 600; 
            color: var(--text-main); 
        }
        .badge {
            background: rgba(255, 255, 255, 0.1);
            color: var(--accent-main);
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
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

        /* Футер */
        .footer {
            text-align: center;
            margin-top: 60px;
            color: rgba(255,255,255,0.2);
            font-size: 12px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>ENTERPRISE ANALYTICS</h1>
        <p>PHP • Docker • Render • Dark Edition</p>
    </div>

    <div class="stats-grid">
        <div class="card stat-card">
            <div class="stat-label">Total Revenue</div>
            <div class="stat-value">$24,500</div>
            <div class="stat-change text-green">▲ 12% vs last month</div>
        </div>
        <div class="card stat-card">
            <div class="stat-label">Active Users</div>
            <div class="stat-value">1,240</div>
            <div class="stat-change text-green">▲ 5% this week</div>
        </div>
        <div class="card stat-card">
            <div class="stat-label">Conversion Rate</div>
            <div class="stat-value">3.2%</div>
            <div class="stat-change text-red">▼ 0.5% decrease</div>
        </div>
        <div class="card stat-card">
            <div class="stat-label">Avg. Order Value</div>
            <div class="stat-value">$125</div>
            <div class="stat-change text-green">▲ Stable</div>
        </div>
    </div>

    <div class="exchange-grid">
        <div class="card">
            <div class="chart-header">
                <h3>USD Trend</h3>
                <span class="badge">Live JSON</span>
            </div>
            <div class="chart-container">
                <canvas id="chartUSD"></canvas>
            </div>
        </div>
        <div class="card">
            <div class="chart-header">
                <h3>CHF Trend</h3>
                <span class="badge">Live JSON</span>
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
                <span class="badge">Data</span>
            </div>
            <div class="chart-container">
                <canvas id="chartSales"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="chart-header">
                <h3>User Growth</h3>
                <span class="badge">Data</span>
            </div>
            <div class="chart-container">
                <canvas id="chartGrowth"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="chart-header">
                <h3>Traffic Sources</h3>
                <span class="badge">Data</span>
            </div>
            <div class="chart-container">
                <canvas id="chartTraffic"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="chart-header">
                <h3>Inventory Status</h3>
                <span class="badge">Data</span>
            </div>
            <div class="chart-container">
                <canvas id="chartInventory"></canvas>
            </div>
        </div>

    </div>

    <div class="footer">
        © 2026 Project Implementation | Secure Dashboard
    </div>

    <script>
        // Глобальные настройки для Темной темы (делаем текст белым, сетку прозрачной)
        Chart.defaults.color = '#94a3b8';
        Chart.defaults.borderColor = 'rgba(255, 255, 255, 0.05)';
        Chart.defaults.font.family = "'Poppins', sans-serif";

        // --- 1. USD Chart (Neon Green) ---
        new Chart(document.getElementById('chartUSD'), {
            type: 'line',
            data: {
                labels: ['Dec 7', 'Dec 10', 'Dec 14', 'Dec 17', 'Dec 21', 'Dec 24', 'Dec 28', 'Jan 4'],
                datasets: [{
                    label: 'USD',
                    data: [3.63, 3.62, 3.60, 3.59, 3.60, 3.58, 3.60, 3.61],
                    borderColor: '#4ade80', // Neon Green
                    backgroundColor: 'rgba(74, 222, 128, 0.1)', // Glow effect
                    borderWidth: 3,
                    pointBackgroundColor: '#0f172a',
                    pointBorderColor: '#4ade80',
                    pointBorderWidth: 2,
                    tension: 0.4, // Smooth curves
                    fill: true
                }]
            },
            options: { maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false } } } }
        });

        // --- 2. CHF Chart (Neon Pink) ---
        new Chart(document.getElementById('chartCHF'), {
            type: 'line',
            data: {
                labels: ['Dec 7', 'Dec 10', 'Dec 14', 'Dec 17', 'Dec 21', 'Dec 24', 'Dec 28', 'Jan 4'],
                datasets: [{
                    label: 'CHF',
                    data: [4.53, 4.51, 4.53, 4.50, 4.52, 4.55, 4.53, 4.52],
                    borderColor: '#f472b6', // Neon Pink
                    backgroundColor: 'rgba(244, 114, 182, 0.1)',
                    borderWidth: 3,
                    pointBackgroundColor: '#0f172a',
                    pointBorderColor: '#f472b6',
                    pointBorderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: { maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false } } } }
        });

        // --- 3. SALES (Blue Gradient Bars) ---
        new Chart(document.getElementById('chartSales'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'Sales',
                    data: [120, 150, 180, 140, 210], 
                    backgroundColor: '#38bdf8', // Light Blue
                    borderRadius: 6,
                    barPercentage: 0.6
                }]
            },
            options: { maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
        });

        // --- 4. GROWTH (Purple Bars) ---
        new Chart(document.getElementById('chartGrowth'), {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
                datasets: [{
                    label: 'Users',
                    data: [10, 12, 8, 15, 11],
                    backgroundColor: '#c084fc', // Purple
                    borderRadius: 6,
                    barPercentage: 0.6
                }]
            },
            options: { maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
        });

        // --- 5. TRAFFIC (Pie - Neon Colors) ---
        new Chart(document.getElementById('chartTraffic'), {
            type: 'doughnut', // Changed to Doughnut for modern look
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

        // --- 6. INVENTORY (Doughnut - Neon Colors) ---
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
