<?php
if (isset($_GET['error']) && $_GET['error'] === 'name_exists') {
  echo "<p style='color:red;'>Item name already exists!</p>";
}

if (isset($_GET['error']) && $_GET['error'] === 'image_upload_failed') {
  echo "<p style='color:red;'>Failed to upload image.</p>";
}

if (isset($_GET['success'])) {
  echo "<p style='color:green;'>Item added successfully!</p>";
}
?>
<div class="add-outer">
  <div class="add">
    <h2>Add New Item</h2>
    <form action="/handlers/add-item.handler.php" method="POST" enctype="multipart/form-data">
        <label>Item Name:</label>
        <input type="text" name="item_name" required>

        <label>Description:</label>
        <input type="text" name="description" required>

        <label>Price:</label>
        <input type="number" name="price" step="0.01" required>

        <label>Quantity:</label>
        <input type="number" name="quantity" required>

        <label>Category:</label>
        <select name="category" required>
          <option value="" disabled selected>Select a category</option>
          <option value="Tools">Tools</option>
          <option value="Gear">Gear</option>
          <option value="Ore">Ore</option>
        </select>

        <label>Image:</label>
        <input type="file" name="item_image" accept="image/*" required>

        <button type="submit">Add Item</button>
    </form>
  </div>
</div>
