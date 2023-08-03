<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>mouse</title>
        
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <x-app-layout>
        
            <form action="/searches/do" method="GET">
            @csrf

            <div class="form-group">
                <div>
                    <label for="">マウス名
                    <div>
                        <input type="text" name="product" value="{{ $product }}">
                    </div>
                    </label>
                </div>

                <div>
                    <label for="">メーカー
                    <div>
                        <select name="manufacture" data-toggle="select">
                            <option value="">全て</option>
                             @foreach($manufactures as $manufacture)
                                <option value="{{ $manufacture->id }}">{{ $manufacture->name }}</option>
                             @endforeach
                        </select>
                    </div>
                    </label>
                </div>

                <div>
                    <label for="">接続方式
                    <div>
                        <select name="connection" data-toggle="select">
                            <option value="">全て</option>
                            @foreach($connections as $connection)
                                <option value="{{ $connection->id }}">{{ $connection->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    </label>
                </div>

                <div>
                    <label for="">使用電池
                    <div>
                        <select name="battery" data-toggle="select">
                            <option value="">全て</option>
                            @foreach($batteries as $battery)
                                <option value="{{ $battery->id }}">{{ $battery->battery }}</option>
                            @endforeach
                        </select>
                    </div>
                    </label>
                </div>
                <div>
                    <label for="">評価
                    <div>
                        <select name="evaluation" data-toggle="select">
                            <option value="">全て</option>
                            @foreach($evaluations as $evaluation)
                                <option value="{{ $evaluation->id }}">{{ $evaluation->level }}</option>
                            @endforeach
                        </select>
                    </div>
                    </label>
                </div>
                
                <div>
                    <input type="submit" class="btn" value="検索">
                </div>
            </div>
        </form>
                
        </x-app-layout>
    </body>
</html>