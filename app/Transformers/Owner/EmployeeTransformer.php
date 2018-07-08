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
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name,
            'email' => $employee->email,
            'male' => $employee->male,
            'country' => $employee->country,
            'gender' => $employee->gender,
            'state' => $employee->state,
            'city' => $employee->city,
            'address' => $employee->address,
            'postal' => $employee->postal,
            'project_id' => $employee->project_id,
            'position' => 'position'
        ];
    }
}
