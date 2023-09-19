<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleLoginController extends Controller
{
    public function getGoogleAuth()
    {
        return Socialite::driver('google')
            ->redirect();
    }
    
    public function authGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::firstOrNew(['email' => $googleUser->email]);

        if (!$user->exists) {
            $user['name'] = $googleUser->getNickName() ?? $googleUser->getName() ?? $googleUser->getNick();
            $user['email'] = $googleUser->email; // Gmailアドレス
            $user['password'] = str_random(); // 適当に生成

            $user->save();
        }

        Auth::login($user);
        return redirect()->route('/');
    }
    
    
    
    
}
