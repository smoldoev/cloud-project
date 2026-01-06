<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise Analytics Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.plot.ly/plotly-2.27.0.min.js"></script>
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 24px; }
        .kpi-label { font-size: 0.85rem; color: #6c757d; text-transform: uppercase; letter-spacing: 1px; }
        .kpi-value { font-size: 2rem; font-weight: 700; color: #2c3e50; }
        .btn-test { font-size: 0.75rem; padding: 4px 12px; }
    </style>
</head>
<body class="p-4">

<?php
function fetchData($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $output = curl_exec($ch);
    curl_close($ch);
    return json_decode($output, true);
}

$nbp_usd = "http://api.nbp.pl/api/exchangerates/rates/a/usd/last/20/?format=json";
$nbp_chf = "http://api.nbp.pl/api/exchangerates/rates/a/chf/last/20/?format=json";

$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$host = $_SERVER['HTTP_HOST'];
$my_api_url = "$protocol://$host/api.php";

$usdData = fetchData($nbp_usd);
$chfData = fetchData($nbp_chf);

$salesData = fetchData("$my_api_url?type=sales");
$userData = fetchData("$my_api_url?type=users");
$trafficData = fetchData("$my_api_url?type=traffic");
$catData = fetchData("$my_api_url?type=categories");
?>

<div class="container">
    <div class="text-center mb-5">
        <h2>Enterprise Analytics Dashboard</h2>
        <p class="text-muted">Cloud Technology Project • PHP • Docker • Render</p>
    </div>

    <div class="row text-center mb-4">
        <div class="col-md-3">
            <div class="card p-3">
                <div class="kpi-label">Total Revenue</div>
                <div class="kpi-value">$24,500</div>
                <small class="text-success">↑ 12% vs last month</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <div class="kpi-label">Active Users</div>
                <div class="kpi-value">1,240</div>
                <small class="text-primary">↑ 5% this week</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <div class="kpi-label">Conversion Rate</div>
                <div class="kpi-value">3.2%</div>
                <small class="text-danger">↓ 0.5% decrease</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3">
                <div class="kpi-label">Avg. Order Value</div>
                <div class="kpi-value">$125</div>
                <small class="text-success">↑ Stable</small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0">USD Exchange Rate (Last 20)</h5>
                    <a href="<?php echo $nbp_usd; ?>" target="_blank" class="btn btn-outline-secondary btn-test">JSON Source</a>
                </div>
                <div id="usdChart"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0">CHF Exchange Rate (Last 20)</h5>
                    <a href="<?php echo $nbp_chf; ?>" target="_blank" class="btn btn-outline-secondary btn-test">JSON Source</a>
                </div>
                <div id="chfChart"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0">Monthly Sales</h5>
                    <a href="api.php?type=sales" target="_blank" class="btn btn-primary btn-test">Test API</a>
                </div>
                <div id="salesChart"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0">User Growth</h5>
                    <a href="api.php?type=users" target="_blank" class="btn btn-primary btn-test">Test API</a>
                </div>
                <div id="usersChart"></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0">Traffic Sources</h5>
                    <a href="api.php?type=traffic" target="_blank" class="btn btn-primary btn-test">Test API</a>
                </div>
                <div id="trafficChart"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="m-0">Product Inventory</h5>
                    <a href="api.php?type=categories" target="_blank" class="btn btn-primary btn-test">Test API</a>
                </div>
                <div id="catChart"></div>
            </div>
        </div>
    </div>
</div>

<script>
    const layout = { responsive: true, height: 320, margin: {t:20, b:30, l:40, r:20} };

    const usdX = <?php echo json_encode(array_column($usdData['rates'], 'effectiveDate')); ?>;
    const usdY = <?php echo json_encode(array_column($usdData['rates'], 'mid')); ?>;
    Plotly.newPlot('usdChart', [{x: usdX, y: usdY, type: 'scatter', mode: 'lines+markers', line: {color: '#198754'}}], layout);

    const chfX = <?php echo json_encode(array_column($chfData['rates'], 'effectiveDate')); ?>;
    const chfY = <?php echo json_encode(array_column($chfData['rates'], 'mid')); ?>;
    Plotly.newPlot('chfChart', [{x: chfX, y: chfY, type: 'scatter', mode: 'lines+markers', line: {color: '#dc3545'}}], layout);

    const sales = <?php echo json_encode($salesData); ?>;
    if(sales) Plotly.newPlot('salesChart', [{x: sales.labels, y: sales.values, type: 'bar', marker:{color:'#0d6efd'}}], layout);

    const users = <?php echo json_encode($userData); ?>;
    if(users) Plotly.newPlot('usersChart', [{x: users.labels, y: users.values, type: 'bar', marker:{color:'#0dcaf0'}}], layout);

    const traffic = <?php echo json_encode($trafficData); ?>;
    if(traffic) Plotly.newPlot('trafficChart', [{labels: traffic.labels, values: traffic.values, type: 'pie', hole: 0.4}], layout);

    const cats = <?php echo json_encode($catData); ?>;
    if(cats) Plotly.newPlot('catChart', [{labels: cats.labels, values: cats.values, type: 'pie', hole: 0.4}], layout);
</script>

<div class="text-center pb-4 text-muted">
    <small>&copy; 2026 Cloud Project Implementation</small>
</div>

</body>
</html>