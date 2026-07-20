# Sử dụng hình ảnh PHP chính thức tích hợp sẵn máy chủ Apache
FROM php:8.2-apache

# Cài đặt các tiện ích mở rộng PHP phổ biến (nếu sau này bạn cần dùng MySQL/PDO)
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Bật mô-đun Rewrite của Apache (rất cần thiết cho các đường dẫn tối ưu SEO hoặc định tuyến)
RUN a2enmod rewrite

# Sao chép toàn bộ mã nguồn từ máy của bạn vào thư mục chạy mặc định của Apache trong container
COPY . /var/www/html/

# Cấp quyền sở hữu thư mục web cho người dùng www-data của Apache để tránh lỗi ghi file/truy cập
RUN chown -R www-data:www-data /var/www/html/

# Khai báo cổng 80 là cổng cấu hình chạy của container này
EXPOSE 80