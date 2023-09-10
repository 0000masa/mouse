<x-app-layout>
            
         <x-slot name="header">
        
        </x-slot>
        <div class="bg-white py-6 sm:py-8 lg:py-12">
          <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl">プロフィール編集</h2>
        
            <form class="mx-auto max-w-lg rounded-lg border" action="/userprofile" method="POST"enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="post[user_id]" value="{{ Auth::user()->id }}">
              <div class=" gap-4 p-4 md:p-8">
                <div>
                  <p  class="mb-2 inline-block text-sm text-gray-800 sm:text-base">画像(2MBまで)</p>
                  <input name="post[image_url]"  id="imageInput" type="file" class="w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 ring-indigo-300 transition duration-100 " />
                  <img id="imagePreview" src="#"  class="hidden w-32 h-32 rounded-full object-cover" {{--style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;"--}}　>
                   <p class="explanation__error" style="color:red">{{ $errors->first('post.image_url') }}</p>
                </div>
               
                <div>
                  <p for="introduce" class="mb-2 inline-block text-sm text-gray-800 sm:text-base">自己紹介(200字まで)</p>
                  <textarea name="post[introduce]" class="h-64 w-full rounded border bg-gray-50 px-3 py-2 text-gray-800 outline-none ring-indigo-300 transition duration-100 focus:ring">{{ old('post.introduce') }}</textarea> 
                   <p class="explanation__error" style="color:red">{{ $errors->first('post.introduce') }}</p>
                </div>
                
                <div class="flex items-center justify-between sm:col-span-2">
                        <button class="inline-block rounded-lg bg-indigo-500 px-8 py-3 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base">OK</button>
                </div>
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