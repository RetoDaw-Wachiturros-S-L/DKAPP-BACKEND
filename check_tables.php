<?php
define('LARAVEL_START', microtime(true));
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$db = $app->make('database');
$connection = $db->connection();
$tables = $connection->select('SHOW TABLES FROM dkapp');

echo "Tablas en la base de datos dkapp:\n";
echo "==================================\n";
foreach($tables as $t) {
    $key = key((array)$t);
    echo $t->$key . "\n";
}
echo "\nTotal: " . count($tables) . " tablas\n";
?>
