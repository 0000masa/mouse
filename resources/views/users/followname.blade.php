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
        <a href="{{ back()->getTargetUrl() }}" class="btn btn-primary">戻る</a></br> 
            <h1>フォローしてるユーザー</h1>
               
                <div class='posts'>
                    @foreach($followusers as $followuser)
                        <div class='post'>
                            <a href="/users/{{ $followuser->id }}">{{ $followuser->name }}</a>
                             
                            
                        </div>
                    @endforeach
              
                </div>
               <div class='paginate'>
                    {{ $followusers->links() }}
                </div>
                
                </x-app-layout>
    </body>
</html>