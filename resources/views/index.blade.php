@extends('layout.base')

@section('content')

<div class="position-relative" id="l-slider">
    <div class="position-relative d-flex flex-column justify-content-center" id="slider-home">
        <img src="/img/logo-slider.png" alt="Oshi Cafe Factory" class="slider-logo">
        {{--<div class="text-center">
            <a href="buy" class="btn btn-rainbow fz-24 pl-40 px-32 mt-32">作ってみる！</a>
        </div>--}}
    </div>
</div>
<?php
    // ==============================
    //  Oshi Cafe factoryとは？
    // ==============================
?>
<div class="container-wrap" id="l-originaldripbag">
    <div class="container">
        <div class="row justify-content-center mb-24">
            <div class="col-md-9 border border-primary p-16 p-md-32">
                <p class="text-center fz-20 pb-16 font-weight-bold">メンテナンスのお知らせ</p>
                <p class="text-justify pb-24">メンテナンスに伴い、一時ご注文の受付を停止させていただいておりますが、作業に遅れが生じており、終了予定時刻を2026年10月23日18:00頃まで延長させていただきます。皆様には大変ご不便をおかけいたしますが、何卒ご理解とご容赦のほどお願い申し上げます。</p>
        <div class="row justify-content-center mt-20">
            <div class="col-md-auto">
                <p class="fz-14 text-center">お急ぎの方はLINE公式アカウントからご注文ください。</p>
                <a href="https://lin.ee/9CPX4p1">
                    <img border="0" src="/img/line-de.png" style="width:168px;">
                </a>
            </div>
        </div>
            </div>
        </div>

        <div class="row justify-content-center mb-40">
            <div class="col-md-9 p-16 p-md-24 rounded-lg text-center text-pink" style="background: linear-gradient(90deg, #fce8f0 0%, #fdf4e8 50%, #e8f4fd 100%);">
                <p class="text-center fz-18 mb-0 font-weight-bold">今年の夏はアイスコーヒーで推し活！</p>
                <a href="https://mikoya134.com/howtomakeicecoffee/" target="_blank" class="text-center text-pink fz-18">作り方を見る＞＞</a>
            </div>
        </div>
        {{--<div class="row justify-content-center mb-24">
            <div class="col-md-9 border border-primary p-16 p-md-32">
                <p class="text-center fz-20 pb-16 font-weight-bold">【GW中の発送について】</p>
                <p class="text-justify pb-24">日頃より、推しカフェファクトリーをご利用いただき誠にありがとうございます。 <br>勝手ながらゴールデンウィーク中は当店お休みのため、お届け期間を変更させていただきます。<span class="font-weight-bold fz-18">4月27日（月）までのご注文分は5月2日（土）に発送。4月28日（火）以降のご注文分は5月7日（木）から順次発送</span>となります。皆様には大変ご不便をおかけ致しますが、何卒ご容赦いただきますようお願い申し上げます。</p>
            </div>
        </div>
        <div class="row justify-content-center mb-24">
            <div class="col-md-9 border border-primary p-16 p-md-32">
                <p class="text-center fz-20 pb-16 font-weight-bold">【お盆中の発送について】</p>
                <p class="text-justify pb-24">日頃より、推しカフェファクトリーをご利用いただき誠にありがとうございます。 <br>勝手ながらお盆期間中は当店お休みのため、お届け期間を変更させていただきます。<span class="font-weight-bold fz-18">8月11日（月）以降の受付分は8月17日（日）からの</span>順次発送となります。皆様には大変ご不便をおかけ致しますが、何卒ご容赦いただきますようお願い申し上げます。</p>
            </div>
        </div>
        <div class="row justify-content-center mb-24">
            <div class="col-md-9 border border-primary p-16 p-md-32">
                <p class="text-center fz-20 pb-16 font-weight-bold">【納期にについて】</p>
                <p class="text-justify pb-24">日頃より、推しカフェファクトリーをご利用いただき誠にありがとうございます。 <br>只今多くのご注文をいただいており、勝手ながら<span class="font-weight-bold fz-18">ご購入から8営業日後の発送</span>とさせていただきます。ご注文順に順次発送しておりますので、大変ご不便をおかけ致しますが、何卒ご容赦いただきますようお願い申し上げます。</p>
            </div>
        </div>
        <div class="row justify-content-center mb-24">
            <div class="col-md-9 border border-primary p-16 p-md-32">
                <p class="text-center fz-20 pb-16 font-weight-bold">本人認証サービス「3Dセキュア」対応に伴うメンテナンス実施のお知らせ</p>
                <p class="text-justify pb-24">日頃より、推しカフェファクトリーをご利用いただき誠にありがとうございます。<br>この度、より安全にお楽しみいただくため、クレジットカード決済において本人認証サービス「3Dセキュア2.0」を導入することとなりました。<br><br>本人認証サービス（3Dセキュア2.0）とはインターネット上でクレジットカード決済をより安全に行うために、VISA、Mastercard、JCB、AMEXが推奨するクレジットカード不正利用対策のための本人認証サービスです。取引の大半は追加認証なしに認証が完了し、高リスクと判断される取引にのみ、ワンタイムパスワード等の追加認証が行われます。<br>※本人認証の方法は、カード会社により異なります<br><br>これに伴い、システムメンテナンスを実施させていただきます。<br><br>■メンテナンス期間<br><span class="font-weight-bold fz-18">2025年1月27日(月)10:00～18:00（予定）</span><br>※開始・終了時刻は前後する場合がございます。<br>※メンテナンス期間中はご注文のお手続きができません。あらかじめご了承ください。</p>
            </div>
        </div>
        <div class="row justify-content-center mb-24">
            <div class="col-md-9 border border-primary p-16 p-md-32">
                <p class="text-center fz-20 pb-16 font-weight-bold">【年末年始の発送について】</p>
                <p class="text-justify pb-24">日頃より、推しカフェファクトリーをご利用いただき誠にありがとうございます。 <br>年末年始の休業にともない、お届け期間が変更となります。<span class="font-weight-bold fz-18">12月26日（金）受付分までは12月30日（火）に発送</span>させていただきます。年末年始の期間中も注文は受け付けておりますが、<span class="font-weight-bold fz-18">12月27日（土）以降のご注文は2026年1月6日（火）から順次発送</span>させていただきます。大変ご不便をおかけ致しますが、何卒ご容赦いただきますようお願い申し上げます。</p>
            </div>
        </div>
        <div class="row justify-content-center mb-24">
            <div class="col-md-9 border border-primary p-16 p-md-32">
                <p class="text-center fz-20 pb-16 font-weight-bold">【料金改定について】</p>
                <p class="text-justify pb-24">いつもご利用いただきありがとうございます。<r>誠に申し訳ございませんが珈琲豆をはじめ、資材などさまざまなものの価格高騰がなかなか落ち着かない状況が続いております。<br>これまでいろいろと工夫を重ねてまいりましたが、これ以上価格の維持が難しい状況となりましたため、大変心苦しいのですが、現在1個220円で販売しております「推しカフェファクトリー」を<span class="font-weight-bold fz-18">2026年4月1日より1個260円</span>に値上げさせていただくこととなりました。<br>ご負担をおかけしてしまい誠に申し訳ございませんが、今後ともどうぞよろしくお願いいたします。</p>
                <p class="text-justify pb-24">2026年4月1日10時現在、システムメンテナンスは終了しております。</p>
            </div>
        </div>--}}


         <img src="/img/SVG/setumeibun3.svg" alt="" class="" style="width: 550px;">
         <div class="text-center mt-32 mb-56">
            {{-- <a href="buy" class="btn btn-rainbow fz-24 pl-40 px-32">作ってみる！</a> --}}
            <p class="text-danger text-center">ただいまメンテナンス中です。しばらくお待ちください。</p>
        </div>
        <!-- <p class="text-center text-primary font-weight-bold lh-12 fz-22">最短2分で完成！<br>オリジナルドリップバッグが<br>1個200円から作れる！</p> -->
        <h2 class="text-center font-weight-bold fz-20 mt-32"><span class="brackets">Oshi Cafe factoryとは？</span></h2>
        <p class="text-center mt-24">コーヒー豆専門店が自家焙煎した<br>最高品質のコーヒーを100％使用！<br>1個からオリジナルパッケージが作れる<br>「推し活応援」オリジナルドリップバッグサービス！</p>
        <p class="text-right"><a href="about" class="border-bottom border-brown text-brown">もっと詳しく</a></p>
        <img src="/img/SVG/eraberu.svg" alt="" class="" style="width: 350px;">
    </div>
</div>
<?php
    // ==============================
    //  完全オリジナルからテンプレートまで！、世界に1つのコーヒーギフト！、1個からでもOK！気軽に作れる！
    // ==============================
?>
<div class="container-wrap" id="l-home-points">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="">
                    <img src="/img/home-points1.png" alt="完全オリジナルからテンプレートまで！">
                    <h3 class="text-center text-primary font-weight-bold fz-18 mt-24">画像1枚ですぐに作れる！</h3>
                    <div class="bg-pink-light rounded-10 bg-primary-light p-8">
                        <p class="text-center lh-14 fz-14">プレビューで何度も仕上がり確認が可能！<br class="d-none d-md-block">初心者でも安心して簡単に作れます！</p>
                    </div>

                </div>
            </div>
            <div class="col-md-4 mt-40 mt-md-0">
                <div class="">
                    <img src="/img/home-points2.png" alt="世界に一つのコーヒーギフト！">
                    <h3 class="text-center text-primary font-weight-bold fz-18 mt-24">色々なシーンでの贈り物に最適！</h3>
                    <div class="bg-pink-light rounded-10 bg-primary-light p-8">
                        <p class="text-center lh-14 fz-14">軽くて薄いからノベルティや差し入れに最適！<br class="d-none d-md-block">配送コストも抑えられる！</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-40 mt-md-0">
                <div class="">
                    <img src="/img/home-points3.png" alt="１個からでもOK！気軽に作れる！">
                    <h3 class="text-center text-primary font-weight-bold fz-18 mt-24">欲しい数だけ作れるから安心！</h3>
                    <div class="bg-pink-light rounded-10 bg-primary-light p-8">
                        <p class="text-center lh-14 fz-14">1個から大量注文まで可能！<br class="d-none d-md-block">初めてのグッズ作りを応援します！</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
    // ==============================
    //  #推しカフェファクトリー
    // ==============================
?>

<div class="container-wrap bg-pink-thin">
    <div class="container">
        <img src="/img/SVG/home-customersvoice-ttl.svg" alt="#推しカフェファクトリー" style="width:352px;">
        <h2 class="text-center mt-16">♯推しカフェファクトリー</h2>
        <div class="row gtr-8 row-cols-3 mt-24">
            <div class="col"><img src="/img/oshiinsta06.jpg" alt="#推しカフェファクトリー"></div>
            <div class="col"><img src="/img/oshiinsta07.png" alt="#推しカフェファクトリー"></div>
            <div class="col"><img src="/img/oshiinsta08.jpg" alt="#推しカフェファクトリー"></div>
            <div class="col mt-8"><img src="/img/oshiinsta09.png" alt="#推しカフェファクトリー"></div>
            <div class="col mt-8"><img src="/img/oshiinsta10.png" alt="#推しカフェファクトリー"></div>
            <div class="col mt-8"><img src="/img/oshiinsta11.png" alt="#推しカフェファクトリー"></div>
        </div>
        <p class="text-center mt-24 mb-0">画像をアップロードするだけ！</p>
        <div class="text-center">
            {{-- <a href="buy" class="btn btn-rainbow fz-24 pl-40 px-32">作ってみる！</a> --}}
            <p class="text-danger text-center">ただいまメンテナンス中です。しばらくお待ちください。</p>
        </div>
        <p class="text-center"><a href="/#l-flow" class="text-dark border-bottom border-width-2 d-inline-block mt-24">ご購入までの流れはこちら</a></p>
    </div>
</div>

<?php
    // ==============================
    //  3ステップで簡単作成！
    // ==============================
?>
<div class="py-24 py-md-48 py-lg-64" id="l-flow">
    <div class="px-16">
        <img src="/img/SVG/home-3step-ttl.svg" alt="3ステップで簡単作成！" style="width:406px;">
        <h2 class="text-center">ご購入までの流れ</h2>
    </div>
    <div class="step step1 py-40">
        <div class="row no-gutters align-items-center">
            <div class="col-6">
                <div class="px-16">
                    <h3 class="text-center"><span class="border-stripe">Step 1</span></h3>
                    <p class="text-center">画像を選んでそのままアップロード、<br class="d-none d-md-block">またはテンプレートに画像はめ込むだけ!</p>
                </div>
            </div>
            <div class="col-6">
                <div class="px-16">
                    <img src="/img/home-3step-step1.png" alt="Step 1">
                </div>
            </div>
        </div>
    </div>
    <div class="step step2 position-relative arw-top-btm bg-pink-light py-40">
        <div class="row no-gutters align-items-center">
            <div class="col-6">
                <div class="px-16">
                    <h3 class="text-center"><span class="border-stripe">Step 2</span></h3>
                    <p class="text-center">2色のパッケージから選択！<br>デザインが決まったらプレビューして<br class="d-none d-md-block">デザインが気に入ったら完成！</p>
                </div>
            </div>
            <div class="col-6">
                <div class="px-16">
                    <img src="/img/home-3step-step2.png" alt="Step 2">
                </div>
            </div>
        </div>
    </div>
    <div class="step step3 position-relative arw-top-btm bg-rainbow py-40">
        <div class="row no-gutters align-items-center">
            <div class="col-6">
                <div class="px-16">
                    <h3 class="text-center"><span class="border-stripe">Step 3</span></h3>
                    <p class="text-center">5種類のコーヒーから<br class="d-none d-md-block">好みのフレーバーと抽出タイプを選択して購入。<br class="d-none d-md-block">（抽出はドリップタイプとコヒーバックタイプ）<br>お支払いはカード・コンビニ決済で！</p>
                </div>
            </div>
            <div class="col-6">
                <div class="px-16">
                    <img src="/img/home-3step-step3.png" alt="Step 3">
                </div>
            </div>
        </div>
    </div>
    <p class="text-center mt-24 mb-0">画像をアップロードするだけ！</p>
    <div class="text-center">
        {{-- <a href="buy" class="btn btn-rainbow fz-24 pl-40 px-32">作ってみる！</a> --}}
        <p class="text-danger text-center">ただいまメンテナンス中です。しばらくお待ちください。</p>
    </div>
</div>
<?php
    // ==============================
    //  料金について
    // ==============================
?>
<div class="container-wrap bg-pink-thin" id="l-price">
    <div class="container">
        <h2 class="h2 text-center"><span class="border-bottom border-width-2 border-brown d-inline-block pb-8">料金について</span></h2>
        <div class="card border-skyblue border-width-4 rounded-10">
            <div class="card-header bg-skyblue row no-gutters">
                <div class="col-6 text-center text-white">個数</div>
                <div class="col-6 text-center text-white">料金</div>
            </div>
            <div class="card-body p-0">
                <div class="row no-gutters align-items-center lh-14 border-bottom">
                    <div class="col-6 text-center border-right py-16">1〜9個まで</div>
                    <div class="col-6 text-center py-16">260円</div>
                </div>
                <div class="row no-gutters align-items-center lh-14 border-bottom">
                    <div class="col-6 text-center border-right py-16">10個以上<span class="text-primary fz-14 d-block">（送料無料）</span></div>
                    <div class="col-6 text-center py-16">260円</div>
                </div>
            </div>
        </div>
        <p class="kome mt-16">※500個以上の大量注文をお考えの方はお問い合わせください。</p>
        <div class="row justify-content-center mt-40">
            <div class="col-md-auto">
                <a href="contact" class="btn btn-block btn-outline-brown" style="color:#806239;">お問い合わせ</a>
            </div>
        </div>
        <div class="row justify-content-center mt-40">
            <div class="col-md-auto">
                <a href="https://lin.ee/9CPX4p1">
                    <img border="0" src="/img/line-de.png" style="width:168px;">
                </a>
                <p class="fz-12 text-center">こちらからもお問い合わせいただけます。</p>
            </div>
        </div>
    </div>
</div>
    <?php
    // ==============================
    //  納期について
    // ==============================
?>
<div class="container-wrap" id="l-delivery">
    <div class="container">
        <h2 class="h2 text-center"><span class="border-bottom border-width-2 border-brown d-inline-block pb-8">納期について</span></h2>
        {{-- <div class="row justify-content-center my-24">
            <div class="col-md-9 border border-primary p-16 p-md-32">
                <p class="text-justify pb-24">日頃より、推しカフェファクトリーをご利用いただき誠にありがとうございます。 <br>只今多くのご注文をいただいており、勝手ながら<span class="font-weight-bold fz-18">ご購入から8営業日後の発送</span>とさせていただきます。ご注文順に順次発送しておりますので、大変ご不便をおかけ致しますが、何卒ご容赦いただきますようお願い申し上げます。</p>
            </div>
        </div>
        <p class="text-justify text-md-center text-danger pb-24">GW期間中は納期が変わります。<br>4月27日（土）受付分までは5月2日（木）までに発送、4月28日（日）受付分以降は5月8日（水）から順次発送。</p> --}}
        <p class="text-center font-weight-bold fz-26 mt-24"><span class="border border-brown border-width-4 rounded-10 d-block d-md-inline-block p-16">ご購入から <br class="d-md-none">最短4営業日で発送</span></p>
        <p class="text-md-center">●ご注文から出荷まで、最短4営業日ほどお時間をいただいております。<br class="d-none d-md-block">月曜・火曜の店休日を挟む場合は、発送まで1週間ほどかかることがございます。<br>お早めにご注文くださいますようお願いいたします。</p>
        <p class="text-center">●お急ぎの方や、500個以上のご注文の場合は、<br class="d-none d-md-block">「<a href="https://lin.ee/9CPX4p1">LINEお問い合わせ</a>」よりお問い合わせください。</p>
        <p class="text-md-center">●ギフト包装（有料）をご希望の方、お届け日指定（有料）をご希望の方も、事前に「<a href="https://lin.ee/9CPX4p1">LINEお問い合わせ</a>」からご連絡ください。<br>※送料も別途かかります。</p>
        <p class="text-md-center text-danger fz-14">コンビニ決済の方は、ご入金確認後に制作作業をさせていただきます。</p>
    </div>
</div>
{{--<div class="container-wrap" id="l-delivery">
    <div class="container">
        <h2 class="h2 text-center"><span class="border-bottom border-width-2 border-brown d-inline-block pb-8">納期について</span></h2>
        <p class="text-center font-weight-bold fz-26 mt-24"><span class="border border-brown border-width-4 rounded-10 d-inline-block p-16">ご購入から 約2営業日で発送</span></p>
        <p class="text-center">本日のご注文で最短4日でのお届けとなります。<br class="d-none d-md-block">500個以上のご注文、またはお急ぎの場合は<br class="d-none d-md-block"><a href="https://oshi-cafe.com/contact">こちら</a>よりお問い合わせください。</p>
        <p class="text-md-center fz-12">出荷まで2日程度お時間をいただきます。期日がある場合はお早めにご注文下さいますよう、お願いいたします。</p>
        <p class="text-md-center fz-12">また、店休日のため月曜火曜のご注文分は翌々日以降の発送となりますのでご了承ください。</p>
        <p class="text-md-center text-danger fz-14">コンビニ決済の方は、ご入金確認後に発送作業をさせていただきます。</p>
    </div>
</div>--}}
<?php
    // ==============================
    //  支払い・発送方法
    // ==============================
?>
<div class="container-wrap bg-pink-thin" id="l-payment">
    <div class="container fz-14">
        <h2 class="h2 text-center"><span class="border-bottom border-width-2 border-brown d-inline-block pb-8">支払い・発送方法</span></h2>
        <h3 class="h3 fz-16 mt-24">支払い方法について</h3>
        <h4 class="h4 fz-14"><i class="fas fa-square mr-4 mt-16"></i>コンビニ決済前払い</h4>
        <p>ご注文後送られてくるメールの内容をご確認の上、コンビニでお支払いください。<br>※ご注文後10日までにお支払いの確認ができない場合はキャンセルとさせていただきます。</p>
        <h4 class="h4 fz-14"><i class="fas fa-square mr-4"></i>クレジットカード払い</h4>
        <p>お客様が入力されたカード情報は当店に送られることなく、さらにカード情報入力画面は暗号化（SSL）で保護されています。 </p>
        <h3 class="h3 fz-16 mt-24">配送・送料について</h3>
        <h4 class="h4 fz-14 mt-16"><i class="fas fa-square mr-4"></i>クリックポスト。※数量が多い場合は日本郵便（宅配便）でお届けいたします。</h4>
        <p>送料 300円。10個以上のお買い上げで送料無料。</p>
    </div>
</div>
<?php
    // ==============================
    //  その他
    // ==============================
?>
<div class="container-wrap" id="l-other">
    <div class="container">
        <h2 class="h2 text-center"><span class="border-bottom border-width-2 border-brown d-inline-block pb-8">その他</span></h2>
        <h3 class="h3 fz-16 mt-24">返品・交換</h3>
        <h4 class="h4 fz-14"><i class="fas fa-square mr-4" aria-hidden="true"></i>商品を返品したい</h4>
        <ul class="fz-14" style="padding-left: 20px;">
            <li>受注生産商品の為、お客様のご都合によるご注文のキャンセル・返品交換は固くお断りさせていただきます。<br class="d-none d-md-block">お客様による商品違い・色・画像の位置・イメージ違いなどによるキャンセル・返品交換はお受けできません。</li>
        </ul>
        <h4 class="h4 fz-14"><i class="fas fa-square mr-4" aria-hidden="true"></i>不良品がありました</h4>
        <ul class="fz-14" style="padding-left: 20px;">
            <li>未使用で、商品ご到着後7日以内にご連絡お願いいたします。ご連絡の際は、専用フォーム（お問い合わせ）にて商品の状態がわかるようなお写真を添付してご送付をお願い致します。<br class="d-none d-md-block">（お客様情報、商品の状態、該当商品の画像をお願いいたします）</li>
            <li>弊社にて画像確認後、商品の不備、弊社の過失と判断できる場合のみ交換をお受けいたします。</li>
            <li>お問い合わせの返信は3日以内にメールにてご連絡いたします。※土日祝、定休日を除く</li>
            <li>お送り頂いた画像では判断できない場合は再度、画像の送付、現物の送付をお願いする場合がございます。</li>
            <li>弊社にお送りいただいた商品が交換対象外の場合、送料はお客様のご負担となります事、ご了承お願い致します。※現物を送付いただく場合はお手数ではございますが事前に弊社にご連絡お願い致します。</li>
            <li>原則、同一商品の交換のみとなっており、ご返金の対応は行っておりませんのでご了承ください。</li>
        </ul>
        <h3 class="h3 fz-16 mt-24">著作権・肖像権</h3>
        <ul class="fz-14" style="padding-left: 20px;">
            <li>お客様は弊社に対し、弊社の注文製品の作成及び利用について第三者の著作権（著作者人格権、肖像権も含む）や商標権、その他一切の権利を侵害せず、かつ適法であることを保証する義務を負います。なお、お客様は弊社に対し、お客様による弊社の利用・サービスにより、または、関連して弊社がお客様以外の者から権利の侵害等に基づくクレームを受けた場合や違法行為であるとの指摘を受けた場合、お客様は、お客様の責任と費用によってかかるクレームから弊社を免責し、かかるクレーム、及び違法行為であるとの指摘に対応するために弊社が受けた損害（合理的な弁護士費用等を含む）の全てを速やかに賠償する義務を負います。</li>
            <li>「著作権・肖像権の侵害」に該当する内容のものに関しては印刷をお断りさせて頂いております。</li>
            <li>こちらで著作権・肖像権の侵害の可能性があると判断した場合、ご注文をキャンセルさせていただきます。</li>
            <li>当店は、本サービスにより提供される情報について、その完全性、正確性、特定目的への適合性、有用性等、第三者の権利侵害の有無、その他一切の内容に関して保証するものではありません。</li>
            <li>利用者が本サービスを利用したことにより生じた一切の損害（直接損害、間接損害、通常損害、特別損害、派生損害など損害の種類を問わず、利益、信用、利用機会、データ、またはその他無形資産の喪失による会員の損害を含む。）は、当該利用者会員が負担をするものとし、たとえ、当社に損害発生に関する予見可能性があったとしても、当店は一切責任を負わないものとします。</li>
            <li>弊社ではご注文頂いたデザインを当スタッフが一点一点、確認を行っておりますが、すべての著作権や肖像権などの検証は実上不可能です。</li>
            <li>著作権・肖像権に関しての確認や判断に関してのお問い合わせにはお答えすることができません。</li>
            <li>著作権・肖像権に関わるデザインのご利用に関しては、ご注文者様でご確認頂き、ご注文時にはご了承いただいたものといたします。</li>
            <li>弊社で印刷・発送を行った後に発生したトラブルについても弊社は一切の責任を負いません。</li>
            <li>著作物利用や著作権・肖像権に関わるご相談については弊社ではお答えすることができません。</li>
        </ul>
        <h3 class="h3 fz-16 mt-24">納品書・請求書・領収書</h3>
        <h4 class="h4 fz-14"><i class="fas fa-square mr-4" aria-hidden="true"></i>送付先に商品の金額がわからないようにしてほしい（納品書を同封しないでほしい）</h4>
        <ul class="fz-14" style="padding-left: 20px;">
            <li>納品書に商品金額を記載しております。基本納品書は同封しておりません。</li>
        </ul>
        <h4 class="h4 fz-14"><i class="fas fa-square mr-4" aria-hidden="true"></i>納品書はいただけますか？</h4>
        <ul class="fz-14" style="padding-left: 20px;">
            <li>納品書が必要な方は、お届け先入力の画面で【必要】にチェックを入れてください。納品書は商品と同梱してお送り致します。</li>
        </ul>
        <h4 class="h4 fz-14"><i class="fas fa-square mr-4" aria-hidden="true"></i>領収書は発行出来ますか？</h4>
        <ul class="fz-14" style="padding-left: 20px;">
            <li>カード決済・コンビニ決済の場合、カード会社・コンビニから発行されるものが領収証となるため、弊社からは発行いたしません。</li>
        </ul>
    </div>
</div>@endsection

@push('scripts')

<script>
    jQuery(function($) {
        if ( $('#slider-home').length ) {
            $('#slider-home').bgSwitcher({
                images: [ // 切り替える背景画像
                    '/img/home-bg-slide1.jpg',
                    '/img/home-bg-slide2.jpg',
                    '/img/home-bg-slide3.jpg'
                ],
                interval: 5000, // 背景画像を切り替える間隔 1000=1秒
                loop: true,     // 切り替えを繰り返すか true=繰り返す false=繰り返さない
                shuffle: false,  // 背景画像の順番をシャッフルするか true=する false=しない
                effect: "fade", // エフェクトの種類をfade,blind,clip,slide,drop,hideから指定
                duration: 2000, // エフェクトの時間 1000=1秒
                easing: "swing" // エフェクトのイージングをlinear,swingから指定
            });
        }
    });
</script>
@endpush
