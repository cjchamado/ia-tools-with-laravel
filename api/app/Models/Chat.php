<?php

namespace App\Models;

use Illuminate\Broadcasting\Channel;
use Illuminate\Database\Eloquent\BroadcastsEventsAfterCommit;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use BroadcastsEventsAfterCommit,
        HasFactory,
        HasUuids,
        SoftDeletes;

    protected $fillable = [
        'title',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function broadcastOn(string $event): array
    {
        return [
            new Channel('chats'),
        ];
    }

    public function broadcastConnection()
    {
        return 'sync';
    }
}
