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
             
        </x-slot>
        <div class="bg-white py-6 sm:py-8 lg:py-12">
            <div class="mx-auto max-w-screen-md px-4 md:px-8">
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl xl:mb-12">フォローしてるユーザー</h2>
                    {{--<div class="mb-4 flex items-center justify-between border-t border-b py-4">--}}
                        <div class="divide-y"> 
            
                            @foreach($followusers as $followuser)
                                <div class='flex flex-col gap-3 py-4 md:py-8'>
                                    <div class="block font-bold">
                                        <p class="block text-sm text-gray-500">ユーザー:
                                        <a class="text-lg font-bold text-gray-800 lg:text-xl" href="/users/{{ $followuser->id }}">{{ $followuser->name }}</a></p>
                                    </div>
                                </div>
                            @endforeach
                      
                        
                           <div class='paginate'>
                                {{ $followusers->links() }}
                            </div>
                             <a href="{{ back()->getTargetUrl() }}" class="text-indigo-800 hover:text-blue-400">戻る</a></br>
                        </div>
                    {{--/div>--}}
            </div>
        </div>
        </x-app-layout>
    </body>
</html>