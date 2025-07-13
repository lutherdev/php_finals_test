<?php
require_once BASE_PATH . '/bootstrap.php';
//require_once STATICDATAS_PATH . '/dummies/store.staticData.php';
require_once HANDLERS_PATH . '/store.handler.php';
$products = getAvailableItems();

?>

<section class="store-container" id="inventory">
  <div class="store-header">
    <h1>Miner's Ware</h1>
    <div class="store-filters">
      <button class="menu-btn active" data-category="all">All</button>
      <button class="menu-btn" data-category="ore">Ore</button>
      <button class="menu-btn" data-category="tools">Tools</button>
      <button class="menu-btn" data-category="gear">Gear</button>
    </div>
  </div>

  <div class="store-main">
    <div class="sidebar">
      <div class="cart-image-wrapper">
        <aside class="cart-box">
          <h2>Cart</h2>
          <ul id="cart-items"></ul>
          <div class="total">Total: ₱<span id="cart-total">0</span></div>
          <div class='cart-buttons'>
            <div class='btn-cancel'><button id="checkout-btn">CHECKOUT</button></div>
            <div class='btn-cancel'><button id="cancel-btn">CANCEL</button></div>
          </div>
        </aside>
      </div>

      <div class="cart-image-wrapper">
        <aside class="cart-box2">
          <h2>SAMPLE BOX</h2>
          <ul>
            <li>Miner's Helmet<span>₱150</span></li>
            <li>Gold Nugget<span>₱120</span></li>
          </ul>
          <div class="total">Total: ₱270</div>
        </aside>
      </div>
    </div>

    <div class="products-image-wrapper">
      <div class="products-grid">
      <?php if (empty($products)): ?>
        <p style="color:red;">No items found. Check database or item status.</p>
      <?php else: ?>
        <?php foreach ($products as $product): 
     $imgPublicPath = '/public/uploads/images/' . $product['img_path'];
     $imgStaticPath = '/pages/store/assets/img/' . $product['img_path'];

    $localUploadPath = BASE_PATH . '/public/uploads/images/' . $product['img_path'];
    $localStaticPath = BASE_PATH . '/pages/store/assets/img/' . $product['img_path'];

        if (file_exists($localUploadPath)) {
            $finalImagePath = $imgPublicPath;
        } elseif (file_exists($localStaticPath)) {
            $finalImagePath = $imgStaticPath;
        } else {
            $finalImagePath = '/assets/img/placeholder.png'; // fallback image
        }
    ?>

          <div class="product-card" data-category="<?= strtolower($product['category']) ?>">
          <img src="<?= $finalImagePath ?>" alt="<?= htmlspecialchars($product['name']) ?>">
          <div class="product-info">
            <h3><?= ucwords(strtolower(htmlspecialchars($product['name']))) ?></h3>
            <p><?= strtoupper(htmlspecialchars($product['description'])) ?></p>
            <p><?= htmlspecialchars($product['quantity']) ?> PIECES LEFT</p>
            <div class="price-action">
              <span class="price">₱<?= number_format($product['price'], 2) ?></span>
              <button onclick="addToCart('<?= addslashes($product['name']) ?>', <?= $product['price'] ?>, '<?= strtolower($product['category']) ?>')">Add to Cart</button>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<script src="/pages/store/assets/js/store.js"></script>