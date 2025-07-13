<?php
require_once BASE_PATH . '/bootstrap.php';
require_once HANDLERS_PATH . '/store.handler.php'; // This file should contain a getOrdersByUsername() function

if (!isset($_SESSION['user'])) {
    echo "<script>window.location.href = '/login?error=Please+Login+Admin';</script>";
    exit;
}
global $pdo;
$id = $_SESSION['user']['id'];
$username = $_SESSION['user']['username'];
$users = getAllUsers();
?>

<div class="view-outer">
  <div class="view">
    <h2>EXISTING USERS</h2>
  </div>

  <div class="items-container">
    <?php if (count($users) === 0): ?>
      <p style="color: #fff;">NO USERS.</p>
    <?php else: ?>
      <?php foreach ($users as $user): ?>
        <div class="item-card">
          <h3>USER ID#</h3><p><?= htmlspecialchars($user['id']) ?></p>
          <p><strong>Username:</strong> <?= htmlspecialchars($user['username'])?></p>
          <p><strong>First Name:</strong> <?= ucwords(htmlspecialchars($user['first_name'])) ?></p>
          <p><strong>Last Name:</strong> <?= ucwords(htmlspecialchars($user['last_name'])) ?></p>
          <p><strong>Role:</strong> <?= ucwords(htmlspecialchars($user['role'])) ?></p>
          <p><strong>City:</strong> <?= ucwords(htmlspecialchars($user['city'])) ?></p>
          <p><strong>Province:</strong> <?= ucwords(htmlspecialchars($user['province'])) ?></p>
          <p><strong>Street:</strong> <?= ucwords(htmlspecialchars($user['street'])) ?></p>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>
