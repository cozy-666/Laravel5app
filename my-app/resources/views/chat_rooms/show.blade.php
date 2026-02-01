<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>>チャットアプリ-{{$chatRoom->name}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-blue-100">
    <div class="container mx-auto p-2">
        <div class="my-2">
            <a href="{{ route('chat_rooms.index')}}" class="border border-gray-300 p-2 rounded">TOPへ</a>
        </div>
        
        <h1 class="text-xl font-bold text-gray-700">{{$chatRoom->name}}</h1>
        <div id="messages" class="bg-white h-96 overflow-scroll mb-6 p-2"></div>
        <form id="message-form" class="space-y-4">
            <input type="hidden" name="chat_room_id" value="{{ $chatRoom->id}}">
        <div>
            <div><label for="nickname" class="text-gray-700 mb-2 text-xs">名前</label></div>
            <input type="text" name="nickname" id="nickname" required maxlength="8" placeholder="yamada" class="p-1 rounded shadow">
        </div>
        <div>
            <div><label for="message" class="text-gray-700 mb-2 text-xs">メッセージ</label></div>
            <textarea name="message" id="message"  rows="3" required class="p-1 rounded shadow"></textarea>
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-700">送信</button>
        </form>
    </div>
    <script>
        document.getElementById('message-form').addEventListener('submit', (event) => {
            event.preventDefault();
            const formData = new FormData(document.getElementById('message-form'));
            try{
                const response = fetch('{{route('messages.store')}}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                //メッセージを表示
                const messageDiv = document.getElementById('messages');
                const newMessage = document.createElement('div');
                newMessage.classList.add('flex', 'justify-end');
                newMessage.innerHTML = `
                    <div class="max-w-xs bg-blue-500 text-white mb-2 p-4 rounded-lg shadow-lg">
                        <p class="text-sm font-semibold">${data.nickname}</p>
                        <p>${data.message}</p>
                    </div>
                `;
                messageDiv.appendChild(newMessage);

                //送信したメッセージを削除
                document.getElementById('message').value = '';
                messageDiv.scrollTop = messageDiv.scrollHeight;
                });
            }catch(e){
                console.error(e.message);
                alert('エラーが発生しました。');
            }
        });

        function loadMessages()
        {
            fetch('{{route('messages.index', $chatRoom->id)}}')
            .then(response => response.json())
            .then(data => {
                const messageDiv = document.getElementById('messages');
                messageDiv.innerHTML = '';
                data.forEach(message => {
                    const newMessage = document.createElement('div');
                    const formatDate = new Date(message.created_at).toLocaleString();
                    
                    newMessage.innerHTML = `
                        <div class="max-w-xs bg-gray-200 text-gray-800 mt-2 p-4 rounded-lg shadow-lg ">
                            <p class="text-xs text-gray-400 font-semibold">${message.nickname}</p>
                            <p>${message.message}</p>
                        </div>
                        <p class="text-xs">${formatDate}</p>
                    `;
                    messageDiv.appendChild(newMessage);
                });
                messageDiv.scrollTop = messageDiv.scrollHeight;
            });
        }
        loadMessages();
        setInterval(loadMessages, 5000);
    </script>
</body>
</html>