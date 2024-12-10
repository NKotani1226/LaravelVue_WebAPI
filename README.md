### 概要
- LaravelとVueの組み合わせ勉強用Project
- WebAPI実装

### Version
- PHP：8.3.14
- Laravel：11.34.2
- Vue：3.5.13

### 立ち上げ
- docker-compose build
- docker-compose up
- docker-compose exec app bash
- cp .env.example .env
- composer install
- npm install
- chmod -R guo+w storage
- php artisan storage:link
- php artisan migrate
- php artisan key:generate
- npm run dev

### API設定方法
1. Integrationを設定する
2. 接続するDBにIntegrationを共有する
3. envファイルにNotionAPIのIntegrationとデータベースIDを記載する
- NOTION_API_SECRET=「Integrationから取得するシークレットキー」
- NOTION_DATABASE_ID=「データベースID」

### LINK
- [環境構築参考](https://qiita.com/hitotch/items/2e816bc1423d00562dc2)