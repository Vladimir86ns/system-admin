<?php 

namespace App\Services\Investment;

use App\Investment;
use App\InvestmentsAdmin;
use Sentinel;
use League\Fractal\Resource\Collection;
use Illuminate\Database\Eloquent\Collection as ObjectCollection;
use League\Fractal\Manager as FractalManager;
use App\Transformers\InvestmentsAdminTransformer;
use App\Transformers\InvestmentTransformer;

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
     * @var InvestmentTransformer
     */
    protected $investmentTransformer;

    /**
     * InvestmentController
     *
     * @param FractalManager $fractalManager
     * @param InvestmentsAdminTransformer $investmentsAdminTransformer
     * @param InvestmentTransformer $investmentTransformer
     */
    public function __construct(
        FractalManager $fractalManager,
        InvestmentsAdminTransformer $investmentsAdminTransformer,
        InvestmentTransformer $investmentTransformer
    ) {
        $this->fractal = $fractalManager;
        $this->investmentsAdminTransformer = $investmentsAdminTransformer;
        $this->investmentTransformer = $investmentTransformer;
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
        $this->updateUserInvestmentData($id, $attributes, $investment);

        return $this->investmentsAdminTransformer->transform($this->getInvestment($id));
    }

    /**
     * Update also and user investition data 
     *
     * @param int $id
     * @param array $attributes
     * @param InvestmentsAdmin $investment
     * 
     * @return 
     */
    public function updateUserInvestmentData(
        int $id,
        array &$attributes,
        InvestmentsAdmin $investment
    ) {
        $investment = $this->findInvestmentIfAlreadyHave($id);

        // if user has this investment just update it
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
        $user = $this->getUser();
        return Investment::where('id', $id)->where('user_id', $user->id)->first();
    }

    /**
     * Find user all investments
     *
     * @param int $id
     * 
     * @return Investment
     */
    public function findAllUserInvestments()
    {
        $user = $this->getUser();

        return Investment::where('user_id', $user->id)->get();
    }

    /**
     * Find user all admin investments
     *
     * @param ObjectCollection $investment
     * @return Investment
     */
    public function findAllUserAdminInvestments(ObjectCollection $investment)
    {
        $allProjectIds = $investment->pluck('project_id');

        return InvestmentsAdmin::whereIn('id', $allProjectIds)->get();
    }

    /**
     * Data from investments admin transformer
     * 
     * @param array $InvestmentsAdmin
     * @return array
     */
    public function useInvestmentsAdminTransformer(ObjectCollection $investmentsAdmin)
    {
        $result = new Collection($investmentsAdmin, $this->investmentsAdminTransformer);

        return $this->fractal->createData($result)->toArray();
    }

    /**
     * Data from investments transformer
     * 
     * @param array $attributes
     */
    public function useInvestmentsTransformer(ObjectCollection $investment)
    {
        $result = new Collection($investment, $this->investmentTransformer);

        return $this->fractal->createData($result)->toArray();
    }

    /**
     * Get logged in user
     *
     * @return User
     */
    private function getUser()
    {
        return Sentinel::getUser();
    }
}
