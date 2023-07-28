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
        <h1>投稿一覧</h1>
        <p>ログインユーザー:{{ Auth::user()->name }}<br></p>
        </x-slot>
                 
            
            <a href="/posts/create">新規投稿作成</a>
                <div class='posts'>
                    @foreach($articles as $article)
                        <div class='post'>
                             <a href="/posts/{{ $article->product }}"><h2 class='product'>{{$article->product}}</h2></a>
                            
                            <p class='explanation'>{{$article->explanation}}</p>
                            <form action="/posts/{{ $article->id }}" id="form_{{ $article->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deletePost({{ $article->id }})">delete</button> 
                            </form>
                        </div>
                    @endforeach
              
                </div>
               <div class='paginate'>
                    {{ $articles->links() }}
                </div>
                <script>
                    function deletePost(id) {
                        'use strict'
        
                        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                            document.getElementById(`form_${id}`).submit();
                        }
                    }
                </script>
                </x-app-layout>
    </body>
</html>