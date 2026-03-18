<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">Contact Form</a>
        </div>
    </header>

    <main>
        <div class="auth__content">
            <div class="auth__heading">
                <h2>認証完了</h2>
            </div>

            <div class="auth-home__card">
                <p class="auth-home__text">{{ Auth::user()->name }} さん、ログイン中です。</p>
                <div class="auth-home__actions">
                    <a class="auth-form__button auth-form__button--secondary" href="/">お問い合わせ入力へ</a>
                    <form action="/logout" method="post">
                        @csrf
                        <button class="auth-form__button" type="submit">ログアウト</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>