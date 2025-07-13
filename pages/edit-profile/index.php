<?php
require_once BASE_PATH . '/bootstrap.php';
global $pdo;
if (!isset($_SESSION['user'])) {
    echo "<script>window.location.href = '/login?error=Please+Login+Admin';</script>";
    exit;
}
$user = Auth::getData($pdo, $_SESSION['user']['username']);
$error = $_GET['error'] ?? '';

?>

<div class="edit-profile-outer">
  <div class="edit-profile-card">
    <h2>Edit Your Profile</h2>

    <form method="POST" action="/handlers/edit-profile.handler.php">
      <label>Username:</label>
      <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

      <label>First Name:</label>
      <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>

      <label>Last Name:</label>
      <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>

      <label>City:</label>
      <input type="text" name="city" value="<?= htmlspecialchars($user['city']) ?>" required>

      <label>Province:</label>
      <input type="text" name="province" value="<?= htmlspecialchars($user['province']) ?>" required>

      <label>Street:</label>
      <input type="text" name="street" value="<?= htmlspecialchars($user['street']) ?>" required>

      <button class="gold-btn" type="submit">Save Changes</button>
      <a href="profile-page" class="gold-btn back-btn">Cancel</a>
      <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>
    </form>
  </div>
</div>
