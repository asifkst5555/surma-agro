<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatSessionController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'channel' => 'nullable|string|max:50',
            'visitor_id' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:10',
        ]);

        $conversation = Conversation::create([
            'channel' => $data['channel'] ?? 'website_widget',
            'visitor_id' => $data['visitor_id'] ?? null,
            'language' => $data['language'] ?? 'en',
            'status' => 'active',
            'started_at' => now(),
            'last_message_at' => now(),
        ]);

        return response()->json([
            'conversation_id' => $conversation->id,
        ]);
    }

    public function reset(Request $request): JsonResponse
    {
        $data = $request->validate([
            'conversation_id' => 'nullable|string|exists:conversations,id',
            'channel' => 'nullable|string|max:50',
            'visitor_id' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:10',
        ]);

        if (!empty($data['conversation_id'])) {
            Conversation::where('id', $data['conversation_id'])->update([
                'status' => 'closed',
                'closed_at' => now(),
            ]);
        }

        $conversation = Conversation::create([
            'channel' => $data['channel'] ?? 'website_widget',
            'visitor_id' => $data['visitor_id'] ?? null,
            'language' => $data['language'] ?? 'en',
            'status' => 'active',
            'started_at' => now(),
            'last_message_at' => now(),
        ]);

        return response()->json([
            'conversation_id' => $conversation->id,
        ]);
    }
}
