<?php
function getAllUsers(): array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        INSERT INTO users (username, password, first_name, last_name, street, city, province, role)
        VALUES (:username, :password, :first_name, :last_name, :street, :city, :province, :role)
    ");
    
    $stmt->execute([
        ':username' => $user['username'],
        ':first_name'       => strtolower($user['first_name']),
        ':last_name'       => strtolower($user['last_name']),
        ':password'       => password_hash($user['password'], PASSWORD_DEFAULT),
        ':role' => $user['username'] === 'Notch' ? 'admin' : 'customer',
        ':street' => strtolower($user['street']),
        ':province' => strtolower($user['province']),
        ':city' => strtolower($user['city']),
    ]);
}
