<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Manufacture;
use App\Models\Connection;
use App\Models\Battery;
use App\Models\Evaluation;

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
}
