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
$orders = getAllOrders();
?>

<div class="view-outer">
  <div class="in-outer">
    <div class="view">
      <h2>All User Orders</h2>
    </div>

    <div class="table-container">
      <?php if (count($orders) === 0): ?>
        <p style="color: #fff;">NO ONE ORDERED.</p>
      <?php else: ?>
        <table class="user-table">
          <thead>
            <tr>
              <th>Item ID#</th>
              <th>User ID#</th>
              <th>Item Name</th>
              <th>Quantity</th>
              <th>Total</th>
              <th>Created at</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $order): ?>
              <tr>
                <td><?= htmlspecialchars($order['id']) ?></td>
                <td><?= htmlspecialchars($order['user_id']) ?></td>
                <td><?= ucwords(htmlspecialchars($order['item_name'])) ?></td>
                <td><?= ucwords(htmlspecialchars($order['quantity'])) ?></td>
                <td><?= ucwords(htmlspecialchars($order['total'])) ?></td>
                <td><?= ucwords(htmlspecialchars($order['created_at'])) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</div>
