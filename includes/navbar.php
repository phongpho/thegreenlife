<?php
$currentPage = basename($_SERVER['PHP_SELF'] ?? 'index.php');
?>
<header id="siteHeader" class="site-header">
    <div class="container header-container">
        
        <a href="index.php" class="logo">
            <div class="logo-card">
                <img src="assets/images/global/the-green-life-logo.png" alt="The Green Life" class="logo-img">
            </div>
        </a>

        <button class="navbar-toggle" id="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>

        <nav class="navbar-menu" id="navbarMenu">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?= ($currentPage === 'index.php') ? 'active' : '' ?>">
                        <?= $lang['nav_home'] ?? 'Trang chủ' ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="about-us.php" class="nav-link <?= ($currentPage === 'about-us.php') ? 'active' : '' ?>">
                        <?= $lang['nav_about'] ?? 'Về chúng tôi' ?>
                    </a>
                </li>

                <li class="nav-item has-dropdown <?= ($currentPage === 'grain-trading.php') ? 'active' : '' ?>">
                    <a href="grain-trading.php" class="nav-link dropdown-toggle">
                        <?= $lang['nav_operations'] ?? 'Lĩnh vực hoạt động' ?>
                        <span class="caret">▼</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a
                                href="grain-trading.php"><?= $lang['nav_agriculture'] ?? 'Xuất nhập khẩu & Chế biến lương thực' ?></a>
                        </li>
                        <li><a href="seafood.php"><?= $lang['nav_seafood'] ?? 'Thủy sản nguyên liệu' ?></a>
                        </li>
                        <li><a
                                href="services.php"><?= $lang['nav_services'] ?? 'Thương mại dịch vụ & Lưu trú' ?></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="products.php" class="nav-link <?= ($currentPage === 'products.php') ? 'active' : '' ?>">
                        <?= $lang['nav_products'] ?? 'Sản phẩm' ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="news.php" class="nav-link <?= ($currentPage === 'news.php') ? 'active' : '' ?>">
                        <?= $lang['nav_news'] ?? 'Tin tức & Sự kiện' ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="contact.php" class="nav-link <?= ($currentPage === 'contact.php') ? 'active' : '' ?>">
                        <?= $lang['nav_contact'] ?? 'Liên hệ' ?>
                    </a>
                </li>
            </ul>

            <!-- Language switcher inside mobile menu -->
            <div class="nav-lang-mobile">
                <div class="lang-switcher">
                    <a href="<?= lang_switch_url('vi') ?>" class="<?= $currentLang === 'vi' ? 'active' : '' ?>">
                        <img src="https://flagcdn.com/16x12/vn.png" width="16" height="12" alt="VI" class="flag-icon">
                        Tiếng Việt
                    </a>
                    <span class="divider">|</span>
                    <a href="<?= lang_switch_url('en') ?>" class="<?= $currentLang === 'en' ? 'active' : '' ?>">
                        English
                        <img src="https://flagcdn.com/16x12/gb.png" width="16" height="12" alt="EN" class="flag-icon">
                    </a>
                </div>
            </div>
        </nav>

        <div class="nav-utils">
            <div class="lang-switcher">
                <a href="<?= lang_switch_url('vi') ?>" class="<?= $currentLang === 'vi' ? 'active' : '' ?>">
                    <img src="https://flagcdn.com/16x12/vn.png" width="16" height="12" alt="VI" class="flag-icon">
                    VI
                </a>

                <span class="divider">|</span>

                <a href="<?= lang_switch_url('en') ?>" class="<?= $currentLang === 'en' ? 'active' : '' ?>">
                    EN
                    <img src="https://flagcdn.com/16x12/gb.png" width="16" height="12" alt="EN" class="flag-icon">
                </a>
            </div>
        </div>
    </div>
</header>