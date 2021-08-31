@extends('layout.base')

@section('content')


<div class="container-wrap">
	<div class="container pb-40">
		<div class="row justify-content-center">
			<div class="col-auto">
			<h3 class="fz-24 text-center">お買い上げありがとうございました。</h3>
			<ul class="list-unstyled py-40">
			<li>決済完了日時：{{ $process_date }}</li>
			<li>金額：{{ number_format($amount) }}円</li>
			<li>受注番号：{{ $order_number }}</li>
			</ul>
            <div class="col-12">
                <div class="send text-center my-40">
				<a href="https://oshi-cafe.com/" class="btn btn-primary">トップへ戻る</a>
                </div>
	        </div>
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
