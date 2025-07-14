<?php
$error = $_GET['error'] ?? '';
?>

<div class="register-container">
  <div class="register-box">
    <h2>Register</h2>
    <form action="handlers/auth.handler.php" method="POST">

      <div class="input-group">
        <label>Username: </label>
        <input type="text" name="username" required>
      </div>

      <div class="input-group">
        <label>Password: </label>
        <input type="password" name="password" required>
      </div>

      <div class="input-group">
        <label>Firstname: </label>
        <input type="text" name="firstname" required>
      </div>

      <div class="input-group">
        <label>Lastname: </label>
        <input type="text" name="lastname" required>
      </div>

      <div class="input-group">
        <label>Street: </label>
        <input type="text" name="street" required>
      </div>

      <div class="input-group">
        <label>Province: </label>
        <input type="text" name="province" required>
      </div>

      <div class="input-group">
        <label>City: </label>
        <input type="text" name="city" required>
      </div>

        <input type="hidden" name="action" value="register">
        <button type="submit">Register</button>

        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
    </form>
  </div>
</div>