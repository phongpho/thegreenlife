<?php
require_once __DIR__ . '/includes/language.php';
require_once __DIR__ . '/includes/csrf.php';

?>
<!DOCTYPE html>
<html lang="<?= $currentLang ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Green Life
        <?= $currentLang === 'vi' ? ' | Liên hệ' : ' | Contact' ?>
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/contact.css">
</head>

<body>

    <?php require_once __DIR__ . '/includes/navbar.php'; ?>

    <!-- ========================================= -->
    <!-- 1. HERO BANNER                             -->
    <!-- ========================================= -->
    <div class="section banner-section">
        <div class="container">
            <div class="title-page">
                <h1>
                    <?= $lang['contact_banner_title'] ?>
                </h1>

                <div class="breadcrumb">
                    <a href="index.php"><?= $lang['breadcrumb_home'] ?></a>
                    <span>/</span>
                    <span class="current">
                        <?= $lang['contact_breadcrumb'] ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================= -->
    <!-- 2. FORM LIÊN HỆ + THÔNG TIN CÔNG TY        -->
    <!-- ========================================= -->
    <div class="section contact-form-section">
        <div class="container">
            <div class="contact-form-layout">
                <div class="contact-form-col">
                    <h2 class="title-with-line"><?= $lang['contact_form_heading'] ?></h2>
                    <p class="form-desc"><?= $lang['contact_form_desc'] ?></p>

                    <form id="contactForm" class="contact-form" action="send-contact.php" method="POST">

                        <!-- CSRF Token -->
                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">

                        <!-- Ngôn ngữ hiện tại (để email auto-reply đúng ngôn ngữ) -->
                        <input type="hidden" name="lang" value="<?= $currentLang ?>">

                        <!-- Honeypot (ẩn với người, bot sẽ tự điền) -->
                        <div style="position:absolute;left:-9999px;" aria-hidden="true">
                            <label for="hp_website">Website</label>
                            <input type="text" id="hp_website" name="website" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="contactName"><?= $lang['contact_form_name'] ?> <span class="required">*</span></label>
                                <input type="text" id="contactName" name="name" placeholder="<?= $lang['contact_form_name_placeholder'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="contactPhone"><?= $lang['contact_form_phone'] ?> <span class="required">*</span></label>
                                <input type="tel" id="contactPhone" name="phone" placeholder="<?= $lang['contact_form_phone_placeholder'] ?>" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="contactEmail"><?= $lang['contact_form_email'] ?> <span class="required">*</span></label>
                                <input type="email" id="contactEmail" name="email" placeholder="<?= $lang['contact_form_email_placeholder'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="contactDepartment"><?= $lang['contact_form_department'] ?></label>
                                <select id="contactDepartment" name="department">
                                    <option value=""><?= $lang['contact_form_department_default'] ?></option>
                                    <option value="business"><?= $lang['contact_form_dept_business'] ?></option>
                                    <option value="import-export"><?= $lang['contact_form_dept_import_export'] ?></option>
                                    <option value="procurement"><?= $lang['contact_form_dept_procurement'] ?></option>
                                    <option value="support"><?= $lang['contact_form_dept_support'] ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contactMessage"><?= $lang['contact_form_message'] ?> <span class="required">*</span></label>
                            <textarea id="contactMessage" name="message" rows="6" placeholder="<?= $lang['contact_form_message_placeholder'] ?>" required></textarea>
                        </div>

                        <div id="formResponse" class="form-response" style="display:none;"></div>

                        <button type="submit" class="btn btn-primary btn-submit">
                            <?= $lang['contact_form_submit'] ?>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>

                <div class="contact-info-col">
                    <h2 class="title-with-line"><?= $lang['contact_info_heading'] ?></h2>
                    <p class="form-desc"><?= $lang['contact_info_desc'] ?></p>

                    <div class="info-list">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="info-text">
                                <h4><?= $lang['contact_info_address_label'] ?></h4>
                                <p><?= $lang['address_content'] ?></p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="info-text">
                                <h4><?= $lang['contact_info_hotline_label'] ?></h4>
                                <p><a href="tel:0939660004">0939 660 004</a></p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-text">
                                <h4><?= $lang['contact_info_email_label'] ?></h4>
                                <p><a href="mailto:phoquocduyvn@gmail.com">phoquocduyvn@gmail.com</a></p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="info-text">
                                <h4><?= $lang['contact_info_working_hours_label'] ?></h4>
                                <p><?= $lang['contact_info_working_hours'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================= -->
    <!-- 3. LIÊN HỆ THEO BỘ PHẬN                    -->
    <!-- ========================================= -->
    <div class="section departments-section">
        <div class="container">
            <div class="section-header">
                <h2 class="title-with-line"><?= $lang['contact_departments_heading'] ?></h2>
            </div>

            <div class="departments-grid">
                <div class="dept-card">
                    <div class="dept-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3><?= $lang['contact_dept_business_title'] ?></h3>
                    <p><?= $lang['contact_dept_business_desc'] ?></p>
                    <a href="tel:0939660004" class="dept-phone"><i class="fas fa-phone-alt"></i> 0939 660 004</a>
                </div>

                <div class="dept-card">
                    <div class="dept-icon">
                        <i class="fas fa-ship"></i>
                    </div>
                    <h3><?= $lang['contact_dept_import_export_title'] ?></h3>
                    <p><?= $lang['contact_dept_import_export_desc'] ?></p>
                    <a href="tel:0939660004" class="dept-phone"><i class="fas fa-phone-alt"></i> 0939 660 004</a>
                </div>

                <div class="dept-card">
                    <div class="dept-icon">
                        <i class="fas fa-tractor"></i>
                    </div>
                    <h3><?= $lang['contact_dept_procurement_title'] ?></h3>
                    <p><?= $lang['contact_dept_procurement_desc'] ?></p>
                    <a href="tel:0939660004" class="dept-phone"><i class="fas fa-phone-alt"></i> 0939 660 004</a>
                </div>

                <div class="dept-card">
                    <div class="dept-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3><?= $lang['contact_dept_support_title'] ?></h3>
                    <p><?= $lang['contact_dept_support_desc'] ?></p>
                    <a href="tel:0939660004" class="dept-phone"><i class="fas fa-phone-alt"></i> 0939 660 004</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================= -->
    <!-- 4. HÌNH ẢNH VĂN PHÒNG                      -->
    <!-- ========================================= -->
    <div class="section office-section">
        <div class="container">
            <div class="section-header">
                <h2 class="title-with-line"><?= $lang['contact_office_heading'] ?></h2>
            </div>

            <div class="office-gallery">
                <div class="office-img main-img">
                    <img src="assets/images/banner/banner-1.jpg" alt="Office">
                </div>
                <div class="office-img">
                    <img src="assets/images/banner/banner-2.jpg" alt="Office">
                </div>
                <div class="office-img">
                    <img src="assets/images/banner/banner-3.jpg" alt="Office">
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================= -->
    <!-- 5. GOOGLE MAPS                            -->
    <!-- ========================================= -->
    <div class="section map-section">
        <div class="container">
            <div class="section-header">
                <h2 class="title-with-line"><?= $lang['contact_map_heading'] ?></h2>
            </div>
        </div>

        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3923.123456789!2d105.123456!3d10.123456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTDCsDA3JzI0LjQiTiAxMDXCsDA3JzI0LjQiRQ!5e0!3m2!1svi!2s!4v1234567890"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="The Green Life Location">
            </iframe>
        </div>
    </div>

    <!-- ========================================= -->
    <!-- 6. FAQ                                    -->
    <!-- ========================================= -->
    <div class="section faq-section">
        <div class="container">
            <div class="section-header">
                <h2 class="title-with-line"><?= $lang['contact_faq_heading'] ?></h2>
            </div>

            <div class="faq-list">
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><?= $lang['contact_faq_1_q'] ?></span>
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="faq-answer">
                        <p><?= $lang['contact_faq_1_a'] ?></p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><?= $lang['contact_faq_2_q'] ?></span>
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="faq-answer">
                        <p><?= $lang['contact_faq_2_a'] ?></p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><?= $lang['contact_faq_3_q'] ?></span>
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="faq-answer">
                        <p><?= $lang['contact_faq_3_a'] ?></p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><?= $lang['contact_faq_4_q'] ?></span>
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="faq-answer">
                        <p><?= $lang['contact_faq_4_a'] ?></p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span><?= $lang['contact_faq_5_q'] ?></span>
                        <i class="fas fa-plus"></i>
                    </button>
                    <div class="faq-answer">
                        <p><?= $lang['contact_faq_5_a'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================= -->
    <!-- 7. CTA                                    -->
    <!-- ========================================= -->
    <div class="section cta-section">
        <div class="container">
            <div class="cta-content">
                <h2><?= $lang['contact_cta_heading'] ?></h2>
                <p><?= $lang['contact_cta_desc'] ?></p>
                <a href="#contactForm" class="btn btn-secondary cta-btn">
                    <?= $lang['contact_cta_btn'] ?>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>


    <?php require_once __DIR__ . '/includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
    <!-- Cấu hình đa ngôn ngữ cho contact.js -->
    <script>
    window.TGL_CONTACT = {
        sendingText: '<?= $currentLang === 'vi' ? 'Đang gửi...' : 'Sending...' ?>',
        successMsg:  '<?= addslashes($lang['contact_form_success']) ?>',
        errorMsg:    '<?= addslashes($lang['contact_form_error']) ?>',
        submitText:  '<?= addslashes($lang['contact_form_submit']) ?> <i class="fas fa-paper-plane"></i>'
    };
    </script>
    <script src="assets/js/contact.js"></script>
</body>

</html>
