<?php 

namespace App\Services\Investment;

use App\User;
use App\InvestmentsAdmin;
use App\Services\Investment\InvestmentService;

class InvestmentValidationService 
{
    /**
     * @var InvestmentService
     */
    protected $investmentService;

    /**
     * InvestmentValidationService
     *
     * @param InvestmentService $investmentService
     */
    public function __construct(
        InvestmentService $investmentService
    ) {
        $this->investmentService = $investmentService;
    }

    /**
     * Check user exists with email.
     *
     * @param string $email
     */
    public function isEmailAvailable(string $email)
    {   
        return User::where('email', $email)->exists();
    }

    /**
     * Check dose investment is less then total amount to pay of investition
     *
     * @param string $email
     * @param int $id
     */
    public function validateInvest($totalInvestment, $id)
    {
        $error = [];
        $adminInvestment = $this->investmentService->getInvestment($id);

        $sumToPayOff = $adminInvestment->total_investition - $adminInvestment->collected_to_date;

        if ($sumToPayOff < $totalInvestment) {
            $formated = number_format($sumToPayOff, 2);
            $error['total_investment'] = "You can't invest more then {$formated}.";
        }

        return $error;
    }
}
