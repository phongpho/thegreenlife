<?php
require_once __DIR__ . '/includes/language.php';

// Tự động quét toàn bộ ảnh trong thư mục assets/images/banner
$bannerDir = __DIR__ . '/assets/images/banner';
$bannerImages = [];

if (is_dir($bannerDir)) {
    $files = glob($bannerDir . '/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE);
    natsort($files); // sắp xếp banner-1, banner-2... đúng thứ tự
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
    <meta property="og:image" content="https://thegreenlife.vn/assets/images/global/the-green-life-logo.png">
    <meta property="og:url" content="https://thegreenlife.vn/">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="The Green Life">
    <meta property="og:locale" content="<?= $currentLang === 'en' ? 'en_US' : 'vi_VN' ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($lang['index_og_title']) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($lang['index_meta_desc']) ?>">
    <meta name="twitter:image" content="https://thegreenlife.vn/assets/images/global/the-green-life-logo.png">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/global/favicon.ico">
    <link rel="apple-touch-icon" href="assets/images/global/the-green-life-logo.png">

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
      "logo": "https://thegreenlife.vn/assets/images/global/the-green-life-logo.png",
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
    <div class="section banner" id="bannerSection" role="banner"
        data-banner-images='<?= htmlspecialchars(json_encode($bannerImages), ENT_QUOTES) ?>'>
        <?php if (!empty($bannerImages)): ?>
        <noscript>
            <img src="<?= htmlspecialchars($bannerImages[0]) ?>" alt="The Green Life Banner" style="width:100%;height:100%;object-fit:cover;">
        </noscript>
        <?php endif; ?>
        <?php if (count($bannerImages) > 1): ?>
            <button id="bannerPrev" class="banner-arrow banner-arrow-left" aria-label="<?= $lang['index_banner_prev'] ?>">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button id="bannerNext" class="banner-arrow banner-arrow-right" aria-label="<?= $lang['index_banner_next'] ?>">
                <i class="fas fa-chevron-right"></i>
            </button>
        <?php endif; ?>
    </div>




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

                <a href="about-us.php" class="btn btn-primary">
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

    <!-- lĩnh vực hoạt động cơ bản -->
    <section class="section activities-section" aria-labelledby="activities-heading">
        <div class="container">
            <div class="section-header">
                <h2 class="title-with-line" id="activities-heading"><?= $lang['index_activities_heading'] ?></h2>
            </div>

            <!-- Khối chứa các thẻ -->
            <div class="activity-grid">

                <!-- Thẻ 1 -->
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
                    <a href="grain-trading.php" class="corner-btn"><i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Thẻ 2 -->
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
                    <a href="seafood.php" class="corner-btn"><i class="fas fa-arrow-right"></i></a>
                </div>

                <!-- Thẻ 3 -->
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
                    <a href="services.php" class="corner-btn"><i class="fas fa-arrow-right"></i></a>
                </div>

            </div>
        </div>
    </div>



    <!-- sản phẩm -->
    <div class="section products-section">
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
                        <img src="assets/images/products/gao-trang.jpg" alt="<?= $lang['index_product_1_title'] ?>" loading="lazy">
                    </div>
                </div>

                <div class="products-item">
                    <div class="content">
                        <h3><?= $lang['index_product_2_title'] ?></h3>
                        <p><?= $lang['index_product_2_desc'] ?></p>
                    </div>
                    <div class="picture">
                        <img src="assets/images/products/gao-thom.jpg" alt="<?= $lang['index_product_2_title'] ?>" loading="lazy">
                    </div>
                </div>

                <div class="products-item">
                    <div class="content">
                        <h3><?= $lang['index_product_3_title'] ?></h3>
                        <p><?= $lang['index_product_3_desc'] ?></p>
                    </div>
                    <div class="picture">
                        <img src="assets/images/products/gao-st.jpg" alt="<?= $lang['index_product_3_title'] ?>" loading="lazy">
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

    </main>
    <?php require_once __DIR__ . '/includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>

</html>