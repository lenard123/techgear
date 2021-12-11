<?php

namespace App\Auth;

use Illuminate\Auth\SessionGuard;
use App\Enums\UserRole;

class CustomerGuard extends SessionGuard
{

    protected function hasValidCredentials($user, $credentials)
    {
        if ($user->role === UserRole::CUSTOMER) {
            return parent::hasValidCredentials($user, $credentials);
        }

        return false;
    }

}