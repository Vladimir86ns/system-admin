<?php

namespace App\Transformers\Owner;

use App\User;
use League\Fractal\TransformerAbstract;

class EmployeeTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param User $project
     * @return array
     */
    public function transform(User $employee)
    {
        return [
            'id' => $employee->id,
            'name' => $employee->first_name . ' ' . $employee->first_name,
            'email' => $employee->email,
            'position' => 'position'
        ];
    }
}
