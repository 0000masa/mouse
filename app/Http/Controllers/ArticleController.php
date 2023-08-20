<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Manufacture;
use App\Models\Connection;
use App\Models\Battery;
use App\Models\Evaluation;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use App\Http\Requests\PostRequest;
use Cloudinary; 

class ArticleController extends Controller
{
    public function index(Article $article)
    {
        return view('posts.index')->with(['articles' => $article->getPaginateByLimit()]);  
       
    }
    
    public function show(Article $article,User $user,Comment $comment)
    {
        //ここからとreturnに$paramを追記
        $reviews = Article::withCount('likes')->orderBy('id', 'desc')->paginate(10);
        
        $param = [
            'reviews' => $reviews,
             
        ];
        //ここまで
        
         $comments=$comment->where('article_id','=',$article->id)->orderBy('created_at','Asc')->paginate(10);
        
        return view('posts.show',$param)->with(['article' => $article,'users' =>$user->get(),'comments' => $comments]);
       
        
    
    }
    
    public function create(Manufacture $manufacture,Connection $connection,Battery $battery,Evaluation $evaluation)
    {
        return view('posts.create')->with(['manufactures' => $manufacture->get(),'connections' => $connection->get(),'batteries' => $battery->get(),'evaluations' => $evaluation->get()]);
    }
    
    public function store(Request $request, Article $article)
    {
        $request->validate([
             'post.product' => 'required|string|max:100',
             'post.price' => 'required|numeric|max:1000000',
             'post.maximum_dpi' => 'nullable|numeric|max:1000000',
             'post.weight' => 'required|numeric|max:10000',
             'post.buttons' => 'nullable|numeric|max:100',
            'post.explanation' => 'required|string|max:4000',
            'post.image_url' => 'nullable|image',
        ],
        [
             'post.product' => '商品名を入力してください。',
             'post.price' => '金額を入力してください',
             'post.maximum_dpi' => '最大DPIを入力してください',
             'post.weight' => '重さを入力してください',
             'post.buttons' => 'ボタン数を入力してください',
            'post.explanation' => '説明を入力してください',
            'post.image_url' => '画像データを選択してください',
        ]);
        $input = $request['post'];
        
       if ($request->hasFile('post.image_url')) {
        $image_url = Cloudinary::upload($request->file('post.image_url')->getRealPath())->getSecurePath();
        //$input += ['image_url' => $image_url];
        
        $input['image_url'] = $image_url;
        
       }

        
        $article->fill($input)->save();
        
        return redirect('/');
    }
    
    public function edit(Article $article,Manufacture $manufacture,Connection $connection,Battery $battery,Evaluation $evaluation)
    {
        return view('posts.edit')->with(['article' => $article,'manufactures' => $manufacture->get(),'connections' => $connection->get(),'batteries' => $battery->get(),'evaluations' => $evaluation->get()]);
    }
    
    public function update(Request $request, Article $article)
    {
        $request->validate([
             'post.product' => 'required|string|max:100',
             'post.price' => 'required|numeric|max:1000000',
             'post.maximum_dpi' => 'nullable|numeric|max:1000000',
             'post.weight' => 'required|numeric|max:10000',
             'post.buttons' => 'nullable|numeric|max:100',
            'post.explanation' => 'required|string|max:4000',
            'post.image_url' => 'nullable|image',
        ],
        [
             'post.product' => '商品名を入力してください。',
             'post.price' => '金額を入力してください',
             'post.maximum_dpi' => '最大DPIを入力してください',
             'post.weight' => '重さを入力してください',
             'post.buttons' => 'ボタン数を入力してください',
            'post.explanation' => '説明を入力してください',
            'post.image_url' => '画像データを選択してください',
        ]);
        
        $input_post = $request['post'];
        
        if ($request->hasFile('post.image_url')) {
        $image_url = Cloudinary::upload($request->file('post.image_url')->getRealPath())->getSecurePath();
        //$input += ['image_url' => $image_url];
        
        $input_post['image_url'] = $image_url;
        
       }
       
        $article->fill($input_post)->save();
    
        return redirect('/');
    }
    
    public function delete(Article $article)
    {
        $article->delete();
        return redirect('/');
    }
    
    
    
    
    public function like(Request $request)
    {
        $user_id = \Auth::user()->id; //1.ログインユーザーのid取得
        $article_id = $request->article_id; //2.投稿idの取得
        $already_liked = Like::where('user_id', $user_id)->where('article_id', $article_id)->first(); //3.
    
        if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
            $like = new Like; //4.Likeクラスのインスタンスを作成
            $like->article_id = $article_id; //Likeインスタンスにreview_id,user_idをセット
            $like->user_id = $user_id;
            $like->save();
        } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
            Like::where('article_id', $article_id)->where('user_id', $user_id)->delete();
        }
        //5.この投稿の最新の総いいね数を取得
        $review_likes_count = Article::withCount('likes')->findOrFail($article_id)->likes_count;
        $param = [
            'review_likes_count' => $review_likes_count,
        ];
        return response()->json($param); //6.JSONデータをjQueryに返す
    }
    
    
    public function likecount(Request $request)
    {
       //1.ログインユーザーのid取得
        $article_id = $request->article_id; //2.投稿idの取得
        
    
        
        //5.この投稿の最新の総いいね数を取得
        $review_likes_count = Article::withCount('likes')->findOrFail($article_id)->likes_count;
        $param = [
            'review_likes_count' => $review_likes_count,
        ];
        return response()->json($param); //6.JSONデータをjQueryに返す
    }
    //public function likeshow(Request $request)
    //{
        //$reviews = Article::withCount('likes')->orderBy('id', 'desc')->paginate(10);
        //$param = [
            //'reviews' => $reviews,
        //];
        //return view('posts.show', $param);
    //}
}
