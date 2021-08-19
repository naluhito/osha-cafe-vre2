<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function login(Request $request) {
        $message = '';
        $method = request()->getMethod();
        if ($method == 'POST') {
            $message = 'メールアドレスが登録されていません';
        }
        return view('login', compact('message'));
    }

    public function regist() {
        return view('regist');
    }
    public function registmail() {
        return view('registmail');
    }
}
