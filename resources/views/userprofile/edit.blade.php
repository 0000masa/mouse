<x-app-layout>
            
         <x-slot name="header">
        
        </x-slot>
         @if (Auth::check() && $profile->user_id === Auth::user()->id)
        <div class="bg-white py-6 sm:py-8 lg:py-12">
          <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl">プロフィール編集</h2>
        
            <form class="mx-auto max-w-lg rounded-lg border" action="/userprofile/{{$profile->id}}" method="POST"enctype="multipart/form-data">
                @csrf
                @method('PUT')
               
              <div class=" gap-4 p-4 md:p-8">
                <div>
                  <p  class="mb-2 inline-block text-sm text-gray-800 sm:text-base">画像(2MBまで){{--<span class="text-red-500 text-sm">画像を変更しない場合でも画像を選択し直してください。</span>--}}</p>
                  <input name="post[image_url]"  id="imageInput" type="file" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 ring-indigo-300 transition duration-100 " />
                  <img id="imagePreview" src="{{$profile->image_url}}"  class=" w-32 h-32 rounded-full object-cover" 　>
                  <p class="explanation__error" style="color:red">{{ $errors->first('post.image_url') }}</p>
                </div>
               
                <div>
                  <p for="introduce" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">自己紹介(200字まで)</p>
                  <textarea name="post[introduce]" class="h-64 w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">@if ($errors->any()){{ old('post.introduce') }}@else{{ $profile->introduce }}@endif</textarea> 
                   <p class="explanation__error" style="color:red">{{ $errors->first('post.introduce') }}</p>
                </div>
                
                <div class="flex items-center justify-between sm:col-span-2">
                        <button class="inline-block rounded-lg bg-indigo-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base">OK</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        @else 
        編集権限がありません
        @endif
        <script>
          const imageInput = document.getElementById('imageInput');
          const imagePreview = document.getElementById('imagePreview');
           const profileImgUrl = "{{$profile->image_url}}";
        
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
              imagePreview.src = profileImgUrl;
              imagePreview.style.display = 'none';
            }
          });
        </script>
               
</x-app-layout>