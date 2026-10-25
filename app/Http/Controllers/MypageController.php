<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderBean;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
 
class MypageController extends Controller
{
    public function index() {
        $auth = Auth::user();
        $order = new Order();
        $orders = $order->where('user_id', Auth::id())->get();
        $order_list = [];
        foreach ($orders as $val) {
            $image_list = [];
            foreach ($val->items as $item) {
                $bean = OrderBean::with('bean')->where('order_item_id', $item['id'])->get();
                $item['beans'] = $bean;
                $image_list[] = $item;
            }
            $order_list[] = [
                'date' => $val->created_at,
                'order_no' => $val->order_no,
                'amount' => $val->amount,
                'items' => $image_list
            ];
        }
        $message = '';
        return view('mypage', compact('auth', 'order_list', 'message'));
    }

    public function edit() {
        $user = Auth::user();
        return view('mypage_edit', compact('user'));
    }

    public function update(Request $request) {
        $form =  $request->all();
        $user = Auth::user();

        unset($form['_token']);
        $form['name'] = $form['name1'].$form['name2'];
        if (isset($form['password'])) {
            $form['password'] = Hash::make($form['password']);
            unset($form['password_confirmation']);
        } else {
            unset($form['password']);
            unset($form['password_confirmation']);
        }
        $user->fill($form)->save();
        return redirect("/mypage");
    }

    public function delete_account(Request $request) {
        $pass = Auth::user()->password;
        Log::debug($request->input("password"));

        if (Hash::check($request->input("password"), $pass)) {
            $data = [
                'auth' => Auth::user()
            ];
            Mail::send('mails.delaccount', $data, function($message) {
                $message->from('no-reply@oshi-cafe.com', '推しカフェファクトリー')
                ->to('info@oshi-cafe.com')
                ->subject('退会依頼');
                });
            $message = '退会依頼を受け付けました。';
        } else {
            $message = 'パスワードが違います。';
        }
        $auth = Auth::user();
        $order = new Order();
        $orders = $order->where('user_id', Auth::id())->get();
        $order_list = [];
        foreach ($orders as $val) {
            $image_list = [];
            foreach ($val->items as $item) {
                $bean = OrderBean::with('bean')->where('order_item_id', $item['id'])->get();
                $item['beans'] = $bean;
                $image_list[] = $item;
            }
            $order_list[] = [
                'date' => $val->created_at,
                'order_no' => $val->order_no,
                'amount' => $val->amount,
                'items' => $image_list
            ];
        }
        return view('mypage', compact('auth', 'order_list', 'message'));
    }
}
