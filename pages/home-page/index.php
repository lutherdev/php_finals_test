<?php
require_once BASE_PATH . '/bootstrap.php';
$carousel_items = [
  [
    'src' => 'carousel1.jpg',
    'alt' => 'Kingdom of WyrmForge',
  ],
  [
    'src' => 'carousel2.jpg',
    'alt' => 'Lower Cities',
  ],
  [
    'src' => 'carousel3.jpg',
    'alt' => "MineForge's Hall",
  ]
];

$homePageCss = '/pages/homepage/assets/css/home-page.css';
?>

<link rel="stylesheet" href="<?= htmlspecialchars($homePageCss) ?>">
<main class="homepage-container">
  <section class="hero-section">
    <div class="hero-carousel">
        <?php foreach ($carousel_items as $item): ?>
            <div class="carousel-item">
                <img src="/pages/home-page/assets/img/<?= htmlspecialchars($item['src']) ?>"
                alt="<?= htmlspecialchars($item['alt'])?>">
            </div>
        <?php endforeach; ?>
    </div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1>KINGDOM OF WYRMFORGE</h1>
      <p>Mine the most exquisite, high-grade veins beneath the Sword Coast mountains.</p>
      <div class="hero-btn">
        <a href="store" class="btn-gold">Browse Our Wares</a>
        <a href="aboutUs" class="btn-outline">Learn Our History</a>
      </div>
    </div>
  </section>
  <section class="intro-container">
    <div class="intro-content">
        <h2 class="intro-title">MineForge's Legacy</h2>
        <div class="intro-divider"></div>
        <p class="intro-text">
      Forged in the depths of the Sword Coast mountains, MineForge has supplied Baldur's Gate
      with premium metals and minerals since 1357 DR. Our dwarven-crafted wares are
      unearthed through ancient techniques perfected over centuries.
        </p>
        <div class="intro-icon">⚒️</div>
    </div>
  </section>
</main>
