@extends('layout.base')

@section('content')

<div class="container-wrap">
    <div class="container">

        <div class="bg-pink-light rounded-10 py-16">
            <h2 class="text-center font-weight-bold fz-20"><span class="brackets">Oshi Cafe factoryとは？</span></h2>
        </div>
        <p class="text-center mt-16">1個からオリジナルパッケージが作れる<br>「推し活応援」オリジナルドリップバッグサービス！</p>
        <img src="/img/logo-mikoya.png" alt="珈琲豆専門店mikoya134" class="mt-24">
        <p class="mt-16">コーヒー豆専門店「mikoya134」で自家焙煎した最高品質のコーヒーを100％使用。珈琲豆の個性を最大限に引き出すため、世界に一台だけのオリジナル焙煎機をつくって焙煎するというこだわりぶり。鹿児島は温度や湿度が珈琲豆の熟成に最適な土地。134時間熟成した「南国薩摩熟成珈琲」をぜひお楽しみください。</p>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="">
                    <a href="https://mikoya134.com/oshi-cafe/" target="_blank" class="btn btn-block btn-primary py-3">推しカフェ豆紹介</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-64">
            <div class="col-md-4">
                <div class="">
                    <img src="/img/about-points1.png" alt="134時間熟成！南国薩摩熟成珈琲">
                </div>
            </div>
            <div class="col-md-4 mt-40 mt-md-0">
                <div class="">
                    <img src="/img/about-points2.png" alt="本格的なコーヒーをオリジナルグッズで作れる！">
                </div>
            </div>
        </div>
    </div>
</div>


@endsection