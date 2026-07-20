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
    <link rel="stylesheet" href="assets/css/services.css">
</head>

<body>

    <?php require_once __DIR__ . '/includes/navbar.php'; ?>
    <!-- banner -->

    <div class="section banner-section">
        <div class="container">
            <div class="title-page">
                <h1>
                    Thương mại dịch vụ – Lưu trú – Nhà hàng

                </h1>

                <div class="breadcrumb">

                    <a href="index.php">Trang chủ</a>

                    <span>/</span>


                    <span class="current">
                        Thương mại dịch vụ - Lưu trú - Nhà hàng

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
                        <h2 class="title-with-line">hệ sinh thái dịch vụ</h2>
                    </div>
                    <h2 class="section-title">Đa dạng dịch vụ –<br>Kết nối giá trị</h2>
                    <p class="section-desc">
                        Chúng tôi cung cấp giải pháp dịch vụ toàn diện, kết hợp giữa chất lượng, trải nghiệm và sự kết
                        nối
                        để mang lại giá trị bền vững cho khách hàng và cộng đồng.
                    </p>
                </div>

                <!-- Cột phải: Các mốc dịch vụ và hình ảnh nhỏ tương ứng -->
                <div class="ecosystem-content">
                    <!-- Hàng Icon + Tên dịch vụ kết nối ngang -->
                    <div class="ecosystem-steps">
                        <div class="step-item">
                            <div class="step-icon"><i class="fa-solid fa-bed"></i></div>
                            <h4>Dịch vụ lưu trú</h4>
                        </div>
                        <div class="step-item">
                            <div class="step-icon"><i class="fa-solid fa-bell-concierge"></i></div>
                            <h4>Nhà hàng</h4>
                        </div>
                        <div class="step-item">
                            <div class="step-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                            <h4>Thương mại dịch vụ<br>tổng hợp</h4>
                        </div>
                        <div class="step-item">
                            <div class="step-icon"><i class="fa-solid fa-handshake"></i></div>
                            <h4>Kết nối giao thương<br>và xúc tiến thương mại</h4>
                        </div>
                    </div>

                    <!-- Hàng thẻ ảnh minh họa phía dưới -->
                    <div class="ecosystem-gallery">
                        <div class="gallery-card">
                            <div class="img-wrapper">
                                <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Dịch vụ lưu trú">
                            </div>
                            <p>Không gian lưu trú tiện nghi, đẳng cấp và thân thiện.</p>
                        </div>
                        <div class="gallery-card">
                            <div class="img-wrapper">
                                <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Nhà hàng">
                            </div>
                            <p>Ẩm thực đa dạng, chất lượng và an toàn.</p>
                        </div>
                        <div class="gallery-card">
                            <div class="img-wrapper">
                                <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Thương mại tổng hợp">
                            </div>
                            <p>Đáp ứng nhu cầu mua sắm, giải trí và các dịch vụ tiện ích.</p>
                        </div>
                        <div class="gallery-card">
                            <div class="img-wrapper">
                                <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Xúc tiến thương mại">
                            </div>
                            <p>Mở rộng cơ hội hợp tác và phát triển bền vững.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section core-services-section">
        <div class="container">
            <h2 class="core-section-title">Chi tiết dịch vụ</h2>

            <div class="core-services-grid">
                <!-- Card 01 -->
                <div class="core-service-card">
                    <div class="card-header">
                        <span class="card-num">01</span>
                        <span class="card-divider"></span>
                        <h3>Dịch vụ lưu trú</h3>
                    </div>
                    <div class="card-img">
                        <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Dịch vụ lưu trú">
                    </div>
                    <p class="card-desc">Hệ thống lưu trú đạt tiêu chuẩn, mang đến trải nghiệm thoải mái, tiện nghi cho
                        khách hàng.</p>
                </div>

                <!-- Card 02 -->
                <div class="core-service-card">
                    <div class="card-header">
                        <span class="card-num">02</span>
                        <span class="card-divider"></span>
                        <h3>Nhà hàng</h3>
                    </div>
                    <div class="card-img">
                        <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Nhà hàng">
                    </div>
                    <p class="card-desc">Nhà hàng với thực đơn phong phú, nguyên liệu tươi ngon, không gian sang trọng
                        và dịch vụ chuyên nghiệp.</p>
                </div>

                <!-- Card 03 -->
                <div class="core-service-card">
                    <div class="card-header">
                        <span class="card-num">03</span>
                        <span class="card-divider"></span>
                        <h3>Thương mại dịch vụ tổng hợp</h3>
                    </div>
                    <div class="card-img">
                        <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Thương mại dịch vụ tổng hợp">
                    </div>
                    <p class="card-desc">Cung cấp đa dạng sản phẩm, dịch vụ từ mua sắm, giải trí đến các tiện ích đáp
                        ứng mọi nhu cầu.</p>
                </div>

                <!-- Card 04 -->
                <div class="core-service-card">
                    <div class="card-header">
                        <span class="card-num">04</span>
                        <span class="card-divider"></span>
                        <h3>Kết nối giao thương và xúc tiến thương mại</h3>
                    </div>
                    <div class="card-img">
                        <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Kết nối giao thương">
                    </div>
                    <p class="card-desc">Tổ chức các hoạt động kết nối, sự kiện và chương trình xúc tiến thương mại
                        trong và ngoài nước.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================================== MẠNG LƯỚI KẾT NỐI ===================================== -->
    <section class="section network-section">
        <div class="container">
            <div class="network-content">
                <h2 class="network-title">Mạng lưới kết nối</h2>
                <p class="network-desc">
                    THE GREEN LIFE không ngừng mở rộng mạng lưới đối tác và khách hàng,
                    hướng đến sự phát triển bền vững và cùng nhau thịnh vượng.
                </p>

            </div>
        </div>
    </section>






    <?php require_once __DIR__ . '/includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>

</html>