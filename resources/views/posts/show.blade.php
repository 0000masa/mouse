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
        <a href="/users/{{ $article->user->id }}">{{ $article->user->name }}</a>
        @if (Auth::check() && $article->user_id === Auth::user()->id)
        <div class='edit'>
            <a href="/posts/{{$article->id}}/edit">編集</a>
        </div>
        @endif
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
        @if($article->user_id != Auth::id())
           <like :article_id="{{$article->id}}"></like>
        @endif
        <div class="footer">
            <a href="{{ back()->getTargetUrl() }}" class="btn btn-primary">戻る</a>
        </div>
        
        <template>
             <div>
            1  <button v-if="status == false" type="button" @click.prevent="like" class="btn btn-outline-warning">Like</button>
               <button v-else type="button" @click.prevent="like" class="btn btn-warning">Liked</button>
             </div>
        </template>
            
            <script>
            export default {
             props: ['article_id'],      
             data() {
               return {
                 status: false,
               }
             },
             created() {
               this.like_check()      2
             },
             methods: {
               like_check() {
                 const id = this.article_id
                 const array = ["/posts/",id,"/check"];
                 const path = array.join('')
                 axios.get(path).then(res => {
                   if(res.data == 1) {
                     this.status = true
                   } else {
                     this.status = false
                   }
                 }).catch(function(err) {
                   console.log(err)
                 })
               },
               like() {                         3
                 const id = this.article_id
                 const array = ["/posts/",id,"/likes"];
                 const path = array.join('')
                 axios.post(path).then(res => {
                   this.like_check()
                 }).catch(function(err) {
                   console.log(err)
                 })
               }
             }
            }
            </script>
        
    </body>
    </x-app-layout>
</html>