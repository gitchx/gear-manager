# Composer のステージ
FROM composer:2 AS composer

# PHP 8.2 FPM + Node.js（Vite ビルド用）
FROM php:8.2-fpm

# 必要な PHP 拡張 & Node.js
RUN apt-get update && apt-get install -y \
    libsqlite3-dev unzip git zip curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_sqlite

# Composer インストール
COPY --from=composer /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ
WORKDIR /var/www/html

# アプリコピー
COPY . .

# Composer インストール + Vite ビルド
RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build

# 権限設定
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# PHP-FPM 起動
CMD ["php-fpm"]
