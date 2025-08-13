<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>チャットアプリ-TOP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-2">
        <h1 class="text-2xl font-bold mb-4">チャットアプリ</h1>
        <form action="{{ route('chat_rooms.store') }}" method="POST" class="mb-4">
            @csrf
            <input type="text" name="name" class="border border-gray-300 p-2 rounded" placeholder="チャットルーム名" required>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">作成</button>
        </form>
        <ul class="border-b py-2 ">
            @foreach($chatRooms as $chatRoom)
                <li class="flex mb-3">
                    <p>{{$chatRoom->id}}.</p>
                    <p class="font-bold mr-1">{{$chatRoom->name}}</p>
                    <a href="{{ route('chat_rooms.show',$chatRoom)}}" class="bg-blue-500 hover:bg-blue-700 text-white px-2 rounded">入室する</a>
                </li>
            @endforeach
        </ul>
        @if($chatRooms->isEmpty())
            <p>チャットルームはありません。</p>
        @endif
    </div>
</body>
</html>