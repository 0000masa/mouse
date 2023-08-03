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
            <h1>検索結果一覧</h1>
                <div class='result'>
                    @foreach($items as $item)
                        <div class='result'>
                            <a href="/users/{{ $item->user->id }}">{{ $item->user->name }}</a>
                             <a href="/posts/{{ $item->id }}"><h2 class='product'>{{$item->product}}</h2></a>
                            
                            <p class='explanation'>{{$item->explanation}}</p>
                            
                        </div>
                    @endforeach
              
                </div>
               <div class='paginate'>
                    {{ $items->links() }}
                </div>
                
                </x-app-layout>
    </body>
</html>