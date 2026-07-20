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
    <title>The Green Life
        <?= $currentLang === 'vi' ? ' | Trang chủ' : ' | Home' ?>
    </title>
    <!-- <meta name="description" content="<?= htmlspecialchars($lang['home_hero_desc']) ?>"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>

    <?php require_once __DIR__ . '/includes/navbar.php'; ?>
    <!-- banner -->
    <div class="section banner" id="bannerSection" data-banner-images='<?= htmlspecialchars(json_encode($bannerImages), ENT_QUOTES) ?>'>
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
    <div class="section about-section">
        <div class="container-flex">
            <div class="content">
                <div class="title-with-line">
                    <h2>
                        <?= $lang['index_title_h2'] ?>
                    </h2>
                    <h3>
                        <?= $lang['index_title_h3'] ?>
                    </h3>
                </div>

                <p>
                    <?= $lang['index_p_1'] ?>
                </p>

                <a href="about-us.php" class="btn btn-primary">
                    <?= $lang['index_btn_learn_more'] ?>
                </a>
            </div>
        </div>
    </div>

    <!-- Giá trị cốt lõi -->
    <div class="section values-section">
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
    </div>

    <!-- lĩnh vực hoạt động cơ bản -->
    <div class="section activities-section">
        <div class="container">
            <div class="section-header">
                <h2 class="title-with-line"><?= $lang['index_activities_heading'] ?></h2>
            </div>

            <!-- Khối chứa các thẻ -->
            <div class="activity-grid">

                <!-- Thẻ 1 -->
                <div class="activity-card">
                    <div class="activity-picture">
                        <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="<?= $lang['index_activity_1_title'] ?>">
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
                        <img src="assets/images/index/ca-nguyen-lieu-sach.jpg" alt="<?= $lang['index_activity_2_title'] ?>">
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
                        <img src="assets/images/index/thuong-mai-dich-vu.jpg" alt="<?= $lang['index_activity_3_title'] ?>">
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
                <h2 class="title-with-line"><?= $lang['index_products_heading'] ?></h2>
            </div>
        </div>

        <div class="product-slider-outer">
            <button id="prevProduct" class="arrow-btn arrow-btn--prev" aria-label="Previous"><i class="fas fa-arrow-left"></i></button>
            <button id="nextProduct" class="arrow-btn arrow-btn--next" aria-label="Next"><i class="fas fa-arrow-right"></i></button>

            <div class="product-slider-track" id="productSlider">

                <div class="products-item">
                    <div class="content">
                        <h3><?= $lang['index_product_1_title'] ?></h3>
                        <p><?= $lang['index_product_1_desc'] ?></p>
                    </div>
                    <div class="picture">
                        <img src="assets/images/products/gao-trang.jpg" alt="<?= $lang['index_product_1_title'] ?>">
                    </div>
                </div>

                <div class="products-item">
                    <div class="content">
                        <h3><?= $lang['index_product_2_title'] ?></h3>
                        <p><?= $lang['index_product_2_desc'] ?></p>
                    </div>
                    <div class="picture">
                        <img src="assets/images/products/gao-thom.jpg" alt="<?= $lang['index_product_2_title'] ?>">
                    </div>
                </div>

                <div class="products-item">
                    <div class="content">
                        <h3><?= $lang['index_product_3_title'] ?></h3>
                        <p><?= $lang['index_product_3_desc'] ?></p>
                    </div>
                    <div class="picture">
                        <img src="assets/images/products/gao-st.jpg" alt="<?= $lang['index_product_3_title'] ?>">
                    </div>
                </div>

                <div class="products-item">
                    <div class="content">
                        <h3><?= $lang['index_product_4_title'] ?></h3>
                        <p><?= $lang['index_product_4_desc'] ?></p>
                    </div>
                    <div class="picture">
                        <img src="assets/images/products/ca-tra-nguyen-lieu.jpg" alt="<?= $lang['index_product_4_title'] ?>">
                    </div>
                </div>

                <div class="products-item">
                    <div class="content">
                        <h3><?= $lang['index_product_5_title'] ?></h3>
                        <p><?= $lang['index_product_5_desc'] ?></p>
                    </div>
                    <div class="picture">
                        <img src="assets/images/products/ca-dieu-hong-nguyen-lieu.jpg" alt="<?= $lang['index_product_5_title'] ?>">
                    </div>
                </div>

                <div class="products-item">
                    <div class="content">
                        <h3><?= $lang['index_product_6_title'] ?></h3>
                        <p><?= $lang['index_product_6_desc'] ?></p>
                    </div>
                    <div class="picture">
                        <img src="assets/images/products/lua-nguyen-lieu.png" alt="<?= $lang['index_product_6_title'] ?>">
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- tin tức sự kiện -->
    <div class="section news-section">
        <div class="container">
            <div class="section-header">
                <h2 class="title-with-line"><?= $lang['index_news_heading'] ?></h2>
            </div>

            <div class="container-flex">
                <div class="container-flex-left">
                    <div class="picture">
                        <img src="assets/images/global/default.png" alt="About Us">
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
                        <img src="assets/images/global/default.png" alt="About Us">

                        <h4>
                            <?= $lang['index_news_updating'] ?>
                        </h4>
                    </div>

                    <div class="container-flex-right-small">
                        <img src="assets/images/global/default.png" alt="About Us">

                        <h4>
                            <?= $lang['index_news_updating'] ?>
                        </h4>
                    </div>

                    <div class="container-flex-right-small">
                        <img src="assets/images/global/default.png" alt="About Us">

                        <h4>
                            <?= $lang['index_news_updating'] ?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once __DIR__ . '/includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>

</html>