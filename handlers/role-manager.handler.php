<?php
require_once BASE_PATH . '/bootstrap.php';
require_once UTILS_PATH . '/auth.util.php';

Auth::init();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $newRole = trim($_POST['role']);

    $allowedRoles = ['Customer', 'Admin'];

    if (!in_array($newRole, $allowedRoles)) {
        header("Location: /role-manager?error=Invalid+role");
        exit;
    }

    if ($username === '') {
        header("Location: /role-manager?error=Missing+User+ID");
        exit;
    }

    try {
        $sql = "UPDATE users SET role = :newRole WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':newRole' => strtolower($newRole),
            ':username' => $username
        ]);

        if ($stmt->rowCount() > 0) {
            header("Location: /role-manager?success=Role+Updated");
        } else {
            header("Location: /role-manager?error=No+changes+made+or+invalid+User+ID");
        }
        exit;
    } catch (PDOException $e) {
        error_log("Role update failed: " . $e->getMessage());
        header("Location: /role-manager?error=PDO+Failed");
        exit;
    }
} else {
    header("Location: /role-manager?error=Invalid+Request");
    exit;
}
