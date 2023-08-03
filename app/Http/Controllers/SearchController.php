<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Manufacture;
use App\Models\Connection;
use App\Models\Battery;
use App\Models\Evaluation;
use App\Http\Requests\PostRequest;

class SearchController extends Controller
{
     public function index(Request $request,Manufacture $manufacture,Connection $connection,Battery $battery,Evaluation $evaluation)
     {
         $product = $request->input('product');
        
         return view('searches.index')->with(['manufactures' => $manufacture->get(),'connections' => $connection->get(),'batteries' => $battery->get(),'evaluations' => $evaluation->get(),'product'=>$product]);
     }
     
     public function search(Request $request)
     {
         $product = $request->input('product');
         $manufacture = $request->input('manufacture');
         $connection = $request->input('connection');
         $evaluation = $request->input('evaluation');
         $battery = $request->input('battery'); 
         
         $query = Article::query();
         
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
        
        if(!empty($product)) {
            $query->where('product', 'LIKE', "%{$product}%");
        }

        $items = $query->paginate(10);
       
         return view('searches/result', ['items' => $items]);
     }
}
