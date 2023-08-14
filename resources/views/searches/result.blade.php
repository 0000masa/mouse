
        <x-app-layout>
         <x-slot name="header">
             
        </x-slot>
            <h1>検索結果一覧</h1>
                <div class='result'>
                @if($items->isEmpty())
                    <p>検索結果はありません。</p>
                @else
                  
                @foreach($items as $item)
                   
                    @php
                   $username = App\Models\User::where('id', $item->user_id)->first();
                    @endphp
                        <div class='result'>
                        
                            <a href="/users/{{ $item->user_id }}">{{ $username->name }}</a>
                             <a href="/posts/{{$item->id}}"><h2 class='product'>{{$item->product}}</h2></a>
                            
                            <p class='explanation'>{{$item->explanation}}</p>
                            
                        </div>
                   
                @endforeach
             　@endif
                </div>
               <div class='paginate'>
                    {{ $items->links() }}
                </div>
                
                </x-app-layout>
    
