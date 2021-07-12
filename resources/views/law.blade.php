@extends('layout.base')

@section('content')
<div class="bg-rainbow py-24 py-md-48">
    <h1 class="text-center font-weight-bold fz-24 fz-md-32">特定商取引に基づく表記</h1>
</div>
<div class="container-wrap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <table class="table tbl-2column border border-primary fz-14">
                    <tbody>
                        <tr>
                            <th>ショップ名</th>
                            <td>推しカフェファクトリー</td>
                        </tr>
                        <tr>
                            <th>販売業者</th>
                            <td>bueno珈琲豆専門店mikoya134　馬場克也</td>
                        </tr>
                        <tr>
                            <th>運営統括責任者</th>
                            <td>馬場　克也</td>
                        </tr>
                        <tr>
                            <th>所在地</th>
                            <td>鹿児島県鹿児島市下荒田３丁目３７−１</td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td>099-201-5529</td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td>info<i class="fas fa-at"></i>oshi-cafe.com</td>
                        </tr>
                        <tr>
                            <th>販売URL</th>
                            <td><a href="https://oshi-cafe.com/" target="_blank" rel="noopener noreferrer">https://oshi-cafe.com</a></td>
                        </tr>
                        <tr>
                            <th>お支払い方法</th>
                            <td>
                                <h4 class="h4 fz-14 mt-16"><i class="fas fa-square mr-4"></i>クレジットカード払い</h4>
                                <p>支払時期：ご利用のカード会社ごとに異なります。<br>お客様が入力されたカード情報は当店に送られることなく、さらにカード情報入力画面は暗号化（SSL）で保護されています。</p>
                                <h4 class="h4 fz-14 mt-16"><i class="fas fa-square mr-4"></i>コンビニ決済払い</h4>
                                <p>ご購入後送られてくるメールの内容をご確認の上、コンビニでお支払いください。</p>
                            </td>
                        </tr>
                        <tr>
                            <th>商品代金以外の 必要金額</th>
                            <td>
                                <h4 class="h4 fz-14"><i class="fas fa-square mr-4"></i>送料</h4>
                                <p>10個以上のご注文で送料無料</p>
                            </td>
                        </tr>
                        <tr>
                            <th>配送・送料について</th>
                            <td>
                                <h4 class="h4 fz-14"><i class="fas fa-square mr-4"></i>ネコポス（ヤマト運輸）またはクリックポスト（日本郵便）での発送となります。※郵便受けに配達</h4>
                                <h4 class="h4 fz-14"><i class="fas fa-square mr-4"></i>数量が多い場合はクロネコヤマト（宅急便）での発送となります。</h4>
                                <p>10個以上のご注文で送料無料</p>
                                <!--<table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td class="border-0">北海道、離島</td>
                                            <td class="border-0 text-nowrap text-right">1,000円</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">青森県、岩手県、秋田県、宮城県、山形県、福島県</td>
                                            <td class="border-0 text-nowrap text-right">900円</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">茨城県、栃木県、群馬県、埼玉県、千葉県、東京都、神奈川県、新潟県、山梨県、長野県</td>
                                            <td class="border-0 text-nowrap text-right">700円</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">福井県、石川県、富山県、静岡県、愛知県、岐阜県、三重県</td>
                                            <td class="border-0 text-nowrap text-right">600円</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">和歌山県、滋賀県、奈良県、京都府、大阪府、兵庫県、岡山県、広島県、鳥取県、島根県、山口県、香川県、徳島県、愛媛県、高知県</td>
                                            <td class="border-0 text-nowrap text-right">500円</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">福岡県、佐賀県、長崎県、大分県、熊本県、宮崎県、鹿児島県</td>
                                            <td class="border-0 text-nowrap text-right">450円</td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">沖縄県</td>
                                            <td class="border-0 text-nowrap text-right">700円</td>
                                        </tr>
                                    </tbody>
                                </table>-->
                            </td>
                        </tr>
                        <tr>
                            <th>販売数量</th>
                            <td>1個から</td>
                        </tr>
                        <tr>
                            <th>お申込み有効期限</th>
                            <td>7日以内にお願いいたします。 7日間入金がない場合は、キャンセルとさせていただきます。</td>
                        </tr>
                        <tr>
                            <th>商品引渡し時期</th>
                            <td>
                                前払いの場合、指定日が無ければ入金確認後2営業日以内で発送致します。 その他の支払方法の場合、指定日が無ければご入金確認後2日営業日以内で発送致します。<br><br>
                                期日がある場合はお早めにご注文下さいますよう、お願いいたします。
                            </td>
                        </tr>
                        <tr>
                            <th>商品引渡し方法</th>
                            <td>当方にて手配後、運送会社による配送</td>
                        </tr>
                        <tr>
                            <th>返品・不良品について</th>
                            <td>「不良品・当社の商品の間違い」の場合は当社が負担いたします。 配送途中の破損などの事故がございましたら、弊社までご連絡下さい。 送料・手数料ともに弊社負担で早急に新品をご送付致します。 <br>【返品対象】 「不良品・当社の商品の間違い」の場合 <br>【返品時期】 ご購入後7日以内にご連絡があった場合に返金可能となります。 <br>【返品方法】 メールにて返金要請してください。 7日以内にご購入代金を指定の口座へお振込みいたします。<br>【返品交換不可】受注生産商品の為、お客様のご都合によるご注文のキャンセル・返品交換は固くお断りさせていただきます。お客様による商品違い、および色・画像の位置・イメージ違いなどによるキャンセル・返品交換はお受けできません。
                            </td>
                        </tr>
                        <tr>
                            <th>著作権・肖像権</th>
                            <td>
                                <ul class="pl-24">
                                    <li>お客様は弊社に対し、弊社の注文製品の作成及び利用について第三者の著作権（著作者人格権、肖像権も含む）や商標権、その他一切の権利を侵害せず、かつ適法であることを保証する義務を負います。なお、お客様は弊社に対し、お客様による弊社の利用・サービスにより、または、関連して弊社がお客様以外の者から権利の侵害等に基づくクレームを受けた場合や違法行為であるとの指摘を受けた場合、お客様は、お客様の責任と費用によってかかるクレームから弊社を免責し、かかるクレーム、及び違法行為であるとの指摘に対応するために弊社が受けた損害（合理的な弁護士費用等を含む）の全てを速やかに賠償する義務を負います。</li>
                                    <li>「著作権・肖像権の侵害」に該当する内容のものに関しては印刷をお断りさせて頂いております。</li>
                                    <li>こちらで著作権・肖像権の侵害の可能性があると判断した場合、ご注文をキャンセルさせていただきます。</li>
                                    <li>利用者が本サービスを利用したことにより生じた一切の損害（直接損害、間接損害、通常損害、特別損害、派生損害など損害の種類を問わず、利益、信用、利用機会、データ、またはその他無形資産の喪失による会員の損害を含む。）は、当該利用者会員が負担をするものとし、たとえ、当社に損害発生に関する予見可能性があったとしても、当店は一切責任を負わないものとします。</li>
                                    <li>弊社ではご注文頂いたデザインを当スタッフが一点一点、確認を行っておりますが、すべての著作権や肖像権などの検証は実上不可能です。</li>
                                    <li>著作権・肖像権に関しての確認や判断に関してのお問い合わせにはお答えすることができません。</li>
                                    <li>著作権・肖像権に関わるデザインのご利用に関しては、ご注文者様でご確認頂き、ご注文時にはご了承いただいたものといたします。</li>
                                    <li>弊社で印刷・発送を行った後に発生したトラブルについても弊社は一切の責任を負いません。</li>
                                    <li>著作物利用や著作権・肖像権に関わるご相談については弊社ではお答えすることができません。</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>納品書・請求書・領収書</th>
                            <td>
                                <h4 class="h4 fz-14"><i class="fas fa-square mr-4"></i>送付先に商品の金額がわからないようにしてほしい（納品書を同封しないでほしい）</h4>
                                <ul class="fz-14 pl-24">
                                    <li>納品書に商品金額を記載しておりますので、納品書がご不要な方はご注文時の備考欄に【納品書不要】とお書きください。</li>
                                </ul>
                                <h4 class="h4 fz-14"><i class="fas fa-square mr-4"></i>納品書はいただけますか？</h4>
                                <ul class="fz-14 pl-24">
                                    <li>納品書は商品と同梱してお送り致します。</li>
                                </ul>
                                <h4 class="h4 fz-14"><i class="fas fa-square mr-4"></i>領収書は発行出来ますか？</h4>
                                <ul class="fz-14 pl-24">
                                    <li>カード決済・コンビニ決済の場合、カード会社・コンビニから発行されるものが領収証となるため、弊社からは発行いたしません。</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th class="">表現、及び商品に 関する注意書き</th>
                            <td class="">本商品に示された表現や再現性には個人差があり、必ずしも利益や効果を保証したものではございません。</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




@endsection