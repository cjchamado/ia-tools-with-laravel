<?php

namespace App\Broadcasting;

use App\Models\Chat;
use App\Models\User;

class ChatChannel
{
    public function __construct() {}

    public function join(User $user, Chat $chat): array|bool
    {
        return true;
    }
}
