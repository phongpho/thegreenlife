<?php
require_once __DIR__ . '/includes/language.php';
?>
<!DOCTYPE html>
<html lang="<?= $currentLang ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Green Life
        <?= ' | ' . $lang['about_page_title'] ?>
    </title>
    <!-- <meta name="description" content="<?= htmlspecialchars($lang['home_hero_desc']) ?>"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/about-us.css">
</head>

<body>

    <?php require_once __DIR__ . '/includes/navbar.php'; ?>
    <!-- banner -->
    <!-- giới thiệu -->
    <div class="section about-section">
        <div class="container-flex">
            <div class="content">
                <div class="title-with-line">
                    <h2>
                        <?= $lang['about_overview'] ?>
                    </h2>
                    <h3>
                        <?= $lang['about_about_us'] ?>
                    </h3>
                </div>

                <p>
                    <?= $lang['about_desc_1'] ?>
                </p>

                <p>
                    <?= $lang['about_desc_2'] ?>
                </p>


            </div>

            <div class="picture">
                <img src="assets/images/about/ve-chung-toi.png" alt="About Us">
            </div>
        </div>


    </div>

    <!-- giá trị cốt lỗi -->
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

    <div class="section vision-section">
        <div class="container">
            <div class="section-header">
                <h2 class="title-with-line"><?= $lang['about_vision_heading'] ?></h2>
            </div>
            <!-- tầm nhìn -->
            <div class="container-flex">
                <div class="content">
                    <h2>
                        <?= $lang['about_vision_title'] ?>
                    </h2>
                    <p>
                        <?= $lang['about_vision_desc'] ?>
                    </p>
                </div>
                <div class="picture">
                    <img src="assets/images/about/tam-nhin.jpg" alt="About Us">
                </div>
            </div>


            <!-- sứ mệnh -->
            <div class="container-flex">
                <div class="container-flex">
                    <div class="picture">
                        <img src="assets/images/about/su-menh.jpg" alt="About Us">
                    </div>
                    <div class="content">
                        <h2>
                            <?= $lang['about_mission_title'] ?>
                        </h2>
                        <p>
                            <?= $lang['about_mission_desc'] ?>
                        </p>
                    </div>
                </div>
            </div>


            <!-- giá trị cốt lõi -->
            <div class="container-flex">
                <div class="content">
                    <h2>
                        <?= $lang['about_core_values_title'] ?>
                    </h2>
                    <ul>
                        <li><?= $lang['about_core_value_1'] ?></li>
                        <li><?= $lang['about_core_value_2'] ?></li>
                        <li><?= $lang['about_core_value_3'] ?></li>
                        <li><?= $lang['about_core_value_4'] ?></li>
                        <li><?= $lang['about_core_value_5'] ?></li>
                    </ul>
                </div>
                <div class="picture">
                    <img src="assets/images/about/gia-tri-cot-loi.jpg" alt="About Us">
                </div>
            </div>
        </div>
    </div>


    <?php require_once __DIR__ . '/includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>

</html>