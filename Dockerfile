# ============================================================
# The Green Life - Production Dockerfile
# Target: Render Web Service (php:8.2-apache)
# ============================================================
FROM php:8.2-apache

# ── 1. Cài system packages ──────────────────────────────────
# libzip-dev : thư viện C để compile PHP zip extension
# unzip      : command-line tool để Composer giải nén --prefer-dist
# Cả hai đều cần, không thể thay thế cho nhau
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# ── 2. Cài & compile PHP extensions ─────────────────────────
# zip yêu cầu libzip-dev đã có ở bước trên
RUN docker-php-ext-install pdo pdo_mysql mysqli zip

# ── 3. Bật mod_rewrite (cần cho .htaccess) ──────────────────
RUN a2enmod rewrite

# ── 4. Cho phép Apache đọc .htaccess ────────────────────────
# apache2.conf: directive <Directory /> và <Directory /var/www/>
# 000-default.conf: directive <Directory /var/www/html>
# Sửa cả 2 file để chắc chắn AllowOverride All ở mọi cấp
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf \
    && sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/sites-available/000-default.conf

# ── 5. Cấu hình PHP session path ────────────────────────────
# Container thường không có quyền ghi /var/lib/php/sessions mặc định
# → Tạo thư mục riêng với đúng owner là www-data
RUN mkdir -p /tmp/php_sessions \
    && chown www-data:www-data /tmp/php_sessions \
    && chmod 755 /tmp/php_sessions
RUN { \
        echo 'session.save_path = /tmp/php_sessions'; \
        echo 'session.gc_probability = 1'; \
    } > /usr/local/etc/php/conf.d/sessions.ini

# ── 6. Cấu hình PHP cho production ──────────────────────────
# display_errors=Off: ngăn PHP lỗi output ra HTML → tránh vỡ giao diện
# error_log: ghi lỗi ra stderr để Render Logs capture được
RUN { \
        echo 'display_errors = Off'; \
        echo 'display_startup_errors = Off'; \
        echo 'error_reporting = E_ALL'; \
        echo 'log_errors = On'; \
        echo 'error_log = /dev/stderr'; \
    } > /usr/local/etc/php/conf.d/production.ini

# ── 7. Cài Composer ─────────────────────────────────────────
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# ── 8. Copy toàn bộ source code ─────────────────────────────
COPY . /var/www/html/

# ── 9. Cài PHP dependencies ─────────────────────────────────
# Nếu đã có composer.lock → dùng install (nhanh & repeatable)
# Nếu chưa có → dùng update (tự resolve + tạo lock file)
RUN cd /var/www/html && \
    if [ -f composer.lock ]; then \
        composer install --no-dev --no-interaction --optimize-autoloader --prefer-dist; \
    else \
        composer update --no-dev --no-interaction --optimize-autoloader --prefer-dist; \
    fi

# ── 10. Set quyền cho Apache ────────────────────────────────
RUN chown -R www-data:www-data /var/www/html/

# ── 11. Expose port 80 ──────────────────────────────────────
# Render tự động map PORT env → 80 trong container
EXPOSE 80