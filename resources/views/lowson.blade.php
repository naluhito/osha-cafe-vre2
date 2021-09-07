@extends('layout.base')

@section('content')

<div class="container-wrap">
	<div class="container pb-40">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<h3 class="fz-16 p-16 mb-32 text-white" style="background-color:#a6d1ec;"><i class="fas fa-store pr-4" aria-hidden="true"></i>お支払いについて（ローソン・ミニストップ・セイコーマート）</h3>
				<p class="ffont-weight-bold text-primary">ローソン・ミニストップの場合</p>
				<p>お支払い受付番号と購入者様の電話番号で、Ｌｏｐｐｉ等の店頭端末に入力いただき、発行される申込券をレジで提示してお支払いください。</p>
				<p class="ffont-weight-bold text-primary">セイコーマートの場合</p>
				<p>レジにて「インターネット支払い」と告げてください。レジの画面に番号入力画面が表示されるので、「お支払受付番号」と「購入者様電話番号」を入力し、レジにてお支払いください。</p>
				<p>※必ず記載の払込期限までにお支払いください。</p>
				<div class="p-16 border border-primary">
					<ul class="list-unstyled">
						<li>お支払受付番号：{{ $view_param['econ_no'] }}</li>
						<li>購入者様電話番号：{{  }}</li>
						<li>支払期限：{{ $view_param['expired_date'] }}</li>
					</ul>
				</div>
				<h3 class="fz-16 p-16 my-32 text-white" style="background-color:#a6d1ec;"><i class="fas fa-cash-register pr-4" aria-hidden="true"></i>お支払いの流れ</h3>
				<p>下記からご確認ください。</p>
				<ul class="list-unstyled">
					<li><a href="https://www.econtext.jp/support/cvs/lawson.html" target="_blank">ローソン・ミニストップでお支払いの場合はこちら</a></li>
					<li><a href="https://www.econtext.jp/support/cvs/seicomart.html#paymentReceipt" target="_blank">セイコーマートでお支払いの場合はこちら</a></li>
				</ul>				
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
jQuery(function($) {
	localStorage.removeItem('oshiBasket');
});
</script>

@endpush
