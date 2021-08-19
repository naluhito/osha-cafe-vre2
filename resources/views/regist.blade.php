@extends('layout.base')

@section('content')

<div class="container-wrap bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-auto">
                <h2 class="text-center">新規会員登録</h2>
                <form class="mt-24" name="mail_form" id="mail_form" action="registmail" method="post">
                    @csrf
                    <p class="text-center mb-0">メールアドレスを入力してください</p>
                    <div class="form-group">
                        <input type="email" class="form-control" id="" name="" value="" placeholder="メールアドレス">
                    </div>
                    <div class="form-group form-check d-flex align-items-center">
                        <input type="checkbox" class="form-check-input" id="" name="" value="">
                        <label class="form-check-label fz-14" for="">利用規約・プライバシーポリシーに同意する</label>
                    </div>
                    <button type="submit" class="btn btn-block btn-lg btn-primary text-white">送信する</button>
                </form>
                <p class="text-center"><a href="login">ログインはこちら</a></p>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

@endpush
