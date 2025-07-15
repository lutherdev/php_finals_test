<?php
require_once BASE_PATH . '/bootstrap.php';
if (!isset($_SESSION['user'])) {
    echo "<script>window.location.href = '/login?error=Please+Login+Admin';</script>";
    exit;
}
if ($_SESSION['user']['role'] == 'customer'){
    echo "<script>window.location.href = '/';</script>";
    exit;
}
?>
<link rel="stylesheet" href="/pages/dashboard/assets/css/dashboard.css">
<main class="admin-page">
    <div class="admin-container">
        <div class="admin-wrapper">
            <div class="admin-grid">
                <div class="admin-card" onclick="location.href='add-item'">
                    <h3>Add Item</h3>
                    <div class="admin-icon">⛏</div>
                </div>

                <div class="admin-card" onclick="location.href='view-item'">
                    <h3>View Item</h3>
                    <div class="admin-icon">📜</div>
                </div>

                <div class="admin-card" onclick="location.href='edit-item'">
                    <h3>Update Item</h3>
                    <div class="admin-icon">🛠</div>
                </div>

                <div class="admin-card" onclick="location.href='remove-item'">
                    <h3>Delete Item</h3>
                    <div class="admin-icon">💀</div>
                </div>
            </div>

            <div class="admin-grid2">
                <div class="admin-card" onclick="location.href='role-manager'">
                    <h3>Role Manager</h3>
                    <div class="admin-icon">⛏</div>
                </div>
                <div class="admin-card" onclick="location.href='view-users'">
                    <h3>View Users</h3>
                    <div class="admin-icon">⛏</div>
                </div>
                <div class="admin-card" onclick="location.href='remove-user'">
                    <h3>Delete Users</h3>
                    <div class="admin-icon">⛏</div>
                </div>
                <div class="admin-card" onclick="location.href='view-messages'">
                    <h3>View Messages</h3>
                    <div class="admin-icon">⛏</div>
                </div>
                <div class="admin-card" onclick="location.href='view-item-orders'">
                    <h3>View Orders</h3>
                    <div class="admin-icon">⛏</div>
                </div>
            </div>
        </div>
    </div>
</main>
