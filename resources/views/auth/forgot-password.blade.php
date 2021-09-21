@extends('layout.base')

@section('content')

<div class="container-wrap bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-auto">
                <h2 class="text-center">パスワードリセット</h2>
                <form method="POST" action="{{ route('password.email') }}" class="mt-24">
                    @csrf
                    <p class="text-center mb-0">メールアドレスを入力してください</p>
                    <div class="form-group">
                        <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="メールアドレス" required autofocus />
                    </div>
                    <button type="submit" class="btn btn-block btn-lg btn-primary text-white">送信する</button>
                </form>
                <p class="text-center"><a href="/login.php">ログインはこちら</a></p>
            </div>
        </div>
    </div>
</div>

@endsection