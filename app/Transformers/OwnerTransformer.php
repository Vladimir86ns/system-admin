<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Project;

class OwnerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Project $project
     * @return array
     */
    public function transform(Project $project)
    {
        return [
            'id' => $project->id,
            'name' => $project->name,
            'total_amount' => number_format($project->total_amount, 2),
            'income' => number_format($project->income, 2),
            'expense' => number_format($project->expense, 2),
            'profit' => number_format($project->profit, 2),
            'profit_sharing' => number_format($project->profit_sharing, 2),
            'investment_collected' => number_format($project->investment_collected, 2),
            'phone_number' => $project->phone_number,
            'income' => number_format($project->income, 2),
            'owner_id' => $project->owner_id,
            'investments_admin_id' => $project->investments_admin_id,
            'positions' => $project->positions
        ];
    }
}
