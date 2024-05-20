# 飲食店予約サービス rese_test

## 作成した目的
アプリを利用し、自社で予約サービスを管理する。

## 環境構築
#### i.Dockerビルド

1. git clone git@github.com:leo-bianchini22/rese_test.git
2. mv atte-test "任意のディレクトリ名"
3. docker-compose up -d --build

#### Lalavel環境構築
1. docker-compose exec php bash
2. composer install
3. cp .env.example .env
  ( .env.exampleファイルから.env作成、環境変数の変更を行う )
4. php artisan key:generate
5. php artisan migrate

## 機能一覧
#### i.すべてのユーザー
* 会員登録機能
* ログイン、ログアウト機能
* 飲食店一覧取得
* 飲食店詳細取得
* 飲食店エリア検索
* 飲食店ジャンル検索
* 飲食店店名検索
* 評価一覧取得

#### ii.一般アカウント（ログイン済）
* ユーザー情報取得
* ユーザー飲食店お気に入り一覧取得
* ユーザー飲食店予約情報取得
* 飲食店お気に入り追加
* 飲食店お気に入り削除
* 飲食店予約情報追加
* 飲食店予約情報更新
* 飲食店予約情報削除
* 評価機能

#### iii.店舗代表者アカウント
* 該当する店舗情報の作成、更新
* 該当する店舗の予約情報日付別情報取得

#### iii.店舗代表者アカウント（email:admin@example.com , password:password）
* 全ての店舗情報の作成、更新
* 店舗代表者作成
* 店舗代表者一覧取得

## 使用技術
* PHP 8.3.0
* Laravel 8.83.27
* Laravel/fortify 1.19.1
* livewire/livewire 2.12.6
* mysql 8.2.0

## ER図
![スクリーンショット (122)](https://github.com/leo-bianchini22/rese_test/assets/149698762/96c47fa4-621f-4ccd-80da-abd1a605c307)


## URL
開発環境
* http://localhost/

phpMyAdmin
* http://localhost:8080/
