<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        Log::debug($request);

        $request->validate([
            'name1' => ['required', 'string', 'max:64'],
            'name2' => ['required', 'string', 'max:64'],
            'name3' => ['required', 'string', 'max:64'],
            'name4' => ['required', 'string', 'max:64'],
            'zipcode' => ['required', 'string'],
            'pref' => ['required', 'string'],
            'address1' => ['required', 'string', 'max:64'],
            'address2' => ['required', 'string', 'max:64'],
            'address3' => ['nullable', 'string', 'max:64'],
            'tel' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name1.$request->name2,
            'name1' => $request->name1,
            'name2' => $request->name2,
            'name3' => $request->name3,
            'name4' => $request->name4,
            'zip' => $request->zipcode,
            'pref' => $request->pref,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'address3' => $request->address3,
            'tel' => $request->tel,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
