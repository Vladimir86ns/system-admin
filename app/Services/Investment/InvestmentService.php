<?php

namespace App\Services\Investment;

use App\Investment;
use App\InvestmentsAdmin;
use Sentinel;
use Charts;
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
            ->where('on_production', 1)
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
        $investment->collected_to_date += $attributes['total_investment'];
        $investment->closed = $investment->total_investition == $investment->collected_to_date;
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

        $newInvestment = $this->findAdminSelectedToInvest($id);

        $user = Sentinel::getUser();
        $attributes['project_id'] = $newInvestment->id;
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
     * Find investition if already have
     *
     * @param int $id
     *
     * @return Investment
     */
    public function findInvestment($id)
    {
        $user = $this->getUser();
        return Investment::where('project_id', $id)->where('user_id', $user->id)->first();
    }

    /**
     * Find admin investition where want to invest
     *
     * @param int $id
     *
     * @return InvestmentsAdmin
     */
    private function findAdminSelectedToInvest($id)
    {
        return InvestmentsAdmin::where('id', $id)->first();
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
     * Get statistic for selected investment
     *
     * @param Investment $investment
     * @param InvestmentsAdmin $investmentsAdmin
     */
    public function getChartPie(Investment $investment, InvestmentsAdmin $investmentsAdmin)
    {
        $collected = $investment->investment_collected_total;
        $invested = $investment->total_investment;

        return Charts::create('pie', 'fusioncharts')
            ->title($investmentsAdmin->name)
            ->labels(['Collected', 'Invested'])
            //    ->responsive(true)
            ->values([$collected, $invested])
            ->dimensions(0,400);
    }

    /**
     * Data from investments transformer
     *
     * @param Investment $investment
     * @param InvestmentsAdmin $adminSelected
     * @return array
     */
    public function useInvestmentsTransformer(Investment $investment, InvestmentsAdmin $adminSelected)
    {
        return $this->investmentTransformer->transform($investment, $adminSelected);
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
