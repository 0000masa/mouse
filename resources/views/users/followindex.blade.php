<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>mouse</title>
        
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <x-app-layout>
         <x-slot name="header">
        
        </x-slot>
        <h1>フォローしたユーザーの投稿</h1>
         <div class='posts'>
                    @foreach($articles as $article)
                        <div class='post'>
                            <a href="/users/{{ $article->user->id }}">{{ $article->user->name }}</a>
                             <a href="/posts/{{ $article->id }}"><h2 class='product'>{{$article->product}}</h2></a>
                            
                            <p class='explanation'>{{$article->explanation}}</p>
                            
                        </div>
                    @endforeach
              
                </div>
               <div class='paginate'>
                    {{ $articles->links() }}
                </div>
         </x-app-layout>
         
     </body>
    
</html>