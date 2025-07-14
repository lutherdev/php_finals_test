<?php
declare(strict_types=1);

require_once 'bootstrap.php';

require_once DUMMIES_PATH . '/users.staticData.php';
require_once DUMMIES_PATH . '/items.staticData.php';
require_once UTILS_PATH . '/items.util.php';
require_once UTILS_PATH . '/users.util.php';

$dsn = "pgsql:host={$dbConfig['pgHost']};port={$dbConfig['pgPort']};dbname={$dbConfig['pgDB']}";

try {
    $pdo = new PDO($dsn, $dbConfig['pgUser'], $dbConfig['pgPassword'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    echo "Connected to PostgreSQL!\n";
    $checkStmt = $pdo->query("SELECT to_regclass('public.users')");
    $tableExists = $checkStmt->fetchColumn();

    if (!$tableExists) {
        throw new Exception("Table 'users' does not exist. Please run migrations first.");
    }
    echo "Seeding users…\n";
    $pdo->beginTransaction();
    foreach ($users as $u) {
        try {
            insertUser($pdo, $u);
            echo "Inserted user: {$u['username']}\n";
        } catch (PDOException $e) {
            echo "Failed to insert {$u['username']}: " . $e->getMessage() . "\n";
        }
    }
    $pdo->commit();
    echo "All users seeded.\n\n";


    echo "Seeding items…\n";  
    $pdo->beginTransaction();
    foreach ($products as $item) {
        try {
            insertItem($pdo, $item);
            echo "Inserted item: {$item['name']}\n";
        } catch (PDOException $e) {
            echo "Failed to item {$item['name']}: " . $e->getMessage() . "\n";
        }
    }
    $pdo->commit();
    echo "All items seeded.\n\n";

    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        echo "---------------------------\n";
        echo "User ID:    {$user['id']}\n";
        echo "Username:   {$user['username']}\n";
        echo "First Name: {$user['first_name']}\n";
        echo "Last Name:  {$user['last_name']}\n";
        echo "Role:       {$user['role']}\n";
        echo "Wallet:     {$user['role']}\n";
        echo "---------------------------\n";
    }

    $stmt = $pdo->query("SELECT * FROM items");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($items as $item) {
        echo "---------------------------\n";
        echo "Item Name:    {$item['name']}\n";
        echo "Price:   {$item['price']}\n";
        echo "Description: {$item['description']}\n";
        echo "Quantity:  {$item['quantity']}\n";
        echo "Category:       {$item['category']}\n";
        echo "Status:     {$item['status']}\n";
        echo "---------------------------\n";
    }

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    exit(255);
}