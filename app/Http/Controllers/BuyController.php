<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Bean;

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
    
}
