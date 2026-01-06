<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$db = new SQLite3('store.db');
$type = $_GET['type'] ?? '';
$data = ['labels' => [], 'values' => []];

if ($type == 'sales') {
    $res = $db->query("SELECT month, amount FROM sales");
    while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
        $data['labels'][] = $row['month'];
        $data['values'][] = $row['amount'];
    }
} elseif ($type == 'users') {
    $res = $db->query("SELECT day, count FROM users");
    while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
        $data['labels'][] = $row['day'];
        $data['values'][] = $row['count'];
    }
} elseif ($type == 'traffic') {
    $res = $db->query("SELECT source, percent FROM traffic");
    while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
        $data['labels'][] = $row['source'];
        $data['values'][] = $row['percent'];
    }
} elseif ($type == 'categories') {
    $res = $db->query("SELECT name, stock FROM categories");
    while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
        $data['labels'][] = $row['name'];
        $data['values'][] = $row['stock'];
    }
} else {
    echo json_encode(["error" => "Invalid type parameter"]);
    exit;
}

echo json_encode($data);
?>