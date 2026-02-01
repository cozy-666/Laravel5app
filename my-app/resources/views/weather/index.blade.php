<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>天気アプリ-TOP</title>
    {{--
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="warp flex items-center justify-center h-screen bg-gray-300">
    <div class="container mx-auto p-4 w-64 bg-white shadow-lg rounded-md">
        <div>
          <svg width="72" height="72" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
            <!-- 太陽 -->
            <circle cx="22" cy="22" r="12" fill="#FFD700" />
            <line x1="22" y1="4" x2="22" y2="0" stroke="#FFD700" stroke-width="2" />
            <line x1="22" y1="40" x2="22" y2="44" stroke="#FFD700" stroke-width="2" />
            <line x1="4" y1="22" x2="0" y2="22" stroke="#FFD700" stroke-width="2" />
            <line x1="40" y1="22" x2="44" y2="22" stroke="#FFD700" stroke-width="2" />
            <line x1="9" y1="9" x2="5" y2="5" stroke="#FFD700" stroke-width="2" />
            <line x1="35" y1="9" x2="39" y2="5" stroke="#FFD700" stroke-width="2" />
            <line x1="9" y1="35" x2="5" y2="39" stroke="#FFD700" stroke-width="2" />
            <line x1="35" y1="35" x2="39" y2="39" stroke="#FFD700" stroke-width="2" />
        
            <!-- 雲 -->
            <g fill="#C0C0C0" transform="translate(18, 18)">
                <ellipse cx="24" cy="24" rx="12" ry="8" />
                <ellipse cx="16" cy="24" rx="8" ry="5" />
                <ellipse cx="32" cy="24" rx="8" ry="5" />
            </g>
        </svg>  
        </div>
        <h1 class="text-2xl font-bold mb-4 ">天気予報-{{$city}}</h1>
        <select name="city" id="city-selector" class="mb-4 p-2 border border-gray-300 rounded">
            
            @foreach ($cities as $c)
                <option value="{{$c['english_name']}}" @selected($c['english_name'] === $city->name)>{{$c['kanji_name']}}</option>
            @endforeach
        </select>
        <div>
            <p>時刻: {{ date('Y-m-d H:i', strtotime($weatherData['current']['time'])) }}</p>
            <p>気温: {{$weatherData['current']['temperature_2m']}}°</p>
            <p>風速: {{$weatherData['current']['wind_speed_10m']}} m/s</p>
        </div>
        <button type="button" class="bg-blue-500 text-white p-2 mt-2 rounded" onclick="openModal()">詳細を見る</button>
    </div>
    <div id="weatherModal" class="fixed insert-0 hidden">
        <div class="flex items-center justify-center h-screen">
            <div class="bg-gray-100 rounded-lg shadow-lg  w-80 max-md:w-96 overflow-y-auto p-4">
                <div class="flex items-center justify-between border-b pb-2">
                    <h2 class="text-xl font-bold">詳細な天気データ</h2>
                    <button type="button" class="text-gray-600 hover:text-gray-800" onclick="closeModal()">&times;</button>
                </div>
                <div class="mt-4 overflow-scroll h-52">
                    <ul>
                        @foreach ($weatherData['hourly']['time'] as $index => $hourlyTime)
                            <li class="border-b py-2">
                                <span class="font-bold">
                                    {{date('Y-m-d H:i', strtotime($hourlyTime))}}: {{$weatherData['hourly']['temperature_2m'][$index]}}°
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        document.getElementById('city-selector').addEventListener('change', (event) => {
            const city = event.target.value;
            window.location.href = `/weather?city=${city}`;
            
        });

        function openModal(){
            console.log('詳細データ');
            document.getElementById('weatherModal').classList.remove('hidden');
        }
        function closeModal(){
            document.getElementById('weatherModal').classList.add('hidden');
        }
    </script>
</body>
</html>