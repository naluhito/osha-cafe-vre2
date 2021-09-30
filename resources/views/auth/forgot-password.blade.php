@extends('layout.base')

@section('content')

<div class="container-wrap">
		<div class="container">
			<h2 class="text-center fz-20 font-weight-bold">パスワードのリセット</h2>
		</div>
	</div>
	<div class="container-wrap pt-64 pb-80">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10">
					<p>パスワードをお忘れの方は、ご登録のメールアドレスを下記へ入力いただき送信してください。<br>送られてくるメールのリンク先からパスワードを再設定してください。</p>
						<form action="delete_account" method="post">
                        @csrf
                    	<label for="password">メールアドレス</label><br>
                        <x-input id="email" class="w-75 w-md-50" type="email" name="email" :value="old('email')" required autofocus />
                        <input id="submit" class="px-48 py-8 bg-mizuiro text-white d-inline-block d-sm-inline mt-16 mt-sm-0" type="submit" value="送信" style="border: 0;">
                        </form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection