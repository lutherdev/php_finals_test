<?php
declare(strict_types=1);

require_once 'bootstrap.php';

// $pgConfig = [
// 'host' => $dbConfig['pgHost'],
// 'port' => $dbConfig['pgPort'],
// 'db'   => $dbConfig['pgDB'],
// 'user' => $dbConfig['pgUser'],
// 'pass' => $dbConfig['pgPassword'],
// ];


// $dsn = "pgsql:host={$pgConfig['host']};port={$pgConfig['port']};dbname={$pgConfig['db']}";
 try {
// $pdo = new PDO($dsn, $pgConfig['user'], $pgConfig['pass'], [
//     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
// ]);

echo "Connected to PostgreSQL!\n";

$dbfiles = ['database/users.model.sql', 'database/items.model.sql', 'database/users_messages.model.sql', 'database/item_orders.model.sql'];

foreach ($dbfiles as $dbfile){
$num = 1;
$sql = file_get_contents($dbfile);
if (!$sql) {
    throw new RuntimeException("❌ Could not read the SQL file");
}
echo "✅ Tables $num created.\n";
$pdo->exec($sql);
$num++;
}

echo "✅ All Tables created successfully.\n";

foreach (['items', 'users', 'item_orders', 'users_messages'] as $table) {
    $pdo->exec("TRUNCATE TABLE {$table} RESTART IDENTITY CASCADE;");
    echo "the table $table has been truncated. \n";
}

echo "✅ All Tables truncated.\n";

} catch (Exception $e) {
echo "❌ ERROR: " . $e->getMessage() . "\n";
exit(255);
}