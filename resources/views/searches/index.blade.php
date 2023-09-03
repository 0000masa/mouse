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
                <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
                    <div class="mb-10 md:mb-16">
                      <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">マウス検索</h2>
                    </div>
        
                    <form action="/searches/do" method="GET" class="mx-auto grid max-w-screen-md gap-4 sm:grid-cols-2">
                    @csrf
        
                    
                        <div>
                            <label for="" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">マウス名 </label>
                            <input type="text" name="product"  class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                        </div>
        
                        <div>
                            <label for="" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">メーカー </label>
                            <select name="manufacture" data-toggle="select" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                                <option value="" >全て</option>
                                 @foreach($manufactures as $manufacture)
                                    <option value="{{ $manufacture->id }}">{{ $manufacture->name }}</option>
                                 @endforeach
                            </select>
                        </div>
        
                        <div>
                            <label for="" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">接続方式 </label>
                            <select name="connection" data-toggle="select" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                                <option value="">全て</option>
                                @foreach($connections as $connection)
                                    <option value="{{ $connection->id }}">{{ $connection->name }}</option>
                                @endforeach
                            </select>
                        </div>
        
                        <div>
                            <label for="" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">使用電池 </label>
                            <select name="battery" data-toggle="select" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                                <option value="">全て</option>
                                @foreach($batteries as $battery)
                                    <option value="{{ $battery->id }}">{{ $battery->battery }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">評価 </label>
                            <select name="evaluation" data-toggle="select" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                                <option value="">全て</option>
                                @foreach($evaluations as $evaluation)
                                    <option value="{{ $evaluation->id }}">{{ $evaluation->level }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="flex items-center justify-between sm:col-span-2">
                            <button class="inline-block rounded-lg bg-indigo-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base">検索</button>
                        </div>
                            
                    </form>
                </div>
            </div>
                
        </x-app-layout>
    </body>
</html>