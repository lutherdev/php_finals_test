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
    <div class="view">
        <h2>EXISTING MESSAGES</h2>
    </div>
    <div class="items-container">
        <?php if (count($messages) === 0): ?>
            <p style="color: #fff;">NO MESSAGES.</p>
        <?php else: ?>
            <?php foreach ($messages as $message): ?>
                <div class="item-card">
                    <h3>Message ID: <?= htmlspecialchars($message['id']) ?></h3>
                    <p><strong>Name: </strong> <?= htmlspecialchars($message['name']) ?></p>
                    <p><strong>Username: </strong> <?= htmlspecialchars($message['username']) ?></p>
                    <p><strong>Email: </strong> <?= htmlspecialchars($message['email']) ?></p>
                    <p><strong>Message: </strong> <?= htmlspecialchars($message['message']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
