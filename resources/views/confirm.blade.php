@extends('layout.base')

@section('content')

<style type="text/css">
	.kounyuhin.tbl-2column tbody tr th {
		background-color: #fff;
		font-weight: 500;
		color: #212529;
	}

	.kounyuhin.tbl-2column tbody tr th,
	.kounyuhin.tbl-2column tbody tr td
	 {
		padding: 8px 15px!important;
		text-align: left;
	}

	.kounyuhin.tbl-2column tbody tr {
		border-bottom: 2px solid #212529;
	}

	input[type="radio"], input[type="checkbox"] {
	    width: 20px;
	    height: 20px;
	}

	.creditinfo {
	  display: none;
	}

	input:checked ~ .creditinfo {
	  display: block;
	}

	.btn.btn-primary2 {
	    border-radius: 15px;
	    background: rgb(49,115,255);
		background: linear-gradient(0deg, rgba(49,115,255,1) 0%, rgba(101,168,255,1) 49%, rgba(59,218,228,1) 100%);
	}
</style>
<div class="container-wrap">
	<div class="container pb-40 px-0">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="row justify-content-between p-16" style="background-color:#a6d1ec;">
					<div class="col-auto">
						<p class="text-white">
							<i class="fas fa-shopping-cart"></i> ご注文内容
						</p>
					</div>
					<div class="col-auto">
						<a href="#" class="text-white">
							変更する <i class="fas fa-chevron-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-center mt-24">
			<div class="col-8 col-sm-5 col-md-3">
				<img src="./img/coffee-claft.png" alt="商品画像">
				<p class="text-center mt-16">
					<span style="border-bottom:double;" class="pb-4">
						合計金額&emsp;<span class="fz-26 font-weight-bold">0,000</span><span class="fz-18">円</span>
					</span>
				</p>
			</div>
		</div>
		<div class="row justify-content-center mt-32">
			<div class="col-md-8">
				<div class="row justify-content-between p-16" style="background-color:#a6d1ec;">
					<div class="col-auto">
						<p class="text-white">
							<i class="fas fa-truck-moving"></i> お届け情報
						</p>
					</div>
					<div class="col-auto">
						<a href="#" class="text-white">
							変更する <i class="fas fa-chevron-right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-8 p-16">
				<p class="font-weight-bold text-primary mb-0 mt-8">◎お届け方法</p>
				<p>クロネコヤマト<br class="d-md-none">(配送料 495円)</p>
				<hr>
				<p class="font-weight-bold text-primary mb-0 mt-24">◎お届け先</p>
				<p class="mb-0">〒{{ $response->zipcode }}<br class="d-md-none"> {{ $response->pref }}{{ $response->address1 }}{{ $response->address2 }}{{ $response->address3 }}<br class="d-md-none"> {{ $response->address4 }}</p>
				<p><i class="fas fa-phone-alt"></i>&ensp;{{ $response->tel }}</p>
				<hr>
				<p class="font-weight-bold text-primary mb-0 mt-24">◎メールアドレス</p>
				<p>{{ $response->mailaddress1 }}</p>
				<hr>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-8 px-md-0">
				<p class="bg-primary px-16 py-8 text-white text-center mt-40 mb-0" style="border-radius: 10px 10px 0 0;">
					お支払い方法
				</p>
				<div class="p-16" style="border: 2px solid #f2b2ce; border-radius: 0 0 10px 10px;">
					<div>
						<input type="radio" name="payment" value="credit" class="mr-8 credit"><span class="fz-20">クレジット</span>
						<div class="creditinfo mb-24">
							<button type="button" class="btn btn-primary2 w-100 text-white p-16 ls-02" data-toggle="modal" data-target="#choice10Modal">
							<i class="fas fa-hand-point-right fz-24"></i> クレジット情報入力
							</button>
						</div>
						<!-- Modal01 -->
						<div class="modal fade pt-8" id="choice10Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-bs-backdrop="static">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header" style="background-color: #03a9f4;">
										<h5 class="modal-title" id="exampleModalLongTitle">●●●●●●●</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body py-200">
								    	
								    </div>
								</div>
							</div>
						</div>
					<div class="mt-8">
						<input type="radio" name="payment" value="convenience" class="mr-8"><span class="fz-20">コンビニ決済払い</span>
					</div>
				</div>
				<div class="send text-center my-40">
	                <input name="member_regmode" class="px-40 py-16 bg-mizuiro text-white" style="border: 0px;" type="hidden" value="newmemberform" />
	                <input name="regmember" class="px-40 py-16 bg-mizuiro text-white" style="border: 0px;" type="submit" value="確認する" />
	            </div>
			</div>
		</div>
	</div>
</div>@endsection
@push('scripts')
<script type="text/javascript">
	$("#check1").on("click", function(){
	  var val = $(this).val();
	  $("#result1").text(val);
	});

	$("#check2").on("click", function(){
	  var val = $(this).val();
	  $("#result2").text(val);
	});
</script>
@endpush
