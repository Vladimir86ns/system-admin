<?php

namespace App\Services\Employee;

use Sentinel;

class EmployeeService
{
    /**
     * If user already exists just update permissions
     *
     * @param array $attributes
     * @return Redirect
     */
    public function checkDoseUserExistsUpdatePermissionAndRedirect(array $attributes)
    {
        $user = Sentinel::authenticate([$attributes['email'], $attributes['password']]);

        if ($user) {
            $permissions = $user->permissions;

            $permissions['employee'] = 1;
            $user->permissions = $permissions;
            $user->update();

            return Redirect::route("employee-dashboard")->with('success', trans('auth/message.signin.success'));
        }
    }

    /**
     * Registered new employee and activate.
     *
     * @param array $attributes
     * @return array
     */
    public function registerAndActivateUser(array $attributes)
    {
        $permissions = [
            'employee' => 1,
        ];

        return Sentinel::registerAndActivate([
            'first_name' => $attributes['first_name'],
            'last_name' => $attributes['last_name'],
            'email' => $attributes['email'],
            'password' => $attributes['password'],
            'project_id' => $attributes['project_id'],
            'permissions' => $permissions
        ]);
    }
}
