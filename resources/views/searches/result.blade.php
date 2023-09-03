
        <x-app-layout>
         <x-slot name="header">
             
        </x-slot>
        <div class="bg-white py-6 sm:py-8 lg:py-12">
            <div class="mx-auto max-w-screen-md px-4 md:px-8">
                <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl xl:mb-12">検索結果一覧</h2>
                    <div class="mb-4 flex items-center justify-between border-t border-b py-4">
                        <div class="divide-y">    
                            @if($items->isEmpty())
                                <p>検索結果はありません。</p>
                            @else
                              
                            @foreach($items as $item)
                               
                                @php
                               $username = App\Models\User::where('id', $item->user_id)->first();
                                @endphp
                                    <div class='flex flex-col gap-3 py-4 md:py-8'>
                                        <div class="block font-bold">
                                            <p class="block text-sm text-gray-500">ユーザー:
                                            <a class="text-lg font-bold text-gray-800 lg:text-xl" href="/users/{{ $item->user_id }}">{{ $username->name }}</a></p>
                                            <p class="block text-sm text-gray-500">マウス:
                                            <a class="text-lg font-bold text-gray-800 lg:text-xl" href="/posts/{{$item->id}}">{{$item->product}}</a></p>
                                            
                                            <p class='block text-sm text-gray-500'>説明:
                                            <span  class="text-base  text-gray-800 ">{{$item->explanation}}</span></p>
                                        </div>
                                    </div>
                               
                            @endforeach
                         　@endif
                         　<div class='paginate'>
                                {{ $items->links() }}
                            </div>
                        </div>
                    </div>
            </div>
        </div>        
      
        
        </x-app-layout>
    
