# Composer のステージ
FROM composer:2 AS composer

# PHP 8.2 FPM
FROM php:8.2-fpm

# 必要な PHP 拡張
RUN apt-get update && apt-get install -y libsqlite3-dev unzip git zip \
    && docker-php-ext-install pdo pdo_sqlite

# Composer インストール済みイメージなら不要
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ
WORKDIR /var/www/html

# アプリコピー（事前に public/build は生成しておく）
COPY . .

# Composer install（本番用）
RUN composer install --no-dev --optimize-autoloader

# 権限設定
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# PHP-FPM 起動
CMD ["php-fpm"]
