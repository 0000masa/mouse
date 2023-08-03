<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>mouse</title>
        
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <x-app-layout>
         <x-slot name="header">
        
        </x-slot>
        @if(count($articles) > 0)
                 {{ $articles[0]->user->name }}さんの投稿
        @else         
        投稿はありません        
        @endif
        
                <div class='posts'>
                    @foreach($articles as $article)
                        <div class='post'>
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