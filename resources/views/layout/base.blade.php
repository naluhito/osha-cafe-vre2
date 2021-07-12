<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>オリジナルドリップバッグ工房 推しカフェファクトリー</title>
    <meta name="description" content="オリジナルドリップバッグ工房 推しカフェファクトリー">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap-custom.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</head>
<body>
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
@stack('scripts')
</body>
</html>
