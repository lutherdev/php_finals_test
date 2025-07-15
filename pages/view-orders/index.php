<?php
require_once BASE_PATH . '/bootstrap.php';
require_once UTILS_PATH . '/item_orders.util.php'; 

if (!isset($_SESSION['user'])) {
    echo "<script>window.location.href = '/login?error=Please+Login+Admin';</script>";
    exit;
}
global $pdo;
$id = $_SESSION['user']['id'];
$username = $_SESSION['user']['username'];
$orders = getAllItemsUser($id);
?>

<div class="view-outer">
  <div class="in-outer">
    <div class="view">
      <h2>Your Orders</h2>
    </div>

    <div class="table-container">
      <?php if (count($orders) === 0): ?>
        <p style="color: #fff;">You haven't placed any orders yet.</p>
      <?php else: ?>
        <div class="scroll-wrapper">
          <table class="user-table">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Total (Gold)</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($orders as $order): ?>
                <tr>
                  <td><?= htmlspecialchars($order['id']) ?></td>
                  <td><?= htmlspecialchars($order['created_at']) ?></td>
                  <td><?= htmlspecialchars($order['item_name']) ?></td>
                  <td><?= htmlspecialchars($order['quantity']) ?></td>
                  <td><?= htmlspecialchars($order['total']) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
