@extends('layout.base')

@section('content')

<div class="container-wrap bg-usumizuiro">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-auto">
                <i class="fas fa-user-circle d-block text-center fz-50"></i>
                <h3 class="text-center mt-8 font-weight-bold">ログイン</h3>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <!-- Email Address -->
                    <div class="form-group">
                        <x-input id="email" class="form-control"
                                        type="email"
                                        name="email" :value="old('email')" required autofocus
                                        placeholder="メールアドレス"/>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <x-input id="password" class="form-control"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" 
                                        placeholder="パスワード"/>
                    </div>



                    <input type= "submit" id="submit" class="btn btn-block btn-lg btn-primary text-white font-weight-bold mt-24" value="ログイン" />
                </form>
                @if (Route::has('password.request'))
                <p class="text-center mt-4"><a class="text-pink font-weight-bold" href="{{ route('password.request') }}">
                        {{ __('パスワードをお忘れですか？') }}
                    </a></p>
                @endif
                <hr>
                <p class="text-center mb-0">アカウントをお持ちでない場合はこちらから</p>
                @if (Route::has('register'))
                <p class="text-center"><a href="{{ route('register') }}" class="text-pink font-weight-bold">アカウント作成</a></p>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection