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
