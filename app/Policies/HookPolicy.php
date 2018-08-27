<?php

namespace App\Policies;

use App\User;
use App\Hook;
use Illuminate\Auth\Access\HandlesAuthorization;

class HookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the hook.
     *
     * @param  \App\User  $user
     * @param  \App\Thread  $thread
     * @return mixed
     */
    public function update(User $user, Hook $hook)
    {
        return $hook->user_id == $user->id;
    }
}
