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
                );
                Log::debug($user);          
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
        );
        session(['address' => json_encode($address)]);
        $json = json_encode($address);
        $address = json_decode($json);

        $access_key = "81663032";
        $check_sum = hash('sha256', $access_key);
        $message = '';
        return view('confirm', compact('address', 'check_sum', 'message'));
    }

    public function decision(Request $request) {
        $order = $this->_store_order($request);
        $view_param = [];
        $order_no = $order->order_no;
        $amount = $order->amount;
        $shipping = $order->shipping;
        $address = json_decode(session('address'));
        if ($request->input('payment') == 'credit') {
            $res = $this->_procedure_card($order_no, $amount+$shipping, $address, $request->input('webcollectToken'));
            if ($res['returnCode'] != '0') {
                $err_order = new Order();
                $err_order->where('id', $order->id)->delete();
                $access_key = "81663032";
                $check_sum = hash('sha256', $access_key);
                if ($res['errorCode'] == 'A082000010') {
                    $message = '['.$res['creditErrorCode'].'] 決済処理でエラーが発生しました。<br>ご利用のカード会社様へ直接お問い合わせください';
                } else {
                    $message = '['.$res['errorCode'].'] 決済処理でエラーが発生しました。';
                }
                return view('confirm', compact('address', 'check_sum', 'message'));
            }
            $this->_store_paid($order_no, $res['returnDate']);
            $date = $this->_date_format($res['returnDate']);
            $view_param =[
                'order_number' => $order_no,
                'amount' => $amount,
                'process_date' => $date,
            ];
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
        $this->_store_items($request, $order);
        session()->forget('address');
        if ($request->input('payment') == 'credit') {
            return view('card', compact('view_param'));
        } else {
            if ($request->input('convenience') == 'seven') {
                return view('seven', compact('view_param'));            
            } else if ($request->input('convenience') == 'fm') {
                return view('fm', compact('view_param'));
            } else {
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

    private function _store_items($request, $order) {
        $ids = array();
        foreach ($request->input('basket') as $key=>$val) {
            if ($val != null) {
                $ids[] = $val;
            }
        }
        $basket = new Basket();
        $baskets = $basket->whereIn('id', $ids)->get();
        $count = 1;
        foreach ($baskets as $basket) {
            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $filename = sprintf("%s_%03d.jpeg", $order->order_no, $count);
            Log::debug($filename);

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
        $amount = $num * 200;
        $tax = $amount - floor($amount / 1.08);
        $order->amount = $amount;
        $order->tax = $tax;
        $shipping = 0;
        $order->shipping = $shipping;

        $order->save();
        $order_id = $order->id;
        $order_number = sprintf("OC-%06d", $order_id);
        $order->order_no = $order_number;
        $order->save();
        return $order;

    }

    private function _procedure_card($order_number, $price, $address, $token) {
        //            $url = 'https://api.kuronekoyamato.co.jp/api/creditToken';
        $url = 'https://ptwebcollect.jp/test_gateway/creditToken.api';
        $param = [
            'function_div' => 'A08',
            'trader_code' => '970651403',
            'device_div' => '1',
            'order_no' => $order_number,
            'settle_price' => $price,
            'buyer_name_kanji' => $address->name1.$address->name2,
            'buyer_tel' => $address->tel,
            'buyer_email' => $address->mailaddress1,
            'pay_way' => '1',
            'token' => $token
        ];
        $response = Http::asForm()->post($url, $param);
        $xml  = simplexml_load_string($response);
        $res = json_decode( json_encode($xml), TRUE );
        Log::debug($res);
        return $res;
    }

    private function _procedure_seven($order_number, $price, $address) {
//        $url = 'https:// api.kuronekoyamato.co.jp/api/cvs1';
        $url = 'https://ptwebcollect.jp/test_gateway/cvs1.api';
        $param = [
            'function_div' => 'B01',
            'trader_code' => '970651403',
            'device_div' => '1',
            'order_no' => $order_number,
            'settle_price' => $price,
            'buyer_name_kanji' => $address->name1.$address->name2,
            'buyer_email' => $address->mailaddress1
        ];
        Log::debug($param);
        $response = Http::asForm()->post($url, $param);
        Log::debug($response);
        $xml  = simplexml_load_string($response);
        $res = json_decode( json_encode($xml), TRUE );
        Log::debug($res);
        return $res;
    }
    
    private function _procedure_fm($order_number, $price, $address) {
//        $url = 'https:// api.kuronekoyamato.co.jp/api/cvs2';
        $url = 'https://ptwebcollect.jp/test_gateway/cvs2.api';
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
        Log::debug($param);
        $response = Http::asForm()->post($url, $param);
        $xml  = simplexml_load_string($response);
        $res = json_decode( json_encode($xml), TRUE );
        Log::debug($res);
        return $res;
    }
    
    private function _procedure_lowson($kind, $order_number, $price, $address) {
        //        $url = 'https:// api.kuronekoyamato.co.jp/api/cvs2';
        if ($kind == 'lowson') {
            $url = 'https://ptwebcollect.jp/test_gateway/cvs3.api';
            $function_div = 'B03';            
        } else if ($kind == 'ms') {
            $url = 'https://ptwebcollect.jp/test_gateway/cvs3.api';
            $function_div = 'B05';
        } else {
            $url = 'https://ptwebcollect.jp/test_gateway/cvs3.api';
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
        Log::debug($res);
        return $res;
    }

    private function _date_format($date) {
        $y = substr($date, 0, 4);
        $m = substr($date, 4, 2);
        $d = substr($date, 6, 2);
        return $y.'年'.$m.'月'.$d.'日';
    }

    private function _create_print_image($filename, $basket) {
        $photo = \Image::make($basket->photo_uri);
        $path = storage_path('app/frame/'.$basket->frame);
        $frame = \Image::make($path);

        $scale =  $frame->width() / $basket->image_frameWidth;

        $c = \Image::canvas(floor($photo->width() * $scale), floor($photo->height() * $scale), '#ffffff');

        $w = $photo->width() * $basket->image_scale;
        $w *= $scale;
        $photo->widen(floor($w));

        $px = $basket->image_diffx * $basket->image_scale;
        $py = $basket->image_diffy * $basket->image_scale;
        $px *= $scale;
        $py *= $scale;
        $c->insert($photo, 'top-left', floor($px), floor($py));

        $fx = ($c->width() / 2) - ($frame->width() / 2);
        $fy = ($c->height() / 2) - ($frame->height() / 2);
        $c->insert($frame, 'top-left', floor($fx), floor($fy));

        $c->crop($frame->width(), $frame->height(), floor($fx), floor($fy));

//        $save_path = storage_path('app/upimages/'.$filename);
        $save_path = '/var/www/html/print_images/'.$filename;
        $c->save($save_path);

        $photo->destroy();
        $frame->destroy();
        $c->destroy();
    }
}    
