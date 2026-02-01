<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class News extends Model
{
    use HasFactory;

    //ニュースの取得
    public static function fetchNews($keyword=null)
    {
        $url = 'https://newsapi.org/v2/top-headlines?country=jp&apiKey=' . config('services.newsapi.key');

        //キーワードがある場合はキーワードを含むニュースを取得
        if($keyword){
            $url .= '&q=' . urlencode($keyword);
        }
        $response = Http::get($url);

        if($response->failed()){
            throw new \Exception('Failed to fetch news data');
        }        
        return $response->json();
    }

    public static function summarizeArticle($content)
    {
        $client = new Client();
        $apiKey = config('services.openai.key');

        $systemRole = 'あなたは優秀なWebライターです';
        $prompt ='以下の記事を100文字程度で要約してください。#記事 /\n' . $content;
        try {
            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $apiKey,
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => $systemRole],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'max_tokens' => 300,
                ],
                ]);
            $response = json_decode($response->getBody(), true);
            $summarizedContent =  $response['choices'][0]['message']['content'];
            return response()->json($summarizedContent);
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        throw new \Exception($e->getMessage());
    }
}
}
