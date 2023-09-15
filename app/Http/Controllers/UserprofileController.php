<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cloudinary;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class UserprofileController extends Controller
{
    public function create()
    {
            // ログインしているユーザーを取得
        $user = auth()->user();
    
        // ユーザーが既にプロフィールを作成しているかどうかをチェック
        if ($user->profile) {
            // 既にプロフィールを作成している場合、リダイレクト
            return redirect('/');
        }
        
        return view('userprofile.create');
    }
    
     public function store(Request $request,Profile $profile)
    {
         $request->validate([
            'post.introduce' => 'nullable|string|max:200',
            'post.image_url' => 'nullable|image|max:2000',
        ],
        [
            'post.introduce' => '自己紹介を正しく入力してください',
            'post.image_url' => '正しい画像データを選択してください',
        ]);
        
        $input = $request['post'];
        
        
       if ($request->hasFile('post.image_url')) {
        $image_url = Cloudinary::upload($request->file('post.image_url')->getRealPath())->getSecurePath();
        //$input += ['image_url' => $image_url];
        
        $input['image_url'] = $image_url;
        
       }
       
       
        
        $profile->fill($input)->save();
        
        $userId=Auth::user()->id;
    
        return redirect('/users/'.$userId);
       
    }
    
    public function edit(Profile $profile)
    {
        return view('userprofile.edit')->with(['profile' => $profile]);
    }
    
     public function update(Request $request,Profile $profile)
    {
         $request->validate([
            'post.introduce' => 'nullable|string|max:200',
            'post.image_url' => 'nullable|image|max:2000',
        ],
        [
            'post.introduce' => '自己紹介を正しく入力してください',
            'post.image_url' => '正しい画像データを選択してください',
        ]);
        
        $input = $request['post'];
        
        
       if ($request->hasFile('post.image_url')) {
        $image_url = Cloudinary::upload($request->file('post.image_url')->getRealPath())->getSecurePath();
        //$input += ['image_url' => $image_url];
        
        $input['image_url'] = $image_url;
        
       }
    
        
        
        $profile->fill($input)->save();
        
        $userId=Auth::user()->id;
    
        return redirect('/users/'.$userId);
       
    }
}
