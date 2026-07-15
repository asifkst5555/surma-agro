<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ChatSessionController;
use App\Http\Controllers\Api\ChatMessageController;
use App\Http\Controllers\Api\ChatHistoryController;

Route::post('/chat/session', [ChatSessionController::class, 'store']);
Route::post('/chat/reset', [ChatSessionController::class, 'reset']);
Route::post('/chat/message/{conv}', [ChatMessageController::class, 'store']);
Route::get('/chat/history/{conv}', [ChatHistoryController::class, 'show']);
