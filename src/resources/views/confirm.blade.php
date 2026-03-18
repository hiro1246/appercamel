<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
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
        <div class="confirm__content">
            <div class="confirm__heading">
                <h2>お問い合わせ内容確認</h2>
            </div>
            <form class="form" action="/contacts" method="post">
                @csrf
                <div class="confirm-table">
                    <table class="confirm-table__inner">
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お名前</th>
                            <td class="confirm-table__text">
                                {{ $contact['name'] }}
                                <input type="hidden" name="name" value="{{ $contact['name'] }}" />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">メールアドレス</th>
                            <td class="confirm-table__text">
                                {{ $contact['email'] }}
                                <input type="hidden" name="email" value="{{ $contact['email'] }}" />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">住所</th>
                            <td class="confirm-table__text">
                                {{ $contact['address'] }}
                                <input type="hidden" name="address" value="{{ $contact['address'] }}" />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">建物名</th>
                            <td class="confirm-table__text">
                                {{ $contact['building'] ?? '（未入力）' }}
                                <input type="hidden" name="building" value="{{ $contact['building'] }}" />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">電話番号</th>
                            <td class="confirm-table__text">
                                @php
                                $tel = preg_replace('/\D/', '', $contact['tel']);
                                $tel1 = substr($tel, 0, 3);
                                $tel2 = substr($tel, 3, 4);
                                $tel3 = substr($tel, 7);
                                @endphp
                                {{ $tel1 }}-{{ $tel2 }}-{{ $tel3 }}
                                <input type="hidden" name="tel" value="{{ $contact['tel'] }}" />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">性別</th>
                            <td class="confirm-table__text">
                                {{ $contact['gender'] === '1' ? '男性' : ($contact['gender'] === '2' ? '女性' : 'その他') }}
                                <input type="hidden" name="gender" value="{{ $contact['gender'] }}" />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせの種類</th>
                            <td class="confirm-table__text">
                                @php
                                $inquiryTypes = [
                                'delivery' => '商品お届けについて',
                                'exchange' => '商品の交換について',
                                'trouble' => '商品トラブル',
                                'shop' => 'ショップへのお問い合わせ',
                                'other' => 'その他',
                                ];
                                @endphp
                                {{ $inquiryTypes[$contact['inquiry_type']] ?? $contact['inquiry_type'] }}
                                <input type="hidden" name="inquiry_type" value="{{ $contact['inquiry_type'] }}" />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせ内容</th>
                            <td class="confirm-table__text">
                                {{ $contact['content'] }}
                                <input type="hidden" name="content" value="{{ $contact['content'] }}" />
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="form__button">
                    <form action="/contacts/edit" method="post" style="display: inline;">
                        @csrf
                        <input type="hidden" name="name" value="{{ $contact['name'] }}" />
                        <input type="hidden" name="email" value="{{ $contact['email'] }}" />
                        <input type="hidden" name="address" value="{{ $contact['address'] }}" />
                        <input type="hidden" name="building" value="{{ $contact['building'] }}" />
                        <input type="hidden" name="tel" value="{{ $contact['tel'] }}" />
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}" />
                        <input type="hidden" name="inquiry_type" value="{{ $contact['inquiry_type'] }}" />
                        <input type="hidden" name="content" value="{{ $contact['content'] }}" />
                        <button class="form__button-submit" type="submit" style="background-color: #999;">修正</button>
                    </form>
                    <form action="/contacts" method="post" style="display: inline;">
                        @csrf
                        <input type="hidden" name="name" value="{{ $contact['name'] }}" />
                        <input type="hidden" name="email" value="{{ $contact['email'] }}" />
                        <input type="hidden" name="address" value="{{ $contact['address'] }}" />
                        <input type="hidden" name="building" value="{{ $contact['building'] }}" />
                        <input type="hidden" name="tel" value="{{ $contact['tel'] }}" />
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}" />
                        <input type="hidden" name="inquiry_type" value="{{ $contact['inquiry_type'] }}" />
                        <input type="hidden" name="content" value="{{ $contact['content'] }}" />
                        <button class="form__button-submit" type="submit">送信</button>
                    </form>
                </div>
        </div>
    </main>
</body>

</html>