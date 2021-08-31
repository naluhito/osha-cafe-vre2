@extends('layout.base')

@section('content')

<div class="container-wrap">
	<div class="container pb-40">
		<div class="row justify-content-center">
			<div class="col-md-8">
			<h3 class="fz-16 p-16 mb-32 text-white" style="background-color:#a6d1ec;"><i class="fas fa-store pr-4"></i>お支払いについて（セブンイレブン）<h3>
				<p>下記URLから払込票をご確認ください。<br>パソコンの場合は払込票をプリントしたものを、スマートフォン、携帯電話については画面上に表示したものを、店頭レジにてお見せください。</p>
				<p>※必ず記載の払込期限（{{ $view_param['expired_date'] }}）までにお支払いください。</p>
				<a href="{{ $view_param['billing_url'] }}" target="_blank">{{ $view_param['billing_url'] }}</a>
				<h3 class="fz-16 p-16 my-32 text-white" style="background-color:#a6d1ec;"><i class="fas fa-cash-register pr-4"></i>お支払いの流れ</h3>
				<p>下記URLからご確認ください。</p>
				<a href="https://payment.kuronekoyamato.co.jp/webcollect/help/SevenelevenHelp.html" target="_blank">https://payment.kuronekoyamato.co.jp/webcollect/help/SevenelevenHelp.html</a>
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
