<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;
use App\Models\Article;
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
    
     public function followindex(User $user,Article $article)
    {
        $userIds=$user->follows()->pluck('follower_user_id');
        //dd($userIds);
        
        $articles=$article->whereIn('user_id',$userIds)->orderBy('created_at','desc')->paginate(10);
        return view('users.followindex')->with(['articles' => $articles]);
    }
    
     public function followsname(User $user)
     {
        $followusers=$user->follows()->orderBy('created_at','desc')->paginate(20);
        //dd($followusers);
        
        return view('users.followname')->with(['followusers'=>$followusers]);
     }
     
      public function followersname(User $user)
     {
        $followerusers=$user->followers()->orderBy('created_at','desc')->paginate(20);
        
        return view('users.followername')->with(['followerusers'=>$followerusers]);
     }
     
      public function updatefollowcount($userId)
    {
            $user = User::find($userId);
            $followerCount = $user->followers()->count();
            return response()->json(['follower_count' => $followerCount]);
       
        
    }
    
     
}
