<?php
function getAllUsers(): array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

function getUserDataa($username): array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function insertUser($pdo, $user) {
    $stmt = $pdo->prepare("
        INSERT INTO users (username, password, first_name, last_name, street, city, province)
        VALUES (:username, :password, :first_name, :last_name, :street, :city, :province)
    ");
    
    $stmt->execute([
        ':username' => $user['username'],
        ':first_name'       => strtolower($user['first_name']),
        ':last_name'       => strtolower($user['last_name']),
        ':password'       => password_hash($user['password'], PASSWORD_DEFAULT),
        ':street' => strtolower($user['street']),
        ':province' => strtolower($user['province']),
        ':city' => strtolower($user['city']),
    ]);
}
