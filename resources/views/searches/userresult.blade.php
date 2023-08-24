 <x-app-layout>
         <x-slot name="header">
             
        </x-slot>
            <h1>検索結果一覧</h1>
                <div class='result'>
                @if($items->isEmpty())
                    <p>検索結果はありません。</p>
                @else
                  
                @foreach($items as $item)
                   
                        <div class='result'>
                        
                            <a href="/users/{{ $item->id }}">{{ $item->name }}</a>
                             
                            
                        </div>
                   
                @endforeach
             　@endif
                </div>
               <div class='paginate'>
                    {{ $items->links() }}
                </div>
                
                </x-app-layout>