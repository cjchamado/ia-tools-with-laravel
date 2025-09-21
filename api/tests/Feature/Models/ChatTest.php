<?php

use App\Models\Chat;

it('store a chat', function () {
    $data = [
        'title' => fake()->sentence(),
        'content' => fake()->word(),
    ];

    $uri = route('chats.store');

    $this->postJson($uri, $data)
        ->assertCreated();

    $this->assertDatabaseHas('chats', [
        'title' => $data['title'],
    ]);
})->group(
    'chats',
    'chat-actions',
    'chat-action-store',
);

it('update a chat', function () {
    $chat = Chat::factory()->create();

    $data = Chat::factory()->definition();
    $data['title'] .= ' IS CHANGED';

    $uri = route('chats.update', [
        'chat' => $chat,
    ]);

    $this->putJson($uri, $data)
        ->assertOk();

    $this->assertDatabaseHas('chats', [
        'title' => $data['title'],
    ]);
})->group(
    'chats',
    'chat-actions',
    'chat-action-update',
);

it('show a chat', function () {
    $chat = Chat::factory()->create();

    $uri = route('chats.show', [
        'chat' => $chat,
    ]);

    $this->getJson($uri)
        ->assertOk()
        ->assertJson([
            'id' => $chat->id,
            'title' => $chat->title,
        ]);
})->group(
    'chats',
    'chat-actions',
    'chat-action-show',
);

it('delete a chat', function () {
    $chat = Chat::factory()->create();

    $uri = route('chats.destroy', [
        'chat' => $chat,
    ]);

    $this->deleteJson($uri)
        ->assertNoContent();

    $this->assertDatabaseMissing('chats', [
        'id' => $chat->id,
    ]);
})->group(
    'chats',
    'chat-actions',
    'chat-action-destroy',
);

it('index a chat', function () {
    Chat::factory(30)->create();

    $uri = route('chats.index');

    $this->getJson($uri)
        ->assertOk()
        ->assertJson([
            'total' => 30,
            'current_page' => 1,
            'per_page' => 15,
        ]);
})->group(
    'chats',
    'chat-actions',
    'chat-action-index',
);
