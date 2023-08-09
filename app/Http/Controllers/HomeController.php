<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class HomeController extends Controller
{
    public function add(Request $request,Comment $comment)
    {
         $request->validate([
             'post.comment'=>'required|string|max:400',
             ],
             [
               'post.comment'=>'コメントを入力してください'
                 ]);
                 
        
        $input = $request['post'];
        $articleId=$request['post.article_id'];
        //dd($articleId);
        $comment->fill($input)->save();
         
        return redirect('/posts/'.$articleId);
    }
}
