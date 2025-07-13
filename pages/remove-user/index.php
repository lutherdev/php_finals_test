<?php
if (!isset($_SESSION['user'])) {
    echo "<script>window.location.href = '/login?error=Please+Login+Admin';</script>";
    exit;
}
$error = $_GET['error'] ?? '';

?>

<div class="remove-outer">
  <div class="remove">
    <h2>Remove User</h2>
    <form action="handlers/remove-user.handler.php" method="POST">
        <label>username:</label>
        <input type="text" name="username" required>

        <button type="submit">Remove Item</button>
        <?php if (!empty($error)): ?>
          <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
    </form>
  </div>
</div>
<script src = '/pages/remove-item/assets/js/remove-user.js'></script>
