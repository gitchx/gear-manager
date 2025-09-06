# ------------------------
# ビルドステージ
# ------------------------
FROM php:8.3-fpm AS build

# 必要な PHP 拡張 & Node.js（ビルド用）
RUN apt-get update && apt-get install -y \
    libsqlite3-dev unzip git zip curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_sqlite \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /app

# Composer と npm 依存ファイルコピーでキャッシュ効率向上
COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader --no-scripts

COPY package*.json ./
RUN npm install

# アプリ全体コピー
COPY . .

# Laravel の package discovery を手動で実行
RUN php artisan package:discover --ansi

# Vite ビルド
RUN npm run build

# ------------------------
# 本番ステージ（軽量）
# ------------------------
FROM php:8.2-fpm

# 必要な PHP 拡張のみ
RUN apt-get update && apt-get install -y libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

WORKDIR /var/www/html

# ビルド済み成果物だけコピー（Node.js や dev 依存は不要）
COPY --from=build /app /var/www/html

# 権限設定
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# PHP-FPM 起動
CMD ["php-fpm"]
