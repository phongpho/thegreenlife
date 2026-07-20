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
                        Tổng quan
                    </h2>
                    <h3>
                        Về chúng tôi
                    </h3>
                </div>

                <p>
                    THE GREEN LIFE là doanh nghiệp hoạt động trong lĩnh vực xuất nhập khẩu lương thực, chế biến nông
                    sản, cung ứng nguyên liệu thủy sản và thương mại dịch vụ. Công ty tập trung xây dựng chuỗi giá trị
                    bền vững từ vùng nguyên liệu đến thị trường tiêu thụ trong nước và quốc tế.
                </p>

                <p>
                    Với hệ thống liên kết
                    vùng nguyên liệu tại Đồng bằng sông Cửu Long và Campuchia, cùng mạng lưới đối tác chiến lược trong
                    lĩnh vực nông nghiệp, chế biến và logistics, THE GREEN LIFE không ngừng mở rộng năng lực cung ứng
                    nhằm đáp ứng nhu cầu ngày càng cao của thị trường khu vực và thế giới.
                </p>


            </div>

            <div class="picture">
                <img src="assets/images/index/vietnam-campuchia.png" alt="About Us">
            </div>
        </div>

        <div class="container-flex values">
            <!-- Thẻ 1:  -->
            <div class="value-card">
                <div class="card-header">
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="title">
                        Uy tín
                    </h3>
                </div>
                <div class="card-body">
                    <p>
                        Luôn thực hiện đúng cam kết về chất lượng, tiến độ và trách nhiệm,
                        xây dựng niềm tin lâu dài với khách hàng và đối tác trong nước
                        cũng như quốc tế.
                    </p>
                </div>
            </div>

            <!-- Thẻ 2:  -->
            <div class="value-card">
                <div class="card-header">
                    <div class="icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3 class="title">
                        Chất lượng
                    </h3>
                </div>
                <div class="card-body">
                    <p>
                        Kiểm soát chặt chẽ từ vùng nguyên liệu, chế biến đến vận chuyển,
                        mang đến các sản phẩm nông nghiệp và thủy sản đạt tiêu chuẩn
                        phục vụ thị trường trong nước và xuất khẩu.
                    </p>
                </div>
            </div>

            <!-- Thẻ 3:  -->
            <div class="value-card">
                <div class="card-header">
                    <div class="icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h3 class="title">
                        Phát triển bền vững
                    </h3>
                </div>
                <div class="card-body">
                    <p>
                        Xây dựng chuỗi giá trị nông nghiệp bền vững thông qua hợp tác lâu
                        dài với vùng nguyên liệu, đối tác và khách hàng, góp phần nâng cao
                        giá trị nông sản Việt Nam.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="section vision-section">
        <div class="container">
            <div class="section-header">
                <h2 class="title-with-line">TẦM NHÌN - SỨC MỆNH - GIÁ TRỊ CỐT LỖI</h2>
            </div>
            <!-- tầm nhìn -->
            <div class="container-flex">
                <div class="content">
                    <h2>
                        Tầm nhìn
                    </h2>
                    <p>
                        Trở thành doanh nghiệp hàng đầu trong lĩnh vực xuất nhập khẩu và chế biến nông sản tại khu vực
                        Đồng bằng sông Cửu Long, đồng thời là cầu nối thương mại nông nghiệp hiệu quả giữa Việt Nam,
                        Campuchia và thị trường quốc tế.
                    </p>
                </div>
                <div class="picture">
                    <img src="assets/images/global/default.png" alt="About Us">
                </div>
            </div>


            <!-- sứ mệnh -->
            <div class="container-flex">
                <div class="container-flex">
                    <div class="picture">
                        <img src="assets/images/global/default.png" alt="About Us">
                    </div>
                    <div class="content">
                        <h2>
                            Sứ mệnh
                        </h2>
                        <p>
                            Cung cấp các sản phẩm nông nghiệp và thủy sản chất lượng cao, xây dựng chuỗi cung ứng bền
                            vững, góp phần nâng cao giá trị nông sản Việt Nam trên thị trường toàn cầu.
                        </p>
                    </div>

                </div>
            </div>


            <!-- giá trị cốt lõi -->
            <div class="container-flex">
                <div class="content">
                    <h2>
                        Giá trị cốt lỗi
                    </h2>
                    <ul>
                        <li>Uy tín</li>
                        <li>Chất lượng</li>
                        <li>Chuyên nghiệp</li>
                        <li>Hợp tác bền vững</li>
                        <li>Phát triển lâu dài</li>
                    </ul>
                </div>
                <div class="picture">
                    <img src="assets/images/global/default.png" alt="About Us">
                </div>
            </div>
        </div>
    </div>


    <?php require_once __DIR__ . '/includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
</body>

</html>