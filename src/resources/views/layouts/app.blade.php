{{-- ヘッダー --}}

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page_title', 'お問い合わせフォーム')</title>
    {{-- フォント読み込み --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&family=Noto+Serif+JP:wght@200..900&display=swap" rel="stylesheet">
    {{-- CSS読み込み --}}
    <link rel="stylesheet" href={{ asset('css/sanitize.css') }}>
    <link rel="stylesheet" href={{ asset('css/common.css') }}>

    {{-- 各ページ固有のCSSを読み込む --}}
    @yield('css')
</head>

<body>
    {{-- サイト全ページで共通のヘッダー --}}
    <header class="header">
        <div class="header__inner">
            <a href="/" class="header__logo">FashionablyLate</a>
            <div class="header__auth">
                @auth
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="header__button">ログアウト</button>
                </form>
                @endauth
                @guest
                <button onclick="window.location.href='{{ route('login') }}'" class="header__button">ログイン</button>
                @endguest
            </div>
        </div>
    </header>

    <main>
        {{-- 各ページ共有のページタイトル --}}
        <div class="page-title">
            <div class="page-title__text">
                @yield('page_title')
            </div>
        </div>
        
        {{-- メインコンテンツ --}}
        <div class="main-content">
            @yield('content')
        </div>
    </main>

    {{-- jsファイルの読み込み --}}
    @if(request()->is('admin*'))
        <script src="{{ asset('js/admin.js') }}"></script>
    @endif

</body>

{{-- フッター --}}
</html>