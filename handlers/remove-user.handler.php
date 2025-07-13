<?php
require_once BASE_PATH . '/bootstrap.php'; 
require_once UTILS_PATH . '/auth.util.php';
Auth::init();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);

    if ($username == $_SESSION['user']['username']){
        header("Location: /remove-user?error=cant+delete+self");
    } 
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE LOWER(username) = LOWER(:name)");
    $checkStmt->execute([':name' => $username]);
    $count = $checkStmt->fetchColumn();

    if ($count <= 0) {
        header("Location: /remove-user?error=username+doesnt+exists");
        exit;
    }

    $stmt = $pdo->prepare("DELETE FROM users WHERE LOWER(username) = LOWER(:username)");
    $stmt->execute([':username' => $username]);

    header("Location: /remove-user?success=1");
    exit;
}
