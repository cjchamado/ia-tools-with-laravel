<?php

use App\Models\Chat;
use App\Models\Message;

it('index chat messages', function () {
    $chat = Chat::factory()->create();

    $data = [];
    for ($i = 0; $i < 50; $i++) {
        $data[] = Message::factory()->definition();
    }

    $chat->messages()->createMany($data);

    $this->assertCount(count($data), $chat->messages);

    $uri = route('chats.messages.index', [
        'chat' => $chat,
    ]);

    $this->getJson($uri)
        ->assertOk()
        ->assertJson([
            'total' => 50,
        ]);
})->group(
    'chat-messages',
    'chat-messages-index',
);

it('stote/proccess chat message', function () {
    $chat = Chat::factory()->create();

    $uri = route('chats.messages.store', [
        'chat' => $chat,
    ]);

    $this->postJson($uri, ['content' => fake()->sentence()])
        ->assertCreated()
        ->assertJson([
            'chat_id' => $chat->id,
        ]);
})->group(
    'chat-messages',
    'chat-messages-store',
);
