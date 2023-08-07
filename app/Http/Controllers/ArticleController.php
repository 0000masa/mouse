<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Manufacture;
use App\Models\Connection;
use App\Models\Battery;
use App\Models\Evaluation;
use App\Http\Requests\PostRequest;
use Cloudinary; 

class ArticleController extends Controller
{
    public function index(Article $article)
    {
        return view('posts.index')->with(['articles' => $article->getPaginateByLimit()]);  
       
    }
    
    public function show(Article $article)
    {
        return view('posts.show')->with(['article' => $article]);
    
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
}
