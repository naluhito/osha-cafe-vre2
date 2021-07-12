@extends('layout.base')

@section('content')

<div class="bg-rainbow py-24 py-md-48">
    <h1 class="text-center font-weight-bold fz-24 fz-md-32">店舗情報</h1>
</div>
<div class="container-wrap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <table class="table tbl-2column border border-primary fz-14">
                    <tbody>
                        <tr>
                            <th>店舗名</th>
                            <td>bueno珈琲豆専門店mikoya134</td>
                        </tr>
                        <tr>
                            <th>運営統括責任者</th>
                            <td>馬場　克也</td>
                        </tr>
                        <tr>
                            <th>所在地</th>
                            <td>鹿児島県鹿児島市下荒田3丁目37−1</td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td><span class="tel-link">099-201-5529</span></td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td>bueno<i class="fas fa-at"></i>mikoya134-coffee.com</td>
                        </tr>
                        <tr>
                            <th>店舗URL</th>
                            <td><a href="https://mikoya134.com" target="_blank" rel="noopener noreferrer">https://mikoya134.com</a></td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="text-center fz-20 font-weight-bold mt-40 mb-24">店舗地図</h2>
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3399.3430724926006!2d130.5507193151519!3d31.56963868135332!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x353e6734cf427f97%3A0x1a7bd64b536dcb18!2z44CSODkwLTAwNTYg6bm_5YWQ5bO255yM6bm_5YWQ5bO25biC5LiL6I2S55Sw77yT5LiB55uu77yT77yX4oiS77yR!5e0!3m2!1sja!2sjp!4v1621747575643!5m2!1sja!2sjp" style="border:0;" allowfullscreen=""></iframe>
                </div>
                <a href="https://goo.gl/maps/BKg7VXFckyG5gXzQ7" target="_blank" rel="noopener noreferrer" class="btn btn-lg btn-block btn-outline-brown mt-24">大きな地図で見る</a>
            </div>
        </div>
    </div>
</div>


@endsection