<?php 

namespace App\Services\InvestmentsAdmin;

use App\InvestmentsAdmin;
use App\Transformers\InvestmentsAdminTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Manager as FractalManager;

class InvestmentsAdminService 
{
    /**
     * @var FractalManager
     */
    protected $fractal;

    /**
     * @var InvestmentsAdminTransformer
     */
    protected $investmentsAdminTransformer;

    /**
     * InvestmentsAdminController
     *
     * @param FractalManager $fractal
     */
    public function __construct(
        FractalManager $fractalManager,
        InvestmentsAdminTransformer $investmentsAdminTransformer
    ) {
        $this->fractal = $fractalManager;
        $this->investmentsAdminTransformer = $investmentsAdminTransformer;
    }

    /**
     * Get all investments
     *
     * @param FractalManager $fractal
     */
    public function getAllInvestments()
    {
        return InvestmentsAdmin::get();
    }

    /**
     * Get all investments from transformer
     * 
     * @param array $attributes
     */
    public function getAllInvestmentsFromTransformer()
    {
        $result = new Collection($this->getAllInvestments(), $this->investmentsAdminTransformer);

        return $this->fractal->createData($result)->toArray();
    }

    /**
     * Get single investment
     *
     * @param FractalManager $fractal
     */
    public function getInvestment($id)
    {
        return InvestmentsAdmin::find($id);
    }

    /**
     * Get single investment
     *
     * @param FractalManager $fractal
     */
    public function getInvestmentFromTransformer($id)
    {
        return $this->investmentsAdminTransformer->transform($this->getInvestment($id));
    }

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
