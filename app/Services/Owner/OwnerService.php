<?php

namespace App\Services\Owner;

use App\User;
use Redirect;
use Sentinel;
use League\Fractal\Resource\Collection;
use App\Transformers\OwnerTransformer;
use League\Fractal\Manager as FractalManager;
use App\Transformers\Owner\EmployeeTransformer;

class OwnerService
{
    /**
     * @var FractalManager
     */
    protected $fractal;

    /**
     * @var transformer
     */
    protected $transformer;

    /**
     * Controller
     *
     * @param FractalManager $fractalManager
     * @param OwnerTransformer $transformer
     */
    public function __construct(
        FractalManager $fractalManager,
        OwnerTransformer $transformer
    ) {
        $this->fractal = $fractalManager;
        $this->transformer = $transformer;
    }

    /**
     * Get owner project.
     *
     * @return array
     */
    public function getProject()
    {
        $ownerProject = Sentinel::getUser()->project;

        return $this->transformer->transform($ownerProject);
    }

    /**
     * Get owner project.
     *
     * @return array
     */
    public function getProjectId()
    {
        return Sentinel::getUser()->project->id;
    }

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

    /**
     * Save employee to project.
     *
     * @return array
     */
    public function saveEmployeeToProject(array $attributes, string $projectId, string $employeeId)
    {
        $user = User::findOrFail($employeeId);

        if (!$user) {
            return;
        }

        $attributesToSave = collect($attributes)->except(['name', 'email', 'btnSubmit'])->toArray();
        $user->employee_active = true;
        $user->update($attributesToSave);

        return $user;
    }

    /**
     * Get all employees.
     *
     * @return array
     */
    public function getAllEmployees()
    {
        $employeeTransformer = new EmployeeTransformer();

        $employees = User::where('project_id', $this->getProjectId())
            ->where('employee_active', 1)
            ->get();
        $result = new Collection($employees, $employeeTransformer);

        return $this->fractal->createData($result)->toArray();
    }
}
