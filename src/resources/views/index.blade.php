<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                Contact Form
            </a>
        </div>
    </header>

    <main>
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2>お問い合わせ</h2>
            </div>
            <form class="form" action="/contacts/confirm" method="post">
                @csrf
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お名前</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="name_last" placeholder="テスト" value="{{ old('name_last') }}" />
                            <input type="text" name="name_first" placeholder="太郎" value="{{ old('name_first') }}" />
                        </div>
                        <div class="form__error">
                            @if ($errors->has('name_last'))
                            {{ $errors->first('name_last') }}
                            @endif
                            @if ($errors->has('name_first'))
                            {{ $errors->first('name_first') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">メールアドレス</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" />
                        </div>
                        <div class="form__error">
                            @if ($errors->has('email'))
                            {{ $errors->first('email') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">住所</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="address" placeholder="東京都渋谷区道玄坂1-2-3" value="{{ old('address') }}" />
                        </div>
                        <div class="form__error">
                            @if ($errors->has('address'))
                            {{ $errors->first('address') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">建物名</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="building" placeholder="○○マンション101" value="{{ old('building') }}" />
                        </div>
                        <div class="form__error">
                            @if ($errors->has('building'))
                            {{ $errors->first('building') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">電話番号</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="tel" name="tel1" placeholder="090" maxlength="3" value="{{ old('tel1') }}" class="tel-input" />
                            -
                            <input type="tel" name="tel2" placeholder="1234" maxlength="4" value="{{ old('tel2') }}" class="tel-input" />
                            -
                            <input type="tel" name="tel3" placeholder="5678" maxlength="4" value="{{ old('tel3') }}" class="tel-input" />
                        </div>
                        <div class="form__error">
                            @if ($errors->has('tel1'))
                            {{ $errors->first('tel1') }}
                            @endif
                            @if ($errors->has('tel2'))
                            {{ $errors->first('tel2') }}
                            @endif
                            @if ($errors->has('tel3'))
                            {{ $errors->first('tel3') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">性別</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <label>
                                <input type="radio" name="gender" value="1" {{ old('gender') === '1' ? 'checked' : (old('gender') ? '' : 'checked') }} />
                                男性
                            </label>
                            <label>
                                <input type="radio" name="gender" value="2" {{ old('gender') === '2' ? 'checked' : '' }} />
                                女性
                            </label>
                            <label>
                                <input type="radio" name="gender" value="3" {{ old('gender') === '3' ? 'checked' : '' }} />
                                その他
                            </label>
                        </div>
                        <div class="form__error">
                            @if ($errors->has('gender'))
                            {{ $errors->first('gender') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせの種類</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <select name="inquiry_type">
                                <option value="" {{ old('inquiry_type') === '' ? 'selected' : '' }}>選択してください</option>
                                <option value="delivery" {{ old('inquiry_type') === 'delivery' ? 'selected' : '' }}>商品お届けについて</option>
                                <option value="exchange" {{ old('inquiry_type') === 'exchange' ? 'selected' : '' }}>商品の交換について</option>
                                <option value="trouble" {{ old('inquiry_type') === 'trouble' ? 'selected' : '' }}>商品トラブル</option>
                                <option value="shop" {{ old('inquiry_type') === 'shop' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                                <option value="other" {{ old('inquiry_type') === 'other' ? 'selected' : '' }}>その他</option>
                            </select>
                        </div>
                        <div class="form__error">
                            @if ($errors->has('inquiry_type'))
                            {{ $errors->first('inquiry_type') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせ内容</span>
                        <span class="form__label--required">必須</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--textarea">
                            <textarea name="content" placeholder="資料をいただきたいです" maxlength="120">{{ old('content') }}</textarea>
                        </div>
                        <div style="font-size: 12px; color: #999; margin-top: 5px;">
                            <span id="char-count">0</span>/120文字
                        </div>
                        <div class="form__error">
                            @if ($errors->has('content'))
                            {{ $errors->first('content') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">確認画面</button>
                </div>
            </form>
        </div>
    </main>
    <script>
        // 電話番号入力の全角を半角に自動変換
        document.querySelectorAll('input.tel-input').forEach(input => {
            input.addEventListener('input', function(e) {
                // 全角数字を半角に変換
                let value = e.target.value.replace(/[０-９]/g, function(s) {
                    return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
                });

                // 数値以外を削除
                value = value.replace(/[^0-9]/g, '');

                e.target.value = value;
            });
        });

        // お問い合わせ内容の文字数カウント
        const contentTextarea = document.querySelector('textarea[name="content"]');
        const charCountSpan = document.getElementById('char-count');

        if (contentTextarea && charCountSpan) {
            // 初期表示
            charCountSpan.textContent = contentTextarea.value.length;

            // リアルタイム更新
            contentTextarea.addEventListener('input', function(e) {
                charCountSpan.textContent = e.target.value.length;
            });
        }
    </script>
</body>

</html>