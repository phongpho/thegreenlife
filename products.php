<?php
require_once __DIR__ . '/includes/language.php';
?>
<!DOCTYPE html>
<html lang="<?= $currentLang ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Green Life
        <?= $currentLang === 'vi' ? ' | Sản phẩm' : ' | Products' ?>
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>

    <?php require_once __DIR__ . '/includes/navbar.php'; ?>

    <div class="section banner-section">
        <div class="container">
            <div class="title-page">
                <h1>
                    <?= $currentLang === 'vi' ? 'Sản phẩm' : 'Products' ?>
                </h1>
                <div class="breadcrumb">
                    <a href="<?= route_to_url('index.php', $currentLang) ?>"><?= $lang['breadcrumb_home'] ?></a>
                    <span>/</span>
                    <span class="current">
                        <?= $currentLang === 'vi' ? 'Sản phẩm' : 'Products' ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <section class="section" style="min-height: 60vh; display: flex; align-items: center; justify-content: center; text-align: center;">
        <div class="container">
            <i class="fas fa-box-open" style="font-size: 64px; color: var(--primary-color); opacity: 0.3; margin-bottom: 24px;"></i>
            <h2 style="color: var(--primary-color); margin-bottom: 16px;">
                <?= $currentLang === 'vi' ? 'Đang cập nhật' : 'Coming Soon' ?>
            </h2>
            <p style="color: var(--text-light); max-width: 480px; margin: 0 auto; line-height: 1.7;">
                <?= $currentLang === 'vi'
                    ? 'Chúng tôi đang hoàn thiện danh mục sản phẩm. Vui lòng quay lại sau hoặc liên hệ trực tiếp để được tư vấn.'
                    : 'We are finalizing our product catalog. Please check back later or contact us directly for inquiries.' ?>
            </p>
        </div>
    </section>

    <?php require_once __DIR__ . '/includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>

</html>
