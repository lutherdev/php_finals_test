<?php
require_once BASE_PATH . '/bootstrap.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['item_name']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $category = $_POST['category'];
    $status = 'is-active'; 

    //name checker
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM items WHERE LOWER(name) = LOWER(:name)");
    $checkStmt->execute([':name' => $name]);
    $count = $checkStmt->fetchColumn();

    if ($count > 0) {
        header("Location: /add-item?error=name_exists");
        exit;
    }

    $originalName = basename($_FILES['image']['name']);
    $filename = uniqid() . '_' . $originalName;
    $uploadPath = BASE_PATH . '/public/uploads/images/' . $filename;



    
    // if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
    // error_log("✅ Image uploaded successfully to: $uploadPath");
    // } else {
    //     error_log("❌ Upload failed. Check permissions or if file exists.");
    // }

    $stmt = $pdo->prepare("INSERT INTO items (name, description, quantity, price, category, img_path, status)
                           VALUES (:name, :description, :quantity, :price, :category, :img_path, :status)");

    $stmt->execute([
        ':name' => $name,
        ':description' => $description,
        ':quantity' => $quantity,
        ':price' => $price,
        ':category' => $category,
        ':img_path' => $filename,
        ':status' => $status
    ]);

    header("Location: /add-item?success=1");
    exit;
}
