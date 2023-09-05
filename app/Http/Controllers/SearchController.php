<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Manufacture;
use App\Models\Connection;
use App\Models\Battery;
use App\Models\Evaluation;
use App\Models\User;
use App\Http\Requests\PostRequest;

class SearchController extends Controller
{
     public function index(Manufacture $manufacture,Connection $connection,Battery $battery,Evaluation $evaluation)
     {
         //$product = $request->input('product');,'product'=>$product
        
         return view('searches.index')->with(['manufactures' => $manufacture->get(),'connections' => $connection->get(),'batteries' => $battery->get(),'evaluations' => $evaluation->get()]);
     }
     
     public function search(Request $request)
     {
         $product = $request->input('product');
         $manufacture = $request->input('manufacture');
         $connection = $request->input('connection');
         $evaluation = $request->input('evaluation');
         $battery = $request->input('battery'); 
         
         $query = Article::query();
         $query->select('articles.id','articles.product','articles.explanation','articles.user_id');//追記
             $query->join('manufactures', function ($query) use ($request) {
            $query->on('articles.manufacture_id', '=', 'manufactures.id');
            })->join('connections', function ($query) use ($request) {
            $query->on('articles.connection_id', '=', 'connections.id');
            })->join('evaluations', function ($query) use ($request) {
            $query->on('articles.evaluation_id', '=', 'evaluations.id');
            })->join('batteries', function ($query) use ($request) {
            $query->on('articles.battery_id', '=', 'batteries.id');
            });
            
            
    
        if(!empty($manufacture)) {
            $query->where('manufacture_id', 'LIKE', $manufacture);
        }

        if(!empty($connection)) {
            $query->where('connection_id', 'LIKE', $connection);
        }
        
        if(!empty($battery)) {
            $query->where('battery_id', 'LIKE', $battery);
        }
        
         if(!empty($evaluation)) {
            $query->where('evaluation_id', 'LIKE', $evaluation);
        }
        
        if(!empty($product)) {
            //$query->where('product', 'LIKE', "%{$product}%");
             $query->whereRaw('LOWER(product) LIKE ?', ['%' . strtolower($product) . '%']);
        }
        
        
        $items = $query->paginate(10);
       //$product = $items['product'];
       //$items = $article->where('product', '=', $product)->paginate();
       
       
       
         return view('searches/result')->with( ['items' => $items ]);
     }
     
     public function userindex()
     {
         
        
         return view('searches.userindex');
     }
     
      public function usersearch(Request $request)
     {
         $name = $request->input('user');
          
         
         $query = User::query();
         $query->select('users.id','users.name');
            
            
            
    
      
        
        if(!empty($name)) {
            //$query->where('name', 'LIKE', "%{$name}%");
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($name) . '%']);
        }
        
        
        $items = $query->paginate(10);
       //$product = $items['product'];
       //$items = $article->where('product', '=', $product)->paginate();
       
       
       
         return view('searches/userresult')->with( ['items' => $items ]);
     }
}
