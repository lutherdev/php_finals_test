<?php
    require_once BASE_PATH . "/bootstrap.php";
    $site_name = 'MineForge';
    $user_role = $_SESSION['user']['role'] ?? 'customer';
    $nav_config = require STATICDATAS_PATH . '/navConfig.staticData.php';
    $navbar_items = $nav_config[$user_role] ?? [];
    $current_page = basename($_SERVER['PHP_SELF']);
    $logo = BASE_PATH . '/assets/img/mineforge.png';

?>
<link rel="stylesheet" href="/assets/css/nav.component.css">
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-logo">
                <a href="home-page">
                    <img src ="/assets/img/mineforge.png" alt ="logo" class="logo-img">
                    <span class="logo-text">MineForge</span>
                </a>
            </div>

                <button class="burger-menu" aria-label="Toggle navigation">
                    <span class="burger-line"></span>
                    <span class="burger-line"></span>
                    <span class="burger-line"></span>
                </button>

            <div class="navbar-menu">
                <?php foreach ($navbar_items as $title => $url): ?>
                    <?php if (is_array($url)): ?>
                        <div class="navbar-item dropdown">
                            <span class="dropdown-title"><?php echo htmlspecialchars($title); ?></span>
                            
                            <div class="dropdown-content">
                                <?php foreach ($url as $subTitle => $subUrl): ?>
                                    <a href="<?php echo htmlspecialchars($subUrl); ?>"><?php echo htmlspecialchars($subTitle); ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo htmlspecialchars($url); ?>"
                        class="navbar-item <?php echo ($current_page === $url) ? 'is-active' : ''; ?>">
                        <?php echo htmlspecialchars($title); ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </nav>
        <script src="../assets/js/nav.component.js" defer></script>