<?php

namespace App\Http\Controllers\Pesan;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;

class AdminChatController extends Controller
{
    public function index()
    {
        $chats = Chat::with([
            'user',
            'messages'
        ])
            ->latest()
            ->get();

        return view(
            'admin.chat.index',
            compact('chats')
        );
    }

    public function show($id)
    {
        $chat = Chat::with([
            'user',
            'messages'
        ])
            ->findOrFail($id);

        return view(
            'admin.chat.show',
            compact('chat')
        );
    }
    public function send(
        Request $request,
        $id
    ) {
        $request->validate([

            'message' => 'required'

        ]);

        Message::create([

            'chat_id' => $id,

            'sender_role' => 'admin',

            'message' => $request->message

        ]);

        return redirect(
            '/admin/chat/' . $id
        );
    }
    public function open($id)
    {
        $user = User::findOrFail($id);

        $chat = Chat::firstOrCreate([
            'user_id' => $user->id
        ]);

        return redirect('/admin/chat/' . $chat->id);
    }
    public function destroy(Chat $chat)
    {
        $chat->messages()->delete(); 
        $chat->delete();

        return redirect('/admin/chat')->with('success', 'Percakapan berhasil dihapus.');
    }
}