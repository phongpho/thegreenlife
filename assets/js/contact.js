/**
 * contact.js
 * FAQ Accordion + Form AJAX submit cho trang Liên hệ.
 * Đọc cấu hình từ window.TGL_CONTACT (được khai báo trong contact.php).
 */
document.addEventListener('DOMContentLoaded', function () {

    // ── FAQ Accordion ──────────────────────────────────────────
    var faqButtons = document.querySelectorAll('.faq-question');
    faqButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var faqItem = this.parentElement;
            var isOpen = faqItem.classList.contains('is-open');

            // Đóng tất cả các FAQ khác
            document.querySelectorAll('.faq-item.is-open').forEach(function (item) {
                item.classList.remove('is-open');
                var qBtn = item.querySelector('.faq-question');
                if (qBtn) qBtn.setAttribute('aria-expanded', 'false');
            });

            // Nếu item hiện tại chưa mở → mở nó
            if (!isOpen) {
                faqItem.classList.add('is-open');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // ── Form AJAX submit ──────────────────────────────────────
    var contactForm = document.getElementById('contactForm');
    if (!contactForm) return;

    var cfg = window.TGL_CONTACT || {};
    var sendingText = cfg.sendingText || 'Sending...';
    var successMsg  = cfg.successMsg  || 'Message sent successfully!';
    var errorMsg    = cfg.errorMsg    || 'Something went wrong.';
    var submitText  = cfg.submitText  || 'Send <i class="fas fa-paper-plane"></i>';

    contactForm.addEventListener('submit', function (e) {
        e.preventDefault();

        var formData   = new FormData(this);
        var responseEl = document.getElementById('formResponse');
        var submitBtn  = this.querySelector('.btn-submit');
        var originalText = submitBtn.innerHTML;

        // Disable + spinner
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ' + sendingText;

        fetch('send-contact.php', {
            method: 'POST',
            body: formData
        })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                responseEl.style.display = 'block';
                if (data.success) {
                    responseEl.className = 'form-response form-response--success';
                    responseEl.textContent = data.message || successMsg;
                    contactForm.reset();
                } else {
                    responseEl.className = 'form-response form-response--error';
                    responseEl.textContent = data.message || errorMsg;
                }
            })
            .catch(function () {
                responseEl.style.display = 'block';
                responseEl.className = 'form-response form-response--error';
                responseEl.textContent = errorMsg;
            })
            .finally(function () {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
    });

});
