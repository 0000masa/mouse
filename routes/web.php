<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserprofileController;
use App\Http\Controllers\GoogleLoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Route::get('/', [ArticleController::class, 'index'])->middleware('auth');

//Route::get('/', [ArticleController::class, 'index']);

//Route::get('/dashboard', function () {
    //return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

//Route::middleware('auth')->group(function () {
Route::middleware('verified')->group(function(){
    Route::get('/', [ArticleController::class, 'index']);
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users/{user}', [UserController::class,'index'])->name('users.index');
    
    Route::get('/oldest', [ArticleController::class, 'indexoldest']);
    Route::get('/likemost', [ArticleController::class, 'likemost']);
    Route::get('/pricemost', [ArticleController::class, 'pricemost']);
    Route::get('/pricelittle', [ArticleController::class, 'pricelittle']);
    
    Route::get('/posts/create', [ArticleController::class, 'create']);
    Route::get('/posts/{article}', [ArticleController::class ,'show']);
    Route::post('/posts', [ArticleController::class, 'store']);
    Route::get('/searches', [SearchController::class, 'index']);
    Route::get('searches/do',[SearchController::class,'search']);
    Route::get('/posts/{article}/edit', [ArticleController::class, 'edit']);
    Route::put('/posts/{article}', [ArticleController::class, 'update']);
    Route::delete('/posts/{article}', [ArticleController::class,'delete']);
    Route::post('/comment',[HomeController::class,'add']);
    
    Route::get('/comment/{article}', [HomeController::class,'get']);
    Route::delete('/comment/{comment}', [HomeController::class,'destroy']);
    Route::get('/showcomment/{comment}', [HomeController::class,'commentdestroy']);
     
   Route::post('/like', [ArticleController::class,'like'])->name('reviews.like');
   Route::post('/like/count', [ArticleController::class,'likecount'])->name('reviews.likecount');

    Route::get('posts/result/ajax/{articleId}',[HomeController::class,'getData']);
    
    Route::get('/follow/{user}', [ UserController::class, 'followindex']);
    Route::get('/follow/follows/{user}', [ UserController::class, 'followsname']);
    Route::get('/follow/followers/{user}', [ UserController::class, 'followersname']);
    Route::post('/follow/{userId}', [ UserController::class, 'store']);
    Route::post('/follow/{userId}/destroy', [ UserController::class, 'destroy']);
    Route::post('/follower/count/{userId}/', [ UserController::class, 'updatefollowcount']);
    
    Route::get('/usersearches', [SearchController::class, 'userindex']);
    Route::get('/usersearches/do', [SearchController::class, 'usersearch']);
    
    Route::get('/userprofile/create', [UserprofileController::class, 'create']);
    Route::post('/userprofile', [UserprofileController::class, 'store']);
    Route::get('/userprofile/{profile}/edit', [UserprofileController::class, 'edit']);
    Route::put('/userprofile/{profile}', [UserprofileController::class, 'update']);
});

Route::get('/auth/redirect', [GoogleLoginController::class, 'getGoogleAuth']);
Route::get('/login/callback', [GoogleLoginController::class, 'authGoogleCallback']);

//Route::get('/posts/{article}', [ArticleController::class ,'show']);
 

require __DIR__.'/auth.php';
