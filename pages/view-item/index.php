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
<div class="view-outer">
  <div class="in-outer">
    <div class="view">
      <h2>ALL ITEMS</h2>
    </div>

    <div class="table-container">
      <?php if (count($items) === 0): ?>
        <p style="color: #fff;">NO USERS.</p>
      <?php else: ?>
        <table class="user-table">
          <thead>
            <tr>
              <th>Item ID#</th>
              <th>Item name</th>
              <th>Description</th>
              <th>Category</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($items as $item): ?>
              <tr>
                <td><?= htmlspecialchars($item['id']) ?></td>
                <td><?= ucwords(htmlspecialchars($item['name'])) ?></td>
                <td><?= ucwords(htmlspecialchars($item['description'])) ?></td>
                <td><?= ucwords(htmlspecialchars($item['category'])) ?></td>
                <td><?= ucwords(htmlspecialchars($item['price'])) ?></td>
                <td><?= ucwords(htmlspecialchars($item['quantity'])) ?></td>
                <td><?= htmlspecialchars($item['status']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</div>