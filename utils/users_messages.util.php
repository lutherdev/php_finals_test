<?php
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