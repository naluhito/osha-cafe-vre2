@extends('layout.base')

@section('content')

<div class="bg-rainbow py-24 py-md-48">
    <h1 class="text-center font-weight-bold fz-24 fz-md-32">お問い合わせ</h1>
</div>
<div class="container-wrap">
<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-auto">
                <p class="text-center font-weight-bold">ご確認後、送信ボタンをおしてください。</p>
            </div>
        </div>
    </div>
</div>
<div class="container-wrap pt-md-0">
    <div class="container">
        <input type="hidden" name="_token" value="N5PI9yzgzBTe3XzY3WDUlxkWWG4BCvzRxzSSphx0">
        	<div class="row justify-content-center">
                <div class="col-lg-10">
                    <table class="table tbl-2column border border-primary fz-14">
                        <tbody>
                            <tr>
                                <th><label for="onamae">お名前<span class="badge">必須</span></label></th>
                                <td>
                                    <span class="d-block ml-24 lh-32">{{ $contact->name1 }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="furigana">ふりがな<span class="badge">必須</span></label></th>
                                <td>
                                    <span class="d-block ml-24 lh-32">{{ $contact->name2 }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="age">年齢</label></th>
                                <td>
                                    <span class="d-block ml-24 lh-32">{{ $contact->age }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="email">メールアドレス<span class="badge">必須</span></label></th>
                                <td>
                                    <span class="d-block ml-24 lh-32">{{ $contact->mail }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="tel">電話番号<span class="badge">必須</span></label></th>
                                <td>
                                    <div class="tel-field d-flex align-items-center">
                                        <span class="d-block ml-24 lh-32">{{ $contact->tel }}</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-md-40 last"><label for="otoiawase">お問い合わせ内容<span class="badge">必須</span></label></th>
                                <td class="last">
                                    <textarea id="otoiawase" name="otoiawase" class="form-control" cols="50" row="10" readonly>{{ $contact->otoiawase }}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center my-48">
                    	<input type="buttn" id="back" name="submitBack" value="戻る" class="btn btn-secondary btn-lg text-white fz-18 font-weight-bold px-32" style="border-radius:15px;">
                        <input type="buttn" id="send" name="submitConfirm" value="送信" class="btn btn-primary btn-lg text-white fz-18 font-weight-bold px-32">
                    </div>
                </div>
            </div>
    </div>
</div>

@endsection
@push('scripts')
    <script src="{{ asset('js/contact.js') }}"></script>
@endpush
