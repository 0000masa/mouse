<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
//use Socialite; 

class GoogleLoginController extends Controller
{
    
    //use AuthenticatesUsers;
    
    
    //protected $redirectTo = RouteServiceProvider::HOME;
      
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
   public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback()
    {
        $gUser = Socialite::driver('google')->stateless()->user();
        // email が合致するユーザーを取得
        //dd($gUser);
        $user = User::where('email', $gUser->email)->first();
        // 見つからなければ新しくユーザーを作成
        if ($user == null) {
            $user = $this->createUserByGoogle($gUser);
        }
        // ログイン処理
        \Auth::login($user, true);
        return redirect('/');
    }
    
    public function createUserByGoogle($gUser)
    {
        return User::create([
            'name' => $gUser->name,
            'email' => $gUser->email,
            'email_verified_at' => now(),//追加
            'password' => \Hash::make(uniqid()),
        ]);
    }
    
    
    
    
}
