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
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl xl:mb-12">フォローしたユーザーの投稿</h2>
                  
                 <div class="divide-y">
                            @foreach($articles as $article)
                                <div class='flex flex-col gap-3 py-4 md:py-8'>
                                    <div class="block font-bold">
                                        <a class="block text-base font-bold" href="/users/{{ $article->user->id }}">{{ $article->user->name }}</a>
                                         <a class="block text-base font-bold" href="/posts/{{ $article->id }}"><h2 class='product'>{{$article->product}}</h2></a>
                                        
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
         </x-app-layout>
         
     </body>
    
</html>