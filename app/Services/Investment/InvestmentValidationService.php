<?php 

namespace App\Services\Investment;

use App\User;

class InvestmentValidationService 
{
    public function isEmailAvailable(string $email)
    {   
        return User::where('email', $email)->exists();
    }
}
