<?php
function getAllItemsUser($user_id): array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM item_orders WHERE user_id = :user_id");
    $stmt->execute([':user_id' => $user_id]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($items);
    echo "</pre>";

    return $items;
}

function getAllOrders(): array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM item_orders");
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($items);
    echo "</pre>";

    return $items;
}