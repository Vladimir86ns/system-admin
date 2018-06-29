<?php

namespace App\Services\Owner;

use Sentinel;
use Redirect;

class OwnerService
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

            $permissions['investor'] = 1;
            $user->permissions = $permissions;
            $user->update();

            return Redirect::route("investor-dashboard")->with('success', trans('auth/message.signin.success'));
        }
    }

    /**
     * Registered new user and activate.
     *
     * @param array $attributes
     * @return array
     */
    public function registerAndActivateUser(array $attributes)
    {
        $permissions = [
            'owner' => 1,
        ];

        return Sentinel::registerAndActivate([
            'first_name' => $attributes['first_name'],
            'last_name' => $attributes['last_name'],
            'email' => $attributes['email'],
            'password' => $attributes['password'],
            'permissions' => $permissions
        ]);
    }
}
