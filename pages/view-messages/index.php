<?php
require_once BASE_PATH . '/bootstrap.php';
require_once UTILS_PATH . '/users_messages.util.php'; 

if (!isset($_SESSION['user'])) {
    echo "<script>window.location.href = '/login';</script>";
    exit;
}
$messages = getAllMessages();
?>

<div class="view-outer">
  <div class="in-outer">
    <div class="view">
      <h2>MESSAGES</h2>
    </div>

    <div class="table-container">
      <?php if (count($messages) === 0): ?>
        <p style="color: #fff;">NO MESSAGES.</p>
      <?php else: ?>
        <table class="user-table">
          <thead>
            <tr>
              <th>Message ID</th>
              <th>Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Message</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($messages as $message): ?>
              <tr>
                <td><?= htmlspecialchars($message['id']) ?></td>
                <td><?= ucwords(htmlspecialchars($message['name'])) ?></td>
                <td><?= htmlspecialchars($message['username']) ?></td>
                <td><?= htmlspecialchars($message['email']) ?></td>
                <td><?= nl2br(htmlspecialchars($message['message'])) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</div>