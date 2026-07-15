<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Services\WebsiteAssistantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    public function store(Request $request, string $conversationId): JsonResponse
    {
        $data = $request->validate([
            'content' => 'required|string|max:1800',
        ]);

        $conversation = Conversation::find($conversationId);

        if (!$conversation || $conversation->status === 'closed') {
            return response()->json(['message' => 'Conversation not found or closed.'], 404);
        }

        $message = ConversationMessage::create([
            'conversation_id' => $conversation->id,
            'role' => 'user',
            'content' => $data['content'],
        ]);

        $conversation->update(['last_message_at' => now()]);

        $assistant = app(WebsiteAssistantService::class);
        $reply = $assistant->handleUserMessage($conversation, $data['content']);

        return response()->json([
            'user' => ['content' => $message->content],
            'assistant' => ['content' => $reply],
        ]);
    }
}
