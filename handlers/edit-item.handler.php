<?php
require_once BASE_PATH . '/bootstrap.php';
require_once UTILS_PATH . '/auth.util.php';

Auth::init();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['id']);
    $editField = trim($_POST['edit']);
    $newValue = trim($_POST['changes']);

    $allowedFields = ['name', 'description', 'price', 'quantity', 'category'];

    if (!in_array($editField, $allowedFields)) {
        header("Location: /edit-item?error=Invalid+field");
        exit;
    }

    if ($id === '' || $newValue === '') {
        header("Location: /edit-item?error=Missing+input");
        exit;
    }

    try {
        if ($editField === 'price') {
            $newValue = floatval($newValue);
        } elseif ($editField === 'quantity') {
            $newValue = intval($newValue);
        }

        $sql = "UPDATE items SET {$editField} = :newValue WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':newValue' => $newValue,
            ':id' => $id
        ]);

        if ($stmt->rowCount() > 0) {
            header("Location: /edit-item?success=Item+Updated");
        } else {
            header("Location: /edit-item?error=No+changes+made+or+invalid+Item+ID");
        }
        exit;
    } catch (PDOException $e) {
        error_log("Edit item failed: " . $e->getMessage());
        header("Location: /edit-item?error=PDO+Failed");
        exit;
    }
} else {
    header("Location: /edit-item?error=Invalid+Request");
    exit;
}
