<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('to_user_id', Auth::id())
            ->orWhere('from_user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->with('fromUser', 'toUser', 'service')
            ->paginate(20);
        
        return view('messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'type' => 'nullable|in:general,update_request,notification',
            'service_id' => 'nullable|exists:services,id'
        ]);

        Message::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $request->to_user_id,
            'message' => $request->message,
            'type' => $request->type ?? 'general',
            'service_id' => $request->service_id
        ]);

        return back()->with('success', 'Pesan berhasil dikirim');
    }

    public function markAsRead(Message $message)
    {
        if ($message->to_user_id == Auth::id()) {
            $message->update(['read' => true]);
        }
        return back();
    }

    public function getUnreadCount()
    {
        $count = Message::where('to_user_id', Auth::id())
            ->where('read', false)
            ->count();
        
        return response()->json(['count' => $count]);
    }

    public function conversation($userId)
    {
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('from_user_id', Auth::id())
                  ->where('to_user_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('from_user_id', $userId)
                  ->where('to_user_id', Auth::id());
        })->with('fromUser', 'toUser', 'service')
          ->orderBy('created_at', 'asc')
          ->get();

        // Mark all messages to current user as read
        Message::where('from_user_id', $userId)
            ->where('to_user_id', Auth::id())
            ->update(['read' => true]);

        $otherUser = \App\Models\User::find($userId);
        
        return view('messages.conversation', compact('messages', 'otherUser'));
    }
}
