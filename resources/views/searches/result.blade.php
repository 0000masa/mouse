
        <x-app-layout>
         <x-slot name="header">
             
        </x-slot>
            <h1>検索結果一覧</h1>
                <div class='result'>
                  @php
                        $selectedIds = [];
                @endphp
                @foreach($items as $item)
                    @php
                    
                    $articleId=$article->whereNotIn('id', $selectedIds)->where('product', $item->product)->first()->id;
                  
                    @endphp
              
                        <div class='result'>
                            <a href="/users/{{ $item->user->id }}">{{ $item->user->name }}</a>
                             <a href="/posts/{{$articleId}}"><h2 class='product'>{{$item->product}}</h2></a>
                            
                            <p class='explanation'>{{$item->explanation}}</p>
                            
                        </div>
                    @php
                    $selectedIds[]=$articleId
                    
                    @endphp
                @endforeach
             
                </div>
               <div class='paginate'>
                    {{ $items->links() }}
                </div>
                
                </x-app-layout>
    
