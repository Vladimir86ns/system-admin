<?php 

namespace App\Services\InvestmentsAdmin;

use App\InvestmentsAdmin;

class InvestmentsAdminService 
{
    /**
     * Store new investments in DB
     * 
     * @param array $attributes
     */
    public function storeInvestments(array &$attributes)
    {
        $attributes['status'] = InvestmentsAdmin::PENDING;
        return InvestmentsAdmin::create($attributes);
    }
}