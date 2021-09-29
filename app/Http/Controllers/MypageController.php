<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

 
class MypageController extends Controller
{
    public function index() {
        $auth = Auth::user();
        return view('mypage', compact('auth'));
    }
}
