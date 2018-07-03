<?php

namespace App\Services\Employee;

use App\User;
use Sentinel;

class EmployeeValidationService
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
