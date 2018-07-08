<?php

namespace App\Services\Owner;

use App\User;
use Redirect;
use Sentinel;
use App\Project;
use App\ProjectPosition;
use Illuminate\Support\Facades\DB;
use App\Transformers\OwnerTransformer;
use League\Fractal\Resource\Collection;
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
     * @var employeeTransformer
     */
    protected $employeeTransformer;

    /**
     * Controller
     *
     * @param FractalManager $fractalManager
     * @param OwnerTransformer $transformer
     * @param EmployeeTransformer $employeeTransformer
     */
    public function __construct(
        FractalManager $fractalManager,
        OwnerTransformer $transformer,
        EmployeeTransformer $employeeTransformer
    ) {
        $this->fractal = $fractalManager;
        $this->transformer = $transformer;
        $this->employeeTransformer = $employeeTransformer;
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
    public function saveEmployeeToProject(array $attributes, string $employeeId)
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
        $employees = User::where('project_id', $this->getProjectId())
            ->where('employee_active', 1)
            ->get();
        $result = new Collection($employees, $this->employeeTransformer);

        return $this->fractal->createData($result)->toArray();
    }

    /**
     * Get employee details.
     *
     * @param string
     * @return array
     */
    public function getEmployee(string $id)
    {
        $employee = User::findOrFail($id);

        return $this->employeeTransformer->transform($employee);
    }

    /**
     * Save project positions
     *
     * @param array $attributes
     * @param string $id
     * @return array
     */
    public function balkCreateProjectPositions(array $attributes, string $id)
    {
        $allNames = explode(',', $attributes['position']);
        $project = Project::findOrFail($id);

        DB::transaction(function () use ($allNames, $project) {
            foreach ($allNames as $name) {
                $projectPosition = new ProjectPosition();
                $projectPosition->name = $name;
                $project->positions()->save($projectPosition);
            }
        });

        return $attributes['position'];
    }
}
