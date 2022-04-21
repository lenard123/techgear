<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\NewCustomer;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $user->generateAvatar();

        $developer = User::where('email', config('site.admin.email'))->first();

        if ($developer) {
            $developer->notify(new NewCustomer($user));
        }

    }
}
