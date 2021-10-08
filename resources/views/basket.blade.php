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
	}

	.kounyuhin.tbl-2column tbody tr .bg-768-gray {
		background-color: #ddd;
	}

</style>
<div class="container-wrap">
	<div class="container">
		<h2 class="text-center fz-20 font-weight-bold">買い物かご</h2>
	</div>
</div>
<div class="container-wrap">
    <div class="container pb-40">
        <div id="item" style="display: none">
            <div class="row gtr-48 justify-content-center border-top border-dark py-40">
                <div class="col-md-auto">
                    <img id = "frame" src="" style="width:100%; width:180px;">
                </div>
                <div class="col-md-7 mt-24 mt-md-0">
                    <div id="drip" style="display: none">
                        <p class="bg-dark text-white fz-14 mt-24 px-32 py-8 d-inline-block text-center" class="" style="border-radius: 5px;">ドリップバッグ</p>
                        <table class="kounyuhin table table-bordered tbl-2column mt-0">
                            <tbody>
                            <tr id="item-tbl" style="display: none">
                                <th id="name" class="w-md-25 bg-768-gray"></th>
                                <th id="num" class="w-md-25 text-right"></th>
                                <td id="amount" class="text-right"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="coffee" style="display: none">
                        <p class="bg-dark text-white fz-14 mt-24 px-32 py-8 d-inline-block text-center" class="" style="border-radius: 5px;">コーヒーバッグ</p>
                        <table class="kounyuhin table table-bordered tbl-2column mt-0">
                            <tbody>
                            <tr id="item-tbl" style="display: none">
                                <th id="name" class="w-md-25 bg-768-gray"></th>
                                <th id="num" class="w-md-25 text-right"></th>
                                <td id="amount" class="text-right"></td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                <div class="col-md-auto">
                    <p class="delete fz-24"><i class="bi bi-trash"></i></p>
                </div>
            </div>
        </div>
        <p class="fz-15 mt-16 pt-16 text-dark text-right" style="border-top: 2px solid #8e724e;">送料:<spam id="shipping"></spam></p>
        <p class="fz-24 text-right mb-0">
            <span class="fz-16 pr-8">合計金額：</span><spam id="total-amount"></spam><span class="fz-14">円</span>
        </p>
        <p class="fz-12 text-right">（内消費税<spam id="tax"></spam>円）</p>
        <p class="fz-24 text-right mb-0" >
            <span class="fz-16 pr-8">お支払合計金額：</span><spam id="pay-amount"></spam><span class="fz-14">円</span>
        </p>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6 col-xl-5">
                <a href="choice" class="button05 text-center d-block p-16 mt-56 w-75 mx-auto">買い物を続ける</a>
                <button id="address" type="button" class="button06 text-center d-block p-16 mt-16 w-75 mx-auto" data-dismiss="" disabled="disabled" style="border: 0;"><i class="fas fa-truck fz-20 pr-8" aria-hidden="true"></i>お届け先</button>
            </div>
        </div>
    </div>
</div>




@endsection
@push('scripts')
    <script src="{{ asset('js/basket.js') }}"></script>
@endpush
