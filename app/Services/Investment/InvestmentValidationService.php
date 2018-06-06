<?php 

namespace App\Services\Investment;

use App\User;
use App\InvestmentsAdmin;

class InvestmentValidationService 
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
