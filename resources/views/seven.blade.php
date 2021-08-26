@extends('layout.base')

@section('content')

<div class="container-wrap">
	<div class="container pb-40">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<h3 class=" p-16 mb-32" style="background-color:#a6d1ec;">お支払いについて（セブンイレブン）<h3>
				<p>下記URLから払込票をご確認ください。<br>パソコンの場合は払込票をプリントしたものを、スマートフォン、携帯電話については画面上に表示したものを、店頭レジにてお見せください。</p>
				<p>※必ず記載の払込期限（{{ $expried_date }}）までにお支払いください。</p>
				<a href="{{ $billing_url }}" target="_blank">
				<h3 class=" p-16 my-32" style="background-color:#a6d1ec;">お支払いの流れ<h3>
				<p>下記URLからご確認ください。</p>
				<a href="https://payment.kuronekoyamato.co.jp/webcollect/help/SevenelevenHelp.html" target="_blank">
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
@endpush
