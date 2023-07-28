<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <body>
        <h1 class="product">
            {{ $article->product }}
        </h1>
        <div>
           <p>
               評価<br>
                {{ $article->evaluation->level }}
           </p>
       </div>
       <div>
           <p>
               値段<br>
                {{ $article->price }}
           </p>
       </div>
       <div>
           <p>
               重さ<br>
                {{ $article->weight }}
           </p>
       </div>
        <div>
           <p>
               最大dpi<br>
                {{ $article->maximum_dpi }}
           </p>
       </div>
       <div>
           <p>
               ボタン数<br>
                {{ $article->buttons }}
           </p>
       </div>
       <div>
           <p>
               メーカー<br>
                {{ $article->manufacture->name }}
           </p>
       </div>
       <div>
           <p>
               最大dpi<br>
                {{ $article->maximum_dpi }}
           </p>
       </div>
        <div class="content">
            <div class="content__post">
                <h3>レビュー</h3>
                <p>{{ $article->explanation }}</p>    
            </div>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>