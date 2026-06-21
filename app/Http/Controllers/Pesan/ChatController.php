<?php

namespace App\Http\Controllers\Pesan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;

class ChatController extends Controller
{
    // =====================================================
    // HALAMAN CHAT
    // =====================================================
    public function index()
    {
        $chat = Chat::where(
            'user_id',
            session('user_id')
        )->first();

        return view(
            'user.chat',
            compact('chat')
        );
    }

    // =====================================================
    // KIRIM PESAN
    // =====================================================
    public function store(Request $request)
    {
        $request->validate([

            'message' => 'required'

        ]);

        // CEK ROOM CHAT
        $chat = Chat::firstOrCreate([

            'user_id' => session('user_id')

        ]);

        // SIMPAN PESAN
        Message::create([

            'chat_id' => $chat->id,

            'sender_role' => 'user',

            'message' => $request->message

        ]);

        return redirect('/chat');
    }
}