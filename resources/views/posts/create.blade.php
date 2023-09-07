<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <x-app-layout>
         <x-slot name="header">
             
        </x-slot>
        <div class="bg-white py-6 sm:py-8 lg:py-12">
            <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
                <div class="mb-10 md:mb-16">
                    <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-6 lg:text-3xl">新規投稿作成</h2>
                </div>
                <form class="mx-auto grid max-w-screen-md gap-4 sm:grid-cols-2" action="/posts" method="POST"enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="post[user_id]" value="{{ Auth::user()->id }}">
                    <div class="product">
                        <h2 class="mb-2 inline-block text-sm text-gray-800 sm:text-base">マウス名(50字まで)<span class="text-red-500 text-xs">必須</span></h2>
                        <input type="text" name=post[product] class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" value="{{ old('post.product') }}"/>
                        <p class="product__error" style="color:red">{{ $errors->first('post.product') }}</p>
                    </div>
                    <div class="price">
                        <h2 class="mb-2 inline-block text-sm text-gray-800 sm:text-base">金額(円)<span class="text-red-500 text-xs">必須</span></h2>
                        <input type="number" name=post[price]  class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" value="{{ old('post.price') }}"/>
                        <p class="price__error" style="color:red">{{ $errors->first('post.price') }}</p>
                    </div>
                    <div class="weight">
                        <h2 class="mb-2 inline-block text-sm text-gray-800 sm:text-base">重さ(ｇ)</h2>
                        <input type="number" name=post[weight] class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" value="{{ old('post.weight') }}"/>
                        <p class="weight__error" style="color:red">{{ $errors->first('post.weight') }}</p>
                    </div>
                    <div class="maximum_dpi">
                        <h2 class="mb-2 inline-block text-sm text-gray-800 sm:text-base">最大DPI</h2>
                        <input type="number" name=post[maximum_dpi] class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" value="{{ old('post.maximum_dpi') }}"/>
                        <p class="maximum_dpi__error" style="color:red">{{ $errors->first('post.maximum_dpi') }}</p>
                    </div>
                     <div class="buttons">
                        <h2 class="mb-2 inline-block text-sm text-gray-800 sm:text-base">ボタン数(左右クリックとホイールボタンの3つを含む)</h2>
                        <input type="number" name=post[buttons] class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring" value="{{ old('post.buttons') }}"/>
                        <p class="buttons__error" style="color:red">{{ $errors->first('post.buttons') }}</p>
                    </div>
                    <div class="manufacture">
                        <h2 class="mb-2 inline-block text-sm text-gray-800 sm:text-base">製造メーカー</h2>
                        <select name="post[manufacture_id]" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                            @foreach($manufactures as $manufacture)
                                <option value="{{ $manufacture->id }}" 
                                @if (old('post.manufacture_id')==$manufacture->id)
                                    selected 
                                @endif
                                >
                                    {{ $manufacture->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="connection">
                        <h2 class="mb-2 inline-block text-sm text-gray-800 sm:text-base">接続方式</h2>
                        <select name="post[connection_id]" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                            @foreach($connections as $connection)
                                <option value="{{ $connection->id }}" 
                                @if (old('post.connection_id')==$connection->id)
                                    selected 
                                @endif>
                                    {{ $connection->name }}</option>
                            @endforeach
                        </select>
                    </div>
                     <div class="battery">
                        <h2>使用電池</h2>
                        <select name="post[battery_id]" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                            @foreach($batteries as $battery)
                                <option value="{{ $battery->id }}" 
                                @if (old('post.battery_id')==$battery->id)
                                    selected  
                                @endif>
                                    {{ $battery->battery }}</option>
                            @endforeach
                        </select>
                    </div>
                     <div class="evaluation">
                        <h2 class="mb-2 inline-block text-sm text-gray-800 sm:text-base">評価</h2>
                        <select name="post[evaluation_id]" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                            @foreach($evaluations as $evaluation)
                                <option value="{{ $evaluation->id }}" 
                                @if (old('post.evaluation_id')==$evaluation->id)
                                    selected
                                @endif>
                                    {{ $evaluation->level }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class=sm:col-span-2>
                        <h2 class="mb-2 inline-block text-sm text-gray-800 sm:text-base">説明(200字まで)<span class="text-red-500 text-xs">必須</span></h2>
                        <textarea name="post[explanation]" class="h-64 w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">{{ old('post.explanation') }}</textarea>
                        <p class="explanation__error" style="color:red">{{ $errors->first('post.explanation') }}</p>
                    </div>
                    <div class=sm:col-span-2>
                        <h2 class="mb-2 inline-block text-sm text-gray-800 sm:text-base">画像</h2>
                        <input type="file" name="post[image_url]"  id="imageInput" class="w-full rounded border bg-gray-50  text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">
                        <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 100%; max-height: 300px;"　>
                         <p class="image__error" style="color:red">{{ $errors->first('post.image_url') }}</p>
                    </div>
                    
                    
                    <div class="flex items-center justify-between sm:col-span-2">
                        <button class="inline-block rounded-lg bg-indigo-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base">投稿</button>
                    </div>
                </form>
            </div>
        </div>
           
        <script>
          const imageInput = document.getElementById('imageInput');
          const imagePreview = document.getElementById('imagePreview');
        
          imageInput.addEventListener('change', function () {
            const file = imageInput.files[0];
            if (file) {
              const reader = new FileReader();
              reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
              };
              reader.readAsDataURL(file);
            } else {
              imagePreview.src = '#';
              imagePreview.style.display = 'none';
            }
          });
        </script>

        </x-app-layout>
    </body>
</html>