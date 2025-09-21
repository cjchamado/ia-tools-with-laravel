<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use App\Models\Chat;
use App\Models\Message;

class ChatController extends Controller
{
    public function index()
    {
        return Chat::orderByDesc('id')->paginate();
    }

    public function store(StoreChatRequest $request)
    {
        $data = $request->validated();
        $data['title'] = substr($data['title'], 0, 150);

        $chat = Chat::create($data);

        $chat->messages()->create([
            'role' => Message::ROLE_USER,
            'content' => $data['content'],
        ]);

        return $chat;
    }

    public function show(Chat $chat)
    {
        return $chat;
    }

    public function update(UpdateChatRequest $request, Chat $chat)
    {
        $chat->update($request->validated());
        return $chat;
    }

    public function destroy(Chat $chat)
    {
        $chat->delete();
        return response()->json([], 204);
    }
}
