<x-app-layout>
         <x-slot name="header">
             
        </x-slot>
         <div class="bg-white py-6 sm:py-8 lg:py-12">
            <div class="mx-auto max-w-screen-md px-4 md:px-8">
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl xl:mb-12">すべてのコメント</h2>
                     {{--<div class="mb-4 flex items-center justify-between  py-4">--}}
                        <div class="divide-y"> 
                             @foreach($comments as $comment)
                                            <div class='flex flex-col gap-3 py-4 md:py-8'>
                                                <div class="block font-bold">
                                                    <p class="text-lg font-bold text-gray-800 lg:text-xl">{{$comment->created_at}}</p>
                                                    <a class="text-lg font-bold text-gray-800 lg:text-xl" href="/users/{{ $comment->user->id }}">{{ $comment->user->name }}さん</a>
                                                    <p class="text-lg font-bold text-gray-800 lg:text-xl">{{$comment->comment}}</p>
                                                    @if (Auth::check() && $comment->user_id === Auth::user()->id)
                                                    <form action="/comment/{{ $comment->id }}" method="post">
                                                        <input type="hidden" name="article_id" value="{{ $comment->article_id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-block rounded-lg bg-red-500 px-2 py-1 text-center text-sm  text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base">削除</button> 
                                                    </form>
                                                    @endif
                                                </div>
                                            </div>
                                @endforeach
                                <a href="/posts/{{$article->id}}" class="text-indigo-800 hover:text-blue-400">戻る</a></br>
                                <div class='paginate'>
                                        {{ $comments->links() }}
                                </div>
            </div>
        </div>
</x-app-layout>