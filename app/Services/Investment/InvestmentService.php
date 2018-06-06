<?php 

namespace App\Services\Investment;

use App\InvestmentsAdmin;
use App\Transformers\InvestmentsAdminTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Manager as FractalManager;

class InvestmentService 
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
     * InvestmentController
     *
     * @param InvestmentsAdminTransformer $investmentsAdminTransformer
     */
    public function __construct(
        FractalManager $fractalManager,
        InvestmentsAdminTransformer $investmentsAdminTransformer
    ) {
        $this->fractal = $fractalManager;
        $this->investmentsAdminTransformer = $investmentsAdminTransformer;
    }

    /**
     * Get all investments from country where status approved
     *
     * @param string $country
     */
    public function getAllApprovedInvestments(string $country)
    {
        return InvestmentsAdmin::where('country', $country)
            ->where('status', InvestmentsAdmin::APPROVED)
            ->get();
    }

    /**
     * Get all investments from transformer
     * 
     * @param array $attributes
     */
    public function getAllFromTransformer(string $country)
    {
        $result = new Collection($this->getAllApprovedInvestments($country), $this->investmentsAdminTransformer);

        return $this->fractal->createData($result)->toArray();
    }
}
