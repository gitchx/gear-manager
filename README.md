# 音楽などの機材を記録して管理するためのWebアプリケーションです。

## 技術スタック
• PHP<br>
• Laravel<br>
• SQLite<br>
• Tailwind CSS, daisyUI<br>
• Docker/Podman(本番環境用)

## App URL
~~~
http://localhost:8000/
~~~

# 開発環境のセットアップ

## このリポジトリをクローンする
~~~
clone https://github.com/gitchx/gear-manager
~~~

## laravelサーバを立ち上げる
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
Laravelを実行する準備と、ViteでTailwind CSSがビルドされたりします。
~~~
podman-compose build
~~~

## .envを準備する（開発環境で生成）
ローカルの開発環境で準備することを想定しています。
~~~
php artisan key:generate
~~~
を実行する必要がありますが、Dockerfileはコンテナを軽量化するように作っているため、<br>ビルド後のファイルではartisanを実行できません。

## SQLiteデータベースを準備する（開発環境でマイクレーションする）
ビルド後のDocker環境にはartisanコマンドが入っていません。<br>
<br>
<br>
<br>

---

### ローカルでの作業
ルートディレクトリで
~~~
touch ./database/database.sqlite
~~~
して、空のデータベースを作ります。

~~~
php artisan migrate
~~~
を実行して、マイグレーションされた database/database.sqlite を作ります。

本番環境にdatabase.sqliteをコピーします。

---
<br>
<br>

## podman-composeを実行する
~~~
podman-compose up -d
~~~


## nginxでポート8000にルーティングする

nginxで 80 -> 8000 にルーティングする