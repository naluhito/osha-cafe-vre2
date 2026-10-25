<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use App\Models\Bean;
use App\Models\Basket;
use App\Models\Basketbean;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderBean;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Mail;


class BuyController extends Controller
{
    public function index() {
        if (Auth::check()) {
            $bean = new Bean();
            $beans = $bean->where('disp', true)->get();
            return view('choice',compact('beans'));
        }
        return view('buy');
    }

    public function choice() {
        $bean = new Bean();
        $beans = $bean->where('disp', true)->get();
        return view('choice',compact('beans'));
    }
    
    public function storebasket(Request $request) {
        
        $basket = new Basket();
        $basket->photo_name = $request->input('photo')['name'];
        $basket->photo_type = $request->input('photo')['type'];
        $basket->photo_uri = $request->input('photo')['uri'];
        $basket->frame = $request->input('frame');
        $basket->paper = $request->input('paper');
        $basket->image_width = (float)$request->input('imageInfo')['width'];
        $basket->image_height = (float)$request->input('imageInfo')['height'];
        $basket->image_diffx = (float)$request->input('imageInfo')['diffx'];
        $basket->image_diffy = (float)$request->input('imageInfo')['diffy'];
        $basket->image_scale = (float)$request->input('imageInfo')['scale'];
        $basket->image_frameWidth = (float)$request->input('imageInfo')['frameWidth'];
        $basket->image_frameHeight = (float)$request->input('imageInfo')['frameHeight'];
        $basket->save();
//        $basket->photo_uri = $this->_trim_photo($basket, $request->input('imageInfo')['orientation']);
        $basket->save();
        $basket_id = $basket->id;

        foreach ($request->input('beans') as $id=>$num) {
            $basketbean = new Basketbean();
            $basketbean->bean_id = $id;
            $basketbean->number = $num;
            $basketbean->basket_id = $basket_id;
            $basketbean->save();
        }
        $response = [
            "status" => "OK",
            "id" => $basket_id,
        ];

        return response()->json($response);
    }

    public function getBaskets(Request $request) {
        $ids = array();
        foreach ($request->input('ids') as $key=>$val) {
            $ids[] = $val;
        }
        $basket = new Basket();
        $baskets = $basket->whereIn('id', $ids)->get();
        $resBaskets = [];
        foreach ($baskets as $basket) {
            $beans = [];
            foreach ($basket->beans as $bean) {
                $beans[] = $bean->bean;
            }
            $basket['beans'] = $beans;
            $resBaskets[] = $basket;
        }
        $response = [
            "status" => "OK",
            "baskets" => $resBaskets
        ];
        return response()->json($response);
    }

    public function removeBasket(Request $request) {
        $basket = new Basket();
        $b = $basket->find($request->input('id'));
        $b->beans()->each(function($beans){
            $beans->delete();
        });
        $b->destroy($request->input('id'));
        $response = [
            "status" => "OK",
        ];
        return response()->json($response);
    }

    public function basket() {
        return view('basket');
    }

    public function address() {
        if (session()->has('address')) {
            $address = json_decode(session('address'));
        } else {
            if (Auth::check()) {
                $user = Auth::user();
                $array = array(
                    "name1" => $user->name1,
                    "name2" => $user->name2,
                    "name3" => $user->name3,
                    "name4" => $user->name4,
                    "zipcode" => $user->zip,
                    "pref" => $user->pref,
                    "address1" => $user->address1,
                    "address2" => $user->address2,
                    "address3" => $user->address3,
                    "tel" => $user->tel,
                    "mailaddress1" => $user->email,
                    "mailaddress2" => $user->email,
                    'receipt' => ""
                );
            } else {
                $array = array(
                    "name1" => "",
                    "name2" => "",
                    "name3" => "",
                    "name4" => "",
                    "zipcode" => "",
                    "pref" => "",
                    "address1" => "",
                    "address2" => "",
                    "address3" => "",
                    "tel" => "",
                    "mailaddress1" => "",
                    "mailaddress2" => "",
                    'receipt' => ""
                );
            }
            $json = json_encode($array);
            $address = json_decode($json);
        }
        return view('address', compact('address'));
    }

    public function confirm(Request $request) {
        $address = array(
            "name1" => $request->input("name1"),
            "name2" => $request->input("name2"),
            "name3" => $request->input("name3"),
            "name4" => $request->input("name4"),
            "zipcode" => $request->input("zipcode"),
            "pref" => $request->input("pref"),
            "address1" => $request->input("address1"),
            "address2" => $request->input("address2"),
            "address3" => $request->input("address3"),
            "tel" => $request->input("tel"),
            "mailaddress1" => $request->input("mailaddress1"),
            "mailaddress2" => $request->input("mailaddress2"),
            'receipt' => $request->input("receipt")
        );
        session(['address' => json_encode($address)]);
        $json = json_encode($address);
        $address = json_decode($json);

        $access_key = "81663033";
        $check_sum = hash('sha256', $access_key);
        $message = '';
        return view('confirm', compact('address', 'check_sum', 'message'));
    }

    public function recive3d(Request $request) {
        $order_id = $request['id'];
        $res = $this->_procedure_3d($request);
        if ($res['returnCode'] == '1') {
            if ($res['errorCode'] == 'A092000001') {
                return redirect('/');
            }
            $order = Order::find($order_id);
            $amount = $order->amount;
            $shipping = $order->shipping;
            $address_order = array(
                "name1" => $order->name1,
                "name2" => $order->name2,
                "name3" => $order->name3,
                "name4" => $order->name4,
                "zipcode" => $order->zip,
                "pref" => $order->pref,
                "address1" => $order->address1,
                "address2" => $order->address2,
                "address3" => $order->address3,
                "tel" => $order->tel,
                "mailaddress1" => $order->mail,
                "mailaddress2" => $order->mail,
                'receipt' => $order->receipt
            );
            session(['address' => json_encode($address_order)]);
            $json = json_encode($address_order);
            $address = json_decode($json);
    
            $err_order = new Order();
            $err_order->where('id', $order->id)->delete();
            Logger('######## '.$order_id.'['.$res['errorCode'].']3Dセキュア異常終了');
            $access_key = "81663033";
            $check_sum = hash('sha256', $access_key);
            $message = '['.$res['errorCode'].'] 決済処理でエラーが発生しました。';
            return view('confirm', compact('address', 'check_sum', 'message'));

        }
        $order = Order::find($order_id);
        $this->_store_paid($order->order_no, $res['returnDate']);
        $date = $this->_date_format($res['returnDate']);
        $view_param =[
            'order_number' => $order->order_no,
            'amount' => $order->amount + $order->shipping,
            'process_date' => $date,
        ];

        $order_items = [];
        $images = OrderItem::where('order_id', $order->id)->get();
        foreach ($images as $image) {
            $beans = OrderBean::with('bean')->where('order_item_id', $image['id'])->get();
            foreach ($beans as $bean) {
                if ($bean->bean->kind == 0) {
                    $type = 'ドリップバッグタイプ';
                } else {
                    $type = 'コーヒーバッグタイプ';
                }
                $order_items[] = $image['image'].' '.$image['paper'].' '.$type.' '.$bean->bean->name.' '.$bean->quantity.'個';
            }
        }

        $order_no = $order->order_no;
        $param = [
            'order_no' => $order->order_no,
            'name' => $order->name1.$order->name2,
            'mail' => $order->mail,
            "tel" => $order->tel,
            "zipcode" => $order->zip,
            "pref" => $order->pref,
            "address1" => $order->address1,
            "address2" => $order->address2,
            "address3" => $order->address3,
            "items" => $order_items
        ];
        Mail::send(['text' => 'mails.order'], $param, function($message) use ($order_no) {
            $message->from('no-reply@oshi-cafe.com', '推しカフェファクトリー')
            ->to('info@oshi-cafe.com')
            ->subject('【受注】'.$order_no);
        });

        Mail::send(['text' => 'mails.card'], $param, function($message) use ($order) {
            $message->from('no-reply@oshi-cafe.com', '推しカフェファクトリー')
            ->to($order->mail)
            ->subject('【推しカフェファクトリー】ご注文ありがとうございます♪');
        });

        return view('card', compact('view_param'));
    }

    public function recive3dTimeout(Request $request) {
        $order = Order::where('order_no', $request->order_no)->first();
        $amount = $order->amount;
        $shipping = $order->shipping;
        $address_order = array(
            "name1" => $order->name1,
            "name2" => $order->name2,
            "name3" => $order->name3,
            "name4" => $order->name4,
            "zipcode" => $order->zip,
            "pref" => $order->pref,
            "address1" => $order->address1,
            "address2" => $order->address2,
            "address3" => $order->address3,
            "tel" => $order->tel,
            "mailaddress1" => $order->mail,
            "mailaddress2" => $order->mail,
            'receipt' => $order->receipt
        );
        session(['address' => json_encode($address_order)]);
        $json = json_encode($address_order);
        $address = json_decode($json);
        Logger('######## '.$request->order_no.'3D Time out');

        $err_order = new Order();
        $err_order->where('id', $order->id)->delete();
        return response('result=ok', 200)
                  ->header('Content-Type', 'text/plain');; 
    }

    public function decision(Request $request) {
        $order = $this->_store_order($request);
        $view_param = [];
        $order_no = $order->order_no;
        $amount = $order->amount;
        $shipping = $order->shipping;
        $address = json_decode(session('address'));
        $html = '';

        if ($request->input('payment') == 'credit') {
            $res = $this->_procedure_card($amount+$shipping, $address, $request->input('webcollectToken'));
            if ($res['returnCode'] != '0') {
                Logger('####決済エラー['.$order->order_no.'] returnCode='.$res['returnCode'].'errorCode='.$res['errorCode']);
                $err_order = new Order();
                $err_order->where('id', $order->id)->delete();
                $access_key = "81663033";
                $check_sum = hash('sha256', $access_key);
                if ($res['errorCode'] == 'A082000010') {
                    $message = '['.$res['creditErrorCode'].'] 決済処理でエラーが発生しました。<br>ご利用のカード会社様へ直接お問い合わせください';
                } else {
                    $message = '['.$res['errorCode'].'] 決済処理でエラーが発生しました。';
                }
                return view('confirm', compact('address', 'check_sum', 'message'));
            }            
            // threeDAuthHtmlをviewにセット
            $html = $res['threeDAuthHtml'];
        } else {
            if ($request->input('convenience') == 'seven') {
                $res = $this->_procedure_seven($order_no, $amount+$shipping, $address);
                if ($res['returnCode'] != '0') {
                    $err_order = new Order();
                    $err_order->where('id', $order->id)->delete();
                    $access_key = "81663032";
                    $check_sum = hash('sha256', $access_key);
                    $message = '['.$res['errorCode'].'決済処理でエラーが発生しました。';
                    return view('confirm', compact('address', 'check_sum', 'message'));
                }
                $view_param =[
                    'order_no' => $order_no,
                    'billing_url' => $res['billingUrl'],
                    'expired_date' => $this->_date_format($res['expiredDate'])
                ];
            } else if ($request->input('convenience') == 'fm') {
                $res = $this->_procedure_fm($order_no, $amount+$shipping, $address);
                if ($res['returnCode'] != '0') {
                    $err_order = new Order();
                    $err_order->where('id', $order->id)->delete();
                    $access_key = "81663032";
                    $check_sum = hash('sha256', $access_key);
                    $message = '['.$res['errorCode'].'決済処理でエラーが発生しました。';
                    return view('confirm', compact('address', 'check_sum', 'message'));
                }
                $company_code = $res['companyCode'];
                $order_no = $res['orderNoF'];
                $expired_date = $this->_date_format($res['expiredDate']);
                $view_param =[
                    'order_no' => $order_no,
                    'company_code' => $res['companyCode'],
                    'order_no' => $res['orderNoF'],
                    'expired_date' => $this->_date_format($res['expiredDate'])
                ];
            } else {
                $res = $this->_procedure_lowson($request->input('convenience'), $order_no, $amount+$shipping, $address);
                if ($res['returnCode'] != '0') {
                    $err_order = new Order();
                    $err_order->where('id', $order->id)->delete();
                    $access_key = "81663032";
                    $check_sum = hash('sha256', $access_key);
                    $message = '['.$res['errorCode'].'決済処理でエラーが発生しました。';
                    return view('confirm', compact('address', 'check_sum', 'message'));
                }
                $view_param =[
                    'order_no' => $order_no,
                    'econ_no' => $res['econNo'],
                    'tel' => $address->tel,
                    'expired_date' => $this->_date_format($res['expiredDate'])
                ];
            }
        }

        foreach ($request->input('basket') as $key=>$val) {
            if ($val != null) {
                $ids[] = $val;
            }
        }
        $this->_store_items($ids, $order);
        session()->forget('address');

        if ($request->input('payment') == 'credit') {
            return view('threeda', compact('html'));
//            return view('card', compact('view_param'));
        } else {
            $order_items = [];
            $images = OrderItem::where('order_id', $order->id)->get();
            foreach ($images as $image) {
                $beans = OrderBean::with('bean')->where('order_item_id', $image['id'])->get();
                foreach ($beans as $bean) {
                    if ($bean->bean->kind == 0) {
                        $type = 'ドリップバッグタイプ';
                    } else {
                        $type = 'コーヒーバッグタイプ';
                    }
                    $order_items[] = $image['image'].' '.$image['paper'].' '.$type.' '.$bean->bean->name.' '.$bean->quantity.'個';
                }
            }

            $param = [
                'order_no' => $order_no,
                'name' => $address->name1.$address->name2,
                'mail' => $address->mailaddress1,
                "tel" => $address->tel,
                "zipcode" => $address->zipcode,
                "pref" => $address->pref,
                "address1" => $address->address1,
                "address2" => $address->address2,
                "address3" => $address->address3,
                "items" => $order_items
            ];
            Mail::send(['text' => 'mails.order'], $param, function($message) use ($order_no) {
                $message->from('no-reply@oshi-cafe.com', '推しカフェファクトリー')
                ->to('info@oshi-cafe.com')
                ->subject('【受注】'.$order_no);
            });    
    
            if ($request->input('convenience') == 'seven') {
                $param = [
                    'view_param' => $view_param
                ];
                Mail::send('mails.seven', $param, function($message) use ($address) {
                    $message->from('no-reply@oshi-cafe.com', '推しカフェファクトリー')
                    ->to($address->mailaddress1)
                    ->subject('【推しカフェファクトリー】ご注文ありがとうございます♪');
                    });    
                return view('seven', compact('view_param'));
            } else if ($request->input('convenience') == 'fm') {
                $param = [
                    'view_param' => $view_param
                ];
                Mail::send('mails.fm', $param, function($message)  use ($address){
                    $message->from('no-reply@oshi-cafe.com', '推しカフェファクトリー')
                    ->to($address->mailaddress1)
                    ->subject('【推しカフェファクトリー】ご注文ありがとうございます♪');
                    });    
                return view('fm', compact('view_param'));
            } else {
                $param = [
                    'view_param' => $view_param
                ];
                Mail::send('mails.lowson', $param, function($message)  use ($address){
                    $message->from('no-reply@oshi-cafe.com', '推しカフェファクトリー')
                    ->to($address->mailaddress1)
                    ->subject('【推しカフェファクトリー】ご注文ありがとうございます♪');
                    });    
                return view('lowson', compact('view_param'));
            }
        }

}

    private function _store_paid($order_no, $date) {
        $order = new Order();
        $data = $order->where('order_no', $order_no)->first();
        $data->paid = 1;
        $data->paid_date = $date;
        $data->save();
    }

    private function _store_items($ids, $order) {
//        $ids = array();
//        foreach ($request->input('basket') as $key=>$val) {
//            if ($val != null) {
//                $ids[] = $val;
//            }
//        }
        $basket = new Basket();
        $baskets = $basket->whereIn('id', $ids)->get();
        $count = 1;
        foreach ($baskets as $basket) {
            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $filename = sprintf("%s_%03d.jpeg", $order->order_no, $count);

            $this->_create_print_image($filename, $basket);
            $order_item->image = $filename;
            $order_item->paper = $basket->paper;
            $order_item->save();
            foreach ($basket->beans as $bean) {
                $order_bean = new OrderBean();
                $order_bean->order_id = $order->id;
                $order_bean->order_item_id = $order_item->id;
                $order_bean->bean_id = $bean->bean_id;
                $order_bean->quantity = $bean->number;
                $order_bean->save();
            }
            $count++;
        }
        $basket->whereIn('id', $ids)->delete();
    }

    private function _store_order($request) {
        $ids = array();
        foreach ($request->input('basket') as $key=>$val) {
            if ($val != null) {
                $ids[] = $val;
            }
        }
        $basket = new Basket();
        $baskets = $basket->whereIn('id', $ids)->get();
        $num = 0;
        foreach ($baskets as $basket) {
            foreach ($basket->beans as $bean) {
                $num += $bean->number;
            }
        }
        $address = json_decode(session('address'));
        $order = new Order();
        if (Auth::check()) {
            $user = Auth::user();
            $order->user_id = $user->id;
        }

        if ($request->input('payment') == 'credit') {
            $order->payment_kind = 0;
            $order->convenience = '';
        } else {
            $order->payment_kind = 1;
            if ($request->input('convenience') == 'seven') {
                $order->convenience = 'セブン-イレブン';
            } else if ($request->input('convenience') == 'fm') {
                $order->convenience = 'ファミリーマート';
            } else if ($request->input('convenience') == 'lowson') {
                $order->convenience = 'ローソン';
            } else if ($request->input('convenience') == 'ms') {
                $order->convenience = 'ミニストップ';
            } else if ($request->input('convenience') == 'sm') {
                $order->convenience = 'セイコーマート';
            }
        }
        $order->paid = 0;
        $order->shipped = false;
        $order->name1 = $address->name1;
        $order->name2 = $address->name2;
        $order->name3 = $address->name3;
        $order->name4 = $address->name4;
        $order->zip = $address->zipcode;
        $order->pref = $address->pref;
        $order->address1 = $address->address1;
        $order->address2 = $address->address2;
        $order->address3 = $address->address3;
        $order->tel = $address->tel;
        $order->mail = $address->mailaddress1;
        $amount = $num * 260; // 20260401料金改定
        $tax = $amount - floor($amount / 1.08);
        $order->amount = $amount;
        $order->tax = $tax;
        $order->receipt = $address->receipt;

        $shipping = 0;
        if ($num < 10) {
            $shipping = 300;
        }
        $order->shipping = $shipping;

        $order->save();
        $order_id = $order->id;
        $order_number = sprintf("OC-%06d", $order_id);
        $order->order_no = $order_number;
        $order->save();

        session(['order_id' => $order_id]);

        return $order;

    }

    private function _procedure_card($price, $address, $token) {
        $order = Order::find(session('order_id'));
        // トークン決済登録
        $url = 'https://api.kuronekoyamato.co.jp/api/creditToken';
        $param = [
            'function_div' => 'A08',
            'trader_code' => '970651403',
            'device_div' => '1',
//            'order_no' => strval(session('order_id')),
            'order_no' => $order->order_no,
            'settle_price' => $price,
            'buyer_name_kanji' => $address->name1.$address->name2,
            'buyer_tel' => $address->tel,
            'buyer_email' => $address->mailaddress1,
            'pay_way' => '1',
            'token' => $token,
            'trader_ec_url' => 'https://oshi-cafe.com/recive3d?id=' . session('order_id'),
            'return_url_3ds_timeout' => 'https://oshi-cafe.com/recive3dTimeout'
        ];
        $response = Http::asForm()->post($url, $param);
        $xml  = simplexml_load_string($response);
        $res = json_decode( json_encode($xml), TRUE );
        $order = Order::find(session('order_id'));
        $order->threed_d_token = $res['threeDToken'];
        $order->save();

        return $res;
    }

    private function _procedure_3d($returned_items) {
        $order = Order::find($returned_items['id']);
        // トークン決済登録３Ｄセキュア結果用
        $url = 'https://api.kuronekoyamato.co.jp/api/creditToken3D';
        $param = [
            'function_div' => 'A09',
            'trader_code' => '970651403',
//            'order_no ' => $returned_items['id'],
            'order_no' => $order->order_no,
            'comp_cd' => $returned_items['COMP_CD'],
            'token' => $returned_items['TOKEN'],
            'card_exp' => $returned_items['CARD_EXP'],
            'item_price' => $returned_items['ITEM_PRICE'],
            'item_tax' => $returned_items['ITEM_TAX'],
            'cust_cd' => $returned_items['CUST_CD'],
            'shop_id'  => $returned_items['SHOP_ID'],
            'term_cd' => $returned_items['TERM_CD'],
            'crd_res_cd' => $returned_items['CRD_RES_CD'],
            'res_ve' => $returned_items['RES_VE'],
            'res_pa' => $returned_items['RES_PA'],
            'res_code' => $returned_items['RES_CODE'],
            'three_d_inf' => $returned_items['3D_INF'] == '' ? '                                                                                         ' : $returned_items['3D_INF'],
            'three_d_tran_id' => $returned_items['3D_TRAN_ID'],
            'send_dt' => $returned_items['SEND_DT'],
            'hash_value' => $returned_items['HASH_VALUE'],
            'three_d_token' => $order->threed_d_token,
        ];
        $response = Http::asForm()->post($url, $param);
        $xml  = simplexml_load_string($response);
        $res = json_decode( json_encode($xml), TRUE );
        return $res;
    }

    private function _procedure_seven($order_number, $price, $address) {
        $url = 'https://api.kuronekoyamato.co.jp/api/cvs1';
//        $url = 'https://ptwebcollect.jp/test_gateway/cvs1.api';
        $param = [
            'function_div' => 'B01',
            'trader_code' => '970651403',
            'device_div' => '1',
            'order_no' => $order_number,
            'settle_price' => $price,
            'buyer_name_kanji' => $address->name1.$address->name2,
            'buyer_email' => $address->mailaddress1
        ];
        $response = Http::asForm()->post($url, $param);
        $xml  = simplexml_load_string($response);
        $res = json_decode( json_encode($xml), TRUE );
        return $res;
    }
    
    private function _procedure_fm($order_number, $price, $address) {
        $url = 'https://api.kuronekoyamato.co.jp/api/cvs2';
//        $url = 'https://ptwebcollect.jp/test_gateway/cvs2.api';
        $param = [
            'function_div' => 'B02',
            'trader_code' => '970651403',
            'device_div' => '1',
            'order_no' => $order_number,
            'settle_price' => $price,
            'buyer_name_kanji' => $address->name1.$address->name2,
            'buyer_name_kana' => $address->name3.$address->name4,
            'buyer_tel' => $address->tel,
            'buyer_email' => $address->mailaddress1
        ];
        $response = Http::asForm()->post($url, $param);
        $xml  = simplexml_load_string($response);
        $res = json_decode( json_encode($xml), TRUE );
        return $res;
    }
    
    private function _procedure_lowson($kind, $order_number, $price, $address) {
        $url = 'https://api.kuronekoyamato.co.jp/api/cvs3';
        if ($kind == 'lowson') {
//            $url = 'https://ptwebcollect.jp/test_gateway/cvs3.api';
            $function_div = 'B03';            
        } else if ($kind == 'ms') {
 //           $url = 'https://ptwebcollect.jp/test_gateway/cvs3.api';
            $function_div = 'B05';
        } else {
 //           $url = 'https://ptwebcollect.jp/test_gateway/cvs3.api';
            $function_div = 'B06';
        }
        $param = [
            'function_div' => $function_div,
            'trader_code' => '970651403',
            'device_div' => '1',
            'order_no' => $order_number,
            'goods_name' => 'オリジナルドリップバッグ',
            'settle_price' => $price,
            'buyer_name_kanji' => $address->name1.$address->name2,
            'buyer_tel' => $address->tel,
            'buyer_email' => $address->mailaddress1
        ];
        $response = Http::asForm()->post($url, $param);
        $xml  = simplexml_load_string($response);
        $res = json_decode( json_encode($xml), TRUE );
        return $res;
    }

    private function _date_format($date) {
        $y = substr($date, 0, 4);
        $m = substr($date, 4, 2);
        $d = substr($date, 6, 2);
        return $y.'年'.$m.'月'.$d.'日';
    }

    private function _trim_photo($basket, $orientation) {
        $frame_width = 2000;
        $frame_height = 2134;
        $photo = \Image::make($basket->photo_uri);
        switch ($orientation) {
            case 2:
                $photo->flip();
                break;
            case 3:
                $photo->rotate(180);
                break;
            case 4:
                $photo->rotate(180)->flip();
                break;
            case 5:
                $photo->rotate(270)->flip();
                break;
            case 6:
                $photo->rotate(270);
                break;
            case 7:
                $photo->rotate(90)->flip();
                break;
            case 8:
                $photo->rotate(90);
                break;
        }

        $scale =  $frame_width / $basket->image_frameWidth;
        $c = \Image::canvas(floor($photo->width() * $scale), floor($photo->height() * $scale), '#ffffff');
        $w = $photo->width() * $basket->image_scale;
        $w *= $scale;
        $photo->widen(floor($w));

        $px = $basket->image_diffx * $basket->image_scale;
        $py = $basket->image_diffy * $basket->image_scale;
        $px *= $scale;
        $py *= $scale;
        $c->insert($photo, 'top-left', floor($px), floor($py));
        $photo->destroy();

        $fx = ($c->width() / 2) - ($frame_width / 2);
        $fy = ($c->height() / 2) - ($frame_height / 2);

        $c->crop($frame_width, $frame_height, floor($fx), floor($fy));
        $p = $c->encode('jpg', 100);
        $c->destroy();
        $encoded = base64_encode($p);

        return 'data:image/jpg;base64,'.$encoded;
    }

    private function _create_print_image($filename, $basket) {
        $photo = \Image::make($basket->photo_uri);
        $path = storage_path('app/frame/'.$basket->frame);
        $frame = \Image::make($path);

        $photo->insert($frame, 'top-left', 0, 0);
        $save_path = '/var/www/html/print_images/'.$filename;
        $photo->save($save_path);

        $photo->destroy();
        $frame->destroy();

    }
}    
