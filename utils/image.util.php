<?php
function insertImg($pdo, $img) {
    $stmt = $pdo->prepare("
        INSERT INTO images (item_id, filename, filepath, mimetype, size_bytes, type)
        VALUES (:itemid, :filename, :filepath, :mime, :size, :type)
    ");
    
    $stmt->execute([
        ':itemid' => strtolower($item['name']),
        ':filename' => $item['price'],
        ':filepath' => strtolower($item['description']),
        ':mime' => $item['quantity'],
        ':size' => strtolower($item['category']),
        ':type' => basename($item['image']),
    ]);
}
