@extends('layout.base')

@section('content')

<div class="container-wrap bg-light">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-auto">
				<h2 class="text-center fz-28">編集フォーム</h2>
				<p class="fz-14">
					*印の付いている項目は必須となっております。漏れなくご記入ください。<br>英数字は半角での記入をお願いいたします。
				</p>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
				<form class="my_form" name="edit_form" id="register_form" action="{{ route('register') }}" method="post">
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
                                            <span class="mr-8">姓</span><x-input id="name1" type="text" name="name1" style="ime-mode: active; width:84%;" :value="{{ $user->name1 }}" required autofocus />
                                            <span id="name1-error" class="d-block text-danger ml-24 lh-32"></span>
                                        </div>
                                        <div class="col-6 pl-4">
                                            <span class="mr-8">名</span><x-input id="name2" type="text" name="name2" style="ime-mode: active; width:84%;" :value="{{ $user->name2 }}" required />
                                            <span id="name2-error" class="d-block text-danger ml-24 lh-32"></span>
                                        </div>
                                    </div>
                                </td>
							</tr>
								<tr id="furikana_row" class="inp1">
									<th scope="row">
                                        <em>＊</em>フリガナ
                                    </th>
									<td>
                                    <div class="row no-gutters">
                                            <div class="col-6 pr-4">
                                                <span class="mr-8">姓</span><x-input id="name3" type="text" name="name3" style="ime-mode: active; width:84%;" :value="{{ $user->name3 }}" required />
                                                <span id="name3-error" class="d-block text-danger ml-24 lh-32"></span>
                                            </div>
                                            <div class="col-6 pl-4">
                                                <span class="mr-8">名</span><x-input id="name4" type="text" name="name4" style="ime-mode: active; width:84%;" :value="{{ $user->name4 }}" required />
                                                <span id="name4-error" class="d-block text-danger ml-24 lh-32"></span>
                                            </div>
                                        </div>
									</td>
								</tr>
							<tr id="zipcode_row">
								<th scope="row"><em>＊</em>郵便番号</th>
					 			<td>
					 				<input name="zipcode" id="zipcode" type="text" value="" onKeyDown="if (event.keyCode == 13) {return false;}" class="w-50" style="ime-mode: inactive" /><input type="button" id="search_zipcode" class="search-zipcode button bg-mizuiro2 text-white w-50" value="住所検索" onClick="AjaxZip3.zip2addr('zipcode', '', 'pref', 'address1');"><span class="d-block mt-16">(例）100-1000</span>
                                     <span id="zipcode-error" class="d-block text-danger ml-24 lh-32"></span>
					 			</td>
							</tr>
							<tr id="states_row">
								<th scope="row"><em>＊</em>都道府県</th>
								<td>
									<select name="pref" id="pref" class="pref w-50 p-16" style="border: 0px;">
                                        <option value="">--選択--</option>
                                        <option value="北海道" @if (old('pref') == '北海道') selected @endif >北海道</option>
                                        <option value="青森県" @if (old('pref') == '青森県') selected @endif>青森県</option>
                                        <option value="岩手県" @if (old('pref') == '岩手県') selected @endif>岩手県</option>
                                        <option value="宮城県" @if (old('pref') == '宮城県') selected @endif>宮城県</option>
                                        <option value="秋田県" @if (old('pref') == '秋田県') selected @endif>秋田県</option>
                                        <option value="山形県" @if (old('pref') == '山形県') selected @endif>山形県</option>
                                        <option value="福島県" @if (old('pref') == '福島県') selected @endif>福島県</option>
                                        <option value="茨城県" @if (old('pref') == '茨城県') selected @endif>茨城県</option>
                                        <option value="栃木県" @if (old('pref') == '栃木県') selected @endif>栃木県</option>
                                        <option value="群馬県" @if (old('pref') == '群馬県') selected @endif>群馬県</option>
                                        <option value="埼玉県" @if (old('pref') == '埼玉県') selected @endif>埼玉県</option>
                                        <option value="千葉県" @if (old('pref') == '千葉県') selected @endif>千葉県</option>
                                        <option value="東京都" @if (old('pref') == '東京都') selected @endif>東京都</option>
                                        <option value="神奈川県" @if (old('pref') == '神奈川県') selected @endif>神奈川県</option>
                                        <option value="新潟県" @if (old('pref') == '新潟県') selected @endif>新潟県</option>
                                        <option value="富山県" @if (old('pref') == '富山県') selected @endif>富山県</option>
                                        <option value="石川県" @if (old('pref') == '石川県') selected @endif>石川県</option>
                                        <option value="福井県" @if (old('pref') == '福井県') selected @endif>福井県</option>
                                        <option value="山梨県" @if (old('pref') == '山梨県') selected @endif>山梨県</option>
                                        <option value="長野県" @if (old('pref') == '長野県') selected @endif>長野県</option>
                                        <option value="岐阜県" @if (old('pref') == '岐阜県') selected @endif>岐阜県</option>
                                        <option value="静岡県" @if (old('pref') == '静岡県') selected @endif>静岡県</option>
                                        <option value="愛知県" @if (old('pref') == '愛知県') selected @endif>愛知県</option>
                                        <option value="三重県" @if (old('pref') == '三重県') selected @endif>三重県</option>
                                        <option value="滋賀県" @if (old('pref') == '滋賀県') selected @endif>滋賀県</option>
                                        <option value="京都府" @if (old('pref') == '京都府') selected @endif>京都府</option>
                                        <option value="大阪府" @if (old('pref') == '大阪府') selected @endif>大阪府</option>
                                        <option value="兵庫県" @if (old('pref') == '兵庫県') selected @endif>兵庫県</option>
                                        <option value="奈良県" @if (old('pref') == '奈良県') selected @endif>奈良県</option>
                                        <option value="和歌山県" @if (old('pref') == '和歌山県') selected @endif>和歌山県</option>
                                        <option value="鳥取県" @if (old('pref') == '鳥取県') selected @endif>鳥取県</option>
                                        <option value="島根県" @if (old('pref') == '島根県') selected @endif>島根県</option>
                                        <option value="岡山県" @if (old('pref') == '岡山県') selected @endif>岡山県</option>
                                        <option value="広島県" @if (old('pref') == '広島県') selected @endif>広島県</option>
                                        <option value="山口県" @if (old('pref') == '山口県') selected @endif>山口県</option>
                                        <option value="徳島県" @if (old('pref') == '徳島県') selected @endif>徳島県</option>
                                        <option value="香川県" @if (old('pref') == '香川県') selected @endif>香川県</option>
                                        <option value="愛媛県" @if (old('pref') == '愛媛県') selected @endif>愛媛県</option>
                                        <option value="高知県" @if (old('pref') == '高知県') selected @endif>高知県</option>
                                        <option value="福岡県" @if (old('pref') == '福岡県') selected @endif>福岡県</option>
                                        <option value="佐賀県" @if (old('pref') == '佐賀県') selected @endif>佐賀県</option>
                                        <option value="長崎県" @if (old('pref') == '長崎県') selected @endif>長崎県</option>
                                        <option value="熊本県" @if (old('pref') == '熊本県') selected @endif>熊本県</option>
                                        <option value="大分県" @if (old('pref') == '大分県') selected @endif>大分県</option>
                                        <option value="宮崎県" @if (old('pref') == '宮崎県') selected @endif>宮崎県</option>
                                        <option value="鹿児島県" @if (old('pref') == '鹿児島県') selected @endif>鹿児島県</option>
                                        <option value="沖縄県" @if (old('pref') == '沖縄県') selected @endif>沖縄県</option>
                                </select>
                                <span id="pref-error" class="d-block text-danger ml-24 lh-32"></span>
								</td>
							</tr>
							<tr id="address1_row" class="inp2">
								<th scope="row">
									<em>＊</em>市区郡町村
								</th>
								<td>
                                    <x-input id="address1" type="text" name="address1" style="ime-mode: active"  class="w-100" :value="old('address1')" required />
									<span class="d-block mt-16">(例）横浜市上北町</span>
                                    <span id="address1-error" class="d-block text-danger ml-24 lh-32"></span>
								</td>
							</tr>
							<tr id="address2_row">
								<th scope="row">
									<em>＊</em>番地
								</th>
								<td>
                                    <x-input id="address2" type="text" name="address2" style="ime-mode: active"  class="w-100" :value="old('address2')" required />
									<span class="d-block mt-16">(例）3-24-555</span>
                                    <span id="address2-error" class="d-block text-danger ml-24 lh-32"></span>
								</td>
							</tr>
							<tr id="address3_row">
								<th scope="row">ビル名</th>
								<td>
                                    <x-input id="address3" type="text" name="address3" style="ime-mode: active"  class="w-100" :value="old('address3')" />
									<span class="d-block mt-16">(例）通販ビル4F</span>
								</td>
							</tr>
							<tr id="tel_row">
								<th scope="row"><em>＊</em>電話番号</th>
								<td>
                                    <x-input id="tel" type="text" name="tel" style="ime-mode: inactive"  class="w-100" :value="old('tel')" required />
									<span class="d-block mt-16">(例）1000-10-1000</span>
                                    <span id="tel-error" class="d-block text-danger ml-24 lh-32"></span>
								</td>
							</tr>
							<tr>
								<th scope="row"><em>＊</em>メールアドレス</th>
								<td colspan="2">
                                    <x-input id="email" class="form-control w-100" type="email" name="email" :value="old('email')" autocomplete="off" required />
                                    <span id="mail-error" class="d-block text-danger ml-24 lh-32"></span>
								</td>
							</tr>
							<tr>
								<th scope="row"><em>＊</em>パスワード</th>
								<td colspan="2">
                                    <x-input id="password" class="form-control w-100"
                                                type="password"
                                                name="password"
                                                required autocomplete="new-password" />
                                    <span id="password-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
							</tr>
							<tr>
								<th scope="row"><em>＊</em>パスワード（確認用）</th>
								<td colspan="2">
                                    <x-input id="password_confirmation" class="form-control w-100"
                                                type="password"
                                                name="password_confirmation" required />
                                    <span id="password_confirmation-error" class="d-block text-danger ml-24 lh-32"></span>
                                </td>
							</tr>
						</tbody>
					</table>
                    <div class="send text-center my-40">
                        <input id="submit" class="px-40 py-16 bg-mizuiro text-white" style="border: 0px;" type="submit" value="送信する" />
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('js/register.js') }}"></script>
@endpush
