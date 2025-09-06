# 音楽などの機材を記録して管理するためのWebアプリケーションです。

## 技術スタック
## 技術スタック

- **バックエンド**
  - PHP
  - Laravel
  - Laravel Breeze
  - Livewire (Functional API) + Alpine.js
  - Pest

- **データベース**
  - SQLite

- **フロントエンド**
  - Tailwind CSS
  - daisyUI

- **開発・デプロイ**
  - Docker / Podman（本番環境用）


## App URL
~~~
http://localhost:8000/
~~~

# 開発環境のセットアップ

## このリポジトリをクローンする
~~~
clone https://github.com/gitchx/gear-manager
~~~

## Laravelサーバを立ち上げる
~~~
php artisan serve
~~~

## Viteサーバを立ち上げる
~~~
pnpm run dev
~~~

# 本番環境のセットアップ
Rocky Linux 9.6 (CentOS) でテストしています。<br>
ローカル環境でもDocker Composeを使用してテストができます。

## このリポジトリをクローンする
~~~
clone https://github.com/gitchx/gear-manager
~~~

## podman-compose build を実行する
Laravelを実行する準備と、ViteでTailwind CSSがビルドされます。
~~~
podman-compose build
~~~

## .envを準備する
~~~
podman-compose exec app php artisan key:generate
~~~

## SQLiteデータベースを準備する（開発環境でマイクレーションする）
空のデータベースを作る。
~~~
touch ./database/database.sqlite
~~~

データベースにマイグレーションでテーブルを作成する。
~~~
podman-compose exec app php artisan migrate
~~~

## podman-composeを実行する
~~~
podman-compose up -d
~~~


## nginxでポート8000にルーティングする

nginxで 80 -> 8000 にルーティングする

<br>

# メモ
## Podmanコンテナに入って作業したいとき
~~~
podman-compose exec app bash
~~~
apt install nano が必要 (debianベースのコンテナ)
