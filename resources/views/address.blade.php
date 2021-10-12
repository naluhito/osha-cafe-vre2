@extends('layout.base')

@section('content')
<style type="text/css">
    .addresstable tbody tr th,
    .addresstable tbody tr td {
        background-color: white;
        color: #212529;
        padding: 5px 15px;
        line-height: .05rem;
    }

    .addresstable tbody tr {
        border-bottom: 2px dotted #aaa;
    }
    .addresstable tbody tr:last-child {
        border-bottom: 0px;
    }

    input[type=checkbox] {
        width:          24px;
        height:         24px;
        -moz-transform:     scale(1.4);
        -webkit-transform:  scale(1.4);
        transform:      scale(1.4);
    }
</style>
<div class="container-wrap">
	<div class="container">
		<h2 class="text-center fz-20 font-weight-bold">お届け先入力</h2>
	</div>
</div>
<div class="container-wrap bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <form class="my_form" name="address_form" id="address_form" action="confirm" method="post">
                    @csrf
                    <table class="table contacttable table-bordered tbl-2column fz-14 mt-32 mt-md-48">
                        <tbody>
                            <tr id="name_row" class="inp1">
                                <th scope="row">
                                    <em>＊</em>お名前
                                </th>
                                <td class="name_td">
                                    <div class="row no-gutters">
                                        <div class="col-6 pr-4">
                                            <span class="mr-8">姓</span><input name="name1" id="name1" type="text" maxlength='64' value="{{ $address->name1 }}" onKeyDown="if (event.keyCode == 13) {return false;}" style="ime-mode: active; width:84%;" />
                                            <span id="name1-error" class="d-block text-danger ml-24 lh-32"></span>
                                        </div>
                                        <div class="col-6 pl-4">
                                            <span class="mr-8">名</span><input name="name2" id="name2" type="text" maxlength='64' value="{{ $address->name2 }}" onKeyDown="if (event.keyCode == 13) {return false;}" style="ime-mode: active; width:84%;" />
                                            <span id="name2-error" class="d-block text-danger ml-24 lh-32"></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                <tr id="furikana_row" class="inp1">
                                    <th scope="row">フリガナ</th>
                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-6 pr-4">
                                                <span class="mr-8">姓</span><input name="name3" id="name3" type="text" maxlength='64' value="{{ $address->name3}}" onKeyDown="if (event.keyCode == 13) {return false;}" style="ime-mode: active; width:84%;" />
                                                <span id="name3-error" class="d-block text-danger ml-24 lh-32"></span>
                                            </div>
                                            <div class="col-6 pl-4">
                                                <span class="mr-8">名</span><input name="name4" id="name4" type="text" maxlength='64' value="{{ $address->name4 }}" onKeyDown="if (event.keyCode == 13) {return false;}" style="ime-mode: active; width:84%;" />
                                                <span id="name4-error" class="d-block text-danger ml-24 lh-32"></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <tr id="zipcode_row">
                                <th scope="row"><em>＊</em>郵便番号</th>
                                <td>
                                    <input name="zipcode" id="zipcode" type="text" maxlength='8' value="{{ $address->zipcode }}" onKeyDown="if (event.keyCode == 13) {return false;}" class="w-50" style="ime-mode: inactive" /><input type="button" id="search_zipcode" class="search-zipcode button bg-mizuiro2 text-white w-50" value="住所検索" onClick="AjaxZip3.zip2addr('zipcode', '', 'pref', 'address1');">
                                    <span class="d-block mt-16">(例）100-1000</span>
                                    <span id="zipcode-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
                            </tr>
                            <input type="hidden" name="country" id="member_country" value="JP">
                            <tr id="states_row">
                                <th scope="row"><em>＊</em>都道府県</th>
                                <td>
                                    <select name="pref" id="pref" class="pref w-50 p-16" style="border: 0px;">
                                        <option value="">--選択--</option>
                                        <option value="北海道" @if ($address->pref == '北海道') selected @endif >北海道</option>
                                        <option value="青森県" @if ($address->pref == '青森県') selected @endif>青森県</option>
                                        <option value="岩手県" @if ($address->pref == '岩手県') selected @endif>岩手県</option>
                                        <option value="宮城県" @if ($address->pref == '宮城県') selected @endif>宮城県</option>
                                        <option value="秋田県" @if ($address->pref == '秋田県') selected @endif>秋田県</option>
                                        <option value="山形県" @if ($address->pref == '山形県') selected @endif>山形県</option>
                                        <option value="福島県" @if ($address->pref == '福島県') selected @endif>福島県</option>
                                        <option value="茨城県" @if ($address->pref == '茨城県') selected @endif>茨城県</option>
                                        <option value="栃木県" @if ($address->pref == '栃木県') selected @endif>栃木県</option>
                                        <option value="群馬県" @if ($address->pref == '群馬県') selected @endif>群馬県</option>
                                        <option value="埼玉県" @if ($address->pref == '埼玉県') selected @endif>埼玉県</option>
                                        <option value="千葉県" @if ($address->pref == '千葉県') selected @endif>千葉県</option>
                                        <option value="東京都" @if ($address->pref == '東京都') selected @endif>東京都</option>
                                        <option value="神奈川県" @if ($address->pref == '神奈川県') selected @endif>神奈川県</option>
                                        <option value="新潟県" @if ($address->pref == '新潟県') selected @endif>新潟県</option>
                                        <option value="富山県" @if ($address->pref == '富山県') selected @endif>富山県</option>
                                        <option value="石川県" @if ($address->pref == '石川県') selected @endif>石川県</option>
                                        <option value="福井県" @if ($address->pref == '福井県') selected @endif>福井県</option>
                                        <option value="山梨県" @if ($address->pref == '山梨県') selected @endif>山梨県</option>
                                        <option value="長野県" @if ($address->pref == '長野県') selected @endif>長野県</option>
                                        <option value="岐阜県" @if ($address->pref == '岐阜県') selected @endif>岐阜県</option>
                                        <option value="静岡県" @if ($address->pref == '静岡県') selected @endif>静岡県</option>
                                        <option value="愛知県" @if ($address->pref == '愛知県') selected @endif>愛知県</option>
                                        <option value="三重県" @if ($address->pref == '三重県') selected @endif>三重県</option>
                                        <option value="滋賀県" @if ($address->pref == '滋賀県') selected @endif>滋賀県</option>
                                        <option value="京都府" @if ($address->pref == '京都府') selected @endif>京都府</option>
                                        <option value="大阪府" @if ($address->pref == '大阪府') selected @endif>大阪府</option>
                                        <option value="兵庫県" @if ($address->pref == '兵庫県') selected @endif>兵庫県</option>
                                        <option value="奈良県" @if ($address->pref == '奈良県') selected @endif>奈良県</option>
                                        <option value="和歌山県" @if ($address->pref == '和歌山県') selected @endif>和歌山県</option>
                                        <option value="鳥取県" @if ($address->pref == '鳥取県') selected @endif>鳥取県</option>
                                        <option value="島根県" @if ($address->pref == '島根県') selected @endif>島根県</option>
                                        <option value="岡山県" @if ($address->pref == '岡山県') selected @endif>岡山県</option>
                                        <option value="広島県" @if ($address->pref == '広島県') selected @endif>広島県</option>
                                        <option value="山口県" @if ($address->pref == '山口県') selected @endif>山口県</option>
                                        <option value="徳島県" @if ($address->pref == '徳島県') selected @endif>徳島県</option>
                                        <option value="香川県" @if ($address->pref == '香川県') selected @endif>香川県</option>
                                        <option value="愛媛県" @if ($address->pref == '愛媛県') selected @endif>愛媛県</option>
                                        <option value="高知県" @if ($address->pref == '高知県') selected @endif>高知県</option>
                                        <option value="福岡県" @if ($address->pref == '福岡県') selected @endif>福岡県</option>
                                        <option value="佐賀県" @if ($address->pref == '佐賀県') selected @endif>佐賀県</option>
                                        <option value="長崎県" @if ($address->pref == '長崎県') selected @endif>長崎県</option>
                                        <option value="熊本県" @if ($address->pref == '熊本県') selected @endif>熊本県</option>
                                        <option value="大分県" @if ($address->pref == '大分県') selected @endif>大分県</option>
                                        <option value="宮崎県" @if ($address->pref == '宮崎県') selected @endif>宮崎県</option>
                                        <option value="鹿児島県" @if ($address->pref == '鹿児島県') selected @endif>鹿児島県</option>
                                        <option value="沖縄県" @if ($address->pref == '沖縄県') selected @endif>沖縄県</option>
                                    </select>
                                    <span id="pref-error" class="d-block text-danger ml-24 lh-32"></span>
                               </td>
                            </tr>
                            <tr id="address1_row" class="inp2">
                                <th scope="row">
                                    <em>＊</em>市区郡町村
                                </th>
                                <td>
                                    <input name="address1" id="address1" type="text" maxlength='64' value="{{ $address->address1 }}" onKeyDown="if (event.keyCode == 13) {return false;}" style="ime-mode: active" class="w-100" />
                                    <span class="d-block mt-16">(例）横浜市上北町</span>
                                    <span id="address1-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
                            </tr>
                            <tr id="address2_row">
                                <th scope="row">
                                    <em>＊</em>番地
                                </th>
                                <td>
                                    <input name="address2" id="address2" type="text" maxlength='64' value="{{ $address->address2 }}" onKeyDown="if (event.keyCode == 13) {return false;}" style="ime-mode: active" class="w-100" />
                                    <span class="d-block mt-16">(例）3-24-555</span>
                                    <span id="address2-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
                            </tr>
                            <tr id="address3_row">
                                <th scope="row">ビル名</th>
                                <td>
                                    <input name="address3" id="address3" type="text" maxlength='64' value="{{ $address->address3 }}" onKeyDown="if (event.keyCode == 13) {return false;}" class="w-100" style="ime-mode: active" />
                                    <span class="d-block mt-16">(例）通販ビル4F</span>
                                </td>
                            </tr>
                            <tr id="tel_row">
                                <th scope="row"><em>＊</em>電話番号</th>
                                <td>
                                    <input name="tel" id="tel" type="text" maxlength='14' value="{{ $address->tel }}" onKeyDown="if (event.keyCode == 13) {return false;}"  class="w-100" style="ime-mode: inactive" />
                                    <span class="d-block mt-16">(例）1000-10-1000</span>
                                    <span id="tel-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><em>＊</em>メールアドレス</th>
                                <td colspan="2">
                                    <input name="mailaddress1" class="form-control w-100" maxlength='256' id="mailaddress1" type="email" value="{{ $address->mailaddress1 }}" autocomplete="off" />
                                    <span id="mailaddress1-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><em>＊</em>メールアドレス（確認用）</th>
                                <td colspan="2">
                                    <input name="mailaddress2" class="form-control w-100" maxlength='256' id="mailaddress2" type="email" value="{{ $address->mailaddress2 }}" autocomplete="off" />
                                    <span id="mailaddress2-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"></em>領収書</th>
                                <td colspan="2">
                                    <input name="receipt" class="form-control w-100" id="receipt" type="checkbox" value="必要" @if ($address->receipt == '必要') checked @endif/>必要
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="send text-center my-40">
                        <input id="submit" class="px-40 py-16 bg-mizuiro text-white" style="border: 0px;" type="submit" value="確認する" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- otheraddress -->
<div class="modal fade pt-8" id="otheraddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-inline" id="exampleModalLongTitle">届けたい住所を選んでください</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-16">
                <div class="row align-items-center">
                    <div class="col-2">
                        <input type="checkbox" class="d-block mx-auto" name=“sample” value="1">
                    </div>
                    <div class="col-10">
                        <table class="addresstable tbl-2column w-100">
                            <tbody>
                                <tr>
                                    <th>名前</th>
                                    <td>●●●●●●●●</td>
                                </tr>
                                <tr>
                                    <th>住所</th>
                                    <td>●●●●●●●●</td>
                                </tr>
                                <tr>
                                    <th>電話番号</th>
                                    <td>●●●●●●●●</td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row align-items-center pt-24" style="border-top: 1px solid #212529;">
                    <div class="col-2">
                        <input type="checkbox" class="d-block mx-auto" name=“sample” value="2">
                    </div>
                    <div class="col-10">
                        <table class="addresstable tbl-2column w-100">
                            <tbody>
                                <tr>
                                    <th>名前</th>
                                    <td>●●●●●●●●</td>
                                </tr>
                                <tr>
                                    <th>住所</th>
                                    <td>●●●●●●●●</td>
                                </tr>
                                <tr>
                                    <th>電話番号</th>
                                    <td>●●●●●●●●</td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row align-items-center pt-24" style="border-top: 1px solid #212529;">
                    <div class="col-2">
                        <input type="checkbox" class="d-block mx-auto" name=“sample” value="3">
                    </div>
                    <div class="col-10">
                        <table class="addresstable tbl-2column w-100">
                            <tbody>
                                <tr>
                                    <th>名前</th>
                                    <td>●●●●●●●●</td>
                                </tr>
                                <tr>
                                    <th>住所</th>
                                    <td>●●●●●●●●</td>
                                </tr>
                                <tr>
                                    <th>電話番号</th>
                                    <td>●●●●●●●●</td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('js/address.js') }}"></script>
@endpush
