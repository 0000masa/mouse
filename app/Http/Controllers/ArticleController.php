<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

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
}
