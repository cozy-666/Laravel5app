<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ニュース要約-TOP</title>
    {{--
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl mb-4">ニュース要約</h1>
        <form action="{{ route('news.index')}}" method="GET">
            <input type="text" name="keyword" class="border border-gray-300 p-2 rounded w-64" placeholder="キーワードを入力" value="">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">検索</button>
        </form>
        <div>
            @if(isset($articles))
                @foreach ($articles as $article)
                    <div class="mb-4 border border-gray-300 p-4 my-4 rounded">
                        <h2 class="text-lg font-bold">{{ $article['title'] }}</h2>
                        <p class="text-xs my-2">要約内容</p>
                        <div class="border border-blue-100 p-2 rounded-sm">{{ $article['summary'] }}</div>
                        <a href="{{ $article['url'] }}" target="_blank" class="text-blue-500">詳細を見る</a>
                    </div>
                @endforeach
            @endif
            @empty($articles)
                <p>記事が見つかりませんでした。</p>
            @endempty
        </div>
    </div>
    <script>
        // キーワードが入力されていない場合、アラートを表示
        document.querySelector('form').addEventListener('submit', (event) => {
            const keyword = document.querySelector('input[name="keyword"]').value;
            if (!keyword) {
                event.preventDefault();
                alert('キーワードを入力してください');
            }
        });
    </script>
</body>
</html>