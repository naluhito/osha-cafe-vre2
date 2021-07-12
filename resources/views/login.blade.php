@extends('layout.base')

@section('content')

<div class="container-wrap bg-usumizuiro">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-auto">
                <i class="fas fa-user-circle d-block text-center fz-50"></i>
                <h3 class="text-center mt-8 font-weight-bold">ログイン</h3>
                <form class="mt-24">
                    <div class="form-group">
                        <input type="email" class="form-control" id="" name="" value="" placeholder="メールアドレス">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="" name="" value="" placeholder="パスワード">
                    </div>
                    <a href="https://oshi-cafe.com/choice01.php" class="btn btn-block btn-lg btn-primary text-white font-weight-bold mt-24">ログイン</a>
                </form>
                <p class="text-center mt-4"><a href="/login.php" class="text-pink font-weight-bold">パスワードをお忘れですか？</a></p>
                <hr>
                <p class="text-center mb-0">アカウントをお持ちでない場合はこちらから</p>
                <p class="text-center"><a href="/create_account.php" class="text-pink font-weight-bold">アカウント作成</a></p>
            </div>
        </div>
    </div>
</div>

@endsection