<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>オリジナルドリップバッグ工房 推しカフェファクトリー</title>
    <meta name="description" content="コーヒー豆専門店が自家焙煎した最高品質のコーヒーを100％使用。1個からオリジナルパッケージが作れる「推し活応援」オリジナルドリップバッグサービス。画像を選んでそのままアップロード。好みのフレーバーと抽出タイプを選択して購入。">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="facebook-domain-verification" content="uh8qwpynegucl24hxsdgxme4z3w0pi" />
   <link rel="stylesheet" href="{{ asset('css/bootstrap-custom.css') }}">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-544J6FD');</script>
<!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-544J6FD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="l-wrapper">
    <div class="l-loader">
        <div class="loader">Loading...</div>
    </div>
    <header>
        @include('includes.header')
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @include('includes.footer')
    </footer>

</div>
<div id="toPageTop">
    <a href="#"><i class="fas fa-chevron-up"></i></a>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="//kit.fontawesome.com/af955fd0ec.js"></script>
<script src="{{ asset('js/myScript.js') }}"></script>
<script src="{{ asset('js/jquery.bgswitcher.js') }}"></script>
<script src="{{ asset('js/badge.js') }}"></script>
@stack('scripts')
</body>
</html>
