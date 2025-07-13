<?php
function getAllUsers(): array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($users);
    echo "</pre>";

    return $users;
}

function getUserData($user_id): array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
    $stmt->execute([':user_id' => $user_id]);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($users);
    echo "</pre>";

    return $users;
}
