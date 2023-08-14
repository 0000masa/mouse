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
  
  
        <a href="/users/{{ $article->user->id }}">{{ $article->user->name }}</a>
        @if (Auth::check() && $article->user_id === Auth::user()->id)
        <div class='edit'>
            <a href="/posts/{{$article->id}}/edit">編集</a>
        </div>
        @endif
        
        <div class="footer">
            <a href="{{ back()->getTargetUrl() }}" class="btn btn-primary">戻る</a>
        </div>
        
        <h1 class="product">
            {{$article->product}}
        </h1>
        <div>
                <img src="{{ $article->image_url }}" alt="画像が読み込めません。"/>
                
        </div>
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
               接続方式<br>
                {{ $article->connection->name }}
           </p>
       </div>
       <div>
           <p>
               使用電池<br>
                {{ $article->battery->battery }}
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
        
        <div class="comment">コメント一覧</div>
        {{--
         @php
         $comments=$article->comments()->paginate(10);
         @endphp
         @if($comments->isEmpty())
            <p>コメントはありません</p>
        @else
             @foreach($comments as $comment)
                        <div class='post'>
                            <p>{{$comment->created_at}}</p>
                            <a href="/users/{{ $comment->user->id }}">{{ $comment->user->name }}</a>
                            <p>{{$comment->comment}}</p>
                            <form action="/comment/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post">
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deletePost({{ $comment->id }})">削除</button> 
                            </form>
                        </div>
            @endforeach
        @endif
        
           
         <div class='paginate'>
                    {{ $comments->links() }}
                </div>
        --}}
       
        <div id="comment-data">
            
        </div>
            <form id="comment-form" method="POST" action="/comment">
                @csrf
                <input type="hidden" name="post[user_id]" value="{{ Auth::user()->id }}">
                <input type="hidden" name="post[article_id]" value="{{ $article->id }}">
                <textarea name="post[comment]"></textarea>
                <button type="submit">コメントする</button>
                <p class="comment__error" style="color:red">{{ $errors->first('post.comment') }}</p>
            </form>
        </div>
        
         <a href="/comment/{{$article->id}}">すべてのコメントを見る</a>
        
        
        {{--<script>
             $(document).ready(function() {
                $(".delete-button").on("click", function() {
                    event.preventDefault(); //追加
                    const commentId = $(this).data("comment-id");
                    const deleteUrl = "/comment/" + commentId;
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
                        success: function(response) {
                            get_data(articleId);
                            // コメントの削除に成功した場合、対応するフォームを非表示にする
                            $("#form_" + commentId).hide();
                            // または、ページをリロードしてコメントが消えるのを確認する場合は以下の行をコメントインして使用
                            // location.reload();
                        },
                        error: function(xhr) {
                            alert("コメントの削除に失敗しました");
                        }
                    });
                });
            });
        </script>--}}
       
       
        
        <script>
        　const articleId = {{$article->id}};
        　
        　 
        　
           const get_data = (articleId) => {
                $.ajax({
                    url: "result/ajax/" +articleId,
                    dataType: "json",
                    success: data => {
                        $("#comment-data")
                            .find(".comment-visible")
                            .remove();
                             
                        for (var i = 0; i < data.comments.length; i++) {
                        
                        
                        
                           
                            const html = `
                           
                                        <div class="media comment-visible">
                                    
                                            
                                            <div class="media-body comment-body">
                                                <div class="row">
                                                    
                                                    <a href="/users/${data.comments[i].user_id}">${data.comments[i].name}</a>
                                                    
                                                </div>
                                                <span class="comment-body-content" id="comment">${data.comments[i].comment}</span>
                                                <form action="/comment/${data.comments[i].id}" id="form_${data.comments[i].id}" method="post">
                                                    <input type="hidden" name="article_id" value="{{$article->id}}">
                                                        
                                                        @csrf
                                                        @method('DELETE')
                                                    <button  type="button" class="delete-button" data-comment-id="${data.comments[i].id}">削除</button> 
                                                </form>
                                                
                                            </div>
                                        </div>
                                        
                                       
                                        
        
                  
                   
                                    `;
                        
                       {{-- @foreach($comments as $comment)
                        <div class='post'>
                            <p>{{$comment->created_at}}</p>
                            <a href="/users/{{ $comment->user->id }}">{{ $comment->user->name }}</a>
                            <p>{{$comment->comment}}</p>
                            <form action="/comment/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post">
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deletePost({{ $comment->id }})">削除</button> 
                            </form>
                        </div>
            @endforeach--}}
                       
        
                $("#comment-data").append(html);
                      
                    
                           
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
             $(document).ready(function() {
                $(".delete-button").on("click", function(event) {
                    event.preventDefault(); //追加
                    const commentId = $(this).data("comment-id");
                    const deleteUrl = "/comment/" + commentId;
                    const formData = { article_id: "{{ $article->id }}",
                                        comment_id: commentId
                                        };
        
                    // Ajaxリクエストを送信してコメントを削除
                    $.ajax({
                        url: deleteUrl,
                        data:  formData ,
                        type: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        },
                        success: function(response) {
                            get_data(articleId);
                            // コメントの削除に成功した場合、対応するフォームを非表示にする
                            $("#form_" + commentId).hide();
                            // または、ページをリロードしてコメントが消えるのを確認する場合は以下の行をコメントインして使用
                            // location.reload();
                        },
                        error: function(xhr) {
                            alert("コメントの削除に失敗しました");
                        }
                    });
                });
            });
        </script>
             
             
    
            
        
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
           
        @auth
          <!-- Review.phpに作ったisLikedByメソッドをここで使用 -->
          @if (!$article->isLikedBy(Auth::user()))
            <span class="likes">
                <i class="fas fa-music like-toggle" data-review-id="{{ $article->id }}"></i>
              <span class="like-counter">{{$article->likes_count}}</span>
            </span><!-- /.likes -->
          @else
            <span class="likes">
                <i class="fas fa-music heart like-toggle liked" data-review-id="{{ $article->id }}"></i>
              <span class="like-counter">{{$article->likes_count}}</span>
            </span><!-- /.likes -->
          @endif
        @endauth
        @guest
          <span class="likes">
              <i class="fas fa-music heart"></i>
            <span class="like-counter">{{$article->likes_count}}</span>
          </span><!-- /.likes -->
        @endguest
        
       
        
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
       </x-app-layout>
    </body>
    
</html>