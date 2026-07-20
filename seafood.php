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
                    THỦY SẢN NGUYÊN LIỆU
                </h1>

                <div class="breadcrumb">

                    <a href="index.php">Trang chủ</a>

                    <span>/</span>


                    <span class="current">
                        Thủy sản nguyên liệu
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
                        Tổng quản
                    </span>
                    <h2>CUNG CẤP CÁ NGUYÊN LIỆU SẠCH</h2>
                    <p>
                        THE GREEN LIFE hợp tác với các vùng nuôi thủy sản chất lượng cao nhầm cung cấp nguồn nguyên liệu
                        ổn
                        định
                        cho các nhà máy chế biến xuất khẩu
                    </p>
                </div>

                <div class="note">
                    <div class="note-item">
                        <div class="icon">
                            <!-- Icon Vùng nuôi/Đạt chuẩn: Hình bản đồ có định vị hoặc huy hiệu chất lượng -->
                            <i class="fas fa-award"></i>
                        </div>
                        <span>Vùng nuôi đạt chuẩn</span>
                        <p>Chất lượng cao</p>
                    </div>

                    <div class="note-item">
                        <div class="icon">
                            <!-- Icon Kiểm soát chặt chẽ: Hình chiếc khiên bảo vệ (giống thiết kế mẫu của bạn) -->
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <span>Kiểm soát chặt chẽ</span>
                        <p>Từ ao nuôi đến nhà máy</p>
                    </div>

                    <div class="note-item">
                        <div class="icon">
                            <!-- Icon Nguồn cung ổn định: Hình xe tải vận chuyển chuyên nghiệp -->
                            <i class="fas fa-truck"></i>
                        </div>
                        <span>Nguồn cung ổn định</span>
                        <p>Rõ ràng, minh bạch</p>
                    </div>
                </div>
            </div>

            <div class="big-number">
                10%
                <span>Giá trị doanh nghiệp</span>
            </div>

        </div>
    </div>

    <div class="section activities-section">
        <div class="container">
            <div class="section-header">
                <h2 class="title-with-line">Năng lực cung ứng</h2>
            </div>

            <div class="activity-grid">

                <div class="activity-card">
                    <div class="activity-picture">
                        <img src="assets/images/index/quy-trinh-xuat-nhap-khau.jpg" alt="Xuất nhập khẩu & Chế biến">
                    </div>
                    <div class="activity-content">
                        <h3 class="card-title">Cá tra nguyên liệu</h3>
                        <p class="card-desc">
                            Cung cấp nguồn cá tra nguyên liệu chất lượng cao, được nuôi trồng theo quy trình đạt chuẩn
                            quốc tế. Đảm bảo nguồn cung ổn định, an toàn vệ sinh thực phẩm cho các nhà máy chế biến và
                            xuất khẩu.

                        </p>
                    </div>
                </div>

                <div class="activity-card">
                    <div class="activity-picture">
                        <img src="assets/images/index/ca-nguyen-lieu-sach.jpg" alt="Cá nguyên liệu sạch">
                    </div>
                    <div class="activity-content">
                        <h3 class="card-title">Cá điêu hồng nguyên liệu</h3>
                        <p class="card-desc">
                            Chuyên cung ứng cá điêu hồng thương phẩm tươi sạch, quy trình chăn nuôi khép kín kiểm soát
                            nghiêm ngặt. Thịt cá săn chắc, đạt tiêu chuẩn chất lượng cao phục vụ thị trường nội địa và
                            quốc tế.

                        </p>
                    </div>
                </div>

                <div class="activity-card">
                    <div class="activity-picture">
                        <img src="assets/images/index/thuong-mai-dich-vu.jpg" alt="Xuất nhập khẩu & Chế biến">
                    </div>
                    <div class="activity-content">
                        <h3 class="card-title">Sản phẩm thủy sản theo đơn đặt hàng</h3>
                        <p class="card-desc">
                            Dịch vụ gia công, chế biến và đóng gói các mặt hàng thủy hải sản linh hoạt theo mọi yêu cầu
                            riêng biệt của đối tác. Đảm bảo đúng tiến độ, tối ưu chi phí và chuẩn xác theo thông số kỹ
                            thuật đơn hàng.

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
                    <h2 class="title-with-line">Cam kết chất lượng</h2>
                    <p class="section-desc">
                        THE GREEN LIFE cam kết mang đến nguồn thủy sản nguyên liệu an toàn, sạch và đạt chuẩn quốc tế
                        thông qua quy trình kiểm soát nghiêm ngặt từ vùng nuôi đến thành phẩm.
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
                            <h3>Vùng nuôi đạt chuẩn</h3>
                            <p>Hợp tác chặt chẽ với các vùng nuôi đạt chứng nhận VietGAP, ASC, BAP đảm bảo nguồn nguyên liệu từ môi trường nuôi trồng chất lượng cao.</p>
                        </div>
                    </div>

                    <div class="quality-item">
                        <div class="quality-icon">
                            <i class="fas fa-ban"></i>
                        </div>
                        <div class="quality-info">
                            <h3>Không kháng sinh</h3>
                            <p>Cam kết không sử dụng kháng sinh cấm và hóa chất ngoài danh mục cho phép. Mẻ cá được kiểm nghiệm định kỳ trước khi xuất xưởng.</p>
                        </div>
                    </div>

                    <div class="quality-item">
                        <div class="quality-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="quality-info">
                            <h3>Kiểm soát nghiêm ngặt</h3>
                            <p>Quy trình kiểm soát 3 lớp: tại ao nuôi — tại trạm thu mua — tại nhà máy, đảm bảo chất lượng đồng đều từ nguồn đến điểm đến.</p>
                        </div>
                    </div>

                    <div class="quality-item">
                        <div class="quality-icon">
                            <i class="fas fa-search-location"></i>
                        </div>
                        <div class="quality-info">
                            <h3>Nguồn gốc truy xuất</h3>
                            <p>Hệ thống truy xuất nguồn gốc minh bạch, rõ ràng từng mẻ cá từ ao nuôi, ngày thu hoạch đến lô hàng xuất xưởng.</p>
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