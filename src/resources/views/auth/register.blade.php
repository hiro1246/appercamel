<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
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
                <h2>会員登録</h2>
            </div>

            <form class="auth-form" action="/register" method="post">
                @csrf
                <div class="auth-form__group">
                    <label class="auth-form__label" for="name">お名前</label>
                    <input class="auth-form__input" id="name" type="text" name="name" value="{{ old('name') }}" />
                    @error('name')
                    <p class="auth-form__error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="auth-form__group">
                    <label class="auth-form__label" for="email">メールアドレス</label>
                    <input class="auth-form__input" id="email" type="email" name="email" value="{{ old('email') }}" />
                    @error('email')
                    <p class="auth-form__error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="auth-form__group">
                    <span class="auth-form__label">性別</span>
                    <div class="auth-form__choices">
                        <label class="auth-form__choice">
                            <input type="radio" name="gender" value="1" {{ old('gender') === '1' ? 'checked' : '' }} />
                            男性
                        </label>
                        <label class="auth-form__choice">
                            <input type="radio" name="gender" value="2" {{ old('gender') === '2' ? 'checked' : '' }} />
                            女性
                        </label>
                        <label class="auth-form__choice">
                            <input type="radio" name="gender" value="3" {{ old('gender') === '3' ? 'checked' : '' }} />
                            その他
                        </label>
                    </div>
                    @error('gender')
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

                <div class="auth-form__group">
                    <label class="auth-form__label" for="password_confirmation">確認用パスワード</label>
                    <input class="auth-form__input" id="password_confirmation" type="password" name="password_confirmation" />
                </div>

                <button class="auth-form__button" type="submit">登録</button>
            </form>

            <p class="auth__link">すでに登録済みの場合は <a href="/login">こちら</a></p>
        </div>
    </main>
</body>

</html>