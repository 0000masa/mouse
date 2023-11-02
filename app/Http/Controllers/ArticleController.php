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
        $order="新しい順";
        return view('posts.index')->with(['articles' => $article->getPaginateByLimit(),'order'=>$order]);  
       
    }
    
    public function indexoldest(Article $article)
    {
        $order="古い順";
        return view('posts.index')->with(['articles' => $article->orderBy('created_at','asc')->paginate(10),'order'=>$order]);  
       
    }
    
    public function likemost()
    {
        $order="いいねが多い順";
        $articles = Article::withCount('likes')->orderBy('likes_count', 'desc')->paginate(10);
        return view('posts.index')->with(['articles' => $articles,'order'=>$order]);  
       
    }
    
    public function likelittle()
    {
        $order="いいねが少ない順";
        $articles = Article::withCount('likes')->orderBy('likes_count', 'asc')->paginate(10);
        return view('posts.index')->with(['articles' => $articles,'order'=>$order]);  
       
    }
    
    public function pricemost(Article $article)
    {
        $order="金額が高い順";
        return view('posts.index')->with(['articles' => $article->orderBy('price','desc')->paginate(10),'order'=>$order]);  
       
    }
    
    public function pricelittle(Article $article)
    {
        $order="金額が低い順";
        return view('posts.index')->with(['articles' => $article->orderBy('price','asc')->paginate(10),'order'=>$order]);  
       
    }
    
    public function evaluationmost(Article $article)
    {
        $order="評価が高い順";
        return view('posts.index')->with(['articles' => $article->orderBy('evaluation_id','asc')->paginate(10),'order'=>$order]);  
       
    }
    
    public function evaluationlittle(Article $article)
    {
        $order="評価が低い順";
        return view('posts.index')->with(['articles' => $article->orderBy('evaluation_id','desc')->paginate(10),'order'=>$order]);  
       
    }
    
    public function show(Article $article,User $user,Comment $comment)
    {
       
        
        $articleId=$article->id;
        
        $likecount=Like::where('article_id', $articleId)->count();
        
        
         $comments=$comment->where('article_id','=',$article->id)->orderBy('created_at','Desc')->paginate(10);
        
        return view('posts.show')->with(['article' => $article,'users' =>$user->get(),'comments' => $comments,'likecount'=>$likecount]);
       
        
    
    }
    
    public function create(Manufacture $manufacture,Connection $connection,Battery $battery,Evaluation $evaluation)
    {
        return view('posts.create')->with(['manufactures' => $manufacture->get(),'connections' => $connection->get(),'batteries' => $battery->get(),'evaluations' => $evaluation->get()]);
    }
    
    public function store(Request $request, Article $article)
    {
        $request->validate([
             'post.product' => 'required|string|max:50',
             'post.price' => 'required|numeric|max:1000000',
             'post.maximum_dpi' => 'nullable|numeric|max:1000000',
             'post.weight' => 'nullable|numeric|max:10000',
             'post.buttons' => 'nullable|numeric|max:100',
            'post.explanation' => 'required|string|max:200',
            'post.image_url' => 'nullable|image|max:2000',
        ],
        [
             'post.product' => '商品名を正しく入力してください。',
             'post.price' => '金額を入力してください',
             'post.maximum_dpi' => '正しい数値を入力してください',
             'post.weight' => '正しい数値を入力してください',
             'post.buttons' => '正しい数値を入力してください',
            'post.explanation' => '説明を正しく入力してください',
            'post.image_url' => '正しい画像データを選択してください',
        ]);
        $input = $request['post'];
        
        //dd($input);
       if ($request->hasFile('post.image_url')) {
        //$test = $request->file('post.image_url');
        //dd($test);
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
             'post.product' => 'required|string|max:50',
             'post.price' => 'required|numeric|max:1000000',
             'post.maximum_dpi' => 'nullable|numeric|max:1000000',
             'post.weight' => 'nullable|numeric|max:10000',
             'post.buttons' => 'nullable|numeric|max:100',
            'post.explanation' => 'required|string|max:200',
            'post.image_url' => 'nullable|image|max:2000',
        ],
        [
             'post.product' => '商品名を正しく入力してください。',
             'post.price' => '金額を入力してください',
             'post.maximum_dpi' => '正しい数値を入力してください',
             'post.weight' => '正しい数値を入力してください',
             'post.buttons' => '正しい数値を入力してください',
            'post.explanation' => '説明を正しく入力してください',
            'post.image_url' => '正しい画像データを選択してください',
        ]);
        
        $input_post = $request['post'];
        //dd($input_post);
        
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
        $review_likes_count = Article::withCount('likes')->findOrFail($article_id)->likes_count;//->get()にしてしまうと$review_likes_count->like_countをしないと合計数を獲得できない
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
