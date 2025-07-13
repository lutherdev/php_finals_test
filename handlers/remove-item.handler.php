<?php
require_once BASE_PATH . '/bootstrap.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['item_name']);

    $checkStmt = $pdo->prepare("SELECT * FROM items WHERE LOWER(name) = LOWER(:name)");
    $checkStmt->execute([':name' => $name]);
    $item = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        header("Location: /remove-item?error=name+doesnt+exists");
        exit;
    }

    $imagePath = BASE_PATH . '/public/uploads/images/' . $item['img_path'];

    if (file_exists($imagePath)) {
        if (unlink($imagePath)) {
            error_log("🗑️ Image deleted: $imagePath");
        } else {
            error_log("⚠️ Failed to delete image: $imagePath");
        }
    } else {
        error_log("⚠️ Image not found: $imagePath");
    }

    $stmt = $pdo->prepare("DELETE FROM items WHERE LOWER(name) = LOWER(:name)");
    $stmt->execute([':name' => $name]);

    header("Location: /remove-item?success=1");
    exit;
}
