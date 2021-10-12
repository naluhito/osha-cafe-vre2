@extends('layout.base')

@section('content')

<div class="bg-rainbow py-24 py-md-48">
    <h1 class="text-center font-weight-bold fz-24 fz-md-32">お問い合わせ</h1>
</div>
<div class="container-wrap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-auto">
                <p class="">以下のフォームより、必要事項を入力のうえ送信してください。お客様にも、お問い合わせ内容が自動返信されます。<br class="d-none d-md-block">自動返信がされてない場合はお客様のメールアドレスのお間違いの可能性、もしくは迷惑フォルダに入っている可能性もございます。<br class="d-none d-md-block">48時間以内に当サイトより改めてご返信差し上げます。<br class="d-none d-md-block">もしも返信がない場合には、お手数をおかけしますが099-201-5529までお電話ください。</p>
            </div>
        </div>
    </div>
</div>
<div class="container-wrap pt-md-0">
    <div class="container">
        <form method="post" id="contact_form" action="contact_confirm">
        @csrf
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <table class="table tbl-2column border border-primary fz-14">
                        <tbody>
                            <tr>
                                <th><label for="onamae">お名前<span class="badge">必須</span></label></th>
                                <td>
                                    <input type="text" id= "name1" name="name1" class="form-control" size="60" value="{{ $contact->name1 }}" placeholder="田中 太郎">
                                    <span id="name1-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="furigana">ふりがな<span class="badge">必須</span></label></th>
                                <td>
                                    <input type="text" id= "name2" name="name2" class="form-control" size="60" value="{{ $contact->name2 }}" placeholder="たなか たろう">
                                    <span id="name2-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="age">年齢</label></th>
                                <td>
                                <select name="age" class="form-control">
                                    <option value="" selected="selected">選択してください</option>
                                    <option value="15歳" @if ($contact->age == '15歳') selected @endif>15歳 </option>
                                    <option value="16歳" @if ($contact->age == '16歳') selected @endif >16歳</option>
                                    <option value="17歳" @if ($contact->age == '17歳') selected @endif >17歳</option>
                                    <option value="18歳" @if ($contact->age == '18歳') selected @endif >18歳</option>
                                    <option value="19歳" @if ($contact->age == '19歳') selected @endif >19歳</option>
                                    <option value="20歳" @if ($contact->age == '20歳') selected @endif >20歳</option>
                                    <option value="21歳" @if ($contact->age == '21歳') selected @endif >21歳</option>
                                    <option value="22歳" @if ($contact->age == '22歳') selected @endif >22歳</option>
                                    <option value="23歳" @if ($contact->age == '23歳') selected @endif >23歳</option>
                                    <option value="24歳" @if ($contact->age == '24歳') selected @endif >24歳</option>
                                    <option value="25歳" @if ($contact->age == '25歳') selected @endif >25歳</option>
                                    <option value="26歳" @if ($contact->age == '26歳') selected @endif >26歳</option>
                                    <option value="27歳" @if ($contact->age == '27歳') selected @endif >27歳</option>
                                    <option value="28歳" @if ($contact->age == '28歳') selected @endif >28歳</option>
                                    <option value="29歳" @if ($contact->age == '29歳') selected @endif >29歳</option>
                                    <option value="30歳" @if ($contact->age == '30歳') selected @endif >30歳</option>
                                    <option value="31歳" @if ($contact->age == '31歳') selected @endif >31歳</option>
                                    <option value="32歳" @if ($contact->age == '32歳') selected @endif >32歳</option>
                                    <option value="33歳" @if ($contact->age == '33歳') selected @endif >33歳</option>
                                    <option value="34歳" @if ($contact->age == '34歳') selected @endif >34歳</option>
                                    <option value="35歳" @if ($contact->age == '35歳') selected @endif >35歳</option>
                                    <option value="36歳" @if ($contact->age == '36歳') selected @endif >36歳</option>
                                    <option value="37歳" @if ($contact->age == '37歳') selected @endif >37歳</option>
                                    <option value="38歳" @if ($contact->age == '38歳') selected @endif >38歳</option>
                                    <option value="39歳" @if ($contact->age == '39歳') selected @endif >39歳</option>
                                    <option value="40歳" @if ($contact->age == '40歳') selected @endif >40歳</option>
                                    <option value="41歳" @if ($contact->age == '41歳') selected @endif >41歳</option>
                                    <option value="42歳" @if ($contact->age == '42歳') selected @endif >42歳</option>
                                    <option value="43歳" @if ($contact->age == '43歳') selected @endif >43歳</option>
                                    <option value="44歳" @if ($contact->age == '44歳') selected @endif >44歳</option>
                                    <option value="45歳" @if ($contact->age == '45歳') selected @endif >45歳</option>
                                    <option value="46歳" @if ($contact->age == '46歳') selected @endif >46歳</option>
                                    <option value="47歳" @if ($contact->age == '47歳') selected @endif >47歳</option>
                                    <option value="48歳" @if ($contact->age == '48歳') selected @endif >48歳</option>
                                    <option value="49歳" @if ($contact->age == '49歳') selected @endif >49歳</option>
                                    <option value="50歳" @if ($contact->age == '50歳') selected @endif >50歳</option>
                                    <option value="51歳" @if ($contact->age == '51歳') selected @endif >51歳</option>
                                    <option value="52歳" @if ($contact->age == '52歳') selected @endif >52歳</option>
                                    <option value="53歳" @if ($contact->age == '53歳') selected @endif >53歳</option>
                                    <option value="54歳" @if ($contact->age == '54歳') selected @endif >54歳</option>
                                    <option value="55歳" @if ($contact->age == '55歳') selected @endif >55歳</option>
                                    <option value="56歳" @if ($contact->age == '56歳') selected @endif >56歳</option>
                                    <option value="57歳" @if ($contact->age == '57歳') selected @endif >57歳</option>
                                    <option value="58歳" @if ($contact->age == '58歳') selected @endif >58歳</option>
                                    <option value="59歳" @if ($contact->age == '59歳') selected @endif >59歳</option>
                                    <option value="60歳" @if ($contact->age == '60歳') selected @endif >60歳</option>
                                    <option value="61歳" @if ($contact->age == '61歳') selected @endif >61歳</option>
                                    <option value="62歳" @if ($contact->age == '62歳') selected @endif >62歳</option>
                                    <option value="63歳" @if ($contact->age == '63歳') selected @endif >63歳</option>
                                    <option value="64歳" @if ($contact->age == '64歳') selected @endif >64歳</option>
                                    <option value="65歳" @if ($contact->age == '65歳') selected @endif >65歳</option>
                                    <option value="66歳" @if ($contact->age == '66歳') selected @endif >66歳</option>
                                    <option value="67歳" @if ($contact->age == '67歳') selected @endif >67歳</option>
                                    <option value="68歳" @if ($contact->age == '68歳') selected @endif >68歳</option>
                                    <option value="69歳" @if ($contact->age == '69歳') selected @endif >69歳</option>
                                    <option value="70歳" @if ($contact->age == '70歳') selected @endif >70歳</option>
                                    <option value="71歳" @if ($contact->age == '71歳') selected @endif >71歳</option>
                                    <option value="72歳" @if ($contact->age == '72歳') selected @endif >72歳</option>
                                    <option value="73歳" @if ($contact->age == '73歳') selected @endif >73歳</option>
                                    <option value="74歳" @if ($contact->age == '74歳') selected @endif >74歳</option>
                                    <option value="75歳" @if ($contact->age == '75歳') selected @endif >75歳</option>
                                    <option value="76歳" @if ($contact->age == '76歳') selected @endif >76歳</option>
                                    <option value="77歳" @if ($contact->age == '77歳') selected @endif >77歳</option>
                                    <option value="78歳" @if ($contact->age == '78歳') selected @endif >78歳</option>
                                    <option value="79歳" @if ($contact->age == '79歳') selected @endif >79歳</option>
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="email">メールアドレス<span class="badge">必須</span></label></th>
                                <td>
                                    <input type="email" id= "mail" name="email" size="60" value="{{ $contact->mail }}" class="form-control" placeholder="info@example.com">
                                    <span id="mail-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="email2">メールアドレス（確認用）<span class="badge">必須</span></label></th>
                                <td>
                                    <input type="email" id= "mail2" name="email2" class="form-control" size="60" value="{{ $contact->mail2 }}" placeholder="info@example.com">
                                    <span id="mail2-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="tel">お電話番号<span class="badge">必須</span></label></th>
                                <td>
                                    <div class="tel-field d-flex align-items-center">
                                        <input type="text" id= "tel" name="tel" class="form-control haba" size="6" value="{{ $contact->tel }}" maxlength="14">
                                        <span id="tel-error" class="d-block text-danger ml-24 lh-32"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="w-md-40 last"><label for="otoiawase">お問い合わせ内容<span class="badge">必須</span></label></th>
                                <td class="last">
                                    <textarea id= "otoiawase" name="otoiawase" class="form-control" cols="50" row="10" placeholder="ご質問・ご意見等がございましたらご記入ください。">{{ $contact->otoiawase }}</textarea>
                                    <span id="otoiawase-error" class="d-block text-danger ml-24 lh-32"></span>
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
