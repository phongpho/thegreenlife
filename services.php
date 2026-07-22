<?php
require_once __DIR__ . '/includes/language.php';

?>
<!DOCTYPE html>
<html lang="<?= $currentLang ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Green Life
        <?= $currentLang === 'vi' ? ' | Thương mại dịch vụ – Lưu trú – Nhà hàng' : ' | Trade Services & Hospitality' ?>
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/services.css">
</head>

<body>

    <?php require_once __DIR__ . '/includes/navbar.php'; ?>
    <!-- banner -->

    <div class="section banner-section">
        <div class="container">
            <div class="title-page">
                <h1>
                    <?= $lang['services_banner_title'] ?>

                </h1>

                <div class="breadcrumb">

                    <a href="index.php"><?= $lang['breadcrumb_home'] ?></a>

                    <span>/</span>


                    <span class="current">
                        <?= $lang['services_breadcrumb'] ?>

                    </span>

                </div>
            </div>
        </div>
    </div>


    <div class="section ecosystem-section">
        <div class="container">
            <div class="ecosystem-layout">
                <!-- Cột trái: Tiêu đề giới thiệu -->
                <div class="ecosystem-intro">
                    <div class="section-header">
                        <h2 class="title-with-line"><?= $lang['services_ecosystem_title'] ?></h2>
                    </div>
                    <h2 class="section-title"><?= $lang['services_ecosystem_heading'] ?></h2>
                    <p class="section-desc">
                        <?= $lang['services_ecosystem_desc'] ?>
                    </p>
                </div>

                <!-- Cột phải: Các mốc dịch vụ và hình ảnh nhỏ tương ứng -->
                <div class="ecosystem-content">
                    <!-- Hàng Icon + Tên dịch vụ kết nối ngang -->
                    <div class="ecosystem-steps">
                        <div class="step-item">
                            <div class="step-icon"><i class="fa-solid fa-bed"></i></div>
                            <h4><?= $lang['services_step_1'] ?></h4>
                        </div>
                        <div class="step-item">
                            <div class="step-icon"><i class="fa-solid fa-bell-concierge"></i></div>
                            <h4><?= $lang['services_step_2'] ?></h4>
                        </div>
                        <div class="step-item">
                            <div class="step-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                            <h4><?= $lang['services_step_3'] ?></h4>
                        </div>
                        <div class="step-item">
                            <div class="step-icon"><i class="fa-solid fa-handshake"></i></div>
                            <h4><?= $lang['services_step_4'] ?></h4>
                        </div>
                    </div>

                    <!-- Hàng thẻ ảnh minh họa phía dưới -->
                    <div class="ecosystem-gallery">
                        <div class="gallery-card">
                            <div class="img-wrapper">
                                <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Dịch vụ lưu trú">
                            </div>
                            <p><?= $lang['services_gallery_1_desc'] ?></p>
                        </div>
                        <div class="gallery-card">
                            <div class="img-wrapper">
                                <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Nhà hàng">
                            </div>
                            <p><?= $lang['services_gallery_2_desc'] ?></p>
                        </div>
                        <div class="gallery-card">
                            <div class="img-wrapper">
                                <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Thương mại tổng hợp">
                            </div>
                            <p><?= $lang['services_gallery_3_desc'] ?></p>
                        </div>
                        <div class="gallery-card">
                            <div class="img-wrapper">
                                <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Xúc tiến thương mại">
                            </div>
                            <p><?= $lang['services_gallery_4_desc'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section core-services-section">
        <div class="container">
            <h2 class="core-section-title"><?= $lang['services_core_title'] ?></h2>

            <div class="core-services-grid">
                <!-- Card 01 -->
                <div class="core-service-card">
                    <div class="card-header">
                        <span class="card-num">01</span>
                        <span class="card-divider"></span>
                        <h3><?= $lang['services_core_1_title'] ?></h3>
                    </div>
                    <div class="card-img">
                        <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Dịch vụ lưu trú">
                    </div>
                    <p class="card-desc"><?= $lang['services_core_1_desc'] ?></p>
                </div>

                <!-- Card 02 -->
                <div class="core-service-card">
                    <div class="card-header">
                        <span class="card-num">02</span>
                        <span class="card-divider"></span>
                        <h3><?= $lang['services_core_2_title'] ?></h3>
                    </div>
                    <div class="card-img">
                        <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Nhà hàng">
                    </div>
                    <p class="card-desc"><?= $lang['services_core_2_desc'] ?></p>
                </div>

                <!-- Card 03 -->
                <div class="core-service-card">
                    <div class="card-header">
                        <span class="card-num">03</span>
                        <span class="card-divider"></span>
                        <h3><?= $lang['services_core_3_title'] ?></h3>
                    </div>
                    <div class="card-img">
                        <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Thương mại dịch vụ tổng hợp">
                    </div>
                    <p class="card-desc"><?= $lang['services_core_3_desc'] ?></p>
                </div>

                <!-- Card 04 -->
                <div class="core-service-card">
                    <div class="card-header">
                        <span class="card-num">04</span>
                        <span class="card-divider"></span>
                        <h3><?= $lang['services_core_4_title'] ?></h3>
                    </div>
                    <div class="card-img">
                        <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Kết nối giao thương">
                    </div>
                    <p class="card-desc"><?= $lang['services_core_4_desc'] ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================================== MẠNG LƯỚI KẾT NỐI ===================================== -->
    <section class="section network-section">
        <div class="container">
            <div class="network-content">
                <h2 class="network-title"><?= $lang['services_network_title'] ?></h2>
                <p class="network-desc">
                    <?= $lang['services_network_desc'] ?>
                </p>

            </div>
        </div>
    </section>






    <?php require_once __DIR__ . '/includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>

</html>