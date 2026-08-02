<?php
require_once __DIR__ . '/includes/language.php';

$bannerDir = __DIR__ . '/assets/images/banner';
$bannerImages = [];

if (is_dir($bannerDir)) {
    $files = glob($bannerDir . '/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE);
    natsort($files); 
    foreach ($files as $file) {
        $bannerImages[] = 'assets/images/banner/' . basename($file);
    }
}
?>
<!DOCTYPE html>
<html lang="<?= $currentLang ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($lang['index_og_title']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($lang['index_meta_desc']) ?>">

    <!-- Canonical & hreflang -->
    <link rel="canonical" href="https://thegreenlife.vn/">
    <link rel="alternate" hreflang="vi" href="https://thegreenlife.vn/">
    <link rel="alternate" hreflang="en" href="https://thegreenlife.vn/?lang=en">
    <link rel="alternate" hreflang="x-default" href="https://thegreenlife.vn/">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($lang['index_og_title']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($lang['index_meta_desc']) ?>">
    <meta property="og:image" content="https://thegreenlife.vn/assets/images/global/the-green-life-logo.webp">
    <meta property="og:url" content="https://thegreenlife.vn/">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="The Green Life">
    <meta property="og:locale" content="<?= $currentLang === 'en' ? 'en_US' : 'vi_VN' ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($lang['index_og_title']) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($lang['index_meta_desc']) ?>">
    <meta name="twitter:image" content="https://thegreenlife.vn/assets/images/global/the-green-life-logo.webp">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/global/favicon.ico">
    <link rel="apple-touch-icon" href="assets/images/global/the-green-life-logo.webp">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/index.css">

    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "The Green Life",
      "url": "https://thegreenlife.vn",
      "logo": "https://thegreenlife.vn/assets/images/global/the-green-life-logo.webp",
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+84939660004",
        "contactType": "customer service",
        "availableLanguage": ["Vietnamese", "English"]
      },
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Tỉnh lộ 941, Xã Bình Hòa",
        "addressLocality": "An Giang",
        "addressCountry": "VN"
      },
      "sameAs": [
        "https://www.facebook.com/",
        "https://www.tiktok.com/",
        "https://www.youtube.com/"
      ]
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "The Green Life",
      "url": "https://thegreenlife.vn",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://thegreenlife.vn/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
</head>

<body>

    <?php require_once __DIR__ . '/includes/navbar.php'; ?>

    <main>
        <!-- banner -->
        <section class="section banner" id="bannerSection" role="banner"
            data-banner-images='<?= htmlspecialchars(json_encode($bannerImages), ENT_QUOTES) ?>'>
            <?php if (!empty($bannerImages)): ?>
                <noscript>
                    <img src="<?= htmlspecialchars($bannerImages[0]) ?>" alt="The Green Life Banner"
                        style="width:100%;height:100%;object-fit:cover;">
                </noscript>
            <?php endif; ?>
            <?php if (count($bannerImages) > 1): ?>
                <button id="bannerPrev" class="banner-arrow banner-arrow-left"
                    aria-label="<?= $lang['index_banner_prev'] ?>">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button id="bannerNext" class="banner-arrow banner-arrow-right"
                    aria-label="<?= $lang['index_banner_next'] ?>">
                    <i class="fas fa-chevron-right"></i>
                </button>
            <?php endif; ?>
        </section>




        <!-- giới thiệu sơ lược -->
        <section class="section about-section" aria-labelledby="about-heading">
            <div class="container-flex">
                <div class="content">
                    <p class="hero-eyebrow"><?= $lang['index_hero_eyebrow'] ?></p>
                    <div class="title-with-line">
                        <h1 id="about-heading">
                            <?= $lang['index_hero_h1'] ?>
                        </h1>
                        <span class="hero-subtitle"><?= $lang['index_hero_subtitle'] ?></span>
                    </div>

                    <p class="hero-desc">
                        <?= $lang['index_hero_desc'] ?>
                    </p>

                    <a href="<?= route_to_url('about-us.php', $currentLang) ?>" class="btn btn-primary">
                        <?= $lang['index_btn_learn_more'] ?>
                    </a>
                </div>
            </div>
        </section>

        <!-- Giá trị cốt lõi -->
        <section class="section values-section" aria-labelledby="values-heading">
            <div class="container-flex values">
                <!-- Thẻ 1 -->
                <div class="value-card">
                    <div class="card-header">
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="title">
                            <?= $lang['index_value_1_title'] ?>
                        </h3>
                    </div>
                    <div class="card-body">
                        <p>
                            <?= $lang['index_value_1_desc'] ?>
                        </p>
                    </div>
                </div>

                <!-- Thẻ 2 -->
                <div class="value-card">
                    <div class="card-header">
                        <div class="icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h3 class="title">
                            <?= $lang['index_value_2_title'] ?>
                        </h3>
                    </div>
                    <div class="card-body">
                        <p>
                            <?= $lang['index_value_2_desc'] ?>
                        </p>
                    </div>
                </div>

                <!-- Thẻ 3 -->
                <div class="value-card">
                    <div class="card-header">
                        <div class="icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h3 class="title">
                            <?= $lang['index_value_3_title'] ?>
                        </h3>
                    </div>
                    <div class="card-body">
                        <p>
                            <?= $lang['index_value_3_desc'] ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- hệ thống ruộng lúa -->
        <section class="section farms-section" aria-labelledby="farms-heading">
            <div class="container">
                <div class="content-farm">
                    <div class="section-header-farms">
                        <h2 class="title-with-line" id="farms-heading"><?= $lang['index_farms_heading'] ?></h2>

                        <p class="hero-desc">
                            <?= $lang['index_farm_desc'] ?>
                        </p>
                    </div>

                    <div class="picture">
                        <img src="assets/images/index/ruong-lua.webp" alt="About Us">
                    </div>
                </div>

                <div class="farm-small">

                    <div class="farm-item">
                        <img src="assets/images/index/thu-hoach-lua.webp">
                        <div class="farm-item-content">
                            <div class="farm-icon">
                                <i class="fa-solid fa-wheat-awn"></i>
                            </div>
                            <div class="farm-item-title">
                                <h3><?= $lang['index_farm_harvest_title'] ?></h3>
                                <p><?= $lang['index_farm_harvest_desc'] ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="farm-item">
                        <img src="assets/images/index/van-chuyen-lua.webp">
                        <div class="farm-item-content">
                            <div class="farm-icon">
                                <i class="fa-solid fa-truck"></i>
                            </div>
                            <div class="farm-item-title">
                                <h3><?= $lang['index_farm_transport_title'] ?></h3>
                                <p><?= $lang['index_farm_transport_desc'] ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="farm-item">
                        <img src="assets/images/index/kho-chua-lua.webp">
                        <div class="farm-item-content">
                            <div class="farm-icon">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <div class="farm-item-title">
                                <h3><?= $lang['index_farm_storage_title'] ?></h3>
                                <p><?= $lang['index_farm_storage_desc'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- vùng nguyên liệu thủy sản -->
        <section class="section seafarms-section" aria-labelledby="seafarms-heading">
            <div class="container">
                <div class="content-seafarm">
                    <div class="section-header-seafarms">
                        <h2 class="title-with-line" id="seafarms-heading"><?= $lang['index_seafarm_heading'] ?></h2>

                        <p class="hero-desc">
                            <?= $lang['index_seafarm_desc'] ?>
                        </p>

                        <div class="note-item">
                            <div class="icon">
                                <i class="fas fa-award"></i>
                            </div>
                            <div class="note-item-content">
                                <span>
                                    <?= $lang['index_seafarm_note_1_title'] ?>
                                </span>
                                <p>
                                    <?= $lang['index_seafarm_note_1_desc'] ?>
                                </p>
                            </div>
                        </div>

                        <div class="note-item">
                            <div class="icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="note-item-content">
                                <span>
                                    <?= $lang['index_seafarm_note_2_title'] ?>
                                </span>
                                <p>
                                    <?= $lang['index_seafarm_note_2_desc'] ?>
                                </p>
                            </div>
                        </div>

                        <div class="note-item">
                            <div class="icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="note-item-content">
                                <span>
                                    <?= $lang['index_seafarm_note_3_title'] ?>
                                </span>
                                <p>
                                    <?= $lang['index_seafarm_note_3_desc'] ?>
                                </p>
                            </div>
                        </div>


                    </div>

                    <div class="picture">
                        <img src="assets/images/index/trang-trai-thuy-san.webp" alt="About Us">
                    </div>
                </div>

                <div class="seafarm-small">

                    <div class="seafarm-item">
                        <img src="assets/images/index/thu-hoach-ca.webp">
                        <div class="seafarm-item-content">
                            
                            <div class="seafarm-item-title">
                                <h3><?= $lang['index_seafarm_harvest_title'] ?></h3>
                                <p><?= $lang['index_seafarm_harvest_desc'] ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="seafarm-item">
                        <img src="assets/images/index/van-chuyen-ca.webp">
                        <div class="seafarm-item-content">
                            
                            <div class="seafarm-item-title">
                                <h3><?= $lang['index_seafarm_transport_title'] ?></h3>
                                <p><?= $lang['index_seafarm_transport_desc'] ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="seafarm-item">
                        <img src="assets/images/index/bao-quan-ca.webp">
                        <div class="seafarm-item-content">
                            
                            <div class="seafarm-item-title">
                                <h3><?= $lang['index_seafarm_storage_title'] ?></h3>
                                <p><?= $lang['index_seafarm_storage_desc'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- lĩnh vực hoạt động cơ bản -->
        <section class="section activities-section" aria-labelledby="activities-heading">
            <div class="container">
                <div class="section-header">
                    <h2 class="title-with-line" id="activities-heading"><?= $lang['index_activities_heading'] ?></h2>
                </div>

                <div class="activity-grid">
                    <div class="activity-card">
                        <div class="activity-picture">
                            <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg"
                                alt="<?= $lang['index_activity_1_title'] ?>" loading="lazy">
                        </div>
                        <div class="activity-content">
                            <h3 class="card-title"><?= $lang['index_activity_1_title'] ?></h3>
                            <p class="card-desc">
                                <?= $lang['index_activity_1_desc'] ?>
                            </p>
                        </div>
                        <a href="<?= route_to_url('grain-trading.php', $currentLang) ?>" class="corner-btn"><i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div class="activity-card">
                        <div class="activity-picture">
                            <img src="assets/images/index/ca-nguyen-lieu-sach.jpg"
                                alt="<?= $lang['index_activity_2_title'] ?>" loading="lazy">
                        </div>
                        <div class="activity-content">
                            <h3 class="card-title"><?= $lang['index_activity_2_title'] ?></h3>
                            <p class="card-desc">
                                <?= $lang['index_activity_2_desc'] ?>
                            </p>
                        </div>
                        <a href="<?= route_to_url('seafood.php', $currentLang) ?>" class="corner-btn"><i class="fas fa-arrow-right"></i></a>
                    </div>

                    <div class="activity-card">
                        <div class="activity-picture">
                            <img src="assets/images/index/thuong-mai-dich-vu.jpg"
                                alt="<?= $lang['index_activity_3_title'] ?>" loading="lazy">
                        </div>
                        <div class="activity-content">
                            <h3 class="card-title"><?= $lang['index_activity_3_title'] ?></h3>
                            <p class="card-desc">
                                <?= $lang['index_activity_3_desc'] ?>
                            </p>
                        </div>
                        <a href="<?= route_to_url('services.php', $currentLang) ?>" class="corner-btn"><i class="fas fa-arrow-right"></i></a>
                    </div>

                </div>
            </div>
        </section>



        <!-- sản phẩm -->
        <section class="section products-section" aria-labelledby="products-heading">
            <div class="container">
                <div class="section-header">
                    <h2 class="title-with-line" id="products-heading"><?= $lang['index_products_heading'] ?></h2>
                </div>
            </div>

            <div class="product-slider-outer">
                <button id="prevProduct" class="arrow-btn arrow-btn--prev" aria-label="Previous"><i
                        class="fas fa-arrow-left"></i></button>
                <button id="nextProduct" class="arrow-btn arrow-btn--next" aria-label="Next"><i
                        class="fas fa-arrow-right"></i></button>

                <div class="product-slider-track" id="productSlider">

                    <div class="products-item">
                        <div class="content">
                            <h3><?= $lang['index_product_1_title'] ?></h3>
                            <p><?= $lang['index_product_1_desc'] ?></p>
                        </div>
                        <div class="picture">
                            <img src="assets/images/products/gao-trang.jpg" alt="<?= $lang['index_product_1_title'] ?>"
                                loading="lazy">
                        </div>
                    </div>

                    <div class="products-item">
                        <div class="content">
                            <h3><?= $lang['index_product_2_title'] ?></h3>
                            <p><?= $lang['index_product_2_desc'] ?></p>
                        </div>
                        <div class="picture">
                            <img src="assets/images/products/gao-thom.jpg" alt="<?= $lang['index_product_2_title'] ?>"
                                loading="lazy">
                        </div>
                    </div>

                    <div class="products-item">
                        <div class="content">
                            <h3><?= $lang['index_product_3_title'] ?></h3>
                            <p><?= $lang['index_product_3_desc'] ?></p>
                        </div>
                        <div class="picture">
                            <img src="assets/images/products/gao-st.jpg" alt="<?= $lang['index_product_3_title'] ?>"
                                loading="lazy">
                        </div>
                    </div>

                    <div class="products-item">
                        <div class="content">
                            <h3><?= $lang['index_product_4_title'] ?></h3>
                            <p><?= $lang['index_product_4_desc'] ?></p>
                        </div>
                        <div class="picture">
                            <img src="assets/images/products/ca-tra-nguyen-lieu.jpg"
                                alt="<?= $lang['index_product_4_title'] ?>" loading="lazy">
                        </div>
                    </div>

                    <div class="products-item">
                        <div class="content">
                            <h3><?= $lang['index_product_5_title'] ?></h3>
                            <p><?= $lang['index_product_5_desc'] ?></p>
                        </div>
                        <div class="picture">
                            <img src="assets/images/products/ca-dieu-hong-nguyen-lieu.jpg"
                                alt="<?= $lang['index_product_5_title'] ?>" loading="lazy">
                        </div>
                    </div>

                    <div class="products-item">
                        <div class="content">
                            <h3><?= $lang['index_product_6_title'] ?></h3>
                            <p><?= $lang['index_product_6_desc'] ?></p>
                        </div>
                        <div class="picture">
                            <img src="assets/images/products/lua-nguyen-lieu.png"
                                alt="<?= $lang['index_product_6_title'] ?>" loading="lazy">
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!-- tin tức sự kiện -->
        <section class="section news-section" aria-labelledby="news-heading">
            <div class="container">
                <div class="section-header">
                    <h2 class="title-with-line" id="news-heading"><?= $lang['index_news_heading'] ?></h2>
                </div>

                <div class="container-flex">
                    <div class="container-flex-left">
                        <div class="picture">
                            <img src="assets/images/global/default.png" alt="News thumbnail" loading="lazy">
                        </div>

                        <div class="content">
                            <div>
                                <h3>
                                    <?= $lang['index_news_updating'] ?>
                                </h3>
                            </div>

                            <p>
                                <?= $lang['index_news_updating'] ?>
                            </p>
                        </div>
                    </div>

                    <div class="container-flex-right">
                        <div class="container-flex-right-small">
                            <img src="assets/images/global/default.png" alt="News thumbnail" loading="lazy">

                            <h4>
                                <?= $lang['index_news_updating'] ?>
                            </h4>
                        </div>

                        <div class="container-flex-right-small">
                            <img src="assets/images/global/default.png" alt="News thumbnail" loading="lazy">

                            <h4>
                                <?= $lang['index_news_updating'] ?>
                            </h4>
                        </div>

                        <div class="container-flex-right-small">
                            <img src="assets/images/global/default.png" alt="News thumbnail" loading="lazy">

                            <h4>
                                <?= $lang['index_news_updating'] ?>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- liên hệ ngay -->
        <section class="section cta-section" aria-labelledby="cta-heading">
            <div class="cta-container">
                <!-- Organic blob background -->
                <div class="cta-blob" aria-hidden="true">
                    <svg viewBox="0 0 600 500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                        <path d="M420.5,62.8C481.3,95.2,557.8,138.7,574.2,199.3C590.6,259.9,546.8,337.6,496.4,387.1C446,436.6,389.1,457.8,320.3,472.5C251.5,487.2,170.9,495.4,113.6,458.8C56.3,422.2,22.3,340.9,11.8,269.1C1.3,197.3,14.4,135,54.8,89.2C95.2,43.4,162.9,14.1,243.7,9.9C324.5,5.7,359.7,30.4,420.5,62.8Z" fill="currentColor" opacity="0.06"/>
                    </svg>
                </div>
                <div class="cta-blob cta-blob--secondary" aria-hidden="true">
                    <svg viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                        <path d="M323.2,43.9C388.9,69.5,460.5,109.5,474.2,167.5C487.9,225.5,443.7,301.5,388.2,343.9C332.7,386.3,266,395,206.2,402.5C146.4,410,93.5,416.3,58.2,382.1C22.9,347.9,5.2,273.3,2.8,209.5C0.4,145.7,13.3,92.7,47.8,55.5C82.3,18.3,138.4,-3.1,213.7,0.4C289,3.9,257.5,18.3,323.2,43.9Z" fill="currentColor" opacity="0.04"/>
                    </svg>
                </div>

                <!-- Visual circle (right side) -->
                <div class="cta-visual" aria-hidden="true">
                    <div class="cta-circle">
                        <div class="cta-circle-ring cta-circle-ring--1"></div>
                        <div class="cta-circle-ring cta-circle-ring--2"></div>
                        <div class="cta-circle-inner">
                            <i class="fas fa-handshake"></i>
                        </div>
                    </div>
                    <div class="cta-dot cta-dot--1" aria-hidden="true"></div>
                    <div class="cta-dot cta-dot--2" aria-hidden="true"></div>
                    <div class="cta-dot cta-dot--3" aria-hidden="true"></div>
                </div>

                <!-- Content (left side) -->
                <div class="cta-content">
                    <span class="cta-tag"><?= $lang['index_cta_tag'] ?></span>
                    <h2 class="cta-heading" id="cta-heading"><?= $lang['index_cta_heading'] ?></h2>
                    <p class="cta-desc"><?= $lang['index_cta_desc'] ?></p>
                    <div class="cta-actions">
                        <a href="<?= route_to_url('contact.php', $currentLang) ?>" class="cta-btn cta-btn--primary">
                            <?= $lang['index_cta_btn_primary'] ?>
                            <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </a>
                        <a href="<?= route_to_url('services.php', $currentLang) ?>" class="cta-btn cta-btn--secondary">
                            <?= $lang['index_cta_btn_secondary'] ?>
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <?php require_once __DIR__ . '/includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>

</html>