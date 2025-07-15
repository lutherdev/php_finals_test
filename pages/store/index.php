<?php
require_once BASE_PATH . '/bootstrap.php';
require_once UTILS_PATH . '/items.util.php';
$products = getAvailableItems();
global $pdo;
if (isset($_SESSION['user'])) {
    $user = Auth::getData($pdo, $_SESSION['user']['username']);
}

?>
<button id="mobile-category-toggle" class="mobile-category-button">☰ Categories</button>

<button id="mobile-cart-toggle" class="mobile-cart-button">🛒 Cart</button>

<div id="mobile-category-popup" class="mobile-category-popup hidden">
  <div class="category-popup-content">
    <aside class="category">
      <div class="store-filters">
        <button class="menu-btn active" data-category="all">All</button>
        <button class="menu-btn" data-category="ore">Ore</button>
        <button class="menu-btn" data-category="tools">Tools</button>
        <button class="menu-btn" data-category="gear">Gear</button>
      </div>
    </aside>
  </div>
</div>

<div id="mobile-cart-popup" class="mobile-cart-popup hidden">
  <div class="cart-popup-content">
    <aside class="cart-box">
        <h2>Cart</h2>
        <ul id="cart-items-mobile"></ul>
        <div class="total">Total: ₱<span id="cart-total-mobile">0</span></div>
        <div class='cart-buttons'>
          <div class='btn-cancel'><button id="checkout-btn-mobile">CHECKOUT</button></div>
          <div class='btn-cancel'><button id="cancel-btn-mobile">CANCEL</button></div>
        </div>
    </aside>
  </div>
</div>

<section class="store-container" id="inventory">
  <div class="store-header">
    <h1>Miner's Ware</h1>
    <?php if (isset($user['wallet'])): ?>
      <div class="leftside">
        
        <a href='/topup'><button class="topupbtn">TOP UP</button></a>
        <a href='/view-orders'><button class="ordersbtn">YOUR ORDERS</button></a>
        <div class="walet">
          <h1>Wallet: <?= htmlspecialchars($user['wallet']) ?> gold</h1>
        </div>
      </div>
    <?php endif; ?>
    <div class="store-filters">
    </div>
  </div>

  <div class="store-main">
    <div class="sidebar">
      <div class="cart-image-wrapper desktop-cart">
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

      <div class="cart-image-wrapper desktop-category">
        <aside class="category">
          <div class="store-filters">
            <button class="menu-btn active" data-category="all">All</button>
            <button class="menu-btn" data-category="ore">Ore</button>
            <button class="menu-btn" data-category="tools">Tools</button>
            <button class="menu-btn" data-category="gear">Gear</button>
          </div>
        </aside>
      </div>
    </div>

    <div class="products-image-wrapper">
      <div class="products-grid">
      <?php if (empty($products)): ?>
        <p style="color:black;">No items found. Check database or item status.</p>
      <?php else: ?>
        <?php foreach ($products as $product): 
          $imgPublicPath = $product['img_path'];
          $localUploadPath = BASE_PATH . $product['img_path'];
          
          $imgStaticPath = '/pages/store/assets/img/' . $product['img_path'];
          $localStaticPath = PAGE_PATH . '/store/assets/img/' . $product['img_path'];

        if (file_exists($localUploadPath)) {
            $finalImagePath = $imgPublicPath;
        } elseif (file_exists($localStaticPath)) {
            $finalImagePath = $imgStaticPath;
        } else {
            $finalImagePath = '/assets/img/placeholder.png';
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
              <button onclick="addToCart('<?= $product['id'] ?>','<?= addslashes($product['name']) ?>', <?= $product['price'] ?>, '<?= strtolower($product['category']) ?>')">Add to Cart</button>
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