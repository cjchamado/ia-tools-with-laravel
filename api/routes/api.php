<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/chats', ChatController::class);
Route::apiResource('chats.messages', MessageController::class)->only([
    'index',
    'store',
]);
