<?php
require_once __DIR__ . '/includes/language.php';
?>
<!DOCTYPE html>
<html lang="<?= $currentLang ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Green Life <?= $currentLang === 'vi' ? ' | Tin tức & Sự kiện' : ' | News & Events' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .banner-section {
            background-image: url('assets/images/banner/banner-2.webp');
            margin-top: 70px;
            background-size: cover;
            background-position: center;
            height: 500px;
            position: relative;
        }
        .banner-section .container { position: relative; height: 100%; }
        .title-page {
            position: absolute; color: var(--white); bottom: 50px; left: 0;
        }
        .title-page h1, .title-page a { color: var(--white); }
        .title-page .current { color: var(--white); }
        .title-page span { color: var(--text-main); }

        .placeholder-wrap {
            padding: 100px 24px;
            background: linear-gradient(180deg, rgba(27,94,32,.03) 0%, #fff 40%, rgba(27,94,32,.04) 100%);
        }
        .placeholder-wrap .container {
            max-width: var(--max-width); margin: 0 auto;
            display: flex; align-items: center; gap: 80px;
        }
        .placeholder-visual { flex-shrink: 0; }
        .placeholder-icon-circle {
            width: 160px; height: 160px; border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), #2e7d32);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 16px 48px rgba(27,94,32,.22);
        }
        .placeholder-icon-circle i { font-size: 64px; color: var(--white); }
        .placeholder-content { flex: 1; }
        .placeholder-tag {
            display: inline-block; font-size: .8rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: 3px;
            color: var(--secondary-color);
            background: rgba(251,192,45,.12);
            padding: 7px 20px; border-radius: 100px; margin-bottom: 24px;
            border: 1px solid rgba(251,192,45,.3);
        }
        .placeholder-content h2 {
            font-size: 2.2rem; font-weight: 700; color: var(--primary-color);
            margin: 0 0 18px; line-height: 1.2;
        }
        .placeholder-content p {
            font-size: 1.02rem; color: var(--text-light); line-height: 1.8;
            margin: 0 0 36px; max-width: 520px;
        }
        .placeholder-actions { display: flex; flex-wrap: wrap; gap: 16px; }
        .placeholder-btn {
            display: inline-flex; align-items: center; gap: 10px;
            font-weight: 600; font-size: 1rem; font-family: var(--font-primary);
            padding: 14px 32px; border-radius: var(--border-radius);
            text-decoration: none; transition: all .3s ease; min-height: 52px;
        }
        .placeholder-btn--primary {
            background: var(--primary-color); color: var(--white);
            box-shadow: 0 4px 14px rgba(27,94,32,.22);
        }
        .placeholder-btn--primary:hover { background: #144d18; color: #fff; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(27,94,32,.3); }
        .placeholder-btn--primary:focus-visible { outline: 3px solid var(--secondary-color); outline-offset: 3px; }
        .placeholder-btn--secondary {
            background: transparent; color: var(--primary-color); border: 2px solid var(--primary-color);
        }
        .placeholder-btn--secondary:hover { background: rgba(27,94,32,.06); transform: translateY(-2px); }
        .placeholder-btn--secondary:focus-visible { outline: 3px solid var(--secondary-color); outline-offset: 3px; }

        @media (max-width: 992px) {
            .placeholder-wrap .container { gap: 48px; }
            .placeholder-icon-circle { width: 130px; height: 130px; }
            .placeholder-icon-circle i { font-size: 50px; }
            .placeholder-content h2 { font-size: 1.8rem; }
        }
        @media (max-width: 768px) {
            .banner-section { height: 350px; }
            .placeholder-wrap { padding: 64px 20px; }
            .placeholder-wrap .container { flex-direction: column; text-align: center; gap: 36px; }
            .placeholder-content p { max-width: 100%; }
            .placeholder-actions { justify-content: center; flex-direction: column; align-items: center; }
            .placeholder-btn { width: 100%; max-width: 320px; justify-content: center; }
            .placeholder-icon-circle { width: 110px; height: 110px; }
            .placeholder-icon-circle i { font-size: 42px; }
            .placeholder-content h2 { font-size: 1.5rem; }
        }
    </style>
</head>

<body>
    <?php require_once __DIR__ . '/includes/navbar.php'; ?>

    <div class="section banner-section">
        <div class="container">
            <div class="title-page">
                <h1><?= $currentLang === 'vi' ? 'Tin tức & Sự kiện' : 'News & Events' ?></h1>
                <div class="breadcrumb">
                    <a href="<?= route_to_url('index.php', $currentLang) ?>"><?= $lang['breadcrumb_home'] ?></a>
                    <span>/</span>
                    <span class="current"><?= $currentLang === 'vi' ? 'Tin tức & Sự kiện' : 'News & Events' ?></span>
                </div>
            </div>
        </div>
    </div>

    <section class="section placeholder-wrap" aria-label="<?= $currentLang === 'vi' ? 'Đang cập nhật tin tức' : 'News coming soon' ?>">
        <div class="container">
            <div class="placeholder-visual" aria-hidden="true">
                <div class="placeholder-icon-circle"><i class="fas fa-newspaper"></i></div>
            </div>
            <div class="placeholder-content">
                <span class="placeholder-tag"><?= $currentLang === 'vi' ? 'SẮP RA MẮT' : 'COMING SOON' ?></span>
                <h2><?= $currentLang === 'vi' ? 'Đang cập nhật nội dung' : 'Content in Progress' ?></h2>
                <p><?= $currentLang === 'vi'
                        ? 'Chúng tôi đang chuẩn bị những tin tức và sự kiện mới nhất về hoạt động xuất nhập khẩu nông sản, thủy sản và thương mại dịch vụ. Hãy quay lại sớm để không bỏ lỡ thông tin hữu ích.'
                        : 'We are preparing the latest news and events on agricultural export, seafood, and trade services. Check back soon so you don\'t miss valuable updates.' ?></p>
                <div class="placeholder-actions">
                    <a href="<?= route_to_url('index.php', $currentLang) ?>" class="placeholder-btn placeholder-btn--primary">
                        <?= $currentLang === 'vi' ? 'Về trang chủ' : 'Back to Home' ?>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                    <a href="<?= route_to_url('contact.php', $currentLang) ?>" class="placeholder-btn placeholder-btn--secondary">
                        <?= $currentLang === 'vi' ? 'Liên hệ ngay' : 'Contact Us' ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php require_once __DIR__ . '/includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>
</html>
