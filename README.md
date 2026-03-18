# appercamel

Laravel ベースの問い合わせフォームアプリです。  
Docker（Nginx / PHP-FPM / MySQL / phpMyAdmin）で動作します。

## 起動手順

```bash
docker compose up -d --build
```

アプリ: http://localhost  
phpMyAdmin: http://localhost:8080

## 初期DB設定

```bash
docker compose exec php php artisan migrate
```

必要に応じてシーダー実行:

```bash
docker compose exec php php artisan db:seed
```

## ディレクトリ構成

- `src/` : Laravel アプリ本体
- `docker/` : Docker 設定（nginx / php / mysql）
- `docker-compose.yml` : ローカル開発用コンテナ定義
