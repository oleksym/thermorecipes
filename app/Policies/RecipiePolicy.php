<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Recipie;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecipiePolicy
{
    use HandlesAuthorization;

    public function update(User $user, Recipie $recipie)
    {
        return $user->id === $recipie->user_id;
    }
}
