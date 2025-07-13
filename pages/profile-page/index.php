<?php

require_once BASE_PATH . '/bootstrap.php';
global $pdo;
if (!isset($_SESSION['user'])) {
    echo "<script>window.location.href = '/login?error=Please+Login';</script>";
    exit;
}
$user = Auth::getData($pdo, $_SESSION['user']['username']);
if ($user == 'no_username'){
  $user = null;
}
$error = $_GET['error'] ?? '';
?>
<div class="profile-outer">
  <div class="profile-card">
    <h2>Your Profile</h2>
    <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
    <p><strong>Name:</strong> <?= htmlspecialchars($user['first_name']) . " " . htmlspecialchars($user['last_name']) ?></p>
    <p><strong>Role:</strong> <?= ucfirst(htmlspecialchars($user['role'])) ?></p>
    <p><strong>City:</strong> <?= ucfirst(htmlspecialchars($user['city'])) ?></p>
    <p><strong>Province:</strong> <?= ucfirst(htmlspecialchars($user['province'])) ?></p>
    <p><strong>Street:</strong> <?= ucfirst(htmlspecialchars($user['street'])) ?></p>
    <p><strong>Wallet:</strong> <?= htmlspecialchars($user['wallet']) ?> gold</p>

    <div class="profile-buttons">
      <a href="topup"><button class="gold-btn">Top Up</button></a>
      <a href="edit-profile"><button class="gold-btn">Edit Profile</button></a>
      <a href="view-orders"><button class="gold-btn">View Orders</button></a>
      <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>
    </div>
  </div>
</div>
