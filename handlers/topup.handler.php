<?php
require_once BASE_PATH . '/bootstrap.php'; 
require_once UTILS_PATH . '/auth.util.php';
require_once UTILS_PATH . '/top-up.util.php';
global $pdo;

Auth::init();
if (!isset($_SESSION['user'])) {
    header('Location: /topup?error=No+User'); 
exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = isset($_POST['amount']) ? (int)$_POST['amount'] : 0;
    $userId = $_SESSION['user']['id'];
if ($amount > 0) {
    try {
        $stmt = $pdo->prepare("UPDATE users SET wallet = wallet + ? WHERE id = ?");
        $stmt->execute([$amount, $userId]);

        header("Location: /profile-page?success=Successfully+added+{$amount}+gold!");
        exit;
        } catch (Exception $e) {
        $msg = urlencode("Error topping up: " . $e->getMessage());
        header("Location: /topup?error={$msg}");
        exit;
    }
} else {
    header("Location: /topup?error=Please+enter+a+valid+amount");
    exit;
}
    header('Location: /profile-page');
    exit;
exit;
} else {
    header('Location: /topup'); 
    exit;
}
