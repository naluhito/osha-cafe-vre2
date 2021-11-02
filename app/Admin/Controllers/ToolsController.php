<?php


namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Mail;

class ToolsController extends Controller
{
    public function shipped_mail(Request $request) {
        $status = 'OK';
        $order = new Order();
        $orders = $order->find($request->id);
        if ($orders['shipped']) {
            $param = [
                'order' => $orders
            ];
            Mail::send(['text' => 'mails.shipped'], $param, function($message)  use ($orders){
                $message->from('no-reply@oshi-cafe.com', '推しカフェファクトリー')
                ->to($orders['mail'])
                ->subject('【推しカフェファクトリー】商品を発送しました');
            });
        } else {
            $status = 'NG';
        }

        $response = [
            "status" => $status,
        ];
        return response()->json($response);
    }
}
