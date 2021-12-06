<?php

namespace App\Auth;

use Illuminate\Auth\SessionGuard;
use App\Enums\UserRole;

class AdminGuard extends SessionGuard
{
    protected function hasValidCredentials($user, $credentials)
    {
        if ($this->isAdmin($user)) {
            return parent::hasValidCredentials($user, $credentials);
        }

        return false;
    }

    private function isAdmin($user)
    {
        return $user->role === UserRole::SUB_ADMIN || $user->role === UserRole::ADMIN; 
    }
}