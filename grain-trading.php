<?php
require_once __DIR__ . '/includes/language.php';

?>
<!DOCTYPE html>
<html lang="<?= $currentLang ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Green Life
        <?= $currentLang === 'vi' ? ' | Xuất nhập khẩu & Chế biến' : ' | Import-Export & Processing' ?>
    </title>
    <!-- <meta name="description" content="<?= htmlspecialchars($lang['home_hero_desc']) ?>"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/agriculture.css">
</head>

<body>

    <?php require_once __DIR__ . '/includes/navbar.php'; ?>
    <!-- banner -->

    <div class="section banner-section">
        <div class="container">
            <div class="title-page">
                <h1>
                    <?= $lang['grain_banner_title'] ?>
                </h1>

                <div class="breadcrumb">

                    <a href="index.php"><?= $lang['breadcrumb_home'] ?></a>

                    

                    <span>/</span>

                    <span class="current">
                        <?= $lang['grain_breadcrumb'] ?>
                    </span>

                </div>
            </div>
        </div>
    </div>




    <div class="section pic-section">
        <div class="container">
            <h2 class="title-with-line"><?= $lang['grain_section_title'] ?></h2>

            <div class="img-first">
                <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png"
                    alt="xuất nhập khẩu và chế biến lương thực.">

                <div class="overview-card">
                    <h2><?= $lang['grain_overview_title'] ?></h2>

                    <p>
                        <?= $lang['grain_overview_desc'] ?>
                    </p>
                </div>
            </div>


        </div>
    </div>



    <div class="section capability-section">

        <div class="capability-wrapper">

            <div class="capability-left">

                <h2 class="title-with-line"><?= $lang['grain_capability_title'] ?></h2>
                <p>
                    <?= $lang['grain_capability_desc'] ?>
                </p>

                <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">

            </div>

            <div class="capability-right">

                <div class="capability-item">

                    <span class="number">01</span>

                    <div class="content">
                        <h3><?= $lang['grain_cap_1_title'] ?></h3>
                        <p><?= $lang['grain_cap_1_desc'] ?></p>
                    </div>

                    <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">

                </div>

                <div class="capability-item">

                    <span class="number">02</span>

                    <div class="content">
                        <h3><?= $lang['grain_cap_2_title'] ?></h3>
                        <p><?= $lang['grain_cap_2_desc'] ?></p>
                    </div>

                    <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">

                </div>

                <div class="capability-item">

                    <span class="number">03</span>

                    <div class="content">
                        <h3><?= $lang['grain_cap_3_title'] ?></h3>
                        <p><?= $lang['grain_cap_3_desc'] ?></p>
                    </div>

                    <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">

                </div>

                <div class="capability-item">

                    <span class="number">04</span>

                    <div class="content">
                        <h3><?= $lang['grain_cap_4_title'] ?></h3>
                        <p><?= $lang['grain_cap_4_desc'] ?></p>
                    </div>

                    <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">

                </div>

                <div class="capability-item">

                    <span class="number">05</span>

                    <div class="content">
                        <h3><?= $lang['grain_cap_5_title'] ?></h3>
                        <p><?= $lang['grain_cap_5_desc'] ?></p>
                    </div>

                    <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">

                </div>

                <div class="capability-item">

                    <span class="number">06</span>

                    <div class="content">
                        <h3><?= $lang['grain_cap_6_title'] ?></h3>
                        <p><?= $lang['grain_cap_6_desc'] ?></p>
                    </div>

                    <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">

                </div>
            </div>

        </div>

    </div>


    <!-- năng lực thương mại -->
    <div class="section trading-section">

        <div class=" container trading-wrapper">
            <h2 class="title-with-line"><?= $lang['grain_trading_title'] ?></h2>
            <div class="trading-header">

                <div class="heading">
                    <h3>
                        <?= $lang['grain_trading_heading'] ?>
                    </h3>

                    <p>
                        <?= $lang['grain_trading_desc'] ?>
                    </p>

                </div>

                <div class="trading-stat">

                    <span class="number">
                        <?= $lang['grain_trading_stat_number'] ?>
                    </span>

                    <span class="unit">
                        <?= $lang['grain_trading_stat_unit'] ?>
                    </span>

                    <p>
                        <?= $lang['grain_trading_stat_desc'] ?>
                    </p>

                </div>

                <div class="market-map">

                    <img src="assets/images/agriculture/kim-ngach-xuat-khau.png">

                </div>

            </div>

            <div class="product-gallery">

                <h3 class="section-title"><?= $lang['grain_products_title'] ?></h3>

                <div class="products-wrapper">
                    <button class="products-nav products-nav--prev" aria-label="Previous">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>

                    <div class="products-scroll">
                        <div class="products">

                            <div class="product">
                                <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">
                                <span><?= $lang['grain_product_1'] ?></span>
                            </div>

                            <div class="product">
                                <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">
                                <span><?= $lang['grain_product_2'] ?></span>
                            </div>

                            <div class="product">
                                <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">
                                <span><?= $lang['grain_product_3'] ?></span>
                            </div>

                            <div class="product">
                                <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">
                                <span><?= $lang['grain_product_4'] ?></span>
                            </div>

                            <div class="product">
                                <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">
                                <span><?= $lang['grain_product_5'] ?></span>
                            </div>

                            <div class="product">
                                <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">
                                <span><?= $lang['grain_product_6'] ?></span>
                            </div>

                        </div>
                    </div>

                    <button class="products-nav products-nav--next" aria-label="Next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>

            </div>

            <div class="trade-process">

                <h3 class="section-title"><?= $lang['grain_process_title'] ?></h3>

                <div class="process">

                    <div class="step">
                        <div class="icon">
                            <i class="fa-solid fa-seedling"></i>
                        </div>

                        <h4><?= $lang['grain_step_1_title'] ?></h4>

                        <p>
                            <?= $lang['grain_step_1_desc'] ?>
                        </p>
                    </div>

                    <div class="arrow">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                    <div class="step">
                        <div class="icon">
                            <i class="fa-solid fa-industry"></i>
                        </div>

                        <h4><?= $lang['grain_step_2_title'] ?></h4>

                        <p>
                            <?= $lang['grain_step_2_desc'] ?>
                        </p>
                    </div>

                    <div class="arrow">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                    <div class="step">
                        <div class="icon">
                            <i class="fa-solid fa-truck-fast"></i>
                        </div>

                        <h4><?= $lang['grain_step_3_title'] ?></h4>

                        <p>
                            <?= $lang['grain_step_3_desc'] ?>
                        </p>
                    </div>

                    <div class="arrow">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                    <div class="step">
                        <div class="icon">
                            <i class="fa-solid fa-ship"></i>
                        </div>

                        <h4><?= $lang['grain_step_4_title'] ?></h4>

                        <p>
                            <?= $lang['grain_step_4_desc'] ?>
                        </p>
                    </div>

                    <div class="arrow">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                    <div class="step">
                        <div class="icon">
                            <i class="fa-solid fa-handshake"></i>
                        </div>

                        <h4><?= $lang['grain_step_5_title'] ?></h4>

                        <p>
                            <?= $lang['grain_step_5_desc'] ?>
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>



    <?php require_once __DIR__ . '/includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>

</html>