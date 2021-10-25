<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mail;

class HomeController extends Controller
{
    public function index() {
        return view('index');
    }

    public function contact() {
        if (session()->has('contact')) {
            $contact = json_decode(session('contact'));
        } else {
            $array = array(
                "name1" => "",
                "name2" => "",
                "age" => "",
                "mail" => "",
                "mail2" => "",
                "tel" => "",
                "otoiawase" => "",
            );
            $json = json_encode($array);
            $contact = json_decode($json);
        }

        return view('contact', compact('contact'));
    }
    
    public function confirm(Request $request) {
        $contact = array(
            "name1" => $request->input("name1"),
            "name2" => $request->input("name2"),
            "age" => $request->input("age"),
            "mail" => $request->input("mail"),
            "mail2" => $request->input("mail2"),
            "tel" => $request->input("tel"),
            "otoiawase" => $request->input("otoiawase"),
        );
        session(['contact' => json_encode($contact)]);
        $json = json_encode($contact);
        $contact = json_decode($json);
        return view('contact_confirm', compact('contact'));
    }
    public function send() {
        if (session()->has('contact')) {
            $contact = json_decode(session('contact'));
            $param = [
                'contact' => $contact
            ];

            Mail::send(['text' => 'mails.contact'], $param, function($message)  use ($contact){
                $message->from('no-reply@oshi-cafe.com', '推しカフェファクトリー')
                ->to($contact->mail)
                ->subject('【推しカフェファクトリー】お問い合わせ承りました');
                });    
            Mail::send(['text' => 'mails.contact_staff'], $param, function($message)  use ($contact){
                    $message->from('no-reply@oshi-cafe.com', '推しカフェファクトリー')
                    ->to('info@oshi-cafe.com')
                    ->subject('【推しカフェファクトリー】お問い合わせ');
                    });    
            session()->forget('contact');
        }
        return view('contact_send');
    }
}
