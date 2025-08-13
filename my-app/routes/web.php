<?php

use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// TodoリストApp
Route::get('/tasks', [TaskController::class,'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class,'store'])->name('tasks.store');
Route::put('/tasks/{id}', [TaskController::class, 'maskAsDeleted'])->name('tasks.maskAsDeleted');

Route::get('/tasks/trash', [TaskController::class,'trash'])->name('tasks.trash');
Route::put('/tasks/{id}/recover', [TaskController::class,'recover'])->name('tasks.recover');
Route::delete('/tasks/delete', [TaskController::class,'deleteTrash'])->name('tasks.deleteTrash');

// 天気App
Route::get('/weather', [WeatherController::class,'index'])->name('weather.index');

// ニュースApp
Route::get('/news', [NewsController::class,'index'])->name('news.index');

// チャットApp
Route::get('/chat_rooms', [ChatRoomController::class,'index'])->name('chat_rooms.index');
Route::post('/chat_rooms', [ChatRoomController::class,'store'])->name('chat_rooms.store');
Route::get('/chat_rooms/{chatRoom}', [ChatRoomController::class,'show'])->name('chat_rooms.show');
Route::post('messages', [MessageController::class,'store'])->name('messages.store');
Route::get('messages/{chatRoomId}', [MessageController::class,'index'])->name('messages.index');

// Short URL App
Route::get('/urls', [UrlController::class,'index'])->name('urls.index');
Route::post('/urls', [UrlController::class,'store'])->name('urls.store');
Route::get('/{shortUrl}', [UrlController::class,'redirect'])->name('urls.redirect');