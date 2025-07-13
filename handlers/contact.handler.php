<?php
require_once BASE_PATH . '/bootstrap.php';
require_once UTILS_PATH . '/envSetter.util.php';
global $pdo;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name && $email && $message) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO users_messages (name, username, email, message)
                VALUES (:name, :username, :email, :message)
            ");

            $stmt->execute([
                ':name' => $name,
                ':username' => $username,
                ':email' => $email,
                ':message' => $message
            ]);

            header("Location: /contact-us?success=1");
            exit;

        } catch (Exception $e) {
            error_log("DB Error: " . $e->getMessage());
            header("Location: /contact-us?error=1");
            exit;
        }
    } else {
        header("Location: /contact-us?error=missing");
        exit;
    }
}
