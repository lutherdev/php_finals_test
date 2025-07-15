<?php
require_once BASE_PATH . '/bootstrap.php';
require_once UTILS_PATH .'/users.util.php';

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
  <div class="in-outer">
    <div class="view">
      <h2>EXISTING USERS</h2>
    </div>

    <div class="table-container">
      <?php if (count($users) === 0): ?>
        <p style="color: #fff;">NO USERS.</p>
      <?php else: ?>
        <div class="scroll-wrapper">
          <table class="user-table">
            <thead>
              <tr>
                <th>User ID#</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Role</th>
                <th>City</th>
                <th>Province</th>
                <th>Street</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user): ?>
                <tr>
                  <td><?= htmlspecialchars($user['id']) ?></td>
                  <td><?= htmlspecialchars($user['username']) ?></td>
                  <td><?= ucwords(htmlspecialchars($user['first_name'])) ?></td>
                  <td><?= ucwords(htmlspecialchars($user['last_name'])) ?></td>
                  <td><?= ucwords(htmlspecialchars($user['role'])) ?></td>
                  <td><?= ucwords(htmlspecialchars($user['city'])) ?></td>
                  <td><?= ucwords(htmlspecialchars($user['province'])) ?></td>
                  <td><?= ucwords(htmlspecialchars($user['street'])) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
