<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\InvestmentsAdmin;

class InvestmentsAdminTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param InvestmentsAdmin $investmentsAdmin
     * @return array
     */
    public function transform(InvestmentsAdmin $investmentsAdmin)
    {
        return [
            'id' => $investmentsAdmin->id,
            'name' => $investmentsAdmin->name,
            'total_investition' => number_format($investmentsAdmin->total_investition, 2),
            'collected_to_date' => number_format($investmentsAdmin->collected_to_date, 2),
            'city' => $investmentsAdmin->city,
            'country' => $investmentsAdmin->country,
            'address' => $investmentsAdmin->address,
            'closed' => $investmentsAdmin->closed,
            'status' => $investmentsAdmin->status,
            'left_to_invest' =>number_format(
                ($investmentsAdmin->total_investition - $investmentsAdmin->collected_to_date),
                2
            ),
            'on_production' => $investmentsAdmin->on_production,
        ];
    }
}
