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
        <div>
        ユーザー名:{{$user->name}}</br>
        <a href="/follow/follows/{{$articles[0]->user->id}}"><p>{{ $user->follows()->count();}}フォロー</a>　<a href="/follow/followers/{{$articles[0]->user->id}}">{{ $user->followers()->count();}}フォロワー</a> </br></p>
        
        @if(Auth::check() && Auth::user()->id !== $user->id)
            @if(Auth::user()->follows->contains($user->id))
            <button onclick="follow({{ $user->id }})"><span id="follow-status-{{ $user->id }}">フォロー中</span></button>
            @else
            <button onclick="follow({{ $user->id }})"><span id="follow-status-{{ $user->id }}">フォローする</span></button>
            @endif
        </div>
         @endif
          
        
        
        
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
                <script>
                function follow(userId, button) {
                    const followStatusText = $(`#follow-status-${userId}`).text();
                
                    if (followStatusText === "フォローする") {
                        followadd(userId); // フォローを実行する関数を呼び出す
                    } else if (followStatusText === "フォロー中") {
                        unfollow(userId); // アンフォローを実行する関数を呼び出す
                    }
                }
                  
                  function followadd(userId){
                    $.ajax({
                      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                      url: `/follow/${userId}`,
                      type: "POST",
                    })
                    .done((data) => {
                        {{--$(button).text("フォロー中");--}}
                          
                        $(`#follow-status-${userId}`).text("フォロー中");
                        
                    })
                    .fail((data) => {
                        console.log(data);
                    });
                  }
                
                
                function unfollow(userId){
                    $.ajax({
                      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                      url: `/follow/${userId}/destroy`,
                      type: "POST",
                    })
                    .done((data) => {
                        {{--$(button).text("フォロー中");--}}
                          
                        $(`#follow-status-${userId}`).text("フォローする");
                        
                    })
                    .fail((data) => {
                        console.log(data);
                    });
                  }
                
            
                </script>
    </body>
    
</html>