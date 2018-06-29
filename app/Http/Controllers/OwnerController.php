<?php

namespace App\Http\Controllers;

use Sentinel;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Requests\OwnerRequest;
use App\Services\Owner\OwnerService;
use App\Services\Owner\OwnerValidationService;

class OwnerController extends Controller
{
    /**
     * @var OwnerValidationService
     */
    protected $validationService;

    /**
     * @var OwnerService
     */
    protected $service;

    /**
     * OwnerController
     *
     */
	public function __construct(
        OwnerValidationService $investmentValidationService,
        OwnerService $investmentService
    ) {
        $this->validationService = $investmentValidationService;
        $this->service = $investmentService;
    }

    /**
     * Account sign in.
     *
     * @return View
     */
    public function getSignIn()
    {
        // Is the user logged in?
        if (Sentinel::check()) {
            return redirect::route('owner-dashboard');
        }

        // Show the page
        return view('owner.login');
    }

    /**
     * Account owner sign up form processing.
     *
     * @return Redirect
     */
    public function postSignUp(OwnerRequest $request)
    {
        $user = Sentinel::authenticate($request->only(['email', 'password']));

        if ($user) {
            $permissions = $user->permissions;

            $permissions['owner'] = 1;
            $user->permissions = $permissions;
            $user->update();

            return Redirect::route("owner-dashboard")->with('success', trans('auth/message.signin.success'));
        }

        $available = $this->validationService->isEmailAvailable($request->get('email'));

        if ($available) {
            return view('owner.login')->with('error', trans('auth/message.account_already_exists'));
        }

        $permissions = [
            'owner' => 1,
        ];

        try {
            // Register the user as investor
            $user = Sentinel::registerAndActivate([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'password' => $request->get('password'),
                'permissions' => $permissions
            ]);

            // TO DO SOME DAY
            //add user to 'User' group as Investor
            // $role = Sentinel::findRoleById(1);
            // $role->users()->attach($user);


            // Log the user in
            Sentinel::login($user, false);

            // Redirect to the dashboard page
            return Redirect::route("owner-dashboard")->with('success', trans('auth/message.signin.success'));

        } catch (UserExistsException $e) {
            $this->messageBag->add('email', trans('auth/message.account_already_exists'));
        }

        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    /**
     * Account sign in form processing.
     * @param Request $request
     * @return Redirect
     */
    public function postSignIn(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (empty($user)) {
            return view('owner.login')->with('error', 'Your email or password are not correct!');
        }

        try {
            // Try to log the user in
            if (Sentinel::authenticate($request->only(['email', 'password']), $request->get('remember-me', false))) {
                // Redirect to the dashboard page
                return Redirect::route("owner-dashboard")->with('success', trans('auth/message.signin.success'));
            }

            $this->messageBag->add('email', trans('auth/message.account_not_found'));

        } catch (NotActivatedException $e) {
            $this->messageBag->add('email', trans('auth/message.account_not_activated'));
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            $this->messageBag->add('email', trans('auth/message.account_suspended', compact('delay')));
        }
    }

    /**
     * Show dashboard for owner.
     *
     * @return Redirect
     */
    public function showHome()
    {
        if (Sentinel::check())
			return view('owner.index');
		else
			return view('owner.login')->with('error', 'You must be logged in!');
    }
}
