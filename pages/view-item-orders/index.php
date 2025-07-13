<?php
require_once BASE_PATH . '/bootstrap.php';
require_once HANDLERS_PATH . '/store.handler.php';

if (!isset($_SESSION['user'])) {
    echo "<script>window.location.href = '/login?error=Please+Login+Admin';</script>";
    exit;
}
global $pdo;
$id = $_SESSION['user']['id'];
$username = $_SESSION['user']['username'];
$orders = getAllOrders();
?>

<div class="view-outer">
  <div class="view">
    <h2>Your Orders</h2>
  </div>

  <div class="items-container">
    <?php if (count($orders) === 0): ?>
      <p style="color: #fff;">NO ORDERS YET.</p>
    <?php else: ?>
      <?php foreach ($orders as $order): ?>
        <div class="item-card">
          <h3>Order #<?= htmlspecialchars($order['id']) ?></h3>
          <h3>By User #<?= htmlspecialchars($order['user_id']) ?></h3>
          <p><strong>Date:</strong> <?= htmlspecialchars($order['created_at']) ?></p>
          <p><strong>Item:</strong> <?= htmlspecialchars($order['item_name']) ?></p>
          <p><strong>Quantity:</strong> <?= htmlspecialchars($order['quantity']) ?></p>
          <p><strong>Total:</strong> <?= htmlspecialchars($order['total']) ?> gold</p>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>
