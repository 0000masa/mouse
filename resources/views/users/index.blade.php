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
         <div class="bg-white py-6 sm:py-8 lg:py-12">
            <div class="mx-auto max-w-screen-md px-4 md:px-8">
                <div class="max-w-2xl px-8 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
                     <div class="flex items-center justify-between">
                         <div>
                            <p>ユーザー名: <span class="text-base font-bold">{{$user->name}}</span></p>
                         </div>
                         <div>
                            @if(Auth::check() && Auth::user()->id !== $user->id)
                                @if(Auth::user()->follows->contains($user->id))
                                <button  class="px-6 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80" onclick="follow({{ $user->id }})"><span id="follow-status-{{ $user->id }}">フォロー中</span></button>
                                @else
                                <button  class="px-6 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80" onclick="follow({{ $user->id }})"><span id="follow-status-{{ $user->id }}">フォローする</span></button>
                                @endif
                            @endif
                         </div>
                        
                    </div>
                    
                 
                     <div class="flex ">
                        <p><a href="/follow/follows/{{$user->id}}">{{ $user->follows()->count();}}フォロー</a></p> 　
                        <p id="follower-count-{{ $user->id }}">
                            <a href="/follow/followers/{{$user->id}}">
                                <span id="follower-number-{{ $user->id }}">{{ $user->followers()->count();}}</span>フォロワー
                            </a>
                        </p></br>
                     </div>
                
               
                 
            </div>
                  
                
                
                {{--<div class="bg-white py-6 sm:py-8 lg:py-12">
                    <div class="mx-auto max-w-screen-md px-4 md:px-8">--}}
                    @if(count($articles) > 0)
                             <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl xl:mb-12">{{ $articles[0]->user->name }}さんの投稿</h2>
                    @else         
                    投稿はありません        
                    @endif
                        <div class="mb-4 flex items-center justify-between border-t border-b py-4">
                    
                            <div class='divide-y'>
                                @foreach($articles as $article)
                                <div class="flex flex-col gap-3 py-4 md:py-8">
                                    <div class='block font-bold'>
                                         <a class="block text-base font-bold" href="/posts/{{ $article->id }}">{{$article->product}}</a>
                                        
                                        <p class='text-gray-600'>{{$article->explanation}}</p>
                                        
                                    </div>
                                </div>
                                @endforeach
                          
                            </div>
                           <div class='paginate'>
                                {{ $articles->links() }}
                            </div>
                        </div>
            </div>
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
                        updateFollowerCount(userId)
                        
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
                        updateFollowerCount(userId)
                        
                    })
                    .fail((data) => {
                        console.log(data);
                    });
                  }
                
                
                
                
                
                function updateFollowerCount(userId) {
                $.ajax({
                    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                    url: `/follower/count/${userId}`,
                    type: "POST",
                })
                .done((data) => {
                    //$(`#follower-count-${userId}`).text(`${data.follower_count}フォロワー`);
                     $(`#follower-number-${userId}`).text(data.follower_count);
                })
                 
                .fail((data) => {
                    console.log(data);
                });
            }
                </script>
                
                
    </body>
    
</html>