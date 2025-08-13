<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>短縮URL-TOP</title>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-lg w-10/12">
        <h1 class="text-lg font-bold">短縮URL作成</h1>
        <form id="url-form">
            <input type="text" name="original_url" id="original_url" class="border border-gray-300 p-2 my-2 w-full" placeholder="Enter URL" required>
            <button type="submit" class="bg-blue-500 text-white p-2 mt-4 rounded w-full">短縮する</button>
        </form>
        <div id="result" class="mt-4"></div>
    </div>
    <script>
        document.getElementById('url-form').addEventListener('submit', async (event) => {
            let isUrl = checkVaildUrl();
            if (!isUrl) {
                return alert('有効なURLの形式ではありません');
            }
            event.preventDefault();
            const url = document.getElementById('original_url').value;
            try{
                const response = await fetch('/urls', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ original_url: url })
                });
                const data = await response.json();
                document.getElementById('result').innerHTML = `<p>ShortURL:<span id="shorten-url">${data.short_url}</span><button type="button" 
                        class=" absolute mx-1 border border-gray-300 hover:bg-slate-400 rounded" onclick="copyUrl('shorten-url')">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.15"
                                d="M3 12C3 10.8954 3.89543 10 5 10H12C13.1046 10 14 10.8954 14 12V19C14 20.1046 13.1046 21 12 21H5C3.89543 21 3 20.1046 3 19V12Z"
                                fill="#000000" />
                            <path
                                d="M17.5 14H19C20.1046 14 21 13.1046 21 12V5C21 3.89543 20.1046 3 19 3H12C10.8954 3 10 3.89543 10 5V6.5M5 10H12C13.1046 10 14 10.8954 14 12V19C14 20.1046 13.1046 21 12 21H5C3.89543 21 3 20.1046 3 19V12C3 10.8954 3.89543 10 5 10Z"
                                stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </p>`;
            }catch(e){
                console.error(e.message);
                alert('エラーが発生しました。');
            }
        });

        function checkVaildUrl() {
            const url = document.getElementById('original_url').value;
            const pattern = new RegExp(
            '^(https?:\\/\\/)?' + // protocol
            '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
            '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
            '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
            '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
            '(\\#[-a-z\\d_]*)?$',
            'i'
            ); // fragment locator
            return !!pattern.test(url);
        }

        function copyUrl(elementId) {
            let element = document.getElementById(elementId);

            navigator.clipboard.writeText(element.innerText)
                .then(() => {
                    console.log('コピーしました!');
                    
                    element.insertAdjacentHTML('afterend', '<div class="absolute bg-gray-800 text-white text-xs px-2 py-1 rounded">コピー！</div>');
                    setTimeout(() => {
                        document.querySelector('.bg-gray-800').remove();
                    }, 2000);
                })
                .catch((error) => {
                    console.error('Failed to copy!', error);
                });
        }
    </script>
</body>
</html>