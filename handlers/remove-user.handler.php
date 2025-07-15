<?php
require_once BASE_PATH . '/bootstrap.php'; 
require_once UTILS_PATH . '/auth.util.php';
Auth::init();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);

    if ($username == $_SESSION['user']['username']){
        header("Location: /remove-user?error=cant+delete+self");
        exit;
    } 
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :name");
    $checkStmt->execute([':name' => $username]);
    $count = $checkStmt->fetchColumn();

    if ($count <= 0) {
        header("Location: /remove-user?error=username+doesnt+exists");
        exit;
    }
    $stmt = $pdo->prepare("DELETE FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);

    header("Location: /remove-user?success=account+deleted");
    exit;
}
