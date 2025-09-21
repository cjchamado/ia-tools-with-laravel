<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;

class MessageController extends Controller
{
    public function index(
        Chat $chat
    ) {
        return $chat
            ->messages()
            ->orderByDesc('id')
            ->paginate();
    }

    public function store(
        Chat $chat
    ) {
        return $chat->messages()->create([
            'role' => Message::ROLE_USER,
            'content' => request('content'),
        ]);
    }
}
