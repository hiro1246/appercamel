# FashionablyLate（お問い合わせフォーム）

## 環境構築
**Dockerビルド**
1. `git clone git@github.com:estra-inc/confirmation-test-contact-form.git`
2. DockerDesktopアプリを立ち上げる
3. `docker-compose up -d --build`

> *MacのM1
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
