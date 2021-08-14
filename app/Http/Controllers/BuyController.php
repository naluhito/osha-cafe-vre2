<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use App\Models\Bean;
use App\Models\Basket;
use App\Models\Basketbean;

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
            Log::debug(session('address'));
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
        Log::debug($response);
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
        return view('confirm', compact('response'));
    }
}
