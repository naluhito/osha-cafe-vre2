@extends('layout.base')

@section('content')

<div class="container-wrap bg-usumizuiro">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-auto">
                <i class="fas fa-user-circle d-block text-center fz-50"></i>
                <h3 class="text-center mt-8 font-weight-bold">ログイン</h3>
                <form class="mt-24" name="login_form" id="login_form" action="login" method="post">
                    @csrf
                    <span id="login-error" class="d-block text-danger ml-24 lh-32">{{ $message }}</span>
                    <div class="form-group">
                        <input type="email" class="form-control" id="" name="" value="" placeholder="メールアドレス">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="" name="" value="" placeholder="パスワード">
                    </div>
                    <input type= "submit" id="submit" class="btn btn-block btn-lg btn-primary text-white font-weight-bold mt-24" value="ログイン" />
                </form>
                <p class="text-center mt-4"><a href="#" class="text-pink font-weight-bold">パスワードをお忘れですか？</a></p>
                <hr>
                <p class="text-center mb-0">アカウントをお持ちでない場合はこちらから</p>
                <p class="text-center"><a href="/regist" class="text-pink font-weight-bold">アカウント作成</a></p>
            </div>
        </div>
    </div>
</div>

@endsection