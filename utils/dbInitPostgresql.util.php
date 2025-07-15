<?php 
require_once BASE_PATH . '/bootstrap.php';

try {
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

} catch (Exception $e) {
echo "❌ ERROR: " . $e->getMessage() . "\n";
exit(255);
}
