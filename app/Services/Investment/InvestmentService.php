<?php 

namespace App\Services\Investment;

use App\Investment;
use App\InvestmentsAdmin;
use Sentinel;
use League\Fractal\Resource\Collection;
use League\Fractal\Manager as FractalManager;
use App\Transformers\InvestmentsAdminTransformer;

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
     * Get single investment
     *
     * @param FractalManager $fractal
     */
    public function getInvestment($id)
    {
        return InvestmentsAdmin::find($id);
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
     * Update investment and investition data for investment
     *
     * @param int $id
     * @param array $attributes
     * 
     * @return 
     */
    public function updateInvestment(int $id, array $attributes)
    {
        $investment = $this->getInvestment($id);
        $investment->total_investition -= $attributes['total_investment'];
        $investment->collected_to_date += $attributes['total_investment'];
        $investment->update();

        // update user investition
        $this->updateOfInvestorInvestmentData($id, $attributes, $investment);

        return $this->investmentsAdminTransformer->transform($this->getInvestment($id));
    }

    /**
     * Update also and of investor his investition data 
     *
     * @param int $id
     * @param array $attributes
     * @param InvestmentsAdmin $investment
     * 
     * @return 
     */
    public function updateOfInvestorInvestmentData(
        int $id,
        array &$attributes,
        InvestmentsAdmin $investment
    ) {
        $investment = $this->findInvestmentIfAlreadyHave($id);

        if ($investment) {
            $investment->total_investment += $attributes['total_investment'];
            $investment->update();

            return;
        }

        $user = Sentinel::getUser();
        $attributes['project_id'] = $investment->id;
        $user->investments()->create($attributes);
    }

    /**
     * Find investition if already have
     *
     * @param int $id
     * 
     * @return Investment
     */
    public function findInvestmentIfAlreadyHave($id)
    {
        $userId = Sentinel::getUser()->id;

        return Investment::where('id', $id)->where('user_id', $userId)->first();
    }
}
