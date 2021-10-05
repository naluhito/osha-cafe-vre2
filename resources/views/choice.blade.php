@extends('layout.base')

@section('content')
<style type="text/css">
#overlay{ 
    position: fixed;
    top: 0;
    left: 0;
    z-index: 999;
    width: 100%;
    height:100%;
    display: none;
    background: rgba(0,0,0,0.6);
}
.cv-copy {
    position:absolute;
    width:100%;
    padding-top:120px;
    margin-top:35vh; 
    text-align:center; 
}
.cv-copy h2 {
    color:#fff;
    font-size:18px;
    text-align:center; 
}
.cv-copy p {
    color:#fff;
    text-align:center; 
}
.cv-spinner {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.spinner {
    width: 80px;
    height: 80px;
    border: 4px #ddd solid;
    border-top: 4px #999 solid;
    border-radius: 50%;
    animation: sp-anime 0.8s infinite linear;
}
@keyframes sp-anime {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(359deg); }
}
.is-hide{
    display:none;
}
</style>

<div class="container-wrap">
	<div class="container pb-40">
		<div class="row justify-content-center">
			<div class="col-md-7 col-lg-6 col-xl-5">
				<div id='btn1_1'>
					<div class="btn btn-primary w-100 text-white p-24 ls-02 d-block">
						<a id="choice01">フレーム・無地　を選ぶ</a>
					</div>
				</div>
                <div id="btn1_2" class="button01box" style="display: none">
                    <div class="bg-mizuiro text-center text-white d-block p-24">フレーム・無地を選ぶ</div>
                    <img src="img/SVG/ok.svg" alt="ok" style="width:55px;" class="okmark">
                </div>
				<div id="btn2_0">
					<div class="graybox text-center w-100 p-24 ls-02 mt-24">
					画像選択・調整
					</div>
				</div>
				<div id="btn2_1" style="display: none">
					<div class="btn btn-primary w-100 text-white p-24 ls-02 mt-24 d-block">
						<a id="choice02">画像選択・調整</a>
					</div>
				</div>
				<div id="btn2_2" style="display: none">
					<div class="button01box">
						<div class="bg-mizuiro text-center text-white d-block p-24 mt-24">画像選択・調整</div>
						<img src="img/SVG/ok.svg" alt="ok" style="width:55px;" class="okmark">
					</div>
				</div>
				<div id='btn3_0'>
					<div class="graybox text-center w-100 p-24 ls-02 mt-24">
						珈琲豆と数量を選ぶ
					</div>
				</div>
				<div id='btn3_1' style="display: none">
					<div class="btn btn-primary w-100 text-white p-24 ls-02 d-block mt-24">
						<a id="choice03">珈琲豆と数量を選ぶ</a>
					</div>
				</div>
                <div id="btn3_2" class="button01box" style="display: none">
                    <div class="bg-mizuiro text-center text-white d-block p-24 mt-24">珈琲豆と数量を選ぶ</div>
                    <img src="img/SVG/ok.svg" alt="ok" style="width:55px;" class="okmark">
                </div>
				<div id='btn4' style="display: none">
	                <a href="basket" class="button05 text-center d-block p-16 mt-40 mt-md-64 w-75 mx-auto"><i class="fas fa-shopping-cart fz-20 pr-8"></i>買い物かごへ</a>
				</div>
                <a href="choice" class="button04 text-center d-block p-16 mt-24 w-75 mx-auto">リセット</a>
			</div>
		</div>
	</div>
</div>
{{-- フレーム一覧modal --}}
<div class="modal fade pt-8" id="frameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-bs-backdrop="static">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header ">
				<h5 class="modal-title fz-16" id="exampleModalLongTitle">フレーム・無地を選んでください</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row gtr-16">
					<div class="col-6 mt-16">
						<input class="c01 w-100" type="image" src="img/frame/frame_00.png" value="frame_00.png">
					</div>
					<div class="col-6 mt-16">
						<input class="c01 w-100" type="image" src="img/frame/frame_01.png" value="frame_01.png">
					</div>
					<div class="col-6 mt-16">
						<input class="c01 w-100" type="image" src="img/frame/frame_02.png" value="frame_02.png">
					</div>
					<div class="col-6 mt-16">
						<input class="c01 w-100" type="image" src="img/frame/frame_03.png" value="frame_03.png">
					</div>
					<div class="col-6 mt-16">
						<input class="c01 w-100" type="image" src="img/frame/frame_04.png" value="frame_04.png">
					</div>
					<div class="col-6 mt-16">
						<input class="c01 w-100" type="image" src="img/frame/frame_05.png" value="frame_05.png">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- 確認modal --}}
<div class="modal fade mt-56 pt-8" id="confirmModal">
	<div class="modal-dialog">
	<div class="modal-content p-32 br-4-black">
		<div class="modal-header bg-white">
		</div>
		<div class="modal-body">
		<img id="confirmFrame">
		<p class="text-center mt-24">このフレームでOK?</p>
		</div>
		<div class="row gtr-16">
			<div class="col-6">
				<a href="#" id="confirmOk" class="d-block bg-mizuiro p-16 text-center text-white br-4-2">OK</a>
			</div>
			<div class="col-6">
				<a href="#" class="button001 text-dark d-block p-16 text-center b-4-b1" data-dismiss="modal">キャンセル</a>
			</div>
		</div>			      
	</div>
	</div>
</div>
{{-- 編集modal --}}
<div class="modal fade pt-8" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header choice02">
                <button type="button" id="editClose" class="close text-right">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title fz-16" id="exampleModalLongTitle">位置や拡大縮小で調整してください</h5>
            </div>
            <div class="modal-body p-16">
                <p class="fz-18 mb-0">▼ 印刷範囲</p>
                <div id="frame" class="upload-wrap outer">
                    <div id="drop_area" class="inner" style="overflow: hidden">
	                    <div id="img"></div>
                        <div class="form-group text-center">
                            <label for="exampleFormControlFile1">アップロードしたいファイルを<br>ここにドラッグ＆ドロップ</label>
                            <input type="file" class="form-control-file mt-16" id="input_file" accept="image/*" placeholder="またはファイルを選択">
                        </div>
                    </div>
                </div>
                <div class="form-group text-center upload-scale">
                    <label for="formControlRange">画像の拡大・縮小</label>
                    <input type="range" class="form-control-range" id="controlRange" min="0.1" max="2" value="1" step = "any">
                </div>
                <div class="row gtr-16">
                    <div class="col-6">
                        <a href="#" id="editReturn" data-dismiss="modal" class="button001 d-block p-16 text-center br-4-2">戻る</a>
                    </div>
                    <div class="col-6">
                        <a href="#" id="previewButton" class="button001 d-block p-16 text-center bg-mizuiro text-white">プレビュー</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- プレビューmodal --}}
<div class="modal fade pt-8" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content p-16">
			<div class="row gtr-16 mt-16">
				<div class="col-6">
					<a href="#" id="previewWhite" class="button001 d-block p-16 text-center text-dark br-4-black">
						ホワイト
					</a>
				</div>
				<div class="col-6">
					<a href="#" id="previewKraft" class="button001 d-block p-16 text-center text-dark bg-claft">
						クラフト
					</a>
				</div>
			</div>
			<div class="modal-body p-16">
				<img id="kraftImage" style="width:100%; padding:16px;">
				<img id="whiteImage" style="width:100%; padding:16px;">
				<div class="row gtr-16 mt-24">
					<div class="col-6">
						<a href="#" id="previewReturn" class="button001 d-block p-16 text-center br-4-2" data-dismiss="modal">戻る</a>
					</div>
					<div class="col-6">
						<a href="#" id="PreviewOk" class="button001 d-block p-16 text-center bg-mizuiro text-white">OK</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- 豆modal --}}
<div class="modal fade pt-8" id="choiceBeansModal" tabindex="-1" role="dialog" aria-labelledby="choiceBeensModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header choice02 border-0">
				<button type="button" class="close text-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h5 class="modal-title font-weight-bold text-white fz-16" id="choiceBeensModalTitle">個数を入力してください。</h5>
			</div>
			<div class="modal-body px-16 pb-32">
				<p class="font-weight-bold fz-30 text-pink mb-8">［ ドリップバッグタイプ ］</p>
				{{-- ドリップ行 --}}
				@foreach($beans as $bean)
				@if ($bean->kind == 0)
				<div class="border p-16 mt-0">
					<div class="media">
						<img src="{{ $bean->image}}" alt="{{ $bean->name }}" class="media-img mr-8">
						<div class="media-body">
							<h5 class="fz-16 mt-0">{{ $bean->name }}</h5>
							<p class="lh-14 fz-14">{{ $bean->note}}</p>
						</div>
					</div>
					<div class="row justify-content-between align-items-end gtr-16 mt-16">
						<div class="col-6">
							<ul class="pl-0">
								<li class="bg-cha rouded2 text-white text-center p-1 fz-12 mt-8">{{ $bean->features1 }}</li>
								<li class="bg-cha rouded2 text-white text-center p-1 fz-12 mt-8">{{ $bean->features2 }}</li>
								<li class="bg-cha rouded2 text-white text-center p-1 fz-12 mt-8">{{ $bean->features3 }}</li>
							</ul>
						</div>
						<div class="col-6">
							<div class="input-group">
								<input type="number" min="0" data-id="{{ $bean->id }}" class="bean-num form-control" placeholder="0" aria-label="" aria-describedby="">
								<div class="input-group-append"><span class="input-group-text" id="">個</span></div>
							</div>
						</div>
					</div>
				</div>
				@endif
				@endforeach

				<p class="font-weight-bold fz-30 text-pink mb-8 mt-56">［ コーヒーバッグタイプ ］</p>
				{{-- コーヒーバッグ行 --}}
				@foreach($beans as $bean)
				@if ($bean->kind == 1)
				<div class="border p-16 mt-0">
					<div class="media">
						<img src="{{ $bean->image }}" alt="{{ $bean->name }}" class="media-img mr-8">
						<div class="media-body">
							<h5 class="fz-16 mt-0">{{ $bean->name }}</h5>
							<p class="lh-14 fz-14">{{ $bean->note }}</p>
						</div>
					</div>
					<div class="row justify-content-between align-items-end gtr-16 mt-16">
						<div class="col-6">
							<ul class="pl-0">
							<li class="bg-cha rouded2 text-white text-center p-1 fz-12 mt-8">{{ $bean->features1 }}</li>
								<li class="bg-cha rouded2 text-white text-center p-1 fz-12 mt-8">{{ $bean->features2 }}</li>
								<li class="bg-cha rouded2 text-white text-center p-1 fz-12 mt-8">{{ $bean->features3 }}</li>
							</ul>
						</div>
						<div class="col-6">
							<div class="input-group">
								<input type="number" min="0" data-id="{{ $bean->id }}" class="bean-num form-control" placeholder="0" aria-label="" aria-describedby="">
								<div class="input-group-append"><span class="input-group-text" id="">個</span></div>
							</div>
						</div>
					</div>
				</div>
				@endif
				@endforeach
			</div>
			<div class="modal-footer text-center border-0 d-block py-16">
				<p class="calculate">
					<span class="calculate-text">合計個数</span>
					<span id="bean-total" class="calculate-num">0</span>
					<span class="calculate-text">個</span>
				</p>
				<button id="beansOk" type="button" class="btn btn-lg bg-mizuiro my-24 rounded-sm px-48" data-dismiss="modal" disabled="disabled">OK</button>
			</div>
		</div>
	</div>
</div>
<div id="overlay">
	<div class="cv-copy">
        <h2>買い物かごに登録中です…</h2>
        <p>※ブラウザを閉じないで下さい。</p>
    </div>
	<div class="cv-spinner">
		<span class="spinner"></span>
	</div>
</div>

@endsection
@push('scripts')
    <script src="{{ asset('js/choice.js') }}"></script>
@endpush
