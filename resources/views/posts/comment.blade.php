<x-app-layout>
         <x-slot name="header">
             
        </x-slot>
        
         <a href="/posts/{{$article->id}}" class="btn btn-primary">戻る</a></br>
        全てのコメント
         @foreach($comments as $comment)
                        <div class='post'>
                            <p>{{$comment->created_at}}</p>
                            <a href="/users/{{ $comment->user->id }}">{{ $comment->user->name }}</a>
                            <p>{{$comment->comment}}</p>
                            @if (Auth::check() && $comment->user_id === Auth::user()->id)
                            <form action="/comment/{{ $comment->id }}" method="post">
                                <input type="hidden" name="article_id" value="{{ $comment->article_id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">削除</button> 
                            </form>
                            @endif
                        </div>
            @endforeach
            <div class='paginate'>
                    {{ $comments->links() }}
            </div>
        
</x-app-layout>