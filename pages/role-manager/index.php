<?php
if (!isset($_SESSION['user'])) {
    echo "<script>window.location.href = '/login?error=Please+Login+Admin';</script>";
    exit;
}
$success = $_GET['success'] ?? '';
$error = $_GET['error'] ?? '';
?>
<div class="edit-outer">
  <div class="edit">
    <h2>Role Manager</h2>
    <form action="handlers/role-manager.handler.php" method="POST">
        <label>username:</label>
        <input type="text" name="username" required>

        <label>New Role:</label>
        <select name="role" required>
          <option value="Customer">Customer</option>
          <option value="Admin">Admin</option>
        </select>

        <button type="submit">Update Role</button>
        <?php if (!empty($error)): ?>
          <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
          <p class="error"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
    </form>
  </div>
</div>
