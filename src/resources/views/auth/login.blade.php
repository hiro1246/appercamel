<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">Contact Form</a>
            <a class="header__nav-link" href="/register">register</a>
        </div>
    </header>

    <main>
        <div class="auth__content">
            <div class="auth__heading">
                <h2>ログイン</h2>
            </div>

            <form class="auth-form" action="/login" method="post">
                @csrf
                <div class="auth-form__group">
                    <label class="auth-form__label" for="email">メールアドレス</label>
                    <input class="auth-form__input" id="email" type="email" name="email" value="{{ old('email') }}" />
                    @error('email')
                    <p class="auth-form__error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="auth-form__group">
                    <label class="auth-form__label" for="password">パスワード</label>
                    <input class="auth-form__input" id="password" type="password" name="password" />
                    @error('password')
                    <p class="auth-form__error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="auth-form__group auth-form__group--checkbox">
                    <label>
                        <input type="checkbox" name="remember" />
                        ログイン状態を保持する
                    </label>
                </div>

                <button class="auth-form__button" type="submit">ログイン</button>
            </form>

            <p class="auth__link">アカウントをお持ちでない場合は <a href="/register">こちら</a></p>
        </div>
    </main>
</body>

</html>