<?php
$currentPage = basename($_SERVER['PHP_SELF'] ?? 'index.php');
?>
<header id="siteHeader" class="site-header">
    <div class="container header-container">
        
        <a href="index.php" class="logo">
            <div class="logo-card">
                <img src="assets/images/global/the-green-life-logo.webp" alt="The Green Life" class="logo-img">
            </div>
        </a>

        <!-- Language dropdown for mobile – outside hamburger menu -->
        <div class="mobile-utils">
            <div class="lang-dropdown lang-dropdown--mobile" id="langDropdownMobile">
                <button class="lang-dropdown-toggle" id="langDropdownMobileToggle" aria-expanded="false" aria-label="Select language">
                    <img src="<?= $languages[$currentLang]['flag'] ?>" width="20" height="14" alt="" class="flag-icon">
                    <span class="lang-code"><?= strtoupper($currentLang) ?></span>
                    <span class="caret">▼</span>
                </button>
                <ul class="lang-dropdown-menu">
                    <?php foreach ($languages as $code => $info): ?>
                    <li>
                        <a href="<?= lang_switch_url($code) ?>" class="<?= $currentLang === $code ? 'active' : '' ?>">
                            <img src="<?= $info['flag'] ?>" width="20" height="14" alt="" class="flag-icon">
                            <?= $info['name'] ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <button class="navbar-toggle" id="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>

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


        </nav>

        <div class="nav-utils">
            <div class="lang-dropdown" id="langDropdown">
                <button class="lang-dropdown-toggle" id="langDropdownToggle" aria-expanded="false" aria-label="Select language">
                    <img src="<?= $languages[$currentLang]['flag'] ?>" width="20" height="14" alt="" class="flag-icon">
                    <span class="lang-code"><?= strtoupper($currentLang) ?></span>
                    <span class="caret">▼</span>
                </button>
                <ul class="lang-dropdown-menu">
                    <?php foreach ($languages as $code => $info): ?>
                    <li>
                        <a href="<?= lang_switch_url($code) ?>" class="<?= $currentLang === $code ? 'active' : '' ?>">
                            <img src="<?= $info['flag'] ?>" width="20" height="14" alt="" class="flag-icon">
                            <?= $info['name'] ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</header>