<?php
if (!isset($_SESSION['user'])) {
    echo "<script>window.location.href = '/login?error=Please+Login+Admin';</script>";
    exit;
}
?>
<div class="edit-outer">
  <div class="edit">
    <h2>Edit Item</h2>
    <form action="handlers/edit-item.handler.php" method="POST">
        <label>ID:</label>
        <input type="text" name="id" required>

        <label>What to Edit:</label>
        <select name="edit" required>
          <option value="name">Item Name</option>
          <option value="description">Description</option>
          <option value="price">Price</option>
          <option value="quantity">Quantity</option>
          <option value="category">Category</option>
        </select>

        <label>New Value:</label>
        <input type="text" name="changes" required>

        <button type="submit">Edit Item</button>
    </form>
  </div>
</div>
