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
            <h1>フォロワー</h1>
                <div class='posts'>
                    @foreach($followerusers as $followeruser)
                        <div class='post'>
                            <a href="/users/{{ $followeruser->id }}">{{ $followeruser->name }}</a>
                             
                            
                        </div>
                    @endforeach
              
                </div>
               <div class='paginate'>
                    {{ $followerusers->links() }}
                </div>
                
                </x-app-layout>
    </body>
</html>