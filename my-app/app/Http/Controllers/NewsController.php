<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $articles = [];
        $keyword = $request->input('keyword');
        $articles = News::fetchNews($keyword);
        //テスト用
        // $articles = array(
        //     'status' => 'ok',
        //     'totalResults' => 29,
        //     'articles' => array(
        //         array(
        //             'source' => array(
        //                 'id' => NULL,
        //                 'name' => 'Jiji.com',
        //             ),
        //             'author' => '時事通信社, 時事通信 外信部',
        //             'title' => '民主最重鎮ペロシ氏「決断を」 バイデン氏に出馬再考示唆か―米大統領選 - 時事通信ニュース',
        //             'description' => '【ワシントン時事】米民主党のペロシ元下院議長（８４）は１０日、ＭＳＮＢＣテレビに出演し、大統領選からの撤退圧力に直面するバイデン大統領（８１）の去就に関し「選挙戦を続けるかは大統領次第だ。時間は少なく、私たちは決断を促している」と述べた。バイデン氏は撤退を重ねて否定しており、再考を迫ったとも受け取れる。党最重鎮の「爆弾発言」（米メディア）により、「バイデン降ろし」の動きが雪崩を打って進む可能性がある。',
        //             'url' => 'https://www.jiji.com/jc/article?k=2024071100158&g=int',
        //             'urlToImage' => 'https://www.jiji.com/news2/kiji_photos/202407/20240711at01S_o.jpg',
        //             'publishedAt' => '2024-07-11T02:19:00Z',
        //             'content' => NULL,
        //         ),
                // array(
                //     'source' => array(
                //         'id' => NULL,
                //         'name' => 'Famitsu.com',
                //     ),
                //     'author' => NULL,
                //     'title' => '魔法店経営シム『ポーショノミクス シルヴィアの魔法薬店』Switch/PS5版が11/28発売。客の要望に答えるポーションを研究・開発、交渉術デッキで売りまくれ - ファミ通',
                //     'description' => 'ハピネットは、Nintendo Switch、プレイステーション5（PS5）用ソフト『ポーショノミクス シルヴィアの魔法薬店』を、2024年11月28日（木）に発売する。',
                //     'url' => 'https://www.famitsu.com/article/202407/10354',
                //     'urlToImage' => 'https://cimg.kgl-systems.io/camion/files/10354/thumbnail.jpg',
                //     'publishedAt' => '2024-07-11T01:00:00Z',
                //     'content' => '(C)Voracious Games, LLC. Licensed to and published by XSEED Games / Marvelous USA, Inc.Licensed to and published in Japan by Happinet Corporation.',
                // ),
                // array(
                //     'source' => array(
                //         'id' => NULL,
                //         'name' => 'Nikkei.com',
                //     ),
                //     'author' => '日本経済新聞社',
                //     'title' => 'イラン新大統領、28日就任へ ペゼシュキアン氏 - 日本経済新聞',
                //     'description' => '【テヘラン=共同】イランの最高指導者事務所は10日、ペゼシュキアン次期大統領が28日に就任すると発表した。ペゼシュキアン氏は欧米との対話方針を掲げる。最高指導者ハメネイ師は、欧米との対立を深めたライシ政権の路線継続を勧めている。国営イラン通信による',
                //     'url' => 'https://www.nikkei.com/article/DGXZQOCB110F20R10C24A7000000/',
                //     'urlToImage' => 'https://article-image-ix.nikkei.com/https%3A%2F%2Fimgix-proxy.n8s.jp%2FDSXZQO5083555011072024000000-1.jpg?ixlib=js-3.8.0&auto=format%2Ccompress&fit=crop&bg=FFFFFF&w=1200&h=630&fp-x=0.17&fp-y=0.69&fp-z=1&crop=focalpoint&s=4d5cfe49c0689422b0b4fd4bb7507f89',
                //     'publishedAt' => '2024-07-11T00:57:15Z',
                //     'content' => NULL,
                // ),
        //     ),
        // );

        $summarizeArticles = [];
        if ($articles && isset($articles['articles'])) {
            foreach ($articles['articles'] as $article) {
                $jsonSummaryArticle = News::summarizeArticle($article['description']);
                $content = json_decode($jsonSummaryArticle->getContent(), true);
                $summarizeArticles[] = [
                    'title' => $article['title'],
                    'summary' => $content,
                    'url' => $article['url']
                ];
            }
        }


        return view('news.index',['articles' => $summarizeArticles]);
    }
}
