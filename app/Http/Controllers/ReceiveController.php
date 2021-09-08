<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

 
class ReceiveController extends Controller
{
    public function settle_recive(Request $request) {
        Log::debug('POST recive');
        Log::debug($request);

        $request->input("order_no");
        $order = new Order();
        $data = $order->where('order_no', $request->input("order_no"))->first();
        if ($request->input("settle_result") == '1') {
            $data->paid = 1;
        } else {
            $data->paid = $request->input("settle_detail");
        }
        $data->paid_date = $date;
        $data->save();
    }
}
