<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-blue-400 p-4">
                  <nav class="flex justify-between mx-auto container items-center">
                    <div>ログインユーザー:<a href="/users/{{ Auth::id() }}">{{ Auth::user()->name }}</a></div>
                    <div class="space-x-12 font-bold">
                         
                         <a href="/searches" class="hover:text-green-200 transition-all duration-300">マウス検索</a>
                         <a href="/posts/create" class="hover:text-green-200 transition-all duration-300">新規投稿作成</a>
                         <a href="/follow/{{Auth::user()->id}}" class="hover:text-green-200 transition-all duration-300">フォローした人の投稿</a>
                        {{ $header }}
                    </div>
                  </nav>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
