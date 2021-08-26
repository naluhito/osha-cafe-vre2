<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function test() {
        $contents = Storage::get('upimages/IMG_5543.jpeg');
        $base64data = base64_encode($contents);

        $data = base64_decode($base64data);
        $type = finfo_buffer(finfo_open(), $data, FILEINFO_EXTENSION);
        Log::debug($type);
        Storage::put('upimages/base64_1.txt', $base64data);

        return view('test');
    }
}
