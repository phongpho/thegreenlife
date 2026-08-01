/**
 * assets/js/contact.js
 *
 * Validate & gửi form liên hệ bằng AJAX.
 * Hỗ trợ đa ngôn ngữ qua window.TGL_CONTACT (được inject từ PHP).
 */
(function () {
    'use strict';

    var i18n = window.TGL_CONTACT || {};

    var form    = document.getElementById('contactForm');
    var btn     = form ? form.querySelector('.btn-submit') : null;
    var respBox = document.getElementById('formResponse');

    if (!form || !respBox) return;

    // ── Helper: hiển thị message ──────────────────────────
    function showMessage(type, text) {
        respBox.style.display = 'block';
        respBox.className = 'form-response ' + type;
        respBox.textContent = text;

        clearTimeout(respBox._timeout);
        respBox._timeout = setTimeout(function () {
            respBox.style.display = 'none';
        }, 8000);

        respBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    // ── Helper: loading state ─────────────────────────────
    function setLoading(loading) {
        if (!btn) return;
        btn.disabled = loading;
        if (loading) {
            if (!btn.dataset.originalHtml) {
                btn.dataset.originalHtml = btn.innerHTML;
            }
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ' + (i18n.sendingText || 'Đang gửi...');
        } else {
            btn.innerHTML = btn.dataset.originalHtml || (i18n.submitText || 'Gửi <i class="fas fa-paper-plane"></i>');
        }
    }

    // ── Client-side Validation ────────────────────────────
    function validate() {
        var name    = form.querySelector('#contactName');
        var email   = form.querySelector('#contactEmail');
        var phone   = form.querySelector('#contactPhone');
        var message = form.querySelector('#contactMessage');

        clearErrors();

        var valid = true;

        if (!name || name.value.trim() === '') {
            showFieldError(name, 'Vui lòng nhập họ tên.');
            valid = false;
        }

        if (!phone || phone.value.trim() === '') {
            showFieldError(phone, 'Vui lòng nhập số điện thoại.');
            valid = false;
        } else if (phone && !/^[0-9+\-\s()]{8,20}$/.test(phone.value.trim())) {
            showFieldError(phone, 'Số điện thoại không hợp lệ.');
            valid = false;
        }

        if (!email || email.value.trim() === '') {
            showFieldError(email, 'Vui lòng nhập email.');
            valid = false;
        } else if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
            showFieldError(email, 'Email không đúng định dạng.');
            valid = false;
        }

        if (!message || message.value.trim() === '') {
            showFieldError(message, 'Vui lòng nhập lời nhắn.');
            valid = false;
        }

        return valid;
    }

    function showFieldError(field, msg) {
        if (!field) return;
        field.classList.add('input-error');
        var errEl = field.parentElement.querySelector('.field-error');
        if (!errEl) {
            errEl = document.createElement('span');
            errEl.className = 'field-error';
            field.parentElement.appendChild(errEl);
        }
        errEl.textContent = msg;
    }

    function clearErrors() {
        form.querySelectorAll('.input-error').forEach(function (el) {
            el.classList.remove('input-error');
        });
        form.querySelectorAll('.field-error').forEach(function (el) {
            el.remove();
        });
    }

    // ── Submit AJAX ───────────────────────────────────────
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        if (!validate()) return;

        setLoading(true);
        respBox.style.display = 'none';

        var formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(function (res) { return res.json(); })
        .then(function (data) {
            setLoading(false);

            if (data.status === 'success') {
                showMessage('success', data.message || (i18n.successMsg || 'Gửi thành công!'));
                form.reset();
            } else {
                showMessage('error', data.message || (i18n.errorMsg || 'Có lỗi xảy ra.'));
            }
        })
        .catch(function () {
            setLoading(false);
            showMessage('error', i18n.errorMsg || 'Lỗi kết nối. Vui lòng thử lại sau.');
        });
    });

})();