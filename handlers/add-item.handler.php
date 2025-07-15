<?php
require_once BASE_PATH . '/bootstrap.php'; 
require_once UTILS_PATH . '/upload.util.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['item_name']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $category = $_POST['category'];
    $status = 'is-active'; 

    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM items WHERE LOWER(name) = LOWER(:name)");
    $checkStmt->execute([':name' => strtolower($name)]);
    $count = $checkStmt->fetchColumn();

    if ($count > 0) {
        header("Location: /add-item?error=name_exists");
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO items (name, description, quantity, price, category, img_path, status)
                        VALUES (:name, :description, :quantity, :price, :category, :img_path , :status)
                        RETURNING id");

    $stmt->execute([
        ':name' => $name,
        ':description' => $description,
        ':quantity' => $quantity,
        ':price' => $price,
        ':category' => $category,
        ':img_path' => '',
        ':status' => $status
    ]);
    $itemId = $stmt->fetchColumn();

    // var_dump($_FILES['item_image']);
    // exit;
    $imageResult = Upload::handle($_FILES['item_image'], $pdo, 'item', $itemId);
    

    if (!$imageResult['success']){
        $pdo->prepare("DELETE FROM items WHERE id = :id")->execute([':id' => $itemId]);
        header("Location: /add-item?error=" . urlencode($imageResult['error']));
        exit;
    }
    $stmt = $pdo->prepare("UPDATE items SET img_path = :path WHERE id = :id");
    $stmt->execute([
        ':path' => $imageResult['filename'], 
        ':id' => $itemId
    ]);

    header("Location: /add-item?success=1");
    exit;
}
