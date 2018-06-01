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

    /**
     * Approve investment
     * 
     * @param array $attributes
     */
    public function approveOrUnApproveInvestment(int $id)
    {
        $InvestmentsAdmin = InvestmentsAdmin::find($id);

        if (
            $InvestmentsAdmin['status'] === InvestmentsAdmin::APPROVED || 
            $InvestmentsAdmin['status'] === InvestmentsAdmin::REJECTED
        ) {
            $InvestmentsAdmin->update(['status' => InvestmentsAdmin::PENDING]);
        } else if (
            $InvestmentsAdmin['status'] === InvestmentsAdmin::PENDING ||
            $InvestmentsAdmin['status'] === InvestmentsAdmin::REJECTED
        ) {
            $InvestmentsAdmin->update(['status' => InvestmentsAdmin::APPROVED]);
        }
    }

    /**
     * Rejected investment
     * 
     * @param array $attributes
     */
    public function rejectOrDelete(int $id)
    {
        $InvestmentsAdmin = InvestmentsAdmin::find($id);

        if ($InvestmentsAdmin['status'] === InvestmentsAdmin::REJECTED)
        {
            $InvestmentsAdmin = InvestmentsAdmin::where('id', $id)->delete();
        } else 
        {
            $InvestmentsAdmin->update(['status' => InvestmentsAdmin::REJECTED]);
        }
    }
}
