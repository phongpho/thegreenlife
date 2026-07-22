<?php
require_once __DIR__ . '/includes/language.php';

?>
<!DOCTYPE html>
<html lang="<?= $currentLang ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Green Life
        <?= $currentLang === 'vi' ? ' | Thủy sản nguyên liệu' : ' | Seafood' ?>
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/seafood.css">
</head>

<body>

    <?php require_once __DIR__ . '/includes/navbar.php'; ?>
    <!-- banner -->

    <div class="section banner-section">
        <div class="container">
            <div class="title-page">
                <h1>
                    <?= $lang['seafood_banner_title'] ?>
                </h1>

                <div class="breadcrumb">

                    <a href="index.php"><?= $lang['breadcrumb_home'] ?></a>

                    <span>/</span>


                    <span class="current">
                        <?= $lang['seafood_breadcrumb'] ?>
                    </span>

                </div>
            </div>
        </div>


    </div>

    <!-- Hình ảnh tổng quan -->

    <div class="section img-section">
        <div class="container">
            <div class="content">
                <div class="content-top">
                    <span class="title-with-line">
                        <?= $lang['seafood_overview_label'] ?>
                    </span>
                    <h2><?= $lang['seafood_overview_title'] ?></h2>
                    <p>
                        <?= $lang['seafood_overview_desc'] ?>
                    </p>
                </div>

                <div class="note">
                    <div class="note-item">
                        <div class="icon">
                            <!-- Icon Vùng nuôi/Đạt chuẩn: Hình bản đồ có định vị hoặc huy hiệu chất lượng -->
                            <i class="fas fa-award"></i>
                        </div>
                        <span><?= $lang['seafood_note_1_title'] ?></span>
                        <p><?= $lang['seafood_note_1_desc'] ?></p>
                    </div>

                    <div class="note-item">
                        <div class="icon">
                            <!-- Icon Kiểm soát chặt chẽ: Hình chiếc khiên bảo vệ (giống thiết kế mẫu của bạn) -->
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <span><?= $lang['seafood_note_2_title'] ?></span>
                        <p><?= $lang['seafood_note_2_desc'] ?></p>
                    </div>

                    <div class="note-item">
                        <div class="icon">
                            <!-- Icon Nguồn cung ổn định: Hình xe tải vận chuyển chuyên nghiệp -->
                            <i class="fas fa-truck"></i>
                        </div>
                        <span><?= $lang['seafood_note_3_title'] ?></span>
                        <p><?= $lang['seafood_note_3_desc'] ?></p>
                    </div>
                </div>
            </div>

            <div class="big-number">
                <?= $lang['seafood_big_number'] ?>
                <span><?= $lang['seafood_big_number_label'] ?></span>
            </div>

        </div>
    </div>

    <div class="section activities-section">
        <div class="container">
            <div class="section-header">
                <h2 class="title-with-line"><?= $lang['seafood_capability_title'] ?></h2>
            </div>

            <div class="activity-grid">

                <div class="activity-card">
                    <div class="activity-picture">
                        <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Xuất nhập khẩu & Chế biến">
                    </div>
                    <div class="activity-content">
                        <h3 class="card-title"><?= $lang['seafood_product_1_title'] ?></h3>
                        <p class="card-desc">
                            <?= $lang['seafood_product_1_desc'] ?>

                        </p>
                    </div>
                </div>

                <div class="activity-card">
                    <div class="activity-picture">
                        <img src="assets/images/index/ca-nguyen-lieu-sach.jpg" alt="Cá nguyên liệu sạch">
                    </div>
                    <div class="activity-content">
                        <h3 class="card-title"><?= $lang['seafood_product_2_title'] ?></h3>
                        <p class="card-desc">
                            <?= $lang['seafood_product_2_desc'] ?>

                        </p>
                    </div>
                </div>

                <div class="activity-card">
                    <div class="activity-picture">
                        <img src="assets/images/index/thuong-mai-dich-vu.jpg" alt="Xuất nhập khẩu & Chế biến">
                    </div>
                    <div class="activity-content">
                        <h3 class="card-title"><?= $lang['seafood_product_3_title'] ?></h3>
                        <p class="card-desc">
                            <?= $lang['seafood_product_3_desc'] ?>

                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- cam kết chất lượng -->
    <div class="section quality-section">
        <div class="container">
            <div class="section-header">
                <div>
                    <h2 class="title-with-line"><?= $lang['seafood_quality_title'] ?></h2>
                    <p class="section-desc">
                        <?= $lang['seafood_quality_desc'] ?>
                    </p>
                </div>
            </div>

            <div class="quality-wrapper">
                <div class="quality-image">
                    <img src="assets/images/seafood/ca-basa.png" alt="Cam kết chất lượng">
                </div>

                <div class="quality-list">
                    <div class="quality-item">
                        <div class="quality-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="quality-info">
                            <h3><?= $lang['seafood_quality_1_title'] ?></h3>
                            <p><?= $lang['seafood_quality_1_desc'] ?></p>
                        </div>
                    </div>

                    <div class="quality-item">
                        <div class="quality-icon">
                            <i class="fas fa-ban"></i>
                        </div>
                        <div class="quality-info">
                            <h3><?= $lang['seafood_quality_2_title'] ?></h3>
                            <p><?= $lang['seafood_quality_2_desc'] ?></p>
                        </div>
                    </div>

                    <div class="quality-item">
                        <div class="quality-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="quality-info">
                            <h3><?= $lang['seafood_quality_3_title'] ?></h3>
                            <p><?= $lang['seafood_quality_3_desc'] ?></p>
                        </div>
                    </div>

                    <div class="quality-item">
                        <div class="quality-icon">
                            <i class="fas fa-search-location"></i>
                        </div>
                        <div class="quality-info">
                            <h3><?= $lang['seafood_quality_4_title'] ?></h3>
                            <p><?= $lang['seafood_quality_4_desc'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once __DIR__ . '/includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>

</html>