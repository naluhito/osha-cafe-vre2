@extends('layout.base')

@section('content')
<div class="container-wrap">
    <div class="container pb-40">
        <div id="item"  style="display: none">
            <div class="row gtr-48 justify-content-center align-items-center">
                <div class="col-md-auto">
                    <img id = "frame" src="" style="width:100%; width:180px;">
                </div>
                <div class="col-md-auto mt-24 mt-md-0">
                    <div class="row justify-content-center justify-content-md-start">
                        <div class="col-auto">
                            <p class="bb-4-dotted fz-20">○数量 : <span id="num">10</span>個</p>
                            <p class="bb-4-dotted fz-20 mt-24">○送料 : <span id="shipping">無料</span></p>
                            <p class="lh-14 bb-4-dotted fz-20 mt-24">○合計金額 : <span id="amount">2,000円</span><br class="d-md-none"><span class="fz-14 pl-16 pl-md-8">（内消費税<span id="tax">182</span>円）</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6 col-xl-5">
                <a href="choice" class="button05 text-center d-block p-16 mt-56 w-50 mx-auto">買い物を続ける</a>
                <a href="https://oshi-cafe.com/addressee.php" class="button06 text-center d-block p-16 mt-16 w-50 mx-auto"><i class="fas fa-truck fz-20 pr-8"></i>お届け先</a>
            </div>
        </div>
    </div>
</div>




@endsection
@push('scripts')
    <script src="{{ asset('js/basket.js') }}"></script>
@endpush
