<?php
require_once BASE_PATH . '/bootstrap.php'; 
require_once UTILS_PATH . '/auth.util.php';

Auth::init();

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['cart']) || empty($data['cart'])) {
    http_response_code(400);
    echo json_encode(["message" => "Cart is empty."]);
    exit;
}

$user = Auth::user();

if (!is_array($user) || !isset($user['id'])) {
    error_log("🔎 Auth::user() returned: " . print_r($user, true));
    http_response_code(403);
    echo json_encode(["message" => "User not logged in or session invalid."]);
    exit;
}

try {
    $pdo->beginTransaction();
    error_log("🧪 Current session user: " . print_r($_SESSION['user'], true));

    $totalCartCost = 0;

    foreach ($data['cart'] as $item) {
        $stockStmt = $pdo->prepare("
            SELECT quantity FROM items 
            WHERE id = :item_id AND category = :item_category
        ");
        $stockStmt->execute([
            ':item_id' => strtolower($item['id']),
            ':item_category' => strtolower($item['category'])
        ]);
        $availableQty = $stockStmt->fetchColumn();

        if ($availableQty === false) {
            echo json_encode(["message" => "Item not found: {$item['name']}"]);
            exit;
        }
        if ($item['quantity'] > $availableQty) {
            http_response_code(400);
            echo json_encode([
                "message" => "Not enough stock for {$item['name']}. Available: {$availableQty}, requested: {$item['quantity']}"
            ]);
            exit;
        }
        $totalCartCost += $item['price'] * $item['quantity'];
    }

    $walletStmt = $pdo->prepare("SELECT wallet FROM users WHERE id = :user_id");
    $walletStmt->execute([':user_id' => $user['id']]);
    $wallet = $walletStmt->fetchColumn();

    if ($wallet < $totalCartCost) {
        http_response_code(400);
        echo json_encode([
            "message" => "Insufficient funds. Total: ₱{$totalCartCost}, Wallet: ₱{$wallet}"
        ]);
        exit;
    }

    foreach ($data['cart'] as $item) {     
        $updateStmt = $pdo->prepare(
            "UPDATE items
            SET quantity = quantity - :purchased_quantity
            WHERE id = :item_id AND category = :item_category"
        );

        $updateStmt->execute([
            ':purchased_quantity' => $item['quantity'],
            ':item_id' => $item['id'],
            ':item_category' => strtolower($item['category'])
        ]);
        if ($updateStmt->rowCount() === 0) {
            throw new Exception("No item matched to update for: " . $item['name']);
        }

        $totalCost = $item['price'] * $item['quantity'];
        $updateMon = $pdo->prepare("
            UPDATE users
            SET wallet = wallet - :item_total
            WHERE id = :user_id
        ");

        $updateMon->execute([
            ':user_id' => $user['id'],
            ':item_total' => $totalCost
        ]);

        if ($updateMon->rowCount() === 0) {
            throw new Exception("Wallet update failed — user not found or wallet unchanged for ID: {$user['id']}");
        } else {
            $walletCheck = $pdo->prepare("SELECT wallet FROM users WHERE id = :user_id");
            $walletCheck->execute([':user_id' => $user['id']]);
            $remaining = $walletCheck->fetchColumn();
        }

        try {
        $stmt = $pdo->prepare("
            INSERT INTO item_orders (user_id, item_name, item_category, quantity, price, total)
            VALUES (:user_id, :item_name, :item_category, :quantity, :price, :total)
        ");
        
        $stmt->execute([
            ':user_id' => $user['id'],
            ':item_name' => strtolower($item['name']),
            ':item_category' => strtolower($item['category']),
            ':quantity' => $item['quantity'],
            ':price' => $item['price'],
            ':total' => $item['price'] * $item['quantity']
        ]);
        } catch (PDOException $e) {
            echo json_encode(["error" => "item_orders PDO Failed."]);
            error_log("Failed to insert item: " . $e->getMessage());
            error_log("Item Data: " . print_r($item, true));
        }
    }
    $pdo->commit();
    echo json_encode(["message" => "Order placed successfully."]);

} catch (Exception $e) {
    $pdo->rollBack();
    error_log("Checkout failed: " . $e->getMessage());
    error_log("Cart contents: " . print_r($data['cart'], true));
    error_log("User info: " . print_r($user, true));
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
    exit;
}