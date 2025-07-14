<?php
function getAvailableItems(): array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM items WHERE status = 'is-active'");
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($items);
    echo "</pre>";

    return $items;
}

function getAllItems(): array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM items");
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($items);
    echo "</pre>";

    return $items;
}

function getAllItemsUser($user_id): array { ////////////////////////ASD////////////////////////////////
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


function getAllMessages(): array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users_messages");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($users);
    echo "</pre>";

    return $users;
}