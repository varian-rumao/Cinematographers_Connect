<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Content;

class ContentPolicy
{
    public function delete(User $user)
    {
        return $user->role->name === 'admin';
    }

    public function manage(User $user)
    {
        return $user->role->name === 'admin';
    }
}
