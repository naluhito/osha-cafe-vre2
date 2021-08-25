<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use App\Models\Bean;
use App\Models\Basket;
use App\Models\Basketbean;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use DateTime;

class BuyController extends Controller
{
    public function index() {
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
            $json = json_encode($array);
            $address = json_decode($json);
        }
        return view('address', compact('address'));
    }

    public function confirm(Request $response) {
        $address = array(
            "name1" => $response->input("name1"),
            "name2" => $response->input("name2"),
            "name3" => $response->input("name3"),
            "name4" => $response->input("name4"),
            "zipcode" => $response->input("zipcode"),
            "pref" => $response->input("pref"),
            "address1" => $response->input("address1"),
            "address2" => $response->input("address2"),
            "address3" => $response->input("address3"),
            "tel" => $response->input("tel"),
            "mailaddress1" => $response->input("mailaddress1"),
            "mailaddress2" => $response->input("mailaddress2"),
        );
        session(['address' => json_encode($address)]);
        $access_key = "81663032";
        $check_sum = hash('sha256', $access_key);

        return view('confirm', compact('response', 'check_sum'));
    }

    public function decision(Request $request) {
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
        if ($request->input('payment') == 'credit') {
            $order->payment_kind = 0;
        } else {
            $order->payment_kind = 1;
        }
        $order->paid = false;
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
        // 仮セット
        $order->org_image = '';
        $order->print_image = '';
        $order->x = 0;
        $order->y = 0;
        $order->w = 0;
        $order->h = 0;

        $order->save();
        $order_id = $order->id;
        $order_number = sprintf("OC%06d", $order_id);
        $order->slip_number = $order_number;
        $order->save();

        $baskets = $basket->whereIn('id', $ids)->delete();
        session()->forget('address');

        if ($request->input('payment') == 'credit') {
            $res = $this->_procedure_card($order_number, $amount+$shipping, $address);
            $date = new DateTime();
            $process_date = $date->format('Y年m月d日 H時i分');
            return view('card', compact('order_number', 'amount', 'process_date'));
        } else {
            if ($request->input('convenience') == 'seven') {
                $res = $this->_procedure_seven($order_number, $amount+$shipping, $address);
                return view('seven');            
            } else if ($request->input('convenience') == 'fm') {
                $res = $this->_procedure_fm($order_number, $amount+$shipping, $address);
                return view('fm');
            } else {
                $res = $this->_procedure_lowson($request->input('convenience'), $order_number, $amount+$shipping, $address);
                return view('lowson');
            }
        }
    }

    private function _procedure_card($order_number, $price, $address) {
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
            'token' => $request->input('webcollectToken')
        ];
        Log::debug($param);
        $response = Http::asForm()->post($url, $param);
        $res = json_decode( json_encode( $response ), TRUE );
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
        $xml  = simplexml_load_string($contents);
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
            'buyer_email' => $address->mailaddress1
        ];
        Log::debug($param);
        $response = Http::asForm()->post($url, $param);
        $res = json_decode( json_encode( $response ), TRUE );
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
            'settle_price' => $price,
            'buyer_name_kanji' => $address->name1.$address->name2,
            'buyer_tel' => $address->tel,
            'buyer_email' => $address->mailaddress1
        ];
        Log::debug($param);
        $response = Http::asForm()->post($url, $param);
        $res = json_decode( json_encode( $response ), TRUE );
        Log::debug($res);
        return $res;
    }

}
