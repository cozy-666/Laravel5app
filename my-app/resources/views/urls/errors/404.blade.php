<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-8/12">
        <!-- SVG of an animal -->
        <svg class="w-64 h-64 mx-auto" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M256 0C114.613 0 0 114.616 0 256s114.613 256 256 256 256-114.616 256-256S397.387 0 256 0z"
                fill="#FFB6C1" />
            <path d="M352 352c-48.6 0-88-39.4-88-88s39.4-88 88-88 88 39.4 88 88-39.4 88-88 88z" fill="#F6E6DC" />
            <path d="M160 352c-48.6 0-88-39.4-88-88s39.4-88 88-88 88 39.4 88 88-39.4 88-88 88z" fill="#F6E6DC" />
            <path d="M352 320c-35.4 0-64-28.6-64-64s28.6-64 64-64 64 28.6 64 64-28.6 64-64 64z" fill="#654321" />
            <path d="M160 320c-35.4 0-64-28.6-64-64s28.6-64 64-64 64 28.6 64 64-28.6 64-64 64z" fill="#654321" />
            <path d="M208 352h96c0 26.4-21.6 48-48 48s-48-21.6-48-48z" fill="#FFFFFF" />
        </svg>
        <div class="mb-4 text-center">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">404- Page Not Found</h1>
            <p class="text-lg text-gray-600 mb-4">URL有効期限が切れているか、対応してないようです。</p>
            <a href="{{route('urls.index')}}" class="bg-blue-500 text-white px-4 py-2 rounded">短縮URLTOPへ</a>
        </div>
    </div>
</body>
</html>