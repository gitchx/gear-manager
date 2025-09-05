# PHP 8.2 + Composer
FROM php:8.2-fpm

# 必要パッケージと Node.js
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    unzip \
    git \
    curl \
    zip \
    gnupg2 \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_sqlite

# Composer インストール済みイメージなら不要
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ
WORKDIR /var/www/html

# アプリコピー
COPY . .

# npm と Composer の依存をクリーンインストール
RUN rm -rf node_modules package-lock.json && npm install
RUN composer install --no-dev --optimize-autoloader

# TailwindCSS / Vite ビルド
RUN npm run build

# 権限設定
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# PHP-FPM 起動
CMD ["php-fpm"]
