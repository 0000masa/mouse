<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
         <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        
        
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
        .liked {
             color: pink;
        }
        </style>
    </head>
    
   
    <body>
       <x-app-layout>
         <x-slot name="header">
            
        </x-slot>
  　　  　<div class="bg-white py-6 sm:py-8 lg:py-12">
            <div class="mx-auto max-w-screen-md px-4 md:px-8">
                {{--<div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 lg:gap-12">--}}
                    <div>
                        <div class="rounded-lg border p-4">
                             <h2 class="mb-3 text-lg font-bold text-gray-800 lg:text-xl">画像</h2>
                              <div class="mb-0.5 flex items-center gap-2">
                                @if(isset($article->image_url)) 
                                <img src="{{ $article->image_url }}" style=" max-width: 100%; max-height: 300px;"　alt="画像が読み込めません。"/>  
                                @else
                                    <p class="text-xl">画像はありません。</p>
                                @endif  
                              </div>
                              <div class="mt-6 mb-0.5 flex items-center gap-2">
                              @auth
                                  <!-- Review.phpに作ったisLikedByメソッドをここで使用 -->
                                  @if (!$article->isLikedBy(Auth::user()))
                                    <span class="likes">
                                        いいね
                                        <i class="fas fa-heart like-toggle" data-review-id="{{ $article->id }}"></i>
                                      <span class="like-counter">{{$article->likes_count}}</span>
                                    </span><!-- /.likes -->
                                  @else
                                    <span class="likes">
                                        いいね
                                        <i class="fas fa-heart heart like-toggle liked" data-review-id="{{ $article->id }}"></i>
                                      <span class="like-counter">{{$article->likes_count}}</span>
                                    </span><!-- /.likes -->
                                  @endif
                                @endauth
                                @guest
                                  <span class="likes">
                                      <i class="fas fa-heart heart"></i>
                                    <span class="like-counter">{{$article->likes_count}}</span>
                                  </span><!-- /.likes -->
                                @endguest
                                </div>
                        </div>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="divide-y">
                            <div class="flex flex-col gap-3 py-4 md:py-8">
                                <div class="flex items-center gap-10">
                                    @if (Auth::check() && $article->user_id === Auth::user()->id)
                                    <div class='edit'>
                                        <a href="/posts/{{$article->id}}/edit" class="text-indigo-800 hover:text-blue-400">編集</a>
                                    </div>
                                    @endif
                                    <div>
                                        <a  href="{{ back()->getTargetUrl() }}" class="text-indigo-800 hover:text-blue-400">戻る</a>
                                    </div>
                              　</div>
                                <div class="border-b pb-4 md:pb-6 my-1 whitespace-nowrap">
                                      <p class="block text-sm text-gray-500 ">マウス:
                                      <span class="text-lg font-bold text-gray-800 lg:text-xl ">{{$article->product}}</span></p>
                                </div>
                                <div class="border-b pb-4 md:pb-6 my-1">
                                    <p class="block text-sm text-gray-500">ユーザー:
                                    <a class="text-lg font-bold text-gray-800 lg:text-xl" href="/users/{{ $article->user->id }}">{{ $article->user->name }}</a></p>
                                </div>
                                <div class="border-b pb-4 md:pb-6 my-1">
                                     <p class="block text-sm text-gray-500">評価:
                                     <span class="text-lg font-bold text-gray-800 lg:text-xl">{{ $article->evaluation->level }}</span></p>
                               </div>
                               <div class="border-b pb-4 md:pb-6 my-1">
                                   <p class="block text-sm text-gray-500">値段:
                                   <span class="text-lg font-bold text-gray-800 lg:text-xl">{{ $article->price }}円</span></p>
                               </div>
                                <div  class="border-b pb-4 md:pb-6 my-1">
                                   <p class="block text-sm text-gray-500">接続方式:
                                   <span class="text-lg font-bold text-gray-800 lg:text-xl">{{ $article->connection->name }}</span></p>
                               </div>
                               <div class="border-b pb-4 md:pb-6 my-1">
                                   <p class="block text-sm text-gray-500">使用電池:
                                   <span class="text-lg font-bold text-gray-800 lg:text-xl">{{ $article->battery->battery }}</span></p>
                               </div>
                               @if(isset($article->weight))
                               <div class="border-b pb-4 md:pb-6 my-1">
                                   <p class="block text-sm text-gray-500">重さ:
                                   <span class="text-lg font-bold text-gray-800 lg:text-xl">{{ $article->weight }}g</span></p>
                               </div>
                               @endif
                               @if(isset($article->maximum_dpi))
                                <div class="border-b pb-4 md:pb-6 my-1">
                                   <p class="block text-sm text-gray-500">最大dpi:
                                   <span class="text-lg font-bold text-gray-800 lg:text-xl">{{ $article->maximum_dpi }}</span></p>
                               </div>
                               @endif
                            　 @if(isset($article->buttons))
                               <div class="border-b pb-4 md:pb-6 my-1">
                                   <p class="block text-sm text-gray-500">ボタン数:
                                   <span class="text-lg font-bold text-gray-800 lg:text-xl">{{ $article->buttons }}</span></p>
                               </div>
                               @endif
                               <div class="border-b pb-4 md:pb-6 my-1">
                                   <p class="block text-sm text-gray-500">メーカー:
                                   <span class="text-lg font-bold text-gray-800 lg:text-xl">{{ $article->manufacture->name }}</span></p>
                               </div>
                                <div class="border-b pb-4 md:pb-6 my-1">
                                    <p class="block text-sm text-gray-500">説明</p> 
                                    <p class="text-lg font-bold text-gray-800 lg:text-xl">{{ $article->explanation }}</p>   
                                </div>
                                
                                <div class="border-b pb-4 md:pb-6 my-4 ">
                                    <p class="text-xl mt-20">コメント一覧</p>
                                     <div  id="comment-data"></div>
                                </div>
                                
                                
                              
                                
                                <div>
                                    <form id="comment-form" method="POST" action="/comment">
                                        @csrf
                                        <input type="hidden" name="post[user_id]" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="post[article_id]" value="{{ $article->id }}">
                                        <textarea name="post[comment]" class="w-full " rows="4"></textarea >
                                        <button type="submit" class="px-6 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">コメントする</button>
                                        <p class="comment__error" style="color:red">{{ $errors->first('post.comment') }}</p>
                                    </form>
                                </div>
                              
                                <div>
                                    <a class="text-red-500 hover:text-yellow-700" href="/comment/{{$article->id}}">すべてのコメントを見る</a>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                  {{--</div>--}}
            </div>
      </div> 
        
        
       
       
       
        
        <script>
       
        
        　const articleId = {{$article->id}};
        
        　 
        　
           const get_data = (articleId) => {
                $.ajax({
                    url: "result/ajax/" +articleId,
                    dataType: "json",
                    success: data => {
                        {{--$("#comment-data")
                            .find(".comment-visible")
                            .remove();--}}
                            $("#comment-data")
                           $("#media\\ comment-visible").remove();
                            
                             
                        for (var i = 0; i < data.comments.length; i++) {
                        
                        
                        
                           
                            let html = `
                           
                                        {{--<div class="media comment-visible">--}}
                                       <div id="media comment-visible" class="border-b pb-4 md:pb-6 my-1">
                                            
                                            <div class="media-body comment-body">
                                                <div class="row">
                                                    
                                                    <a  href="/users/${data.comments[i].user_id}">${data.comments[i].name}さん</a>
                                                    
                                                </div>
                                                <span class="comment-body-content" id="comment">${data.comments[i].comment}</span>
                                               
                                                
                                               
                                                
                                            </div>
                                        </div>
                                        
                                       
                                        
        
                  
                   
                                    `;
                        
                     
                       
        
                 $("#comment-data").append(html);
                {{--$(`#comment-data${i}`).append(html);--}}      
                    
                           
                        }
                    },
                    error:()=>{
                        alert("ajaxが失敗しました");
                    }
                });
            } 
              document.addEventListener("DOMContentLoaded", () => {
                get_data(articleId);
            });
            </script>
            
            <script>
             $(document).ready(function() {
                $(".delete-button").click({{--"click"--}} function(event) {
                    console.log('test')
                    {{--event.preventDefault(); //追加--}}
                    const commentId = $(this).data("comment-id");
                    const deleteUrl = `/comment/${commentId}`;
                    const articleId = "{{ $article->id }}"
                    const formData = { article_id: "{{ $article->id }}",
                                        comment_id: commentId
                                        };
        
                    // Ajaxリクエストを送信してコメントを削除
                    $.ajax({
                        url: deleteUrl,
                        data: JSON.stringify({ post: formData }),
                        type: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        },
                        success:()=>{
                            get_data(articleId);
                            // コメントの削除に成功した場合、対応するフォームを非表示にする
                            //$("#form_" + commentId).hide();
                            // または、ページをリロードしてコメントが消えるのを確認する場合は以下の行をコメントインして使用
                        　　//location.reload();
                        },
                        error: function(xhr) {
                            alert("コメントの削除に失敗しました");
                        }
                    });
                });
            });
        
            
            $(function() {
              
                          $('.btn-danger').on('click', function() {
                            
           
                                
                                  var clickEle = $(this)
           
            
                                  var commentID = clickEle.attr('data-comment_id');
                                  var articleId = "{{ $article->id }}";  
                                     
                          $.ajax({
                             type: 'POST',
                             url: '/destroy/'+commentID, 
                             dataType: 'json',
                             data: {'id':commentID},
                                      
                            success: function() {
                    
                            
                                get_data(articleId);
                                
                                
                            },
                            error: function() {
                                alert("失敗しました");
                            }
            
                        });
                        
                  });
            });
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
             $("#comment-form").submit(event => {
            event.preventDefault(); // フォームの通常の送信をキャンセル
             const commentContent = $("textarea[name='post[comment]']").val();
            if (!commentContent.trim()) {
                // コメントが空の場合はエラーメッセージを表示
                alert("コメントを入力してください");
                return;
            }
            const formData = {
                comment: commentContent,
                article_id: "{{ $article->id }}",
                user_id:"{{ Auth::user()->id }}"
            };
            
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }, 
                type: "POST",
                url: "/comment",
                data: JSON.stringify({ post: formData }),
                contentType: "application/json",
                dataType: "json",
                success: () => {
                    // コメント投稿成功後にコメントを取得して表示
                    get_data(articleId);
                    
                   
                    // コメントテキストエリアをクリア
                    $("textarea[name='post[comment]']").val("");
                },
                error: () => {
                    alert("コメントの投稿に失敗しました");
                }
            });
            })
            
           
            </script>
            
       
             
             
    
            
        
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
       
       
        
        <script>
            $(function () {
          let like = $('.like-toggle'); //like-toggleのついたiタグを取得し代入。
          let likeReviewId; //変数を宣言（なんでここで？）
          like.on('click', function () { //onはイベントハンドラー
            let $this = $(this); //this=イベントの発火した要素＝iタグを代入
            likeReviewId = $this.data('review-id'); //iタグに仕込んだdata-review-idの値を取得
            //ajax処理スタート
            $.ajax({
              headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
              },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
              url: '/like', //通信先アドレスで、このURLをあとでルートで設定します
              method: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
              data: { //サーバーに送信するデータ
                'article_id': likeReviewId //いいねされた投稿のidを送る
              },
            })
            //通信成功した時の処理
            .done(function (data) {
              $this.toggleClass('liked'); //likedクラスのON/OFF切り替え。
              $this.next('.like-counter').html(data.review_likes_count);
            })
            //通信失敗した時の処理
            .fail(function () {
              console.log('fail'); 
            });
          });
          });
          
          
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            let likeReviewId={{$article->id}};
                $.ajax({
              headers: { 
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
              },  
              url: '/like/count', 
              method: 'POST', 
              data: { 
                'article_id': likeReviewId 
              },
            })
            .done(function (data) {
              
               document.querySelector('.like-counter').innerHTML = data.review_likes_count;
            })
            
            .fail(function () {
              console.log('fail'); 
            });
            });
            
        </script>
       </x-app-layout>
    </body>
    
</html>