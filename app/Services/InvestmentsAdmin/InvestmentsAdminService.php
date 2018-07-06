<?php

namespace App\Services\InvestmentsAdmin;

use App\User;
use App\Project;
use App\InvestmentsAdmin;
use League\Fractal\Resource\Collection;
use League\Fractal\Manager as FractalManager;
use App\Transformers\InvestmentsAdminTransformer;

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
     * Update investment
     *
     * @param array $attributes
     * @param int $id
     */
    public function updateInvestment(array $attributes, int $id)
    {
        InvestmentsAdmin::where('id', $id)->update($attributes);
    }

    /**
     * Approve investment
     *
     * @param array $attributes
     */
    public function approveOrUnApproveInvestment(int $id)
    {
        $investmentsAdmin = InvestmentsAdmin::find($id);

        if ($investmentsAdmin['status'] === InvestmentsAdmin::APPROVED ||
            $investmentsAdmin['status'] === InvestmentsAdmin::REJECTED
        ) {
            $investmentsAdmin->update(['status' => InvestmentsAdmin::PENDING]);
        } elseif ($investmentsAdmin['status'] === InvestmentsAdmin::PENDING ||
            $investmentsAdmin['status'] === InvestmentsAdmin::REJECTED
        ) {
            $investmentsAdmin->update(['status' => InvestmentsAdmin::APPROVED]);
        }
    }

    /**
     * Rejected investment
     *
     * @param array $attributes
     */
    public function rejectOrDelete(int $id)
    {
        $investmentsAdmin = InvestmentsAdmin::find($id);

        if ($investmentsAdmin['status'] === InvestmentsAdmin::REJECTED) {
            $investmentsAdmin = InvestmentsAdmin::where('id', $id)->delete();
        } else {
            $investmentsAdmin->update(['status' => InvestmentsAdmin::REJECTED]);
        }
    }

    /**
     * Rejected investment
     *
     * @param array $attributes
     * @param int $id
     */
    public function createProject(array &$attributes, int $id)
    {
        $investmentsAdmin = InvestmentsAdmin::find($id);

        if ($investmentsAdmin['on_production']) {
            return false;
        }

        $attributes['total_amount'] = $investmentsAdmin->total_investition;
        $attributes['expense'] = $investmentsAdmin->total_investition;

        $investmentsAdmin->project()->create($attributes);
        $investmentsAdmin->on_production = true;
        $investmentsAdmin->update();

        return $investmentsAdmin->on_production;
    }

    /**
     * Get all owners
     *
     * @return User
     */
    public function getAllOwners()
    {
        return User::all()->filter(function ($value) {
            if (array_has($value['permissions'], 'owner')) {
                return $value;
            }
        })
        ->filter(function ($value) {
            return $value['permissions']['owner'] == 1;
        })->toArray();
    }
}
