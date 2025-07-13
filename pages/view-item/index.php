<?php
require_once BASE_PATH . '/bootstrap.php';
//require_once STATICDATAS_PATH . '/dummies/store.staticData.php';
require_once UTILS_PATH . '/items.util.php';
if (!isset($_SESSION['user'])) {
    echo "<script>window.location.href = '/login?error=Please+Login+Admin';</script>";
    exit;
}
$items = getAllItems();
?>

<body>
  <div class="view-outer">
    <div class="view">
      <h2>All Items</h2>
    </div>

    <div class="items-container">
      <?php if (count($items) === 0): ?>
        <p style="color: #fff;">No items found.</p>
      <?php else: ?>
        <?php foreach ($items as $item): ?>
          <div class="item-card">
            <h3><strong>ID: </strong></h3><p><?= htmlspecialchars($item['id']) ?></p>
            <h3><?= htmlspecialchars($item['name']) ?></h3>
            <p><strong>Description: </strong> <?= htmlspecialchars($item['description']) ?></p>
            <p><strong>Price:</strong> <?= htmlspecialchars($item['price']) ?> gold</p>
            <p><strong>Quantity:</strong> <?= htmlspecialchars($item['quantity']) ?></p>
            <p><strong>Category:</strong> <?= htmlspecialchars($item['category']) ?></p>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</body>