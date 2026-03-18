<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
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
                <h2>管理画面</h2>
            </div>

            <div class="auth-home__card">
                <p class="auth-home__text">{{ Auth::user()->name }} さんでログインしています。</p>
                <p class="auth-home__text">メールアドレス: {{ Auth::user()->email }}</p>

                <h3>お問い合わせ内容一覧</h3>

                <form class="admin-search" method="GET" action="/admin">
                    <div class="admin-search__row">
                        <div class="admin-search__group">
                            <label class="admin-search__label">名前</label>
                            <input class="admin-search__input" type="text" name="name" value="{{ request('name') }}" placeholder="姓名・名前で検索" />
                        </div>
                        <div class="admin-search__group">
                            <label class="admin-search__label">メールアドレス</label>
                            <input class="admin-search__input" type="text" name="email" value="{{ request('email') }}" placeholder="メールアドレスで検索" />
                        </div>
                        <div class="admin-search__group">
                            <label class="admin-search__label">性別</label>
                            <select class="admin-search__select" name="gender">
                                <option value="" {{ request('gender') === '' || request('gender') === null ? 'selected' : '' }}>性別</option>
                                <option value="all" {{ request('gender') === 'all' ? 'selected' : '' }}>全て</option>
                                <option value="1" {{ request('gender') === '1' ? 'selected' : '' }}>男性</option>
                                <option value="2" {{ request('gender') === '2' ? 'selected' : '' }}>女性</option>
                                <option value="3" {{ request('gender') === '3' ? 'selected' : '' }}>その他</option>
                            </select>
                        </div>
                        <div class="admin-search__group">
                            <label class="admin-search__label">お問い合わせの種類</label>
                            <select class="admin-search__select" name="inquiry_type">
                                <option value="">種類を選択</option>
                                <option value="delivery" {{ request('inquiry_type') === 'delivery' ? 'selected' : '' }}>商品のお届けについて</option>
                                <option value="exchange" {{ request('inquiry_type') === 'exchange' ? 'selected' : '' }}>商品の交換について</option>
                                <option value="trouble" {{ request('inquiry_type') === 'trouble' ? 'selected' : '' }}>商品トラブル</option>
                                <option value="shop" {{ request('inquiry_type') === 'shop' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                                <option value="other" {{ request('inquiry_type') === 'other' ? 'selected' : '' }}>その他</option>
                            </select>
                        </div>
                        <div class="admin-search__group">
                            <label class="admin-search__label">日付</label>
                            <input class="admin-search__input" type="date" name="date" value="{{ request('date') }}" />
                        </div>
                    </div>
                    <div class="admin-search__buttons">
                        <button class="admin-search__button" type="submit">検索</button>
                        <a class="admin-search__button admin-search__button--reset" href="/admin">リセット</a>
                    </div>
                </form>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>お名前</th>
                            <th>メールアドレス</th>
                            <th>電話番号</th>
                            <th>お問い合わせ種別</th>
                            <th>内容</th>
                            <th>詳細</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->tel }}</td>
                            <td>{{ $contact->inquiry_type }}</td>
                            <td>{{ $contact->content }}</td>
                            <td>
                                <button class="detail-btn"
                                    type="button"
                                    data-id="{{ $contact->id }}"
                                    data-name="{{ $contact->name }}"
                                    data-email="{{ $contact->email }}"
                                    data-tel="{{ $contact->tel }}"
                                    data-address="{{ $contact->address ?? '' }}"
                                    data-building="{{ $contact->building ?? '' }}"
                                    data-gender="{{ $contact->gender ?? '' }}"
                                    data-inquiry-type="{{ $contact->inquiry_type ?? '' }}"
                                    data-content="{{ $contact->content ?? '' }}"
                                    data-date="{{ $contact->created_at?->format('Y年m月d日 H:i') ?? '' }}"
                                >詳細</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">お問い合わせはまだありません。</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $contacts->links() }}

                <div class="auth-home__actions">
                    <a class="auth-form__button auth-form__button--secondary" href="/">お問い合わせ入力ページへ</a>
                    <form action="/logout" method="post">
                        @csrf
                        <button class="auth-form__button" type="submit">ログアウト</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- Contact Detail Modal -->
    <div class="modal-overlay" id="contactModal" aria-hidden="true">
        <div class="modal-dialog" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">お問い合わせ詳細</h3>
                <button class="modal-close" id="modalClose" type="button" aria-label="閉じる">&times;</button>
            </div>
            <div class="modal-body">
                <table class="modal-detail-table">
                    <tbody>
                        <tr><th>ID</th><td id="modal-id"></td></tr>
                        <tr><th>お名前</th><td id="modal-name"></td></tr>
                        <tr><th>性別</th><td id="modal-gender"></td></tr>
                        <tr><th>メールアドレス</th><td id="modal-email"></td></tr>
                        <tr><th>電話番号</th><td id="modal-tel"></td></tr>
                        <tr><th>住所</th><td id="modal-address"></td></tr>
                        <tr><th>建物名</th><td id="modal-building"></td></tr>
                        <tr><th>お問い合わせ種別</th><td id="modal-inquiry-type"></td></tr>
                        <tr><th>お問い合わせ内容</th><td id="modal-content"></td></tr>
                        <tr><th>登録日時</th><td id="modal-date"></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    (function () {
        var modal = document.getElementById('contactModal');
        var closeBtn = document.getElementById('modalClose');
        var genderMap = { '1': '男性', '2': '女性', '3': 'その他' };
        var inquiryMap = {
            delivery: '商品のお届けについて',
            exchange: '商品の交換について',
            trouble: '商品トラブル',
            shop: 'ショップへのお問い合わせ',
            other: 'その他'
        };

        document.querySelectorAll('.detail-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.getElementById('modal-id').textContent = btn.dataset.id;
                document.getElementById('modal-name').textContent = btn.dataset.name;
                document.getElementById('modal-gender').textContent = genderMap[btn.dataset.gender] || btn.dataset.gender || '―';
                document.getElementById('modal-email').textContent = btn.dataset.email;
                document.getElementById('modal-tel').textContent = btn.dataset.tel;
                document.getElementById('modal-address').textContent = btn.dataset.address || '―';
                document.getElementById('modal-building').textContent = btn.dataset.building || '―';
                document.getElementById('modal-inquiry-type').textContent = inquiryMap[btn.dataset.inquiryType] || btn.dataset.inquiryType || '―';
                document.getElementById('modal-content').textContent = btn.dataset.content || '―';
                document.getElementById('modal-date').textContent = btn.dataset.date || '―';
                modal.setAttribute('aria-hidden', 'false');
                modal.classList.add('is-open');
            });
        });

        function closeModal() {
            modal.setAttribute('aria-hidden', 'true');
            modal.classList.remove('is-open');
        }

        closeBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', function (e) {
            if (e.target === modal) closeModal();
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeModal();
        });
    }());
    </script>
</body>

</html>