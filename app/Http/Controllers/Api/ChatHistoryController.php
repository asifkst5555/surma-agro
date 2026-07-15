<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\JsonResponse;

class ChatHistoryController extends Controller
{
    public function show(string $conversationId): JsonResponse
    {
        $conversation = Conversation::with('messages')->find($conversationId);

        if (!$conversation) {
            return response()->json(['message' => 'Conversation not found.'], 404);
        }

        $messages = $conversation->messages->map(fn ($msg) => [
            'role' => $msg->role,
            'content' => $msg->content,
            'created_at' => $msg->created_at,
        ]);

        return response()->json([
            'conversation_id' => $conversation->id,
            'messages' => $messages,
        ]);
    }
}
