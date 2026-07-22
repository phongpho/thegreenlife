#!/bin/bash
# ============================================================
# The Green Life - Container Entrypoint
# Chạy TRƯỚC Apache, đảm bảo môi trường runtime sẵn sàng.
# ============================================================
set -e

# ── Đảm bảo thư mục session tồn tại ──────────────────────────
# Render mount persistent disk vào /var/www/html → đè lên
# mọi file/dir được tạo trong Dockerfile tại path này.
# → Phải tạo lại tại runtime.
mkdir -p /var/www/html/tmp/sessions
chown www-data:www-data /var/www/html/tmp/sessions
chmod 755 /var/www/html/tmp/sessions

# ── Khởi động Apache ────────────────────────────────────────
exec apache2-foreground
