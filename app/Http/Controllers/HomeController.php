<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;

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
         
        //return redirect('/posts/'.$articleId);
       
        return response()->json($articleId);
    }
    
     //ここから追加
    public function getData($articleId ,Comment $comment)
    {
         $query = Comment::query();
         $query->select('comments.id','comments.comment','comments.created_at','comments.user_id','name');
             $query->join('users', function ($query) {
            $query->on('comments.user_id', '=', 'users.id');
            });
        $query->where('article_id', '=', $articleId);
        $query->orderBy('comments.created_at', 'desc');
        $comments = $query->paginate(10);
        //$comments= Comment::where('article_id', $articleId)->paginate(10);
        //$comments = Comment::orderBy('created_at','desc')->get();
        $commentData = $comments->items();
        
        $json = ["comments" => $commentData];
         
      
        
        
        
        return response()->json($json);
    }
    //ここまで追加
    
    public function delete(Comment $comment,Request $request)
    {
        $article_id=$request['article_id'];
        
        $comment->delete();
        //$articleId=$request['post.article_id'];
        //return response()->json($articleId);
        return redirect('/comment/'.$article_id);
    }
    
    public function get(Article $article,Comment $comment)
    {
        $comments=$comment->where('article_id','=',$article->id)->orderBy('created_at','desc')->paginate(20);
       
        
        return view('posts.comment')->with(['comments' => $comments]); 
    }
    

   

    
}
