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
        <form method="post" action="">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <table class="table tbl-2column border border-primary fz-14">
                        <tbody>
                            <tr>
                                <th><label for="koumoku">お問い合わせ項目<span class="badge">必須</span></label></th>
                                <td>
                                    <label class="check_style"><input type="checkbox" name="koumoku" valu="お問い合わせ">お問い合わせ</label>
                                    <label class="check_style"><input type="checkbox" name="koumoku" valu="資料請求">資料請求</label>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="onamae">お名前<span class="badge">必須</span></label></th>
                                <td>
                                    <input type="text" name="onamae" class="form-control" size="60" placeholder="田中 太郎">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="furigana">ふりがな<span class="badge">必須</span></label></th>
                                <td>
                                    <input type="text" name="furigana" class="form-control" size="60" placeholder="たなか たろう">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="seibetsu">性別</label></th>
                                <td>
                                    <label class="radio_style"><input type="radio" name="seibetsu" valu="男性" checked="checked">男性</label>
                                    <label class="radio_style"><input type="radio" name="seibetsu" valu="女性">女性</label>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="nenrei">年齢</label></th>
                                <td>
                                <select name="nenrei" class="form-control">
                                    <option value="選択してください" selected="selected">選択してください</option>
                                    <option value="15歳">15歳</option>
                                    <option value="16歳">16歳</option>
                                    <option value="17歳">17歳</option>
                                    <option value="18歳">18歳</option>
                                    <option value="19歳">19歳</option>
                                    <option value="20歳">20歳</option>
                                    <option value="21歳">21歳</option>
                                    <option value="22歳">22歳</option>
                                    <option value="23歳">23歳</option>
                                    <option value="24歳">24歳</option>
                                    <option value="25歳">25歳</option>
                                    <option value="26歳">26歳</option>
                                    <option value="27歳">27歳</option>
                                    <option value="28歳">28歳</option>
                                    <option value="29歳">29歳</option>
                                    <option value="30歳">30歳</option>
                                    <option value="31歳">31歳</option>
                                    <option value="32歳">32歳</option>
                                    <option value="33歳">33歳</option>
                                    <option value="34歳">34歳</option>
                                    <option value="35歳">35歳</option>
                                    <option value="36歳">36歳</option>
                                    <option value="37歳">37歳</option>
                                    <option value="38歳">38歳</option>
                                    <option value="39歳">39歳</option>
                                    <option value="40歳">40歳</option>
                                    <option value="41歳">41歳</option>
                                    <option value="42歳">42歳</option>
                                    <option value="43歳">43歳</option>
                                    <option value="44歳">44歳</option>
                                    <option value="45歳">45歳</option>
                                    <option value="46歳">46歳</option>
                                    <option value="47歳">47歳</option>
                                    <option value="48歳">48歳</option>
                                    <option value="49歳">49歳</option>
                                    <option value="50歳">50歳</option>
                                    <option value="51歳">51歳</option>
                                    <option value="52歳">52歳</option>
                                    <option value="53歳">53歳</option>
                                    <option value="54歳">54歳</option>
                                    <option value="55歳">55歳</option>
                                    <option value="56歳">56歳</option>
                                    <option value="57歳">57歳</option>
                                    <option value="58歳">58歳</option>
                                    <option value="59歳">59歳</option>
                                    <option value="60歳">60歳</option>
                                    <option value="61歳">61歳</option>
                                    <option value="62歳">62歳</option>
                                    <option value="63歳">63歳</option>
                                    <option value="64歳">64歳</option>
                                    <option value="65歳">65歳</option>
                                    <option value="66歳">66歳</option>
                                    <option value="67歳">67歳</option>
                                    <option value="68歳">68歳</option>
                                    <option value="69歳">69歳</option>
                                    <option value="70歳">70歳</option>
                                    <option value="71歳">71歳</option>
                                    <option value="72歳">72歳</option>
                                    <option value="73歳">73歳</option>
                                    <option value="74歳">74歳</option>
                                    <option value="75歳">75歳</option>
                                    <option value="76歳">76歳</option>
                                    <option value="77歳">77歳</option>
                                    <option value="78歳">78歳</option>
                                    <option value="79歳">79歳</option>
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="email">メールアドレス<span class="badge">必須</span></label></th>
                                <td>
                                    <input type="email" name="email" size="60" class="form-control" placeholder="info@example.com">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="email2">メールアドレス（確認用）<span class="badge">必須</span></label></th>
                                <td>
                                    <input type="email" name="email2" class="form-control" size="60" placeholder="info@example.com">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="tel">お電話番号<span class="badge">必須</span></label></th>
                                <td>
                                    <div class="tel-field d-flex align-items-center">
                                        <input type="text" name="tel" class="form-control haba" size="6" maxlength="5">－<input type="text" name="tel" class="form-control haba" size="5" maxlength="4">－<input type="text" name="tel" class="form-control haba" size="5" maxlength="4">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="zip">郵便番号<span class="badge">必須</span></label></th>
                                <td>
                                    <input type="text" name="zip" class="form-control" size="60" onKeyUp="AjaxZip3.zip2addr(this,'','pref','addr');" placeholder="住所自動入力">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="pref">都道府県<span class="badge">必須</span></label></th>
                                <td>
                                    <input type="text" name="pref" class="form-control" id="pref" size="60">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="addr">市区町村<span class="badge">必須</span></label></th>
                                <td>
                                    <input type="text" name="addr" class="form-control" id="addr" size="60">
                                </td>
                            </tr>
                            <tr>
                                <th><label>マンション・アパート名など</label></th>
                                <td>
                                    <input type="text" name="pref" class="form-control" size="60">
                                </td>
                            </tr>
                            <tr>
                                <th class="w-md-40 last"><label for="otoiawase">お問い合わせ内容<span class="badge">必須</span></label></th>
                                <td class="last">
                                    <textarea name="otoiawase" class="form-control" cols="50" row="10" placeholder="ご質問・ご意見等がございましたらご記入ください。"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center mt-32">
                        <input type="submit" name="submitConfirm" value="確認画面へ" class="btn btn-primary btn-lg text-white fz-18 font-weight-bold">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection