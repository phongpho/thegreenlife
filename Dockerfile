# Sử dụng hình ảnh PHP chính thức tích hợp sẵn máy chủ Apache
FROM php:8.2-apache

# Cài đặt các tiện ích mở rộng PHP phổ biến
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Bật mô-đun Rewrite của Apache
RUN a2enmod rewrite

# Cài đặt Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Sao chép mã nguồn
COPY . /var/www/html/

# Cài đặt PHP dependencies (PHPMailer)
RUN cd /var/www/html && composer install --no-dev --no-interaction --optimize-autoloader

# Cấp quyền cho www-data
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80