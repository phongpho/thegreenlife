# Sử dụng hình ảnh PHP chính thức tích hợp sẵn máy chủ Apache
FROM php:8.2-apache

# Cài đặt unzip (cần cho Composer --prefer-dist) và PHP extensions
RUN apt-get update && apt-get install -y unzip && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo pdo_mysql mysqli zip

# Bật mô-đun Rewrite của Apache
RUN a2enmod rewrite

# Cho phép .htaccess ghi đè cấu hình Apache
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Cấu hình thư mục session cho PHP (tránh lỗi permission trên container)
RUN mkdir -p /tmp/php_sessions && chown -R www-data:www-data /tmp/php_sessions && chmod 733 /tmp/php_sessions
RUN echo "session.save_path = /tmp/php_sessions" > /usr/local/etc/php/conf.d/sessions.ini

# Cài đặt Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Sao chép mã nguồn
COPY . /var/www/html/

# Cài đặt PHP dependencies (PHPMailer)
# Dùng composer update vì dự án chưa có composer.lock
RUN cd /var/www/html && composer update --no-dev --no-interaction --optimize-autoloader --prefer-dist

# Cấp quyền cho www-data
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80