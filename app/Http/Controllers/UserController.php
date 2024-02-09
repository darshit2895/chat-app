<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Events\MessageEvent;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function loadDashboard() {
        $users = User::whereNotIn('id', [ auth()->user()->id ])->get();
        return view('dashboard', compact('users'));
    }
    
    public function saveChat(Request $request) {

        $chat = Chat::create([
                'sender_id' => $request->sender_id,
                'receiver_id' => $request->receiver_id,
                'message' => $request->message,
            ]);

            $senderUsers = User::where('id', $request->sender_id)->first();
            $receiverUser = User::where('id', $request->receiver_id)->first();

            event(new MessageEvent($chat, $senderUsers, $receiverUser));

        try {
            return response()->json(['success' => true, 'data' => $chat]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()]);
        }
    }

    public function loadChats(Request $request) {

        $chats = Chat::where(function($query) use ($request) {
                        $query->where('sender_id', $request->sender_id)->orWhere('receiver_id', $request->sender_id);
                    })->where(function($query) use ($request) {
                        $query->where('sender_id', $request->receiver_id)->orWhere('receiver_id', $request->receiver_id);
                    })->get();

        try {
            return response()->json(['success' => true, 'data' => $chats]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()]);
        }
    }

    
}
