<?php

namespace App\Http\Controllers;

use App\User;
use Redirect;
use Sentinel;
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
        $inputs =$request->all();
        $this->service->checkDoseUserExistsUpdatePermissionAndRedirect($inputs);

        $available = $this->validationService->isEmailAvailable($inputs['email']);

        if ($available) {
            return view('owner.login')->with('error', trans('auth/message.account_already_exists'));
        }

        try {
            $user = $this->service->registerAndActivateUser($inputs);

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

    /**
     * Logout page and redirect to chose status.
     *
     * @return Redirect
     */
    public function getLogout()
    {
        Sentinel::logout(Sentinel::getUser());

        return Redirect::route('chose-status')->with('success', 'You have successfully logged out!');
    }

    /**
     * Show owner project.
     *
     * @return Redirect
     */
    public function showProject()
    {
        $ownerProject = $this->service->getProject();

        return view('owner.show.index', compact('ownerProject'));
    }
}
