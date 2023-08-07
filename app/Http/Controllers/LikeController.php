<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class LikeController extends Controller
{
    public function store(Article $article)
       {
           $user = Auth::user();
           if($user->id != $article->user_id) {
              if($article->isLiked(Auth::id())) {
                   // 対象のレコードを取得して、削除する。
                   $delete_record = $article->getLike($user->id);
                   $delete_record->delete();
               } else {
                 $like = Like::firstOrCreate(
                       array(
                           'user_id' => Auth::user()->id,
                           'article_id' => $article->id
                       )
                   );
               }
           }
       }
}
