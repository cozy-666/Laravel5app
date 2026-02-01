<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'chat_room_id' => 'required|exists:chat_rooms,id',
            'nickname' => 'required|string|max:8',
            'message' => 'required|string',
        ]);
        $message = Message::create($request->all());
        Log::info(['message' => $message]);
        return response()->json($message);
    }
    public function index($ChatRoom)
    {
        return response()->json(Message::where('chat_room_id', $ChatRoom)->get());
    }
}
