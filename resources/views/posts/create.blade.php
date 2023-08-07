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
        <form action="/posts" method="POST"enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="post[user_id]" value="{{ Auth::user()->id }}">
            <div class="product">
                <h2>マウス名(必須)</h2>
                <input type="text" name=post[product]  value="{{ old('post.product') }}"/>
                <p class="product__error" style="color:red">{{ $errors->first('post.product') }}</p>
            </div>
            <div class="price">
                <h2>金額(必須)</h2>
                <input type="number" name=post[price]  value="{{ old('post.price') }}"/>
                <p class="price__error" style="color:red">{{ $errors->first('post.price') }}</p>
            </div>
            <div class="weight">
                <h2>重さ(必須)</h2>
                <input type="number" name=post[weight]  value="{{ old('post.weight') }}"/>
                <p class="weight__error" style="color:red">{{ $errors->first('post.weight') }}</p>
            </div>
            <div class="maximum_dpi">
                <h2>最大DPI(任意)</h2>
                <input type="number" name=post[maximum_dpi]  value="{{ old('post.maximum_dpi') }}"/>
                <p class="maximum_dpi__error" style="color:red">{{ $errors->first('post.maximum_dpi') }}</p>
            </div>
             <div class="buttons">
                <h2>ボタン数(左右クリックとホイールボタンの3つを含む (任意))</h2>
                <input type="number" name=post[buttons]  value="{{ old('post.buttons') }}"/>
                <p class="buttons__error" style="color:red">{{ $errors->first('post.buttons') }}</p>
            </div>
            <div class="manufacture">
                <h2>製造メーカー</h2>
                <select name="post[manufacture_id]">
                    @foreach($manufactures as $manufacture)
                        <option value="{{ $manufacture->id }}" 
                        @if (old('post.manufacture_id')==$manufacture->id)
                            selected 
                        @endif>
                            {{ $manufacture->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="connection">
                <h2>接続方式</h2>
                <select name="post[connection_id]">
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
                <select name="post[battery_id]">
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
                <h2>評価</h2>
                <select name="post[evaluation_id]">
                    @foreach($evaluations as $evaluation)
                        <option value="{{ $evaluation->id }}" 
                        @if (old('post.evaluation_id')==$evaluation->id)
                            selected
                        @endif>
                            {{ $evaluation->level }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="explanation">
                <h2>説明(必須)</h2>
                <textarea name="post[explanation]" >{{ old('post.explanation') }}</textarea>
                <p class="explanation__error" style="color:red">{{ $errors->first('post.explanation') }}</p>
            </div>
            <div class="image">
                <h2>画像(任意)</h2>
                <input type="file" name="post[image_url]"  id="imageInput">
                <img id="imagePreview" src="#" alt="Image Preview" style="display: none;">
                 <p class="image__error" style="color:red">{{ $errors->first('post.image_url') }}</p>
            </div>
            
            <input type="submit" value="投稿">
        </form>
            <div class='footer'>
                 <a href="{{ back()->getTargetUrl() }}" class="btn btn-primary">戻る</a>
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