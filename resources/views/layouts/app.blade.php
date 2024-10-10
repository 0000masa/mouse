<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="ゲーミングマウスを投稿して比較する">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!--ここから追加-->
        <scpipt crossorigin: "anonymous", integrity: "sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7", src: "https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script
          src="https://code.jquery.com/jquery-3.6.0.min.js"
          integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
          crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <!--ここまで追加-->
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        {{--<script src="https://cdn.tailwindcss.com"></script>--}}
    </head>
    <body class="font-sans antialiased">
        

        <div class="min-h-screen bg-gray-100">
            {{--@include('layouts.navigation')--}}

            <!-- Page Heading -->
            @if (isset($header))
            <header class="text-gray-600 body-font">
            
            @auth    
            @include('layouts.navigation')
            @endauth
            
            {{--
            @guest
            @include('layouts.guestheader')
            @endguest
            --}}
                    {{--<div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
                   
                    
                      <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
                        
                        
                             
                         <a href="/searches" class="mr-5 text-indigo-800 hover:text-blue-400">マウス検索</a>
                         <a href="/usersearches" class="mr-5 text-indigo-800 hover:text-blue-400">ユーザー検索</a>
                         <a href="/posts/create" class="mr-5 text-indigo-800 hover:text-blue-400">新規投稿作成</a>
                         <a href="/follow/{{Auth::user()->id}}" class="mr-5 text-indigo-800 hover:text-blue-400">フォローしたユーザーの投稿</a>
                       
                      </nav>
                  
                     </div>--}}
                      
                       
                  
            </header>    
            @endif
           
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
