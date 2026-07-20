<?php
require_once __DIR__ . '/includes/language.php';

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
    <link rel="stylesheet" href="assets/css/agriculture.css">
</head>

<body>

    <?php require_once __DIR__ . '/includes/navbar.php'; ?>
    <!-- banner -->

    <div class="section banner-section">
        <div class="container">
            <div class="title-page">
                <h1>
                    XUẤT NHẬP KHẨU & CHẾ BIẾN 
                </h1>

                <div class="breadcrumb">

                    <a href="index.php">Trang chủ</a>

                    

                    <span>/</span>

                    <span class="current">
                        Xuất nhập khẩu & Chế biến 
                    </span>

                </div>
            </div>
        </div>
    </div>




    <div class="section pic-section">
        <div class="container">
            <h2 class="title-with-line">Xuất nhập khẩu và chế biến</h2>

            <div class="img-first">
                <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png"
                    alt="xuất nhập khẩu và chế biến lương thực.">

                <div class="overview-card">
                    <h2>TỔNG QUAN</h2>

                    <p>
                        Lĩnh vực kinh doanh cốt lõi, chiếm khoảng <span>80%</span> giá trị doanh nghiệp — thu mua, chế
                        biến, xuất
                        nhập khẩu lúa gạo và các sản phẩm nông nghiệp.
                    </p>
                </div>
            </div>


        </div>
    </div>



    <div class="section capability-section">

        <div class="capability-wrapper">

            <div class="capability-left">

                <h2 class="title-with-line">Năng lực sản xuất</h2>
                <p>
                    Hệ thống nhà máy, kho vận và vùng nguyên liệu
                    được đầu tư đồng bộ, đáp ứng nhu cầu thị trường
                    trong nước và quốc tế.
                </p>

                <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">

            </div>

            <div class="capability-right">

                <div class="capability-item">

                    <span class="number">01</span>

                    <div class="content">
                        <h3>20 ha</h3>
                        <p>Nhà máy chế biến lương thực với tổng diện tích trên 20 ha.</p>
                    </div>

                    <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">

                </div>

                <div class="capability-item">

                    <span class="number">02</span>

                    <div class="content">
                        <h3>1.200 tấn/ngày</h3>
                        <p>Hệ thống sấy lúa công suất 1.200 tấn mỗi ngày.</p>
                    </div>

                    <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">

                </div>

                <div class="capability-item">

                    <span class="number">03</span>

                    <div class="content">
                        <h3>500-600 tấn/ngày</h3>
                        <p>Hệ thống lau bóng gạo hiện đại, nâng cao chất lượng thành phẩm.</p>
                    </div>

                    <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">

                </div>

                <div class="capability-item">

                    <span class="number">04</span>

                    <div class="content">
                        <h3>Kho chứa & Logistics</h3>
                        <p>Hệ thống kho chứa và logistics phục vụ hoạt động xuất nhập khẩu.</p>
                    </div>

                    <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">

                </div>

                <div class="capability-item">

                    <span class="number">05</span>

                    <div class="content">
                        <h3>Đồng bằng sông Cửu Long & Campuchia</h3>
                        <p>Hệ thống liên kết vùng nguyên liệu ổn định, đáp ứng nhu cầu sản xuất quy mô lớn.</p>
                    </div>

                    <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">

                </div>

                <div class="capability-item">

                    <span class="number">06</span>

                    <div class="content">
                        <h3>Đối tác chiến lược</h3>
                        <p>Hợp tác với các doanh nghiệp sản xuất, thu mua và xuất khẩu lớn tại Campuchia.</p>
                    </div>

                    <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">

                </div>
            </div>

        </div>

    </div>


    <!-- năng lực thương mại -->
    <div class="section trading-section">

        <div class=" container trading-wrapper">
            <h2 class="title-with-line">Năng lực thương mại</h2>
            <div class="trading-header">

                <div class="heading">
                    <h3>
                        Kết nối giá trị nông sản
                        với thị trường toàn cầu
                    </h3>

                    <p>
                        Với năng lực xuất nhập khẩu ổn định và mạng lưới đối tác rộng khắp,
                        THE GREEN LIFE không ngừng mở rộng thị trường, mang đến những sản phẩm
                        chất lượng cao cho khách hàng trong nước và quốc tế.
                    </p>

                </div>

                <div class="trading-stat">

                    <span class="number">
                        20
                    </span>

                    <span class="unit">
                        TRIỆU USD
                    </span>

                    <p>
                        Kim ngạch xuất nhập khẩu
                        lúa gạo mỗi năm
                    </p>

                </div>

                <div class="market-map">

                    <img src="assets/images/agriculture/kim-ngach-xuat-khau.png">

                </div>

            </div>

            <div class="product-gallery">

                <h3 class="section-title">SẢN PHẨM CHỦ LỰC</h3>

                <div class="products-wrapper">
                    <button class="products-nav products-nav--prev" aria-label="Previous">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>

                    <div class="products-scroll">
                        <div class="products">

                            <div class="product">
                                <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">
                                <span>GẠO TRẮNG</span>
                            </div>

                            <div class="product">
                                <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">
                                <span>GẠO THƠM</span>
                            </div>

                            <div class="product">
                                <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">
                                <span>GẠO ST</span>
                            </div>

                            <div class="product">
                                <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">
                                <span>GẠO CHẤT LƯỢNG CAO</span>
                            </div>

                            <div class="product">
                                <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">
                                <span>LÚA NGUYÊN LIỆU</span>
                            </div>

                            <div class="product">
                                <img src="assets/images/agriculture/xuat-nhap-khau-va-che-bien-luong-thuc.png">
                                <span>NÔNG SẢN KHÁC</span>
                            </div>

                        </div>
                    </div>

                    <button class="products-nav products-nav--next" aria-label="Next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>

            </div>

            <div class="trade-process">

                <h3 class="section-title">QUY TRÌNH THƯƠNG MẠI</h3>

                <div class="process">

                    <div class="step">
                        <div class="icon">
                            <i class="fa-solid fa-seedling"></i>
                        </div>

                        <h4>Vùng nguyên liệu</h4>

                        <p>
                            Liên kết vùng nguyên liệu tại Đồng bằng sông Cửu Long và Campuchia.
                        </p>
                    </div>

                    <div class="arrow">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                    <div class="step">
                        <div class="icon">
                            <i class="fa-solid fa-industry"></i>
                        </div>

                        <h4>Chế biến hiện đại</h4>

                        <p>
                            Hệ thống nhà máy đảm bảo chất lượng và truy xuất nguồn gốc.
                        </p>
                    </div>

                    <div class="arrow">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                    <div class="step">
                        <div class="icon">
                            <i class="fa-solid fa-truck-fast"></i>
                        </div>

                        <h4>Kho vận & Logistics</h4>

                        <p>
                            Hệ thống kho bãi và logistics đáp ứng mọi yêu cầu xuất nhập khẩu.
                        </p>
                    </div>

                    <div class="arrow">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                    <div class="step">
                        <div class="icon">
                            <i class="fa-solid fa-ship"></i>
                        </div>

                        <h4>Xuất khẩu</h4>

                        <p>
                            Vận chuyển đến các thị trường trong nước và quốc tế.
                        </p>
                    </div>

                    <div class="arrow">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                    <div class="step">
                        <div class="icon">
                            <i class="fa-solid fa-handshake"></i>
                        </div>

                        <h4>Đối tác toàn cầu</h4>

                        <p>
                            Mạng lưới đối tác và khách hàng tại nhiều quốc gia.
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