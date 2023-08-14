<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(User $user)
    {
        
        return view('users.index')->with(['articles' => $user->getByUser(),'user'=>$user]);
    }
    
   public function store($userId)
    {
        Auth::user()->follows()->attach($userId);
        return;
    }
    
     public function destroy($userId)
    {
        Auth::user()->follows()->detach($userId);
        return;
    }
}
