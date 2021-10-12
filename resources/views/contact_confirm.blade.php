@extends('layout.base')

@section('content')

<div class="bg-rainbow py-24 py-md-48">
    <h1 class="text-center font-weight-bold fz-24 fz-md-32">お問い合わせ</h1>
</div>
<div class="container-wrap pt-md-0">
    <div class="container">
        <form method="post" id="contact_form" action="contact">
        @csrf
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <table class="table tbl-2column border border-primary fz-14">
                        <tbody>
                            <tr>
                                <th><label for="onamae">お名前<span class="badge">必須</span></label></th>
                                <td>
                                    <span id="name1-error" class="d-block ml-24 lh-32">{{ $contact->name1 }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="furigana">ふりがな<span class="badge">必須</span></label></th>
                                <td>
                                    <span id="name2-error" class="d-block ml-24 lh-32">{{ $contact->name2 }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="age">年齢</label></th>
                                <td>
                                    <span id="name2-error" class="d-block ml-24 lh-32">{{ $contact->age }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="email">メールアドレス<span class="badge">必須</span></label></th>
                                <td>
                                    <span id="mail-error" class="d-block ml-24 lh-32">{{ $contact->mail }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="tel">お電話番号<span class="badge">必須</span></label></th>
                                <td>
                                    <div class="tel-field d-flex align-items-center">
                                        <span id="tel-error" class="d-block ml-24 lh-32">{{ $contact->tel }}</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-md-40 last"><label for="otoiawase">お問い合わせ内容<span class="badge">必須</span></label></th>
                                <td class="last">
                                    <textarea id= "otoiawase" name="otoiawase" class="form-control" cols="50" row="10">{{ $contact->otoiawase }}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center mt-32">
                        <input type="submit" id="submit" name="submitConfirm" value="確認画面へ" class="btn btn-primary btn-lg text-white fz-18 font-weight-bold">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@push('scripts')
    <script src="{{ asset('js/contact.js') }}"></script>
@endpush
