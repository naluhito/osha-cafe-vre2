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
<div class="container-wrap bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @auth
                <div class="text-right">
                    <button type="button" class="btn btn-primary text-white px-40 py-8 d-inline-block ml-right text-white" data-toggle="modal" data-target="#otheraddress">
                        ▶︎ 自宅以外へ届ける
                    </button>
                </div>
                @endauth
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
                                            <span class="mr-8">姓</span><input name="name1" id="name1" type="text" value="" onKeyDown="if (event.keyCode == 13) {return false;}" style="ime-mode: active; width:84%;" />
                                            <span id="name1-error" class="d-block text-danger ml-24 lh-32"></span>
                                        </div>
                                        <div class="col-6 pl-4">
                                            <span class="mr-8">名</span><input name="name2" id="name2" type="text" value="" onKeyDown="if (event.keyCode == 13) {return false;}" style="ime-mode: active; width:84%;" />
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
                                                <span class="mr-8">姓</span><input name="name3" id="name3" type="text" value="" onKeyDown="if (event.keyCode == 13) {return false;}" style="ime-mode: active; width:84%;" />
                                                <span id="name3-error" class="d-block text-danger ml-24 lh-32"></span>
                                            </div>
                                            <div class="col-6 pl-4">
                                                <span class="mr-8">名</span><input name="name4" id="name4" type="text" value="" onKeyDown="if (event.keyCode == 13) {return false;}" style="ime-mode: active; width:84%;" />
                                                <span id="name4-error" class="d-block text-danger ml-24 lh-32"></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <tr id="zipcode_row">
                                <th scope="row"><em>＊</em>郵便番号</th>
                                <td>
                                    <input name="zipcode" id="zipcode" type="text" value="" onKeyDown="if (event.keyCode == 13) {return false;}" class="w-50" style="ime-mode: inactive" /><input type="button" id="search_zipcode" class="search-zipcode button bg-mizuiro2 text-white w-50" value="住所検索" onClick="AjaxZip3.zip2addr('zipcode', '', 'pref', 'address1');">
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
                                        <option value="北海道">北海道</option>
                                        <option value="青森県">青森県</option>
                                        <option value="岩手県">岩手県</option>
                                        <option value="宮城県">宮城県</option>
                                        <option value="秋田県">秋田県</option>
                                        <option value="山形県">山形県</option>
                                        <option value="福島県">福島県</option>
                                        <option value="茨城県">茨城県</option>
                                        <option value="栃木県">栃木県</option>
                                        <option value="群馬県">群馬県</option>
                                        <option value="埼玉県">埼玉県</option>
                                        <option value="千葉県">千葉県</option>
                                        <option value="東京都">東京都</option>
                                        <option value="神奈川県">神奈川県</option>
                                        <option value="新潟県">新潟県</option>
                                        <option value="富山県">富山県</option>
                                        <option value="石川県">石川県</option>
                                        <option value="福井県">福井県</option>
                                        <option value="山梨県">山梨県</option>
                                        <option value="長野県">長野県</option>
                                        <option value="岐阜県">岐阜県</option>
                                        <option value="静岡県">静岡県</option>
                                        <option value="愛知県">愛知県</option>
                                        <option value="三重県">三重県</option>
                                        <option value="滋賀県">滋賀県</option>
                                        <option value="京都府">京都府</option>
                                        <option value="大阪府">大阪府</option>
                                        <option value="兵庫県">兵庫県</option>
                                        <option value="奈良県">奈良県</option>
                                        <option value="和歌山県">和歌山県</option>
                                        <option value="鳥取県">鳥取県</option>
                                        <option value="島根県">島根県</option>
                                        <option value="岡山県">岡山県</option>
                                        <option value="広島県">広島県</option>
                                        <option value="山口県">山口県</option>
                                        <option value="徳島県">徳島県</option>
                                        <option value="香川県">香川県</option>
                                        <option value="愛媛県">愛媛県</option>
                                        <option value="高知県">高知県</option>
                                        <option value="福岡県">福岡県</option>
                                        <option value="佐賀県">佐賀県</option>
                                        <option value="長崎県">長崎県</option>
                                        <option value="熊本県">熊本県</option>
                                        <option value="大分県">大分県</option>
                                        <option value="宮崎県">宮崎県</option>
                                        <option value="鹿児島県">鹿児島県</option>
                                        <option value="沖縄県">沖縄県</option>
                                    </select>
                                    <span id="pref-error" class="d-block text-danger ml-24 lh-32"></span>
                               </td>
                            </tr>
                            <tr id="address1_row" class="inp2">
                                <th scope="row">
                                    <em>＊</em>市区郡町村
                                </th>
                                <td>
                                    <input name="address1" id="address1" type="text" value="" onKeyDown="if (event.keyCode == 13) {return false;}" style="ime-mode: active" class="w-100" />
                                    <span class="d-block mt-16">(例）横浜市上北町</span>
                                    <span id="address1-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
                            </tr>
                            <tr id="address2_row">
                                <th scope="row">
                                    <em>＊</em>番地
                                </th>
                                <td>
                                    <input name="address2" id="address2" type="text" value="" onKeyDown="if (event.keyCode == 13) {return false;}" style="ime-mode: active" class="w-100" />
                                    <span class="d-block mt-16">(例）3-24-555</span>
                                    <span id="address2-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
                            </tr>
                            <tr id="address3_row">
                                <th scope="row">ビル名</th>
                                <td>
                                    <input name="address3" id="address3" type="text" value="" onKeyDown="if (event.keyCode == 13) {return false;}" class="w-100" style="ime-mode: active" />
                                    <span class="d-block mt-16">(例）通販ビル4F</span>
                                </td>
                            </tr>
                            <tr id="tel_row">
                                <th scope="row"><em>＊</em>電話番号</th>
                                <td>
                                    <input name="tel" id="tel" type="text" value="" onKeyDown="if (event.keyCode == 13) {return false;}"  class="w-100" style="ime-mode: inactive" />
                                    <span class="d-block mt-16">(例）1000-10-1000</span>
                                    <span id="tel-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><em>＊</em>メールアドレス</th>
                                <td colspan="2">
                                    <input name="mailaddress1" class="form-control w-100" id="mailaddress1" type="text" value="" autocomplete="off" />
                                    <span id="mailaddress1-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><em>＊</em>メールアドレス（確認用）</th>
                                <td colspan="2">
                                    <input name="mailaddress2" class="form-control w-100" id="mailaddress2" type="text" value="" autocomplete="off" />
                                    <span id="mailaddress2-error" class="d-block text-danger ml-24 lh-32"></span>
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
