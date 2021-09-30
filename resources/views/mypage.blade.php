@extends('layout.base')

@section('content')

<div class="container-wrap">
	<div class="container">
		<h2 class="text-center fz-20 font-weight-bold">マイページ</h2>
	</div>
</div>
<div class="container-wrap pt-0">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="bg-primary rounded-10 p-16">
					<h3 class="font-weight-bold fz-16"><i class="fas fa-square mr-4"></i>登録者情報</h3>
				</div>
				<div class="p-16">
					<h4 class="fz-12 font-weight-bold pb-4 border-bottom bg-light p-8">お名前</h4>
					<p class="fz-14"><span>{{ $auth->name1 }}</span><span class="pl-8">{{ $auth->name2 }}</span></p>
					<h4 class="fz-12 font-weight-bold pb-4 border-bottom bg-light p-8">ふりがな</h4>
					<p class="fz-14"><span>{{ $auth->name3 }}</span><span class="pl-8">{{ $auth->name4 }}</span></p>
					<h4 class="fz-12 font-weight-bold pb-4 border-bottom bg-light p-8">郵便番号</h4>
					<p class="fz-14">{{ $auth->zip }}</p>
					<h4 class="fz-12 font-weight-bold pb-4 border-bottom bg-light p-8">住所</h4>
					<p class="fz-14">{{ $auth->pref }}{{ $auth->address1 }}{{ $auth->address2 }}<br class="d-md-none">{{ $auth->address3 }}</p>
					<h4 class="fz-12 font-weight-bold pb-4 border-bottom bg-light p-8">電話番号</h4>
					<p class="fz-14">{{ $auth->tel }}</p>
					<h4 class="fz-12 font-weight-bold pb-4 border-bottom bg-light p-8">メールアドレス</h4>
					<p class="fz-14">{{ $auth->email }}</p>
					<h4 class="fz-12 font-weight-bold pb-4 border-bottom bg-light p-8">パスワード</h4>
					<p class="fz-14">・・・・・・・・</p>
				</div>
				<div class="text-right">
					<a href="#" class="btn px-40 py-16 bg-mizuiro text-white">変更する</a>
				</div>
			</div>
			<div class="col-md-10 mt-40">
				<div class="bg-primary rounded-10 p-16">
					<h3 class="font-weight-bold fz-16"><i class="fas fa-square mr-4"></i>注文履歴</h3>
				</div>
                @foreach($order_list as $order)
                <div class="border-bottom px-8 py-16">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-4">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm">
                                    <p class="fz-14 mb-0">{{ $order['date']->format('Y/m/d') }}</p>
                                    <p class="fz-14">受注番号：{{ $order['order_no'] }}</p>
                                </div>
                            </div>
                        </div>
                        @foreach($order['items'] as $item)
                        <div class="col-12 col-md-3">
                            <div class="p-16">
                                <div class="row align-items-center">
                                    <div class="col-4 col-sm">
                                        <img id="frame" src="print_images/{{ $item->image }}" style="width:100%;">
                                    </div>
                                    <div class="col-8 col-sm">
                                        <p class="fz-14 mb-0"><!--再注文ボタンとか--></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>


			<div class="col-md-10 mt-40">
				<div class="bg-primary rounded-10 p-16">
					<h3 class="font-weight-bold fz-16"><i class="fas fa-square mr-4"></i>退会申請</h3>
				</div>
				<div class="p-16">
					<p class="fz-14 mt-24">
						※退会するとプロフィールや画像、購入履歴は削除されます。元には戻せませんのでご注意ください。<br>
                        ※当店にて確認後、退会処理を行います。退会処理完了までしばらくお待ち下さい。<br>
                        ※ご本人確認のためパスワードを入力してください。
					</p>

                    <form action="delete_account" method="post">
                    @csrf
                        <label for="password">パスワード</label><br>
                        <input id="password" class="w-50" type="password" name="password"><br class="d-sm-none">
                        <input id="submit" class="px-48 py-8 bg-mizuiro text-white d-inline-block d-sm-inline mt-16 mt-sm-0" type="submit" value="送信" style="border: 0;">
                        <span id="password-error" class="d-block text-danger ml-24 lh-32">{{ $message }}</span>

                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
@endpush
