<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Investment;

class InvestmentTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Investment $investment
     * @return array
     */
    public function transform(Investment $investment)
    {
        return [
            'id' => $investment->id,
            'total_investment' => number_format($investment->total_investment, 2),
            'percent_of_income' => 0 . ' %',
            'investment_collected_total' => number_format($investment->investment_collected_total, 2),
            'monthly_collected' => number_format($investment->monthly_collected, 2),
            'investment_collected' => number_format($investment->monthly_collected, 2),
            'name' => 'Project Name',
        ];
    }
}
