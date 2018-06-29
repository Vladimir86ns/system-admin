<?php

namespace App\Services\Owner;

use App\User;

class OwnerValidationService
{
    /**
     * Check user exists with email.
     *
     * @param string $email
     */
    public function isEmailAvailable(string $email)
    {
        return User::where('email', $email)->exists();
    }
}
