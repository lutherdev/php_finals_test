<?php
function getAllItemsUser($id): array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM item_orders WHERE user_id = :id");
    $stmt->execute([':id' => $id]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $items;
}

function getAllOrders(): array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM item_orders");
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);


    return $items;
}