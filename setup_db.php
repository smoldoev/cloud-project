<?php
$db = new SQLite3('store.db');

$db->exec("DROP TABLE IF EXISTS sales");
$db->exec("DROP TABLE IF EXISTS users");
$db->exec("DROP TABLE IF EXISTS traffic");
$db->exec("DROP TABLE IF EXISTS categories");

$db->exec("CREATE TABLE sales (id INTEGER PRIMARY KEY, month TEXT, amount INTEGER)");
$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
foreach ($months as $m) {
    $amt = rand(150, 500);
    $db->exec("INSERT INTO sales (month, amount) VALUES ('$m', $amt)");
}

$db->exec("CREATE TABLE users (id INTEGER PRIMARY KEY, day TEXT, count INTEGER)");
$days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
$base = 400;
foreach ($days as $d) {
    $base += rand(20, 100);
    $db->exec("INSERT INTO users (day, count) VALUES ('$d', $base)");
}

$db->exec("CREATE TABLE traffic (id INTEGER PRIMARY KEY, source TEXT, percent INTEGER)");
$traffic = [['Google Search', 45], ['Social Media', 25], ['Direct', 20], ['Ads', 10]];
foreach ($traffic as $row) {
    $db->exec("INSERT INTO traffic (source, percent) VALUES ('{$row[0]}', {$row[1]})");
}

$db->exec("CREATE TABLE categories (id INTEGER PRIMARY KEY, name TEXT, stock INTEGER)");
$cats = [['Electronics', 120], ['Clothing', 80], ['Home', 200], ['Sports', 50]];
foreach ($cats as $row) {
    $db->exec("INSERT INTO categories (name, stock) VALUES ('{$row[0]}', {$row[1]})");
}

echo "Database (store.db) created and populated successfully.";
?>