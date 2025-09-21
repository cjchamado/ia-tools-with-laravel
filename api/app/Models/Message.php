<?php

namespace App\Models;

use Illuminate\Broadcasting\Channel;
use Illuminate\Database\Eloquent\BroadcastsEventsAfterCommit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use BroadcastsEventsAfterCommit,
        HasFactory;

    const ROLE_SYSTEM = 'system';
    const ROLE_USER = 'user';
    const ROLE_ASSISTANT = 'assistant';
    const ROLE_TOOL = 'tool';

    protected $fillable = [
        'chat_id',
        'role',
        'content',
    ];

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    public function broadcastOn(string $event): array
    {
        return [
            new Channel(sprintf('chats.%s', $this->chat->id)),
        ];
    }

    public function broadcastConnection()
    {
        return 'sync';
    }
}
