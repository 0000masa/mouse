<x-app-layout>
        <x-slot name="header">
        
        </x-slot>
            <form action="/usersearches/do" method="GET">
            @csrf

            <div class="form-group">
                <div>
                    <label for="">ユーザー名
                    <div>
                        <input type="text" name="user">
                        
                    </div>
                    </label>
                </div>

    
                
                <div>
                    <input type="submit" class="btn" value="検索">
                </div>
            </div>
        </form>
                
        </x-app-layout>