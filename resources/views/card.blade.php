@extends('layout.base')

@section('content')


<div class="container-wrap">
	<div class="container pb-40">
		<div class="row justify-content-center">
			<div class="col-md-7 col-lg-6 col-xl-5">
			<h3 class="fz-24">お買い上げありがとうございました。<h3>
			//  クレジット決済表示
			<ul class="list-unstyled pb-40">
			<li>決済完了日時：</li>
			<li>金額：</li>
			<li>受注ID：</li>
			</ul>
            <div class="col-12">
                <div class="send text-center my-40">
                    <a href="https://oshi-cafe.com/">トップへ戻る</a>
                </div>
	        </div>
			</div>
		</div>
	</div>
</div>



@endsection
@push('scripts')

@endpush
