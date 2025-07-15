<?php
function getAvailableItems(): array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM items WHERE status = 'is-active'");
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $items;
}

function getAllItems(): array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM items");
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $items;
}

function insertItem($pdo, $item) {
    $stmt = $pdo->prepare("
        INSERT INTO items (name, price, description, quantity, category, img_path, status)
        VALUES (:name, :price, :desc, :qty, :cat, :img, :status)
    ");
    
    $stmt->execute([
        ':name' => strtolower($item['name']),
        ':desc' => strtolower($item['description']),
        ':price' => $item['price'],
        ':qty' => $item['quantity'],
        ':cat' => strtolower($item['category']),
        ':img' => $item['image'],
        ':status' => strtolower($item['status']),
    ]);
}
