@extends('layout.base')

@section('content')

<div class="container-wrap">
	<div class="container pb-40">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<h3 class="fz-16 p-16 mb-32 text-white" style="background-color:#a6d1ec;"><i class="fas fa-store pr-4" aria-hidden="true"></i>お支払いについて（ファミリーマート）</h3>
				<p>店頭のファミポートで、企業コード、受注番号を入力し、発行される申込券をレジで提示してお支払いください。</p>
				<p>※必ず記載の払込期限までにお支払いください。</p>
				<div class="p-16 border border-primary">
					<ul class="list-unstyled">
						<li>企業コード：{{ $view_param['company_code'] }}</li>
						<li>注文番号：{{ $view_param['order_no'] }}</li>
						<li>支払期限：{{ $view_param['expired_date'] }}</li>
					</ul>
				</div>
				<h3 class="fz-16 p-16 my-32 text-white" style="background-color:#a6d1ec;"><i class="fas fa-cash-register pr-4" aria-hidden="true"></i>お支払いの流れ</h3>
				<p>下記からご確認ください。</p>
				<a href="https://www.family.co.jp/services/application/receipt/shuunouhyou.html" target="_blank" style="word-break:break-all;">https://www.family.co.jp/services/application/receipt/shuunouhyou.html</a>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
jQuery(function($) {
	localStorage.removeItem('oshiBasket');
	$('#badge').text('');
});
</script>

@endpush
